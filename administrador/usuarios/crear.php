<?php
// Procesar el formulario de agregar
$tipos_usuario = array(
  'alumno' => 'Alumno',
  'maestro' => 'Maestro',
  'administrador' => 'Administrador'
);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $usuario = $_POST["usuario"];
  $password = $_POST["password"];
  $correo = $_POST["correo"];
  $tipo = $_POST["tipo"];
  // Realizar la conexión a la base de datos
  $conexion = mysqli_connect("localhost", "root", "", "sabaticos");
  // Escapar los valores para evitar inyección de SQL
  $usuario = mysqli_real_escape_string($conexion, $usuario);
  $password = mysqli_real_escape_string($conexion, $password);
  $correo = mysqli_real_escape_string($conexion, $correo);
  // Crear la sentencia SQL de inserción
  $sql = "INSERT INTO usuario (usuario, password, correo, tipo) VALUES ('$usuario', '$password', '$correo', '$tipo')";
  // Ejecutar la sentencia SQL
  if (mysqli_query($conexion, $sql)) {
    // Registro agregado correctamente
    $mensaje_exito = "El registro se agregó correctamente.";
  } else {
    // Error al ejecutar la sentencia SQL
    $mensaje_error = "Error al agregar el registro: " . mysqli_error($conexion);
  }
  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
  header("Location: index.php");
}

?>
<?php include("../../templates/header2.php");?>

<br>
<div class="card">
    <div class="card-header">
        Datos del usuarios
    </div>
    <div class="card-body">

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
      <label for="tipo" class="form-label">Tipo de usuario:</label>
      <select class="form-select" name="tipo" id="tipo">
        <option value="">Seleccione un tipo de usuario</option>
        <?php foreach ($tipos_usuario as $key => $value) { ?>
          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
    </div>

    <button type="submit" class="btn btn-success">Agregar usuario</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer2.php");?>