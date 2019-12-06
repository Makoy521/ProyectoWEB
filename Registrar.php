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
		<link rel="stylesheet" href="styleRegistrar.css">
	</head>
	<body>
		<div class="loginBox">
			<img src="img/user.png" class="user">
			<h2>Crear cuenta</h2>
			<form action="usuarioController.php"method="POST">
				<p>Nombre</p>
				<input type="text" name="name" placeholder="Nombre Completo">
				<p>Correo Electronico</p>
				<input type="text" name="email" placeholder="abc@abc.com">
				<p>Usuario</p>
				<input type="text" name="nickname" placeholder="usuario">
				<p>Fecha de nacimiento</p>
				<input type="date" name="date" placeholder="Edad">
				<p>Contraseña</p>
				<input type="password" name="password" placeholder="*****">
				<p>Confirmar contraseña</p>
				<input type="password" name="" placeholder="*****">
				
				<input type="submit" name="register" value="Entrar">
			</form>
			
		</div>
	</body>
</html>

