<?php
// Procesar el formulario de agregar
$tipos_usuario = array(
  'alumno' => 'Alumno',
  'maestro' => 'Maestro',
  'administrador' => 'Administrador'
);
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
if (isset($_GET['txtID'])) {
  $txtID = $_GET['txtID'];

  $sentencia = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
  $sentencia->bind_param("i", $txtID);
  $sentencia->execute();

  $resultado = $sentencia->get_result();
  $registro = $resultado->fetch_assoc();

  $usuario = $registro["usuario"];
  $password = $registro["password"];
  $tipo = $registro["tipo"];
  $correo = $registro["correo"];
}
// Procesar el formulario de editar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
  $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
  $password = (isset($_POST["password"])) ? $_POST["password"] : "";
  $tipo = (isset($_POST["tipo"])) ? $_POST["tipo"] : "";
  $correo = (isset($_POST["correo"])) ? $_POST["correo"] : "";

  $sentencia = $conexion->prepare("UPDATE usuario SET 
  usuario = ?,
  password = ?,
  tipo = ?,
  correo = ? 
  WHERE id = ? ");

  $sentencia->bind_param("ssssi", $usuario, $password, $tipo, $correo, $txtID);
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
        Datos del usuarios
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
      value="<?php echo $txtID; ?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
      <label for="usuario" class="form-label">Nombre del usuario</label>
      <input type="text"
      value="<?php echo $usuario; ?>"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Contraseña:</label>
      <input type="password"
      value="<?php echo $password; ?>"
        class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
    </div>

    <div class="mb-3">
      <label for="tipo" class="form-label">Tipo de usuario:</label>
      <select class="form-control" name="tipo" id="tipo">
        <?php
        foreach ($tipos_usuario as $tipo_value => $tipo_descripcion) {
          $selected = ($tipo === $tipo_value) ? 'selected' : '';
          echo '<option value="' . $tipo_value . '" ' . $selected . '>' . $tipo_descripcion . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email"
      value="<?php echo $correo; ?>"
        class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
    </div>

    <button type="submit" class="btn btn-success">Editar usuario</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer2.php");?>