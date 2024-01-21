<!--Gestiónar el formulario de cambio de contraseña-->
<?php
session_start();

$mysqli = new mysqli("127.0.0.1", "root", "razerblade", "hacckergadget", 3306);

if ($mysqli->connect_errno) {
    echo "Fallo al conectarse a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];

    // Verificar las credenciales existen en la base de datos
    $query = "SELECT id FROM Usuarios WHERE nombre_usuario = '$username' AND contrasena = '$oldPassword'";
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        // Actualizar la contraseña del usuario
        $updateQuery = "UPDATE Usuarios SET contrasena = '$newPassword' WHERE nombre_usuario = '$username'";
        $updateResult = $mysqli->query($updateQuery);

        if ($updateResult) {
            echo "Contraseña cambiada con éxito.";
            sleep(2); 
            header("Location: ../index.php");

        } else {
            echo "Error al cambiar la contraseña. Inténtalo nuevamente.";
        }
    } else {
        // Credenciales incorrectas, informar al usuario
        echo "La contraseña actual es incorrecta. Inténtalo nuevamente.";
    }
}

$mysqli->close();
?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Encabezado con título en la pestaña informando dónde se sitúa el usuario-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña - Haccing</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Framework de Boostrap -->
    <link rel="icon" href="../img/HacckingGadget-icon.ico">
</head>
<style>
    body {
    background-color: #131313; /* Color de fondo */
    color: white; /* Color del texto */
    }

    .changepasswd {
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
<!--Estructura del formulario de cambio de contraseña-->
<body>
    <main class="container">
        <section class="changepasswd mt-5">
            <h1 class="mb-4">Cambiar Contraseña</h1>
            <form action="changepasswd.php" method="post">
                <div class="form-group">
                    <label for="old_password">Contraseña Actual:</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Nueva Contraseña:</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
            </form>
        </section>
    </main>
</body>
</html>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
