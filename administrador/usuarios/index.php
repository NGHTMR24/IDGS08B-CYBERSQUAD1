<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM usuario WHERE id = ?");
    $sentencia->bind_param("i", $txtID);
    if ($sentencia->execute()) {
        $mensaje = "Registro eliminado";
        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al eliminar el registro: " . $sentencia->error;
    }
}
$seleccion = "SELECT * FROM usuario";
$result = mysqli_query($conexion, $seleccion);
?>
<?php include("../../templates/header2.php");?>
<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuario</a>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table" id="tabla_id">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Tipo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['usuario']; ?></td>
                    <td>*********</td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo obtenerTipoUsuario($row['tipo']); ?></td>
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
        function obtenerTipoUsuario($tipo) {
            switch ($tipo) {
                case 'alumno':
                    return 'Alumno';
                case 'maestro':
                    return 'Maestro';
                case 'administrador':
                    return 'Administrador';
                default:
                    return 'Desconocido';
            }
        }
    ?>
<?php include("../../templates/footer2.php");?>