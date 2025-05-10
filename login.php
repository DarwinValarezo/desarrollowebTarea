<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$conexion = new mysqli("localhost", "root", "", "registro_usuarios");

if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

$usuario = $_POST['username'];
$contrasena = $_POST['password'];


$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

   
    if (password_verify($contrasena, $fila['contraseña'])) {
        $_SESSION['usuario'] = $fila['usuario'];
        header("Location: bienvenida.php");
        exit();
    } else {
        echo "❌ Contraseña incorrecta.";
    }
} else {
    echo "❌ Usuario no encontrado.";
}

$stmt->close();
$conexion->close();
?>
