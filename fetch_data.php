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

// Consulta para obtener los libros
$sql = "SELECT * FROM libros";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los libros en un formato adecuado
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
         <!-- Agregamos el campo Género -->
        </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
        echo "<td>" . htmlspecialchars($row['editorial']) . "</td>";
        echo "<td>" . $row['anio'] . "</td>";
        echo "<td>" . $row['ejemplares'] . "</td>";
        echo "<td>" . $row['disponible'] . "</td>";
        echo "<td>" . htmlspecialchars($row['coleccion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['genero']) . "</td>"; // Agregamos el campo Género
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron libros en la base de datos.</p>";
}

$conn->close();
?>
