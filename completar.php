<?php
include "conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    exit("No autorizado");
}

$id = $_POST['id'];
$completada = $_POST['completada'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "UPDATE tareas SET completada=? WHERE id=? AND usuario_id=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iii", $completada, $id, $usuario_id);
$stmt->execute();
?>
