<?php
	session_start();
	if(isset($_SESSION['user'])){
		header('location:principal.php');
	}
	
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Transparent Login Form</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="loginBox">
			<img src="img/user.png" class="user">
			<h2>Bienvenido</h2>
			<form action="usuarioController.php" method="POST">
				<p>Usuario</p>
				<input type="text" name="nickname" placeholder="Usuario">
				<p>Contraseña</p>
				<input type="password" name="password" placeholder="••••••">
				<input type="submit" name="login" value="Entrar">
				<a href="Registrar.php">¿No tienes cuenta? registrate </a>
			</form>
			
		</div>
	</body>
</html>
