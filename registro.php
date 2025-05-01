<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "registro_usuarios");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$usuario    = $_POST['username'];
$contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encripta la contraseña
$email      = $_POST['email'];
$nombre     = $_POST['nombre'];
$telefono   = $_POST['telefono'];

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (usuario, contraseña, email, nombre, telefono) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssss", $usuario, $contrasena, $email, $nombre, $telefono);

if ($stmt->execute()) {
    echo "✅ Registro exitoso. <a href='login.html'>Iniciar sesión</a>";
} else {
    echo "❌ Error al registrar: " . $stmt->error;
}


$stmt->close();
$conexion->close();
?>
