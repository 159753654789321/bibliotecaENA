<?php
// Configuración de la base de datos (para un ejemplo con usuarios predefinidos)
$usuarios = [
    "admin" => [
        "contrasena_hash" => password_hash("admin123", PASSWORD_DEFAULT),
        "rol_id" => 1,
    ],
    "lector" => [
        "contrasena_hash" => password_hash("pass123", PASSWORD_DEFAULT),
        "rol_id" => 2,
    ],
];

// Configuración para la conexión a la base de datos (para un ejemplo con usuarios predefinidos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
