<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros Subidos</title>
    <link rel="stylesheet" type="text/css" href="todoss.css">
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #bd9d0b; /* Nuevo color de fondo más claro */
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            flex-direction: column;
        }
        .dropdown:hover .dropdown-content {
            display: flex;
        }
    </style>
</head>
<body>
<header>
    <img src="logo.jpg" alt="Logo">
    <h1><font size="8">BIBLIOTECA ESCOLAR “PROFR. MARIO DÍAZ BLANQUEL”</font></h1>
</header>
<nav>
    <div class="navbar">
        <a href="inicio.html">Inicio</a>
        <a href="lector_de_libros.html">Regresar</a>
        <a href="?todos=true">Todos</a>
        <a href="visualizar_pdfs.php">Pdfs</a>
        <div class="dropdown">
            <button class="dropbtn">Colecciones</button>
            <div class="dropdown-content">
                <?php
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "biblioteca"; // Nombre de la base de datos
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Consulta para obtener las colecciones disponibles
                $sql = "SELECT DISTINCT coleccion FROM Libros";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='?coleccion=" . $row['coleccion'] . "'>" . $row['coleccion'] . "</a>";
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</nav>
<div class="content">
    <form action="" method="get">
        <input type="text" name="search" placeholder="Buscar...">
        <button type="submit">Buscar</button>
    </form>
    <div class="table-container" id="table-container">
        <!-- Aquí se mostrarán los datos de la base de datos -->
        <?php include 'fetch_data.php'; ?> <!-- Incluimos el archivo PHP que mostrará los datos -->
    </div>
</div>
<footer>
    <p>Contacto</p>
    <p>Av. Mario Colín Sánchez, No.5, Col. Centro, Atlacomulco, Estado de México</p>
    <p>Teléfono: 712 1220090</p>
    <p>Teléfono: 712 1224855</p>
    <p>Email: normalatlacomulco@edugem.gob.mx</p>
</footer>
<script>
    // Función para cargar los datos de la base de datos y actualizar la página cada 5 segundos
    function loadData() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table-container").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "fetch_data.php", true);
        xhttp.send();
    }
    loadData(); // Cargar los datos por primera vez
    setInterval(loadData, 5000); // Actualizar los datos cada 5 segundos
</script>
</body>
</html>
