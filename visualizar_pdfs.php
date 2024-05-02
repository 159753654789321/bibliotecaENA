<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar PDFs</title>
    <link rel="stylesheet" href="visualiza.css">
</head>
<body>
    
    <h1>PDFs</h1>
    <div class="tarjetas">
        <?php
        // Directorio donde se encuentran los archivos PDF
        $directorio_pdfs = "pdfs/";

        // Obtener todos los archivos PDF en el directorio
        $archivos_pdfs = glob($directorio_pdfs . "*.pdf");

        // Mostrar cada archivo PDF con su título y la imagen de portada
        foreach ($archivos_pdfs as $archivo_pdf) {
            $nombre_pdf = basename($archivo_pdf);
            $titulo_pdf = obtenerTituloPDF($nombre_pdf);

            // Obtener imagen de portada (asumiendo que tiene el mismo nombre que el PDF pero con extensión .jpg)
            $imagen_portada = "imagenes/" . pathinfo($nombre_pdf, PATHINFO_FILENAME) . ".jpg";

            echo "<div class='tarjeta'>";
            echo "<h3>$titulo_pdf</h3>";
            echo "<a href='$archivo_pdf' target='_blank'><img src='$imagen_portada' alt='Imagen de portada'></a>";
            // Se omite el embed ya que ahora el PDF se abrirá en otra ventana
            echo "</div>";
           

        }

        // Función para obtener el título de un archivo PDF a partir de su nombre
        function obtenerTituloPDF($nombre_pdf) {
            // Aquí puedes implementar la lógica para obtener el título del PDF
            // Por ejemplo, puedes almacenar el título junto con el PDF cuando se sube
            // y recuperarlo aquí usando una base de datos u otro método de almacenamiento
            // En este ejemplo, simplemente eliminaremos la extensión ".pdf" del nombre del archivo
            return preg_replace('/\\.[^.\\s]{3,4}$/', '', $nombre_pdf);
        }
        ?>
    </div>
</body>
</html>
