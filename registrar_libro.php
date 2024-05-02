<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $anio = $_POST['anio'];
    $ejemplares = $_POST['ejemplares'];
    $disponible = $_POST['disponible'];
    $coleccion = $_POST['coleccion'];
    
    // Consulta SQL para insertar los datos del libro en la base de datos
    $sql = "INSERT INTO Libros (titulo, autor, editorial, anio, ejemplares, disponible, coleccion)
            VALUES ('$titulo', '$autor', '$editorial', '$anio', '$ejemplares', '$disponible', '$coleccion')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir al usuario a la página correspondiente a la colección seleccionada
        header("Location: coleccion.php?coleccion=" . urlencode($coleccion));
        exit;
    } else {
        // Mensaje de error si ocurrió algún problema durante la inserción
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
