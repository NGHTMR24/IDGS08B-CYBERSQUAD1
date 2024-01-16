<?php
include("../../templates/header.php");

$tipos_alumnoextranjero = array(
    'alumno' => 'Alumno',
    'externo' => 'Externo'
);

$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

function obtenerIdUsuarioActual()
{
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] === "alumno") {
        return $_SESSION['id']; // Asegúrate de que esta sesión exista
    } else {
        header("Location: login.php");
        exit();
    }
}

// Obtener el ID del usuario actual
$usuarioId = obtenerIdUsuarioActual();
if ($usuarioId !== false) {
    
   

    try {
        // Realizar la consulta para obtener el valor de idNuevoIngreso del usuario actual
        $sql = "SELECT idreingreso FROM reingreso WHERE id_usuario = '$usuarioId'";
        $resultado = mysqli_query($conexion, $sql);

        $idNuevoIngreso = '';

        if ($fila = mysqli_fetch_assoc($resultado)) {
            $idNuevoIngreso = $fila['idreingreso'];
        }

        // Realizar la consulta para obtener los valores de la tabla nuevoingreso
        $sql = "SELECT apellidopaterno, apellidomaterno, nombres, alumnoextranjero, matricula, nivel, comprobantepago FROM reingreso WHERE id_usuario = '$usuarioId'";
        $resultado = mysqli_query($conexion, $sql);

        $registro_verificar = false;
        $sentencia_verificar = $conexion->prepare("SELECT id_usuario FROM temporal_reingreso WHERE id_usuario = ?");
        $sentencia_verificar->bind_param("i", $id_usuario);
        $sentencia_verificar->execute();
        $resultado_verificar = $sentencia_verificar->get_result();
        if ($resultado_verificar->num_rows > 0) {
            $registro_verificar = true;
        }

        if ($registro_verificar) {
            // Realizar actualización
            $sentencia_actualizar = $conexion->prepare("UPDATE temporal_reingreso SET 
            apellidopaterno = ?,
            apellidomaterno = ?,
            nombres = ?,
            alumnoextranjero = ?,
            matricula = ?,
            nivel = ?,
            comprobantepago = ?
            WHERE id_usuario = ?");

            $sentencia_actualizar->bind_param("ssssisssi", $apellidopaterno, $apellidomaterno, $nombres, $alumnoextranjero, $matricula, $nivel, $comprobantepago, $id_usuario);

            // Obtener los valores de la tabla nuevoingreso
            if ($fila = mysqli_fetch_assoc($resultado)) {
                $apellidopaterno = $fila['apellidopaterno'];
                $apellidomaterno = $fila['apellidomaterno'];
                $nombres = $fila['nombres'];
                $alumnoextranjero = $fila['alumnoextranjero'];
                $matricula = $fila['matricula'];
                $nivel = $fila['nivel'];
                $comprobantepago = $fila['comprobantepago'];
            }

            $sentencia_actualizar->execute();

            if ($sentencia_actualizar->affected_rows > 0) {
                $mensaje = "Registro actualizado";
                header("Location: index.php?mensaje=" . $mensaje);
                exit;
            } else {
                $error = "Error al actualizar el registro: " . $sentencia_actualizar->error;
            }
        } else {
            // Realizar inserción
            $sentencia_insertar = $conexion->prepare("INSERT INTO temporal_reingreso (apellidopaterno, apellidomaterno, nombres, alumnoextranjero, matricula, nivel, comprobantepago, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $sentencia_insertar->bind_param("ssssisssi", $apellidopaterno, $apellidomaterno, $nombres, $alumnoextranjero, $matricula, $nivel, $comprobantepago, $id_usuario);

            // Obtener los valores de la tabla nuevoingreso
            if ($fila = mysqli_fetch_assoc($resultado)) {
                $apellidopaterno = $fila['apellidopaterno'];
                $apellidomaterno = $fila['apellidomaterno'];
                $nombres = $fila['nombres'];
                $alumnoextranjero = $fila['alumnoextranjero'];
                $matricula = $fila['matricula'];
                $nivel = $fila['nivel'];
                $comprobantepago = $fila['comprobantepago'];
            }

            $sentencia_insertar->execute();

            if ($sentencia_insertar->affected_rows > 0) {
                $mensaje = "Registro insertado";
                header("Location: index.php?mensaje=" . $mensaje);
                exit;
            } else {
                $error = "Error al insertar el registro: " . $sentencia_insertar->error;
            }
        }
    } catch (Exception $e) {
        $error = "Ocurrió un error: " . $e->getMessage();
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

<style>
    .custom-bg {
        background: rgb(219, 218, 217);
        background: radial-gradient(circle, rgba(219, 218, 217, 1) 25%, rgba(237, 237, 237, 1) 50%, rgba(219, 218, 217, 1) 75%);
    }

    .btn-lg {
        padding: 22px 44px;
        font-size: 18px;
    }
</style>
<br>
<div class="L">
    <div class="p-5 mb-4 custom-bg rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenido aquí puedes llenar tu Reinscripcion.</h1>
            <h2>Para hacer tu proceso de Reinscripcion es necesario tu comprobante de pago en PDF.</h2></br>
            <div class="text-center">
                <a href="reingreso.php?txtID=<?php echo isset($idNuevoIngreso) ? $idNuevoIngreso : ''; ?>" class="btn btn-info btn-lg" role="button"><h3><strong>Llenar formulario de Reinscripcion </strong></h3></a>
            </div>
        </div>
    </div>
    <?php include("../../templates/footer.php"); ?>
</div>



