<?php
include("./bd.php");
// Procesar el formulario de agregar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $usuario = $_POST["usuario"];
  $password = $_POST["password"];
  $correo = $_POST["correo"];
  // Establecer el tipo como "alumno"
  $tipo = "alumno";
  // Realizar la conexión a la base de datos
  $conexion = mysqli_connect("localhost", "root", "", "sabaticos");
  // Escapar los valores para evitar inyección de SQL
  $usuario = mysqli_real_escape_string($conexion, $usuario);
  $password = mysqli_real_escape_string($conexion, $password);
  $correo = mysqli_real_escape_string($conexion, $correo);
  // Crear la sentencia SQL de inserción
  $sql = "INSERT INTO usuario (usuario, password, correo, tipo) VALUES ('$usuario', '$password', '$correo', '$tipo')";
  // Ejecutar la sentencia SQL
  // Después de ejecutar la sentencia SQL de inserción
if (mysqli_query($conexion, $sql)) {
  // Registro agregado correctamente
  $mensaje_exito = "El registro se agregó correctamente.";
  // Obtener el ID del usuario registrado
  $id_usuario = mysqli_insert_id($conexion);
  // Guardar el ID en una variable de sesión
  $_SESSION["id_usuario"] = $id_usuario;
} else {
  // Error al ejecutar la sentencia SQL
  $mensaje_error = "Error al agregar el registro: " . mysqli_error($conexion);
}
  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
}
?>
<!doctype html>
<html lang="en">
<head>
  <title>Title</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="imagenes/">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<style>
  body {
    background-color: #ffdd90;
    background-image: url("a.jpg");
  }
  .btn-primary {
      background-color: blue;
      color: white;
    }
    .btn-success {
      background-color: #228B22;
      color: white;
    }
</style>
<header>
        <div class="logo">
          <img src="imagenes/logo-universidad-tecnologica-santa-catarina-PhotoRoom.png" alt="Logotipo de la página">
        </div>
        <nav>
        <ul>
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="cursos.php">Cursos</a></li>
                <li><a href="registrarse.php">Registrarse</a></li>
                <li><a href="login.php">Inicio de session</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="Faq.php">FAQ</a></li>
          </ul>
        </nav>
      </header>
  <main class="container">
<br>
<div class="card">
    <div class="card-header">
        Registro de usuario
    </div>
    <div class="card-body">
    <?php if (isset($mensaje_error)) { ?>
      <div class="alert alert-danger"><?php echo $mensaje_error; ?></div>
    <?php } ?> 
    <?php if (isset($mensaje_exito)) { ?>
      <div class="alert alert-success"><?php echo $mensaje_exito; ?></div>
    <?php } ?>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="usuario" class="form-label">Nombre del usuario</label>
      <input type="text"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
    </div>
    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
    </div>
    <button type="submit" class="btn btn-success">Registrarse</button>
    <a name="" id="" class="btn btn-primary" href="login.php" role="button">Regresar al login</a>
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
</main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
</html>