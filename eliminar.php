<?php
include "conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    exit("No autorizado");
}

$id = $_POST['id'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "DELETE FROM tareas WHERE id=? AND usuario_id=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
?>
