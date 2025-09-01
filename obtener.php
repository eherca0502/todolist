<?php
include "conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    exit("No autorizado");
}

$usuario_id = $_SESSION['usuario_id'];

$result = $conexion->prepare("SELECT * FROM tareas WHERE usuario_id=? ORDER BY id DESC");
$result->bind_param("i", $usuario_id);
$result->execute();
$res = $result->get_result();

$tareas = [];
while ($row = $res->fetch_assoc()) {
    $tareas[] = $row;
}
echo json_encode($tareas);
?>
