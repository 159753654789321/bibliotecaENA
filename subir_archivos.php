<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos</title>
    <link rel="stylesheet" href="subir_pdf.css">
    <style>
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
    <h1>Subir Archivos</h1>

    <div class="navbar">
        <a href="administrador.html">Regresar</a>
        <a href="visualizar_pdfs.php">Ver Pdfs subidos</a>
    </div>
    
    <form action="procesar_subida.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo"><br>
        <label for="imagen">Imagen de Portada:</label><br>
        <input type="file" id="imagen" name="imagen"><br>
        <label for="pdf">Archivo PDF:</label><br>
        <input type="file" id="pdf" name="pdf"><br>
        <input type="submit" value="Subir Archivos">
    </form>
</body>
</html>

