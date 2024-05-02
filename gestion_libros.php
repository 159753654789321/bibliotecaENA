<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" type="text/css" href="gestion.css">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>
<h2>Gestión de Libros</h2>
<div class="navbar">
        <a href="formulario.php">Regresar</a>
    </div>
    <p>
<form method="get">
    <input type="text" name="search" placeholder="Buscar por título, autor, editorial, colección, género...">
    <button type="submit">Buscar</button>
</form>

<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca"; // Nombre de la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar la eliminación del libro si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM libros WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<p>Libro eliminado correctamente.</p>";
    } else {
        echo "<p>Error al eliminar el libro: " . $conn->error . "</p>";
    }
    $stmt->close();
}

// Procesar la modificación del campo disponible
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    $id = $_POST['id'];
    $disponible = $_POST['disponible'];

    $sql = "UPDATE libros SET disponible=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $disponible, $id);

    if ($stmt->execute()) {
        echo "<p>Disponibilidad del libro actualizada correctamente.</p>";
    } else {
        echo "<p>Error al modificar la disponibilidad: " . $conn->error . "</p>";
    }
    $stmt->close();
}

// Consulta para obtener todos los libros de la base de datos
$sql = "SELECT * FROM libros";

// Verificar si se envió un término de búsqueda
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = "%" . $_GET['search'] . "%";
    $sql .= " WHERE titulo LIKE ? OR autor LIKE ? OR editorial LIKE ? OR coleccion LIKE ? OR genero LIKE ?";
}

$stmt = $conn->prepare($sql);

// Si hay un término de búsqueda, enlazar los parámetros y ejecutar la consulta
if (isset($search)) {
    $stmt->bind_param("sssss", $search, $search, $search, $search, $search);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Mostrar los libros en un formulario para modificar o eliminar
    echo "<table>
        <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Género</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Año</th>
        <th>Ejemplares</th>
        <th>Disponible</th>
        <th>Colección</th>
        <th>Acciones</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
        echo "<td>" . htmlspecialchars($row['editorial']) . "</td>";
        echo "<td>" . $row['anio'] . "</td>";
        echo "<td>" . $row['ejemplares'] . "</td>";
        echo "<td>
                <form method='post'>
                    <select name='disponible'>
                        <option value='Sí'" . ($row['disponible'] == 'Sí' ? ' selected' : '') . ">Sí</option>
                        <option value='No'" . ($row['disponible'] == 'No' ? ' selected' : '') . ">No</option>
                    </select>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' name='modificar'>Actualizar</button>
                </form>
              </td>";
        echo "<td>" . htmlspecialchars($row['coleccion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['genero']) . "</td>"; // Nuevo campo de género
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' name='eliminar'>Eliminar</button>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron libros que coincidan con la búsqueda.</p>";
}

$stmt->close();
$conn->close();
?>

</body>
</html>
