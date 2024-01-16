<?php
$conexion = mysqli_connect("localhost", "root", "", "sabaticos");
use function unlink;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idNuevoIngreso'])) {
    $idNuevoIngreso = $_GET['idNuevoIngreso'];

    // Obtener el id_usuario y los campos fichaingreso y comprobantepago del registro a eliminar
    $sentencia_select = $conexion->prepare("SELECT id_usuario, fichaingreso, comprobantepago FROM temporal_nuevoingreso WHERE idNuevoIngreso = ?");
    $sentencia_select->bind_param("i", $idNuevoIngreso);
    $sentencia_select->execute();
    $sentencia_select->bind_result($id_usuario, $fichaingreso, $comprobantepago);
    $sentencia_select->fetch();
    $sentencia_select->close();

    // Eliminar el registro en temporal_nuevoingreso
    $sentencia_delete = $conexion->prepare("DELETE FROM temporal_nuevoingreso WHERE idNuevoIngreso = ?");
    $sentencia_delete->bind_param("i", $idNuevoIngreso);
    if ($sentencia_delete->execute()) {
        $mensaje = "Registro eliminado";

        // Eliminar los archivos si existen
        if (isset($fichaingreso) && $fichaingreso != "") {
            if (file_exists("../../secciones/NuevoIngreso/PDF/" . $fichaingreso)) {
                unlink("../../secciones/NuevoIngreso/PDF/" . $fichaingreso);
            }
        }
        
        if (isset($comprobantepago) && $comprobantepago != "") {
            if (file_exists("../../secciones/NuevoIngreso/compag/" . $comprobantepago)) {
                unlink("../../secciones/NuevoIngreso/compag/" . $comprobantepago);
            }
        }

        // Actualizar los campos fichaingreso y comprobantepago en nuevoingreso si el id_usuario coincide
        $sentencia_update = $conexion->prepare("UPDATE nuevoingreso SET fichaingreso = '', comprobantepago = '' WHERE id_usuario = ?");
        $sentencia_update->bind_param("i", $id_usuario);
        $sentencia_update->execute();
        $sentencia_update->close();

        header("Location: index.php?mensaje=" . $mensaje);
        exit;
    } else {
        $error = "Error al eliminar el registro: " . $sentencia_delete->error;
    }
}
?>
