<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Gestiónar el formulario de inicio de sesión-->
<?php
$mysqli = new mysqli("127.0.0.1", "root", "razerblade", "hacckergadget", 3306);

if ($mysqli->connect_errno) {
    echo "Fallo al conectarse a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Realizar la consulta para verificar las credenciales existen en la base de datos
    $query = "SELECT id FROM Usuarios WHERE nombre_usuario = '$username' AND contrasena = '$password'";
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        // Usuario autenticado, iniciar sesión
        session_start();
        $_SESSION["username"] = $username; // Guardamos el nombre de usuario para futuras peticiónes a la base de datos en diferentes apartados de la paguina 

        // Redirigir al index.php/paguina principal
        header("Location: ../index.php");
        exit();
    } else {
        // Credenciales incorrectas, informar al usuario
        echo "Usuario o contraseña incorrectos. Intenta nuevamente.";
    }
}

$mysqli->close();
?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Encabezado con titulo en la pestaña informando donde se situa el usuario-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Haccing</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Framework de Boostrap -->
    <link rel="icon" href="../img/HacckingGadget-icon.ico">
</head>
<style>
    body {
    background-color: #131313; /* Color de fondo */
    color: white; /* Color del texto */
    }

    .login{
        background-color: #292929;
        padding: 20px;
        border-radius: 10px;
    }

    form {
    max-width: 300px; /* Ancho máximo del formulario */
    margin: 0 auto; /* Centrar el formulario en la página */
    }

    .form-group {
        margin-bottom: 15px; /* Espaciado entre grupos de formularios */
    }

    .form-control {
        width: 100%; 
    }
</style>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Estructura del formulario de Inicio de Sesión-->
<body>
    <main class="container">
        <section class="login mt-5">
            <h1 class="mb-4">Iniciar Sesión</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
            <p class="mt-3">¿Aún no te has registrado? <a href="signup.php">Regístrate aquí</a></p>
        </section>
    </main>
</body>
</html>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
