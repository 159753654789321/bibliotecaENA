<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Solicitudes de Libros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
            color: #000;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .delete-button {
            color: #fff;
            background-color: #f44336;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
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
<h2>Solicitudes de Libros</h2>

<div class="navbar">
    <a href="administrador.html">Regresar</a>
</div>

<table>
    <thead>
        <tr>
            <th>Nombre del Solicitante</th>
            <th>Correo Electrónico</th>
            <th>Número Telefónico</th>
            <th>Título del Libro</th>
            <th>Autor</th>
            <th>Género</th>
            <th>Fecha de Solicitud</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Establecer conexión a la base de datos
        $conn = new mysqli("localhost", "root", "", "solicitudes");

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error al conectar con la base de datos: " . $conn->connect_error);
        }

        // Si se envía un ID para eliminar, procesar la eliminación
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
            $delete_sql = "DELETE FROM solicitudes_libros WHERE id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
        }

        // Consulta SQL para obtener las solicitudes de libros
        $sql = "SELECT * FROM solicitudes_libros";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nombre"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["telefono"]."</td>";
                echo "<td>".$row["titulo"]."</td>";
                echo "<td>".$row["autor"]."</td>";
                echo "<td>".$row["genero"]."</td>";
                echo "<td>".$row["fecha_solicitud"]."</td>";
                echo "<td>
                        <form method='post'>
                            <input type='hidden' name='delete_id' value='".$row["id"]."'>
                            <input type='submit' value='Eliminar' class='delete-button'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No hay solicitudes de libros.</td></tr>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
