<?php
$tipos_alumnoextranjero = array(
    'alumno' => 'Alumno',
    'externo' => 'Externo'
);
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
$nombreArchivo_fichaingreso = ""; // Agrega esta línea para inicializar la variable
$nombreArchivo_comprobantepago = ""; // Agrega esta línea para inicializar la variable
if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $conexion->prepare("SELECT * FROM nuevoingreso WHERE idNuevoIngreso = ?");
    $sentencia->bind_param("i", $txtID);
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    $registro = $resultado->fetch_assoc();

    $apellidopaterno = $registro["apellidopaterno"];
    $apellidomaterno = $registro["apellidomaterno"];
    $nombres = $registro["nombres"];
    $alumnoextranjero = $registro["alumnoextranjero"];
    $matricula = $registro["matricula"];
    $nivel = $registro["nivel"];
    $fichaingreso = $registro["fichaingreso"];
    $comprobantepago = $registro["comprobantepago"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $apellidopaterno = (isset($_POST["apellidopaterno"])) ? $_POST["apellidopaterno"] : "";
    $apellidomaterno = (isset($_POST["apellidomaterno"])) ? $_POST["apellidomaterno"] : "";
    $nombres = (isset($_POST["nombres"])) ? $_POST["nombres"] : "";
    $alumnoextranjero = (isset($_POST["alumnoextranjero"])) ? $_POST["alumnoextranjero"] : "";
    $matricula = (isset($_POST["matricula"])) ? $_POST["matricula"] : "";
    $nivel = ($_SERVER["REQUEST_METHOD"] == "POST") ? 1 : $registro["nivel"];

    $sentencia_idusuario = $conexion->prepare("SELECT id_usuario FROM nuevoingreso WHERE idNuevoIngreso = ?");
    $sentencia_idusuario->bind_param("i", $txtID);
    $sentencia_idusuario->execute();
    $resultado_idusuario = $sentencia_idusuario->get_result();
    $registro_idusuario = $resultado_idusuario->fetch_assoc();
    $id_usuario = $registro_idusuario['id_usuario'];

    $sentencia = $conexion->prepare("UPDATE nuevoingreso SET 
        apellidopaterno = ?,
        apellidomaterno = ?,
        nombres = ?,
        alumnoextranjero = ?,
        matricula = ?,
        nivel = ?
        WHERE idNuevoIngreso = ? ");

    $sentencia->bind_param("ssssssi", $apellidopaterno, $apellidomaterno, $nombres, $alumnoextranjero, $matricula, $nivel, $txtID);

    $fecha_ = new DateTime();

    $fichaingreso = (isset($_FILES["fichaingreso"]['name'])) ? $_FILES["fichaingreso"]['name'] : "";
    $nombreArchivo_fichaingreso = ($fichaingreso != '') ? $fecha_->getTimestamp() . "_" . $_FILES["fichaingreso"]["name"] : "";
    $tmp_fichaingreso = $_FILES["fichaingreso"]["tmp_name"];
    if ($tmp_fichaingreso != '') {
        move_uploaded_file($tmp_fichaingreso, "./PDF/" . $nombreArchivo_fichaingreso);

        $sentencia = $conexion->prepare("SELECT fichaingreso FROM `nuevoingreso` WHERE idNuevoIngreso = ?");
        $sentencia->bind_param("i", $txtID);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $registro_recuperado = $resultado->fetch_assoc();

        if (isset($registro_recuperado["fichaingreso"]) && $registro_recuperado["fichaingreso"] != "") {
            if (file_exists("./PDF/" . $registro_recuperado["fichaingreso"])) {
                unlink("./PDF/" . $registro_recuperado["fichaingreso"]);
            }
        }

        $sentencia = $conexion->prepare("UPDATE nuevoingreso SET 
            fichaingreso = ?
            WHERE idNuevoIngreso = ?");

        $sentencia->bind_param("si", $nombreArchivo_fichaingreso, $txtID);
        $sentencia->execute();
    }

    $comprobantepago = (isset($_FILES["comprobantepago"]['name'])) ? $_FILES["comprobantepago"]['name'] : "";
    $nombreArchivo_comprobantepago = ($comprobantepago != '') ? $fecha_->getTimestamp() . "_" . $_FILES["comprobantepago"]["name"] : "";
    $tmp_comprobantepago = $_FILES["comprobantepago"]["tmp_name"];
    if ($tmp_comprobantepago != '') {
        move_uploaded_file($tmp_comprobantepago, "./compag/" . $nombreArchivo_comprobantepago);

        $sentencia = $conexion->prepare("SELECT comprobantepago FROM `nuevoingreso` WHERE idNuevoIngreso = ?");
        $sentencia->bind_param("i", $txtID);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
        $registro_recuperado = $resultado->fetch_assoc();

        if (isset($registro_recuperado["comprobantepago"]) && $registro_recuperado["comprobantepago"] != "") {
            if (file_exists("./compag/" . $registro_recuperado["comprobantepago"])) {
                unlink("./compag/" . $registro_recuperado["comprobantepago"]);
            }
        }

        $sentencia = $conexion->prepare("UPDATE nuevoingreso SET 
            comprobantepago = ?
            WHERE idNuevoIngreso = ?");

        $sentencia->bind_param("si", $nombreArchivo_comprobantepago, $txtID);
        $sentencia->execute();
    }
    if ($sentencia->execute()) {
        $mensaje = "Registro actualizado";
        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al actualizar el registro: " . $sentencia->error;
    }
}              
$fichaingreso_pdf = '';
$comprobantepago_pdf = '';

if (!empty($fichaingreso) && file_exists("./PDF/" . $fichaingreso)) {
    $fichaingreso_pdf = "./PDF/" . $fichaingreso;
}

if (!empty($comprobantepago) && file_exists("./compag/" . $comprobantepago)) {
    $comprobantepago_pdf = "./compag/" . $comprobantepago;
}
?>
<?php include("../../templates/header.php"); ?>
<br>
<div class="card">
    <div class="card-header">
        Formulario de nuevo ingreso
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validarOpcion()">
            <h2 style="color: red;"><strong>Formulario de nuevo ingreso</strong></h2>

            <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">

            <div class="mb-3">
                <strong><label for="apellidopaterno" class="form-label">Apellido Paterno</label></strong>
                <input type="text"
                    value="<?php echo $apellidopaterno; ?>"
                    class="form-control" name="apellidopaterno" id="apellidopaterno" aria-describedby="helpId" placeholder="Escriba su apellido paterno" maxlength="10" required>
            </div>
            <div class="mb-3">
                <strong><label for="apellidomaterno" class="form-label">Apellido Materno</label></strong>
                <input type="text"
                    value="<?php echo $apellidomaterno; ?>"
                    class="form-control" name="apellidomaterno" id="apellidomaterno" aria-describedby="helpId" placeholder="Escriba su apellido materno" maxlength="10" required>
            </div>
            <div class="mb-3">
                <strong><label for="nombres" class="form-label">Nombre(s)</label></strong>
                <input type="text"
                    value="<?php echo $nombres; ?>"
                    class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Escriba su nombre o nombres" maxlength="30" required>
            </div>

            <div class="mb-3">
                <strong><label for="alumnoextranjero" class="form-label">Seleccione si es un alumno de la UTSC (alumno/exalumno) o una persona externa:</label></strong>
                <select class="form-control" name="alumnoextranjero" id="alumnoextranjero">
                    <?php
                    foreach ($tipos_alumnoextranjero as $tipo_value => $tipo_descripcion) {
                        $selected = ($alumnoextranjero === $tipo_value) ? 'selected' : '';
                        echo '<option value="' . $tipo_value . '" ' . $selected . '>' . $tipo_descripcion . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <strong><label for="matricula" class="form-label">Escriba su matrícula de alumno o exalumno o docente. Si no es de la UTSC, no es necesario escribir nada.</label></strong>
                <input type="text"
                    value="<?php echo $matricula; ?>"
                    class="form-control" name="matricula" id="matricula" aria-describedby="helpId" placeholder="Escriba su matrícula de alumno o docente" maxlength="30">
            </div>

            <div class="mb-3">
                <strong><label for="fichaingreso" class="form-label">Suba su ficha de inscripción:</label></strong></br>
                <strong><label for="fichaingreso"  style="color: blue;" class="form-label">Aquí abajo se mostrara su PDF de nuevo ingreso si es que ya lo subió y le dio al botón y luego volvió al formulario:</label></strong>
                <br>
                <?php if (!empty($fichaingreso_pdf)) { ?>
                    <embed src="<?php echo $fichaingreso_pdf; ?>" type="application/pdf" width="100%" height="600px">
                <?php } ?>
                <input type="file" class="form-control" name="fichaingreso" id="fichaingreso" aria-describedby="helpId" placeholder="Por favor suba su ficha de inscripción en PDF">
            </div>

            <div class="mb-3">
                <strong><label for="comprobantepago" class="form-label">Suba su comprobante de pago:</label></strong></br>
                <strong><label  style="color: blue;" for="comprobantepago" class="form-label">Aquí abajo se mostrara su PDF de comprobante de pago si es que ya lo subió y le dio al botón y luego volvió al formulario:</label></strong>
                <br>
                <?php if (!empty($comprobantepago_pdf)) { ?>
                    <embed src="<?php echo $comprobantepago_pdf; ?>" type="application/pdf" width="100%" height="600px">
                <?php } ?>
                <input type="file" class="form-control" name="comprobantepago" id="comprobantepago" aria-describedby="helpId" placeholder="Por favor suba su comprobante de pago en PDF">
            </div>

            <button type="submit" class="btn btn-success">Inscripción de Nuevo Ingreso</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>      