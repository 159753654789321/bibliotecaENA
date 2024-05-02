<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud de Libros</title>
    <style>
        body {
            background-color: #A04000;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #fff;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        input[type="text"], input[type="email"], input[type="tel"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #bd9d0b;
        }
        .mensaje-exito {
            text-align: center;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
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
<div class="navbar">
        <a href="lector_de_libros.html">Regresar</a>
    </div>
<h2>Solicitud de Libros</h2>
<form id="solicitud-form" method="post">
    <div class="mensaje-exito" id="mensaje-exito">Solicitud enviada con éxito. Gracias por tu solicitud.</div>
    <label for="nombre">Nombre del Solicitante:</label>
    <input type="text" id="nombre" name="nombre" required>
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    <label for="telefono">Número Telefónico:</label>
    <input type="tel" id="telefono" name="telefono" required>
    <label for="titulo">Título del Libro:</label>
    <input type="text" id="titulo" name="titulo" required>
    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" required>
    <label for="genero">Género:</label>
    <input type="text" id="genero" name="genero" required>
    <input type="submit" value="Enviar Solicitud">
</form>

<?php
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include 'conexionn.php';

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];

    // Preparar la consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO solicitudes_libros (nombre, email, telefono, titulo, autor, genero) VALUES ('$nombre', '$email', '$telefono', '$titulo', '$autor', '$genero')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>document.getElementById('mensaje-exito').style.display = 'block';</script>";
    } else {
        echo "Error al enviar la solicitud: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

</body>
</html>
