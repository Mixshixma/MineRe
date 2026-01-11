<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Institución Educativa - Proyecto PHP</title>
</head>
<body>

    <nav>
        <h2>Menú de Navegación</h2>
        <a href="index.php?seccion=Inicio">Inicio</a> | 
        <a href="index.php?seccion=Unidades">Unidades</a> | 
        <a href="index.php?seccion=Contacto">Contacto</a>
    </nav>

    <div>
        <?php
        // Lógica para recibir datos por GET [cite: 8, 10]
        if (isset($_GET['seccion'])) {
            $seccion = $_GET['seccion'];
            echo "<h3>Has seleccionado la sección: " . htmlspecialchars($seccion) . "</h3>"; // [cite: 11, 12]
        }
        ?>
    </div>

    <hr>

    <h2>Formulario de Contacto</h2>
    <form action="index.php" method="POST"> <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br> <label for="email">Correo electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br> <button type="submit">Enviar Datos</button>
    </form>

    <div>
        <?php
        // Lógica para recibir datos por POST [cite: 13, 19]
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];

            echo "<h3>Datos recibidos por POST:</h3>";
            echo "Nombre: " . htmlspecialchars($nombre) . "<br>"; // [cite: 20, 21]
            echo "Email: " . htmlspecialchars($email); // [cite: 20, 21]
        }
        ?>
    </div>

</body>
</html>