<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia esto por el nombre del servidor de la base de datos
$username = "root"; // Cambia esto por el nombre de usuario de la base de datos
$password = ""; // Cambia esto por la contraseña de la base de datos
$dbname = "biblioteca"; // Cambia esto por el nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Capturar los datos del formulario
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editorial = $_POST['editorial'];
$anio = $_POST['anio'];
$ejemplares = $_POST['ejemplares'];
$disponible = $_POST['disponible'];

// Consulta SQL para insertar datos en la tabla de libros
$sql = "INSERT INTO libros (titulo, autor, editorial, anio, ejemplares, disponible) VALUES ('$titulo', '$autor', '$editorial', $anio, $ejemplares, $disponible)";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    // Redirigir al lector de libros
    header("Location: lector_de_libros.html");
} else {
    echo "Error al agregar el libro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
