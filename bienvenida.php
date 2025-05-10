<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<h2>Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h2>
<a href="logout.php">Cerrar sesión</a>


