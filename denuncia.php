<?php 
class Usuario {

	const TABLE = 'usuario';
	public $id;
	public $name;
	public $email;
	public $nickname;
	public $password;
	public $date;
	public $tipo;

	function __construct()
	{
	}

	public function save()
	{
		try {
			require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
			$db = new DB();
			$dbh= $db->getConnection();
			// ("Bryan Muñoz Rodriguez", "bombon@gmail.com", "Bryan", "Bryan", "1999-09-06")
			$query = "INSERT INTO " . self::TABLE . "(nombre, email, usuario,pass,fechaNac) VALUES(:name,:email, :nickname,:password, :date)";
			$stm = $dbh->prepare($query);
			$stm->bindParam(':name', $this->name);
			$stm->bindParam(':email', $this->email);
			$stm->bindParam(':nickname', $this->nickname);
			$stm->bindParam(':password', $this->password);
			$stm->bindParam(':date', $this->date);

			$stm->execute();
			return $stm->rowCount();

		}catch(PDOException $e) {
			return -1;
		}
	}

	public static function findByEmail($nickname, $password) 
	{ 
		try {
			require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
			$db = new DB();
			$dbh= $db->getConnection();
			$query = "SELECT * FROM " . self::TABLE . " WHERE usuario = :nickname and pass =:password";
			$stm = $dbh->prepare($query);
			$stm->bindParam(':nickname', $nickname);
			$stm->bindParam(':password', $password);
			$stm->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Usuario');
			$stm->execute();
			
			if($usuario=$stm->fetch())
				return $usuario;
			return null;

		}catch(PDOException $e) {
			return null;
		}
	}
}
?>