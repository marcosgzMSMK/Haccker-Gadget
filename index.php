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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Haccking</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css"> <!--Cargar el estilo de styles.css-->
	<link rel="icon" href="img/HacckingGadget-icon.ico"> <!--icono en la barra-->
</head>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Superior de la paguina-->
<body>
	<header>
		<div>
			<a href="pages/login.php" style="font-size: 35px; margin-left:1%;">Iniciar sesión</a>
		</div>
		<div class="menu">
			<img src="img/HacckingGadget-icon.png" height="200%" alt="logo Haccking Gadget">
			<a href="pages/quienes-somos.html" style="font-size: 40px;">Quienes somos</a>
			<a href="pages/tienda.php" style="font-size: 40px;">Tienda</a>
			<a href="pages/contacto.php" style="font-size: 40px;">Contacto</a>
		</div>
		<div class="envios">
			<a href="#">ENVÍO GRATIS EN MÁS DE 50€</a>
			<a href="#">50% EN LA CYBER WEEK</a>
			<a href="#">DEVOLUCIONES Y CAMBIOS SIN GASTOS DE ENVÍO</a>
		</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Texto con color transitorio sobre la imagen-->
		<div class="horaDeMoverse" href="tienda.php">
			<div class="textoMoverse">
				<img src="" alt="">
				<h1 id="tituloMov">Haccking Gadget</h1>
				<p id="textoMov">Descubre el mundo del hacking con nuestros gadgets</p>
			</div>
		</div>
	</header>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Productos Principales-->
	<main>
		<section class="productos">
			<article>
				<img src="img/flipperzero.png" width="100%">
				<h2 style="font-size: 30px;">Flipper Zero</h2>
				<a href="pages/tienda.php">Comprar</a>
			</article>
			<article>
				<img src="img/hackrfone.png" width="100%">
				<h2 style="font-size: 30px;">Hackrf One</h2>
				<a href="pages/tienda.php">Comprar</a>
			</article>
			<article>
				<img src="img/rubberducky.png" width="100%">
				<h2 style="font-size: 30px;"> USB Rubber Ducky</h2>
				<a href="pages/tienda.php">Comprar</a>
			</article>
		</section>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!--Google Maps-->
		<div>
			<p>calle Consuegra 3</p>
			<p>
				<iframe style="filter: invert(90%)" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3035.0205649708564!2d-3.679125987087969!3d40.47481005198088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4229475fc7e749%3A0x71a6fb4707b13a23!2sC.%20Consuegra%2C%203%2C%2028036%20Madrid!5e0!3m2!1ses!2ses!4v1695728540816!5m2!1ses!2ses&amp;mode=dark" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</p>			
		</div>
	</footer>
	
</body>
</html>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->