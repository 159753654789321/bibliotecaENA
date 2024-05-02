<?php
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "biblioteca");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "DELETE FROM libros WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Libro eliminado con éxito.";
} else {
    echo "No se pudo eliminar el libro.";
}
$stmt->close();
$conn->close();

header("Location: gestion_libros.php");
exit();
?>
