<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");

if (isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
  
    $sentencia = $conexion->prepare("SELECT * FROM fichainscripcion WHERE idFichaInscripcion = ?");
    $sentencia->bind_param("i", $txtID);
    $sentencia->execute();
  
    $resultado = $sentencia->get_result();
    $registro = $resultado->fetch_assoc();
  
    $fechaAlta = $registro["fechaAlta"];
    $apellidopaterno = $registro["apellidopaterno"];
    $apellidomaterno = $registro["apellidomaterno"];
    $nombres = $registro["nombres"];
    $fecha_nac = $registro["fecha_nac"];
    $direccion = $registro["direccion"];
    $cd = $registro["cd"];
    $municipio = $registro["municipio"];
    $estado = $registro["estado"];
    $pais = $registro["pais"];
    $tel_fijo = $registro["tel_fijo"];
    $tel_mov = $registro["tel_mov"];
    $correo = $registro["correo"];
    $alumno = $registro["alumno"];
    $externo = $registro["externo"];
    $nombre_curso = $registro["nombre_curso"];
    $horario_curso = $registro["horario_curso"];
    $re_de_con = $registro["re_de_con"];
    $correo_ut = $registro["correo_ut"];
    $pag_internet = $registro["pag_internet"];
    $pag_int_ut = $registro["pag_int_ut"];
    $prensa_escrita = $registro["prensa_escrita"];
    $otro = $registro["otro"];
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $fechaAlta = (isset($_POST["fechaAlta"])) ? $_POST["fechaAlta"] : "";
    $apellidopaterno = (isset($_POST["apellidopaterno"])) ? $_POST["apellidopaterno"] : "";
    $apellidomaterno = (isset($_POST["apellidomaterno"])) ? $_POST["apellidomaterno"] : "";
    $nombres = (isset($_POST["nombres"])) ? $_POST["nombres"] : "";
    $fecha_nac = (isset($_POST["fecha_nac"])) ? $_POST["fecha_nac"] : "";
    $direccion = (isset($_POST["direccion"])) ? $_POST["direccion"] : "";
    $cd = (isset($_POST["cd"])) ? $_POST["cd"] : "";
    $municipio = (isset($_POST["municipio"])) ? $_POST["municipio"] : "";
    $estado = (isset($_POST["estado"])) ? $_POST["estado"] : "";
    $pais = (isset($_POST["pais"])) ? $_POST["pais"] : "";
    $tel_fijo = (isset($_POST["tel_fijo"])) ? $_POST["tel_fijo"] : "";
    $tel_mov = (isset($_POST["tel_mov"])) ? $_POST["tel_mov"] : "";
    $correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";
    $alumno = (isset($_POST["alumno"])) ? $_POST["alumno"] : "";
    $externo = (isset($_POST["externo"])) ? $_POST["externo"] : "";
    $nombre_curso = (isset($_POST["nombre_curso"])) ? $_POST["nombre_curso"] : "";
    $horario_curso = (isset($_POST["horario_curso"])) ? $_POST["horario_curso"] : "";
    $re_de_con = (isset($_POST["re_de_con"])) ? $_POST["re_de_con"] : "";
    $correo_ut = (isset($_POST["correo_ut"])) ? $_POST["correo_ut"] : "";
    $pag_internet = (isset($_POST["pag_internet"])) ? $_POST["pag_internet"] : "";
    $pag_int_ut = (isset($_POST["pag_int_ut"])) ? $_POST["pag_int_ut"] : "";
    $prensa_escrita = (isset($_POST["prensa_escrita"])) ? $_POST["prensa_escrita"] : "";
    $otro = (isset($_POST["otro"])) ? $_POST["otro"] : "";
  
    $sentencia = $conexion->prepare("UPDATE fichainscripcion SET 
    fechaAlta = ?,
    apellidopaterno = ?,
    apellidomaterno = ?,
    nombres = ?,
    fecha_nac = ?,
    direccion = ?,
    cd = ?,
    municipio = ?,
    estado = ?,
    pais = ?,
    tel_fijo = ?,
    tel_mov = ?,
    correo = ?,
    alumno = ?,
    externo = ?,
    nombre_curso = ?,
    horario_curso = ?,
    re_de_con = ?,
    correo_ut = ?,
    pag_internet = ?,
    pag_int_ut = ?,
    prensa_escrita = ?,
    otro = ? 
    WHERE idFichaInscripcion = ? ");
  
  $sentencia->bind_param("sssssssssssssssssssssssi", $fechaAlta, $apellidopaterno, $apellidomaterno, $nombres, $fecha_nac, $direccion, $cd, $municipio, $estado, $pais, $tel_fijo, $tel_mov, $correo, $alumno, $externo, $nombre_curso, $horario_curso, $re_de_con, $correo_ut, $pag_internet, $pag_int_ut, $prensa_escrita, $otro, $txtID);
  if ($sentencia->execute()) {
        $mensaje = "Registro actualizado";
        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al actualizar el registro: " . $sentencia->error;
    }
  }
?>
<?php include("../../templates/header2.php");?>
<br>
<div class="card">
    <div class="card-header">
        Formulario para ficha de inscripción
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
    <h2 style="color: red;"></strong>DATOS PERSONALES</strong></h2>

    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
      value="<?php echo $txtID; ?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
        <strong><label for="fechaAlta" class="form-label">Fecha de Alta</label></strong>
        <input type="date" value="<?php echo $fechaAlta; ?>" class="form-control" name="fechaAlta" id="fechaAlta" aria-describedby="emailHelpId" placeholder="Fecha de alta" onfocus="(this.type='date')" onblur="formatDate(this)" required>
    </div>
    <div class="mb-3">
    <strong><label for="apellidopaterno" class="form-label">Apellido Paterno</label></strong>
      <input type="text"
      value="<?php echo $apellidopaterno; ?>"
        class="form-control" name="apellidopaterno" id="apellidopaterno" aria-describedby="helpId" placeholder="Escriba su apellido paterno" required>
    </div>
    <div class="mb-3">
    <strong><label for="apellidomaterno" class="form-label">Apellido Materno</label></strong>
      <input type="text"
      value="<?php echo $apellidomaterno; ?>"
        class="form-control" name="apellidomaterno" id="apellidomaterno" aria-describedby="helpId" placeholder="Escriba su apellido materno" required>
    </div>
    <div class="mb-3">
    <strong><label for="nombres" class="form-label">Nombre(s)</label></strong>
      <input type="text"
      value="<?php echo $nombres; ?>"
        class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Escriba su nombre o nombres" required>
    </div>
    <div class="mb-3">
    <strong><label for="fecha_nac" class="form-label">Fecha de Nacimiento</label></strong>
        <input type="date" value="<?php echo $fecha_nac; ?>" class="form-control" name="fecha_nac" id="fecha_nac" aria-describedby="emailHelpId" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="formatDate(this)" required>
    </div>
    <div class="mb-3">
    <strong><label for="direccion" class="form-label">Dirección (Calle, Número interior, Número exterior, Colonia)</label></strong>
      <input type="text"
      value="<?php echo $direccion; ?>"
        class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Escriba su dirección" required>
    </div>
    <div class="mb-3">
    <strong><label for="cd" class="form-label">Código Postal</label></strong>
      <input type="number"
      value="<?php echo $cd; ?>"
        class="form-control" name="cd" id="cd" aria-describedby="helpId" placeholder="Escriba su código postal" required>
    </div>
    <div class="mb-3">
    <strong><label for="municipio" class="form-label">Municipio o Delegación</label></strong>
      <input type="text"
      value="<?php echo $municipio; ?>"
        class="form-control" name="municipio" id="municipio" aria-describedby="helpId" placeholder="Escriba su municipio o delegación" required>
    </div>
    <div class="mb-3">
    <strong><label for="estado" class="form-label">Estado</label></strong>
      <input type="text"
      value="<?php echo $estado; ?>"
        class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="Escriba su estado" required>
    </div>
    <div class="mb-3">
    <strong><label for="pais" class="form-label">País</label></strong>
      <input type="text"
      value="<?php echo $pais; ?>"
        class="form-control" name="pais" id="pais" aria-describedby="helpId" placeholder="Escriba su país" required>
    </div>
    <div class="mb-3">
    <strong><label for="tel_fijo" class="form-label">Teléfono fijo</label></strong>
      <input type="text"
      value="<?php echo $tel_fijo; ?>"
        class="form-control" name="tel_fijo" id="tel_fijo" aria-describedby="helpId" placeholder="Escriba su teléfono fijo" required>
    </div>
    <div class="mb-3">
    <strong><label for="tel_mov" class="form-label">Teléfono Móvil</label></strong>
      <input type="text"
      value="<?php echo $tel_mov; ?>"
        class="form-control" name="tel_mov" id="tel_mov" aria-describedby="helpId" placeholder="Escriba su teléfono móvil" required>
    </div>
    <div class="mb-3">
    <strong><label for="correo" class="form-label">Correo:</label></br></strong>
    <strong><label style="color: blue;" for="correo" class="form-label">Por favor utiliza el mismo correo que has puesto en el login</label></strong>
      <input type="email"
      value="<?php echo $correo; ?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo" required>
    </div>
    <h2 style="color: red;"></strong>DATOS DE SOLICITUD DE ADMISIÓN</strong></h2>
    <div class="mb-3">
    <strong><label for="alumno" class="form-label">Alumno UTSC/Exalumno UTSC</label></strong>
      <input type="text"
      value="<?php echo $alumno; ?>"
        class="form-control" name="alumno" id="alumno" aria-describedby="helpId" placeholder="Escriba una x si es alumno o exalumno de la UTSC">
    </div>
    <div class="mb-3">
    <strong><label for="externo" class="form-label">Externo</label></strong>
      <input type="text"
      value="<?php echo $externo; ?>"
        class="form-control" name="externo" id="externo" aria-describedby="helpId" placeholder="Escriba una x si eres una persona externa de la UTSC">
    </div>
    <div class="mb-3">
    <strong><label for="nombre_curso" class="form-label">Nombre del curso</label></strong>
      <input type="text"
      value="<?php echo $nombre_curso; ?>"
        class="form-control" name="nombre_curso" id="nombre_curso" aria-describedby="helpId" placeholder="Escriba el nombre del curso a ingresar" required>
    </div>
    <div class="mb-3">
    <strong><label for="horario_curso" class="form-label">Horario del curso</label></strong>
      <input type="text"
      value="<?php echo $horario_curso; ?>"
        class="form-control" name="horario_curso" id="horario_curso" aria-describedby="helpId" placeholder="Escriba el horario del curso" required>
    </div>
    <h2 style="color: red;"></strong>¿CÓMO SE ENTERÓ DEL CURSO</strong></h2>
    <h6></strong>Escriba x si se entero por ese medio por los cursos sabáticos de inglés</strong></h6>
    <div class="mb-3">
    <strong><label for="re_de_con" class="form-label">Recomendación de un conocido</label></strong>
      <input type="text"
      value="<?php echo $re_de_con; ?>"
        class="form-control" name="re_de_con" id="re_de_con" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por recomendación de un conocido">
    </div>
    <div class="mb-3">
    <strong><label for="correo_ut" class="form-label">Correo electrónico</label></strong>
      <input type="text"
      value="<?php echo $correo_ut; ?>"
        class="form-control" name="correo_ut" id="correo_ut" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por correo electrónico">
    </div>
    <div class="mb-3">
    <strong><label for="pag_internet" class="form-label">Página de Internet</label></strong>
      <input type="text"
      value="<?php echo $pag_internet; ?>"
        class="form-control" name="pag_internet" id="pag_internet" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por mediante página de Internet">
    </div>
    <div class="mb-3">
    <strong><label for="pag_int_ut" class="form-label">Página de Internet Universidad Tecnológica Santa Catarina</label></strong>
      <input type="text"
      value="<?php echo $pag_int_ut; ?>"
        class="form-control" name="pag_int_ut" id="pag_int_ut" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por la página de Internet UT Santa Catarina">
    </div>
    <div class="mb-3">
    <strong><label for="prensa_escrita" class="form-label">Prensa escrita</label></strong>
      <input type="text"
      value="<?php echo $prensa_escrita; ?>"
        class="form-control" name="prensa_escrita" id="prensa_escrita" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por prensa escrita">
    </div>
    <div class="mb-3">
    <strong><label for="otro" class="form-label">Otro: </label></strong>
      <input type="text"
      value="<?php echo $otro; ?>"
        class="form-control" name="otro" id="otro" aria-describedby="helpId" placeholder="Escriba si conoció de otra forma sobre los cursos sabáticos de inglés">
    </div>
    <button type="submit" class="btn btn-success">Enviar formulario</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar al apartado de Ficha de Inscripción</a>
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer2.php");?>