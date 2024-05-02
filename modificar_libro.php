<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Libro</title>
</head>
<body>
<h2>Modificar Libro</h2>
<form method="post">
    Título: <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>"><br>
    Autor: <input type="text" name="autor" value="<?php echo $row['autor']; ?>"><br>
    Editorial: <input type="text" name="editorial" value="<?php echo $row['editorial']; ?>"><br>
    Año: <input type="number" name="anio" value="<?php echo $row['anio']; ?>"><br>
    Ejemplares: <input type="number" name="ejemplares" value="<?php echo $row['ejemplares']; ?>"><br>
    Disponible: 
    <select name="disponible">
        <option value="Sí" <?php if ($row['disponible'] == "Sí") echo "selected"; ?>>Sí</option>
        <option value="No" <?php if ($row['disponible'] == "No") echo "selected"; ?>>No</option>
    </select><br>
    Colección: <input type="text" name="coleccion" value="<?php echo $row['coleccion']; ?>"><br>
    <input type="submit" value="Actualizar">
</form>
</body>
</html>
