<?php
include "conexion.php";

$usuario = $_POST['usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (usuario, contrasena) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $usuario, $contrasena);

if ($stmt->execute()) {
    header("Location: index.html");
} else {
    echo "Error: El usuario ya existe";
}
?>
