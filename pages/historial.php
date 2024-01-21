<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<?php
session_start();

// Evitar que el usuario acceda directamente a la paguina principal sin haber iniciado sesión antes
if (!isset($_SESSION["username"])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header("Location: login.html");
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
    $userId = $row["id"]; // Almacenar la variable de la ID del usuario
}

// Obtener historial de compras del usuario
$historialQuery = "SELECT fecha_compra, producto1, producto2, COALESCE(producto3, 0) AS producto3 FROM HistorialCompras WHERE id_usuario = $userId";
$historialResult = $mysqli->query($historialQuery);
// almacenar todas las filas
$historial = [];
while ($row = $historialResult->fetch_assoc()) {
    $historial[] = $row;
}

$mysqli->close();

// Mapeo de códigos de productos a nombres e imágenes
$productos = [
    1 => ["nombre" => "Flipper Zero", "imagen" => "flipperzero.png"],
    2 => ["nombre" => "Hackrf One", "imagen" => "hackrfone.png"],
    3 => ["nombre" => "USB Rubber Ducky", "imagen" => "rubberducky.png"],
];

?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras - Haccking</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/HacckingGadget-icon.ico">
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <style>
        .historial {
            text-align: center;
            margin-top: 10%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: rgb(204, 255, 122); /* Fondo verde */
            color: #fff; /* Texto blanco */
        }

        .imagen-columna {
            width: 100px; /* Ancho de la columna de imágenes */
        }

        /* Color de la tabla */
        .verde-fondo {
            background-color: rgb(204, 255, 122); /* Fondo verde */
        }

        .tienda-btn {
            font-size: 50px; /* Tamaño de fuente */
            padding: 15px; /* Padding alrededor del botón */
        }

    </style>
</head>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<body>
    <header>
        <!-- Botón para regresar a la tienda -->
        <a href="tienda.php" class="tienda-btn">Tienda</a>
    </header>

    <main>
        <section class="historial">
            <h1>Historial de Compras</h1>
            <?php if (!empty($historial)): ?>
                <table>
                    <tr>
                        <th class="verde-fondo">Fecha de Compra</th><!-- Fecha de la compra -->
                        <th class="verde-fondo">Producto Comprado</th><!-- Nombre del producto -->
                        <th class="verde-fondo">Previsualización</th> <!-- Imagen del producto -->
                    </tr>
                    <?php foreach ($historial as $row): ?>
                        <?php foreach ($productos as $codigo => $producto): ?>
                            <?php if ($row["producto" . $codigo]): ?>
                                <!---Empieza nueva fila sobre la tabla para cada producto comprado-->
                                <tr>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                    <td><?php echo $row["fecha_compra"]; ?></td>
                                    <td><?php echo $producto["nombre"]; ?></td>
                                    <td class="imagen-columna">
                                        <img src="../img/<?php echo $producto["imagen"]; ?>" alt="<?php echo $producto["nombre"]; ?>" width="100">
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No hay compras realizadas.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->