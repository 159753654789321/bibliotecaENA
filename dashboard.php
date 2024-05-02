<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if(!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$rol_id = $_SESSION["rol_id"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
	<link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <h2>Dashboard</h2>

    <?php
    echo "<p>Bienvenido, Usuario : {$_SESSION['usuario_id']}, Rol lector: $rol_id</p>";

    if($rol_id == 1) {
        echo "<p>Tienes acceso como administrador.</p>";
        // Coloca aquí el contenido exclusivo para administradores
    } else {
        echo "<p>Tienes acceso como usuario estándar.</p>";
        // Coloca aquí el contenido exclusivo para usuarios estándar
    }
    ?>

    <a href="logout.php">Cerrar Sesión</a>

</body>
</html>
