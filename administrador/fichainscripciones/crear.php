<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $fechaAlta = $_POST["fechaAlta"];
  $apellidopaterno = $_POST["apellidopaterno"];
  $apellidomaterno = $_POST["apellidomaterno"];
  $nombres = $_POST["nombres"];
  $fecha_nac = $_POST["fecha_nac"];
  $direccion = $_POST["direccion"];
  $cd = $_POST["cd"];
  $municipio = $_POST["municipio"];
  $estado = $_POST["estado"];
  $pais = $_POST["pais"];
  $tel_fijo = $_POST["tel_fijo"];
  $tel_mov = $_POST["tel_mov"];
  $correo = $_POST["correo"];
  $alumno = $_POST["alumno"];
  $externo = $_POST["externo"];
  $nombre_curso = $_POST["nombre_curso"];
  $horario_curso = $_POST["horario_curso"];
  $re_de_con = $_POST["re_de_con"];
  $correo_ut = $_POST["correo_ut"];
  $pag_internet = $_POST["pag_internet"];
  $pag_int_ut = $_POST["pag_int_ut"];
  $prensa_escrita = $_POST["prensa_escrita"];
  $otro = $_POST["otro"];

  // Verificar si el usuario ya existe
  $sqlUsuario = "SELECT id FROM usuario WHERE correo = '$correo'";
  $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);

  if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {
    // El usuario ya existe, obtener su ID
    $filaUsuario = mysqli_fetch_assoc($resultadoUsuario);
    $idUsuario = $filaUsuario['id'];
  } else {
    // El usuario no existe, insertarlo en la tabla
    $sqlInsertarUsuario = "INSERT INTO usuario (correo) VALUES ('$correo')";
    if (mysqli_query($conexion, $sqlInsertarUsuario)) {
      // Obtener el ID del usuario recién insertado
      $idUsuario = mysqli_insert_id($conexion);
    } else {
      echo "Error al insertar el usuario: " . mysqli_error($conexion);
      exit; // Salir del script si hay un error
    }
  }

  // Crear la consulta SQL para agregar la ficha de inscripción
  $sqlFichaInscripcion = "INSERT INTO fichainscripcion (fechaAlta, apellidopaterno, apellidomaterno, nombres, fecha_nac, direccion, cd, municipio, estado, pais, tel_fijo, tel_mov, correo, alumno, externo, nombre_curso, horario_curso, re_de_con, correo_ut, pag_internet, pag_int_ut, prensa_escrita, otro, id_usuario) 
    VALUES ('$fechaAlta', '$apellidopaterno', '$apellidomaterno', '$nombres', '$fecha_nac', '$direccion', '$cd', '$municipio', '$estado', '$pais', '$tel_fijo', '$tel_mov', '$correo', '$alumno', '$externo', '$nombre_curso', '$horario_curso', '$re_de_con', '$correo_ut', '$pag_internet', '$pag_int_ut', '$prensa_escrita', '$otro', '$idUsuario')";

  // Ejecutar la consulta
  if (mysqli_query($conexion, $sqlFichaInscripcion)) {
    echo "La ficha de inscripción se ha agregado correctamente.";
  } else {
    echo "Error al agregar la ficha de inscripción: " . mysqli_error($conexion);
  }

  // Cerrar la conexión
  mysqli_close($conexion);
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
        <strong><label for="fechaAlta" class="form-label">Fecha de Alta</label></strong>
        <input type="date" class="form-control" name="fechaAlta" id="fechaAlta" aria-describedby="emailHelpId" placeholder="Fecha de alta" onfocus="(this.type='date')" onblur="formatDate(this)" required>
    </div>
    <div class="mb-3">
    <strong><label for="apellidopaterno" class="form-label">Apellido Paterno</label></strong>
      <input type="text"
        class="form-control" name="apellidopaterno" id="apellidopaterno" aria-describedby="helpId" placeholder="Escriba su apellido paterno" required>
    </div>
    <div class="mb-3">
    <strong><label for="apellidomaterno" class="form-label">Apellido Materno</label></strong>
      <input type="text"
        class="form-control" name="apellidomaterno" id="apellidomaterno" aria-describedby="helpId" placeholder="Escriba su apellido materno" required>
    </div>
    <div class="mb-3">
    <strong><label for="nombres" class="form-label">Nombre(s)</label></strong>
      <input type="text"
        class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Escriba su nombre o nombres" required>
    </div>
    <div class="mb-3">
    <strong><label for="fecha_nac" class="form-label">Fecha de Nacimiento</label></strong>
        <input type="date" class="form-control" name="fecha_nac" id="fecha_nac" aria-describedby="emailHelpId" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="formatDate(this)" required>
    </div>
    <div class="mb-3">
    <strong><label for="direccion" class="form-label">Dirección (Calle, Número interior, Número exterior, Colonia)</label></strong>
      <input type="text"
        class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Escriba su dirección" required>
    </div>
    <div class="mb-3">
    <strong><label for="cd" class="form-label">Código Postal</label></strong>
      <input type="number"
        class="form-control" name="cd" id="cd" aria-describedby="helpId" placeholder="Escriba su código postal" required>
    </div>
    <div class="mb-3">
    <strong><label for="municipio" class="form-label">Municipio o Delegación</label></strong>
      <input type="text"
        class="form-control" name="municipio" id="municipio" aria-describedby="helpId" placeholder="Escriba su municipio o delegación" required>
    </div>
    <div class="mb-3">
    <strong><label for="estado" class="form-label">Estado</label></strong>
      <input type="text"
        class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="Escriba su estado" required>
    </div>
    <div class="mb-3">
    <strong><label for="pais" class="form-label">País</label></strong>
      <input type="text"
        class="form-control" name="pais" id="pais" aria-describedby="helpId" placeholder="Escriba su país" required>
    </div>
    <div class="mb-3">
    <strong><label for="tel_fijo" class="form-label">Teléfono fijo</label></strong>
      <input type="number"
        class="form-control" name="tel_fijo" id="tel_fijo" aria-describedby="helpId" placeholder="Escriba su teléfono fijo" required>
    </div>
    <div class="mb-3">
    <strong><label for="tel_mov" class="form-label">Teléfono Móvil</label></strong>
      <input type="number"
        class="form-control" name="tel_mov" id="tel_mov" aria-describedby="helpId" placeholder="Escriba su teléfono móvil" required>
    </div>
    <div class="mb-3">
    <strong><label for="correo" class="form-label">Correo:</label></br></strong>
    <strong><label style="color: blue;" for="correo" class="form-label">Por favor utiliza el mismo correo que has puesto en el login</label></strong>
      <input type="email"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo" required>
    </div>
    <h2 style="color: red;"></strong>DATOS DE SOLICITUD DE ADMISIÓN</strong></h2>
    <div class="mb-3">
    <strong><label for="alumno" class="form-label">Alumno UTSC/Exalumno UTSC</label></strong>
      <input type="text"
        class="form-control" name="alumno" id="alumno" aria-describedby="helpId" placeholder="Escriba una x si es alumno o exalumno de la UTSC">
    </div>
    <div class="mb-3">
    <strong><label for="externo" class="form-label">Externo</label></strong>
      <input type="text"
        class="form-control" name="externo" id="externo" aria-describedby="helpId" placeholder="Escriba una x si eres una persona externa de la UTSC">
    </div>
    <div class="mb-3">
    <strong><label for="nombre_curso" class="form-label">Nombre del curso</label></strong>
      <input type="text"
        class="form-control" name="nombre_curso" id="nombre_curso" aria-describedby="helpId" placeholder="Escriba el nombre del curso a ingresar" required>
    </div>
    <div class="mb-3">
    <strong><label for="horario_curso" class="form-label">Horario del curso</label></strong>
      <input type="text"
        class="form-control" name="horario_curso" id="horario_curso" aria-describedby="helpId" placeholder="Escriba el horario del curso" required>
    </div>
    <h2 style="color: red;"></strong>¿CÓMO SE ENTERÓ DEL CURSO</strong></h2>
    <h6></strong>Escriba x si se entero por ese medio por los cursos sabáticos de inglés</strong></h6>
    <div class="mb-3">
    <strong><label for="re_de_con" class="form-label">Recomendación de un conocido</label></strong>
      <input type="text"
        class="form-control" name="re_de_con" id="re_de_con" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por recomendación de un conocido">
    </div>
    <div class="mb-3">
    <strong><label for="correo_ut" class="form-label">Correo electrónico</label></strong>
      <input type="text"
        class="form-control" name="correo_ut" id="correo_ut" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por correo electrónico">
    </div>
    <div class="mb-3">
    <strong><label for="pag_internet" class="form-label">Página de Internet</label></strong>
      <input type="text"
        class="form-control" name="pag_internet" id="pag_internet" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por mediante página de Internet">
    </div>
    <div class="mb-3">
    <strong><label for="pag_int_ut" class="form-label">Página de Internet Universidad Tecnológica Santa Catarina</label></strong>
      <input type="text"
        class="form-control" name="pag_int_ut" id="pag_int_ut" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por la página de Internet UT Santa Catarina">
    </div>
    <div class="mb-3">
    <strong><label for="prensa_escrita" class="form-label">Prensa escrita</label></strong>
      <input type="text"
        class="form-control" name="prensa_escrita" id="prensa_escrita" aria-describedby="helpId" placeholder="Escriba una x si conoció el curso por prensa escrita">
    </div>
    <div class="mb-3">
    <strong><label for="otro" class="form-label">Otro: </label></strong>
      <input type="text"
        class="form-control" name="otro" id="otro" aria-describedby="helpId" placeholder="Escriba si conoció de otra forma sobre los cursos sabáticos de inglés">
    </div>
    <button type="submit" class="btn btn-success">Enviar formulario</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Regresar a ver fichas de inscripción</a>
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer2.php");?>