<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Evitar que el usuario acceda directamente a la paguina principal sin haber iniciado sesión antes-->
<?php
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION["username"])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header("Location: pages/login.php");
    exit();
}
?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<?php
// Conectar a la base de datos
$mysqli = new mysqli("127.0.0.1", "root", "razerblade", "hacckergadget", 3306);

if ($mysqli->connect_errno) {
    echo "Fallo al conectarse a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Manejar el envío del formulario
if ($_SERVER && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $mysqli->real_escape_string($_POST['name']); // Medida que ha sido imprescindible para la corecta introcuccion del formulario a la base de datos
    $email = $mysqli->real_escape_string($_POST['email']); // A demás que es una practica importante ya que cubre problemas de seguridad como el SQL Injection
    $mensaje = $mysqli->real_escape_string($_POST['message']);

    // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla Contactos
    $insertQuery = "INSERT INTO Contactos (nombre, email, mensaje) VALUES ('$nombre', '$email', '$mensaje')";
    $insertResult = $mysqli->query($insertQuery);

    if ($insertResult) {
        $mensajeRespuesta = "Mensaje enviado. Gracias por contactarnos.";
    } else {
        $mensajeRespuesta = "Error al enviar el mensaje. Por favor, inténtalo nuevamente.";
    }
}

$mysqli->close();
?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/HacckingGadget-icon.ico">
    <title>Contacto</title>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <style>
        html{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            background-color: #131313;
            color: #ebebeb;
        }
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1f1f1f;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            color: black;
        }

        input[type="submit"] {
            background-color: rgb(204, 255, 122);
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: orange;
        }

        .mensaje-respuesta {
            text-align: center;
            margin-top: 20px;
            color: white;
        }
        .inicio-btn {
            left: 10px;
            font-size: 50px;
        }
    </style>
</head>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<body>
    <a href="../index.php" class="inicio-btn">Inicio</a> <!--Botón para ser redirigido de vuelta al inicio-->
    <form id="contact-form" action="contacto.php" method="post">

        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Correo electrónico</label> <!--                        3 Campos-rellenar-enviar                              -->
        <input type="email" id="email" name="email" required>

        <label for="message">Mensaje</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <input type="submit" value="Enviar">
    </form>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

    <?php if (isset($mensajeRespuesta)): ?>
        <p class="mensaje-respuesta"><?php echo $mensajeRespuesta; ?></p>
    <?php endif; ?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

</body>
</html>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
