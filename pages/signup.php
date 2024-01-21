<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Gestiónar el formulario del registro-->
<?php
$mysqli = new mysqli("127.0.0.1", "root", "razerblade", "hacckergadget", 3306);

if ($mysqli->connect_errno) {
    echo "Fallo al conectarse a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verificar si el nombre de usuario ya existe en la base de datos
    $checkQuery = "SELECT id FROM Usuarios WHERE nombre_usuario = '$username'";
    $checkResult = $mysqli->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // El nombre de usuario ya está en uso, informar al usuario del conflicto
        echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    } else {
        // Insertar nuevo usuario en la base de datos
        $insertQuery = "INSERT INTO Usuarios (nombre_usuario, contrasena) VALUES ('$username', '$password')";
        $insertResult = $mysqli->query($insertQuery);

        if ($insertResult) {
            // Usuario registrado con éxito, iniciar sesión y redirigir a la paguina principal
            session_start();
            $_SESSION["username"] = $username; // Guardar en la cookie de sesión su nombre de usuario
            header("Location: ../index.php");
            exit();
        } else {
            // Error al registrar usuario
            echo "Error al registrar usuario. Inténtalo nuevamente.";
        }
    }
}

$mysqli->close();
?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<style> 
    .signup{
    text-align: center;
    margin-top: 10%;
    }
</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Haccing</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/HacckingGadget-icon.ico">
</head>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<body>
    <main>  
        <section class="signup">
            <h1>Registrarse</h1>
            <form action="signup.php" method="post">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Registrarse">
            </form>
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p> <!--Redirigir al usuario en caso de que realmente si estaba registrado anteriormente-->
        </section>
    </main>
</body>
</html>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
