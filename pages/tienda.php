<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<?php
session_start();

// Evitar que el usuario acceda directamente a la paguina principal sin haber iniciado sesión antes
if (!isset($_SESSION["username"])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario desde la sesión
$username = $_SESSION["username"];

// Conectar a la base de datos
$mysqli = new mysqli("127.0.0.1", "root", "razerblade", "hacckergadget", 3306);

if ($mysqli->connect_errno) {
    echo "Fallo al conectarse a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Obtener el ID del usuario
$idQuery = "SELECT id FROM Usuarios WHERE nombre_usuario = '$username'";
$idResult = $mysqli->query($idQuery);
// Verificar que la consulta haya devuelto una fila
if ($idResult->num_rows == 1) {
    $row = $idResult->fetch_assoc();
    $userId = $row["id"];
}

// Inicializar mensaje de respuesta
$mensajeRespuesta = '';

// Manejar la compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto = $_POST["producto"];

    // Realizar la inserción en la base de datos de historial de compras
    $insertQuery = "INSERT INTO HistorialCompras (id_usuario, $producto) VALUES ($userId, 1)";
    $insertResult = $mysqli->query($insertQuery);

    if ($insertResult) {
        // Introducción exitosa
        $mensajeRespuesta = "Compra realizada con éxito.";
        echo '<script>window.onload = function() { alert("Compra realizada con éxito."); }</script>';
    } else {
        // Error al realizar la compra
        $mensajeRespuesta = "Error al realizar la compra. Inténtalo nuevamente.";
    }
}
?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - Haccking</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/HacckingGadget-icon.ico">
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <style>
        /* Ajusta el tamaño del hitbox del botón Historial */
        .historial-btn, .inicio-btn {
            font-size: 50px; /* Tamaño de fuente */
            padding: 10px 20px; /* Padding alrededor del botón */
            position: absolute; /* Posición absoluta */
            top: 5px; /* Distancia desde la parte superior */
        }

        .historial-btn {
            right: 10px; /* Distancia desde la derecha para el botón Historial */
        }

        .inicio-btn {
            left: 10px; /* Distancia desde la izquierda para el botón Inicio */
        }

        .productos {
            position:relative;
            top:5em;
            margin-right: 5%;
            margin-left:35%;
            bottom: 10em;
        }

        .productos article {
            width: 60%;
        }
    </style>
</head>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<body>
    <header>
        <!-- Botón para ir al historial de compras -->
        <a href="historial.php" class="historial-btn">Historial</a>
        <!-- Botón para ir a la página principal -->
        <a href="../index.php" class="inicio-btn">Inicio</a>
    </header>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <main>
        <section class="productos">
            <form action="tienda.php" method="post">
                <!--Mostrar los productos disponibles en la tienda-->
                <article>
                    <img src="../img/flipperzero.png" width="100%">
                    <h2 style="font-size: 30px;">Flipper Zero</h2>
                    <h3 style="font-size: 20px;">El Flipper Zero es un dispositivo multiherramienta de código abierto que fue diseñado para la investigación y realización de pruebas de tecnologías de comunicación inalámbrica, sistemas de seguridad y dispositivos electrónicos en general. Se presenta como un juguete con forma de delfín cibernético que crece mientras interactúas con sistemas digitales en la vida real. Puede emular llaves, mandos a distancia, tarjetas RFID, NFC y otros protocolos inalámbricos. También tiene un puerto USB, una ranura para tarjetas microSD y pines GPIO para conectar otros dispositivos.</h2>
                    <input type="hidden" name="producto" value="producto1">
                    <button type="submit">Comprar ahora</button>
                    <h3>___________________________________________________________________</h3>
                </article>
            </form>
            
            <form action="tienda.php" method="post">
                <article>
                    <img src="../img/hackrfone.png" width="100%">
                    <h2 style="font-size: 30px;">Hackrf One</h2>
                    <h3 style="font-size: 20px;">El HackRF One es un dispositivo de radio definido por software (SDR, por sus siglas en inglés) que puede recibir y transmitir señales de radio desde 1 MHz hasta 6 GHz. Se puede usar como un periférico USB o programar para operar de forma independiente. Está diseñado para facilitar el testeo y desarrollo de tecnologías de radio modernas y de próxima generación. Es un dispositivo de código abierto y tiene una gran comunidad de usuarios y desarrolladores.</h2>
                    <input type="hidden" name="producto" value="producto2">
                    <button type="submit">Comprar ahora</button>
                    <h3>___________________________________________________________________</h3>
                </article>
            </form>
            
            <form action="tienda.php" method="post">
                <article>
                    <img src="../img/rubberducky.png" width="100%">
                    <h2 style="font-size: 30px;">USB Rubber Ducky</h2>
                    <h3 style="font-size: 20px;">El USB Rubber Ducky es un dispositivo que se parece a una memoria USB, pero que en realidad actúa como un teclado que puede enviar pulsaciones de teclas a gran velocidad. Se puede usar para ejecutar comandos o scripts maliciosos en un ordenador sin que el usuario se dé cuenta. Es una herramienta de hacking muy peligrosa que puede robar datos, contraseñas o infectar el sistema con virus.</h2>
                    <input type="hidden" name="producto" value="producto3">
                    <button type="submit">Comprar ahora</button>
                    <h3>___________________________________________________________________</h3>
                </article>
            </form>
            <div style="height: 400px;"></div> <!--Añadir espaciado para que sea más facil para el usuario localizar el boton de compra del último producto-->
        </section>
    </main>
    <?php if (!empty($mensajeRespuesta)): ?>
        <p class="mensaje-respuesta"><?php echo $mensajeRespuesta; ?></p>
    <?php endif; ?>
</body>
</html>
