<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM temporal_nuevoingreso WHERE idNuevoIngreso = ?");
    $sentencia->bind_param("i", $txtID);
    if ($sentencia->execute()) {
        $mensaje = "Registro eliminado";
        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al eliminar el registro: " . $sentencia->error;
    }
}

$seleccion = "SELECT * FROM temporal_nuevoingreso WHERE aprobado = 0 AND fichaingreso <> '' AND comprobantepago <> ''";
$result = mysqli_query($conexion, $seleccion);
?>
<?php include("../../templates/header2.php");?>
<style>
.hidden-header,
.hidden-cell {
  display: none;
}
</style>
<br>
<div class="card">
    <div class="card-header">
        Aprobar y rechazar solicitudes de nuevo ingreso.
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table" id="tabla_id">
    <thead>
        <tr>
            <th class="hidden-header"></th>
            <th>Nombre completo</th>
            <th>Alumno o extranjero</th>
            <th>Matricula</th>
            <th>Nivel</th>
            <th>Ficha de inscripción</th>
            <th>Comprobante de pago</th>
            <th>id_usuario</th>
            <th>Aprobar</th>
            <th>Rechazar</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM temporal_nuevoingreso WHERE aprobado = 0 AND fichaingreso <> '' AND comprobantepago <> ''";
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='hidden-cell'>" . $row['idNuevoIngreso'] . "</td>";
                echo "<td>" . $row['nombres'] . " " . $row['apellidopaterno'] . " " . $row['apellidomaterno'] . "</td>";
                echo "<td>" . $row['alumnoextranjero'] . "</td>";
                echo "<td>" . $row['matricula'] . "</td>";
                echo "<td>" . $row['nivel'] . "</td>";
                echo "<td><a class='btn btn-warning' href='../../secciones/NuevoIngreso/PDF/" . $row['fichaingreso'] . "'>Ver archivo</a></td>";
                echo "<td><a class='btn btn-warning' href='../../secciones/NuevoIngreso/compag/" . $row['comprobantepago'] . "'>Ver archivo</a></td>";
                echo "<td>" . $row['id_usuario'] . "</td>";
                echo "<td><a class='btn btn-success' href='aprobar.php?idNuevoIngreso=" . $row['idNuevoIngreso'] . "'>Aprobar</a></td>";
                echo "<td><a class='btn btn-danger' href='eliminar.php?idNuevoIngreso=" . $row['idNuevoIngreso'] . "'>Eliminar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No hay alumnos pendientes de aprobación.</td></tr>";
        }
    ?>
    </tbody>
</table>
</div>
    </div>
</div>
<?php include("../../templates/footer2.php");?>


