<?php
include "conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    exit("No autorizado");
}

$tarea = $_POST['tarea'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "INSERT INTO tareas (usuario_id, tarea) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("is", $usuario_id, $tarea);
$stmt->execute();

$id = $stmt->insert_id;
echo json_encode(["id" => $id, "tarea" => $tarea]);
?>
