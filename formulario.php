<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario para Capturar Libros</title>
    <link rel="stylesheet" type="text/css" href="formularioo.css">
    <style>
        /* Estilos para el mensaje de éxito */
        .success-message {
            background-color: #bd9d0b;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            display: none; /* Inicialmente oculto */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
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
    <script>
        // Función para mostrar el mensaje de éxito y ocultarlo después de unos segundos
        function mostrarMensaje() {
            var mensajeExito = document.getElementById('mensaje-exito');
            mensajeExito.style.display = 'block'; // Mostrar el mensaje

            // Ocultar el mensaje después de 3 segundos
            setTimeout(function() {
                mensajeExito.style.display = 'none'; // Ocultar el mensaje
            }, 3000);
        }
    </script>
</head>
<body>
<h1>Formulario para Capturar Libros</h1>
<div class="navbar">
    <a href="administrador.html">Regresar</a>
    <a href="todos.php">Ver libros subidos</a>
    <a href="gestion_libros.php">Modificar libros</a>
</div>
<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "biblioteca";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Capturar los datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $anio = $_POST['anio'];
    $ejemplares = $_POST['ejemplares'];
    $disponible = $_POST['disponible'];
    $coleccion = $_POST['coleccion'];
    $genero = $_POST['genero']; // Nuevo campo de género

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO libros (titulo, autor, editorial, anio, ejemplares, disponible, coleccion, genero) VALUES ('$titulo', '$autor', '$editorial', '$anio', '$ejemplares', '$disponible', '$coleccion', '$genero')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "<script>mostrarMensaje();</script>"; // Llamar a la función mostrarMensaje()
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo" required><br>
    
    <label for="autor">Autor:</label><br>
    <input type="text" id="autor" name="autor" required><br>
    
    <label for="editorial">Editorial:</label><br>
    <input type="text" id="editorial" name="editorial" required><br>
    
    <label for="anio">Año:</label><br>
    <input type="number" id="anio" name="anio" required><br>
    
    <label for="ejemplares">Ejemplares:</label><br>
    <input type="number" id="ejemplares" name="ejemplares" required><br>
    
    <label for="disponible">Disponible:</label><br>
    <select id="disponible" name="disponible">
        <option value="1">Sí</option>
        <option value="0">No</option>
    </select><br>
    
    <label for="coleccion">Colección:</label><br>
    <select id="coleccion" name="coleccion">
        <option value="Tesis">Tesis</option>
        <option value="Libros">Libros</option>
        <option value="Revistas">Revistas</option>
        <!-- Agregar más opciones según sea necesario -->
    </select><br>
    
    <!-- Nuevo campo de género -->
    <label for="genero">Género:</label><br>
    <input type="text" id="genero" name="genero" required><br>
    
    <input type="submit" value="Guardar">
</form>

<!-- Mensaje de éxito -->
<div class="success-message" id="mensaje-exito">Datos guardados con éxito.</div>
</body>
</html>
