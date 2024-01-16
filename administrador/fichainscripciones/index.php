<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM fichainscripcion WHERE idFichaInscripcion = ?");
    $sentencia->bind_param("i", $txtID);
    if ($sentencia->execute()) {
        $mensaje = "Registro eliminado";
        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al eliminar el registro: " . $sentencia->error;
    }
}
$seleccion = "SELECT * FROM fichainscripcion";
$result = mysqli_query($conexion, $seleccion);
?>
<?php include("../../templates/header2.php");?>
<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary"
         href="crear.php" role="button">Agregar ficha de inscripciones</a>
    </div>
    <div class="card-body">

    <div class="table-responsive">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">correo</th>
                <th scope="col">id_usuario</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="">
                     <td><?php echo $row['idFichaInscripcion']; ?></td>
                    <td scope="row">
                        <?php echo $row['nombres']; ?>
                        <?php echo $row['apellidopaterno']; ?>
                        <?php echo $row['apellidomaterno']; ?>
                    </td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['id_usuario']; ?></td>
                <td>
                    <a class="btn btn-warning" href="fichainscripcion.php?txtID=<?php echo $row['idFichaInscripcion']; ?>" role="button">Ver PDF</a>
                    |
                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $row['idFichaInscripcion']; ?>" role="button">Editar</a>
                    |
                    <a class="btn btn-danger" href="?txtID=<?php echo $row['idFichaInscripcion']; ?>" role="button">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
    </div>
</div>
<?php include("../../templates/footer2.php");?>