<?php
include "conexion.php";

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE usuario=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($contrasena, $row['contrasena'])) {
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario'] = $row['usuario'];
        header("Location: todo.html");
        exit;
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>
