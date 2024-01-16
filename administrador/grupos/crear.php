<?php
$tipos_periodos = array(
  'Enero-Abril' => 'Enero-Abril',
  'Mayo-Agosto' => 'Mayo-Agosto',
  'Septiembre-Diciembre' => 'Septiembre-Diciembre'
);

$mensaje_error = "";
$mensaje_exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $grupo = $_POST["grupo"];
  $grado = $_POST["grado"];
  $periodo = $_POST["periodo"];
  $año = $_POST["año"];
  
  $conexion = mysqli_connect("localhost", "root", "", "sabaticos");
  $grupo = mysqli_real_escape_string($conexion, $grupo);
  $grado = mysqli_real_escape_string($conexion, $grado);
  $año = mysqli_real_escape_string($conexion, $año);
  
  // Consulta de búsqueda para verificar si ya existe un registro igual
  $sql_busqueda = "SELECT COUNT(*) as total FROM grupos WHERE grupo = '$grupo' AND grado = '$grado' AND periodo = '$periodo' AND año = '$año'";
  $resultado_busqueda = mysqli_query($conexion, $sql_busqueda);
  
  if ($resultado_busqueda) {
    $fila = mysqli_fetch_assoc($resultado_busqueda);
    $total = $fila['total'];
    
    if ($total > 0) {
      $mensaje_error = "Ya existe un registro con los mismos datos en la base de datos.";
    } else {
      // Si no existe un registro igual, proceder a la inserción
      $sql = "INSERT INTO grupos (grupo, grado, periodo, año) VALUES ('$grupo', '$grado', '$periodo', '$año')";
      
      if (mysqli_query($conexion, $sql)) {
        $mensaje_exito = "El grupo se agregó correctamente.";
      } else {
        $mensaje_error = "Error al agregar el grupo: " . mysqli_error($conexion);
      }
    }
  } else {
    $mensaje_error = "Error al realizar la búsqueda en la base de datos: " . mysqli_error($conexion);
  }
  
  mysqli_close($conexion);
  header("Location: index.php?mensaje_error=" . urlencode($mensaje_error) . "&mensaje_exito=" . urlencode($mensaje_exito));
  exit();
}

?>

<?php include("../../templates/header2.php");?>

<br>
<div class="card">
    <div class="card-header">
        Altas de grupos
    </div>
    <div class="card-body">

    <?php if (!empty($_GET['mensaje_error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_GET['mensaje_error']; ?>
    </div>
    <?php } ?>

    <?php if (!empty($_GET['mensaje_exito'])) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_GET['mensaje_exito']; ?>
    </div>
    <?php } ?>

    <form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="grupo" class="form-label">Grupo:</label>
      <input type="number"
        class="form-control" name="grupo" id="grupo" aria-describedby="helpId" placeholder="Escriba el grupo.">
    </div>

    <div class="mb-3">
      <label for="grado" class="form-label">Grado:</label>
      <input type="text"
        class="form-control" name="grado" id="grado" aria-describedby="helpId" placeholder="Escriba el grado." maxlength="1">
    </div>

    <div class="mb-3">
      <label for="periodo" class="form-label">Periodo:</label>
      <select class="form-select" name="periodo" id="periodo">
        <option value="">Seleccione el periodo</option>
        <?php foreach ($tipos_periodos as $key => $value) { ?>
          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="año" class="form-label">Año:</label>
      <input type="text"
        class="form-control" name="año" id="año" aria-describedby="helpId" placeholder="Escriba el año">
    </div>

    <button type="submit" class="btn btn-success">Agregar grupo</button>
    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<script>
  document.getElementById("grupo").addEventListener("input", function() {
    if (this.value.length > 1) {
      this.value = this.value.slice(0, 1);
    }
  });
  document.getElementById("año").addEventListener("input", function() {
    if (this.value.length > 4) {
      this.value = this.value.slice(0, 4);
    }
  });
</script>
<?php include("../../templates/footer2.php");?>

