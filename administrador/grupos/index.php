<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM grupos WHERE id = ?");
    $sentencia->bind_param("i", $txtID);
    if ($sentencia->execute()) {
        $mensaje = "Registro eliminado";
        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al eliminar el registro: " . $sentencia->error;
    }
}
$seleccion = "SELECT * FROM grupos";
$result = mysqli_query($conexion, $seleccion);
?>
<?php include("../../templates/header2.php");?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar grupos</a>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Grupo</th>
                <th scope="col">Grado</th>
                <th scope="col">Periodo</th>
                <th scope="col">Año</th>
                <th scope="col">Cantidad de alumnos</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['grupo']; ?></td>
                    <td><?php echo $row['grado']; ?></td>
                    <td><?php echo obtenerTipoPeriodo($row['periodo']); ?></td>
                    <td><?php echo $row['año']; ?></td>
                    <td><?php echo $row['alumnos_count']; ?></td>
                <td>
                <a class="btn btn-info" href="editar.php?txtID=<?php echo $row['id']; ?>" role="button">Editar</a>
                    |
                    <a class="btn btn-danger" href="?txtID=<?php echo $row['id']; ?>" role="button">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
    </div>
</div>
    <?php
        // Función para obtener el tipo de usuario en base al código almacenado en la base de datos
        function obtenerTipoPeriodo($periodo) {
            switch ($periodo) {
                case 'Enero-Abril':
                    return 'Enero-Abril';
                case 'Mayo-Agosto':
                    return 'Mayo-Agosto';
                case 'Septiembre-Diciembre':
                    return 'Septiembre-Diciembre';
                default:
                    return 'Desconocido';
            }
        }
    ?>
<?php include("../../templates/footer2.php");?>
<script>
  <?php if (!empty($_GET['mensaje_error'])) { ?>
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '<?php echo $_GET['mensaje_error']; ?>'
    });
  <?php } ?>

  <?php if (!empty($_GET['mensaje_exito'])) { ?>
    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      text: '<?php echo $_GET['mensaje_exito']; ?>'
    });
  <?php } ?>
</script>