<?php 
session_start();
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/Usuario.php');
		if(isset($_POST['register'])) {
			try {
					$u = new Usuario();
					$u->name = $_POST['name'];
					$u->email = $_POST['email'];
					$u->nickname = $_POST['nickname'];
					$u->password = $_POST['password'];
					$u->date = $_POST['date'];

					$rowCount = $u->save();
					if($rowCount === 1) 
						header('location:index.php?status=1');
					else
						header('location:registro.php?status=-2');
			}catch(PDOException $e) {
				header('location:registro.php?error=1');
			}catch(Exception $e)
			{
				header('location:registro.php?error=2');
			}
		} else if(isset($_POST['login'])) {
			$usuario = Usuario::findByEmail($_POST['nickname'], $_POST['password']);
			if(!is_null($usuario)) {
				$_SESSION['user'] = array('id' => $usuario->idUscuario, 'nickname' => $usuario->usuario, 'tipo'=> $usuario->tipo);
				header('location:principal.php');
			} else {
				header('location:index.php?status=-1');
			}
		}
	}

	function compare_password($pass, $hash) {
		return sha1($pass) === $hash;
	}
 ?>