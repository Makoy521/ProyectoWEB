<?php 
class Marker {

	const TABLE = 'markers';
	public $id;
	public $lat;
	public $lng;
	public $user_id;

	function __construct() 
	{

	}

	public function save()
	{
		try {
			require_once($_SERVER['DOCUMENT_ROOT'].'/db/DB.php');
			$db = new DB();
			$dbh= $db->getConnection();
			$query = "INSERT INTO " . self::TABLE . "(lat, lng, user_id) VALUES(:lat, :lng, :user_id)";
			$stm = $dbh->prepare($query);
			$stm->bindParam(':lat', $this->lat);
			$stm->bindParam(':lng', $this->lng);
			$stm->bindParam(':user_id', $this->user_id);

			$stm->execute();
			return $stm->rowCount();

		}catch(PDOException $e) {
			return -1;
		}
	}

	public static function findByUser($user_id)
	{	
		try {
			require_once($_SERVER['DOCUMENT_ROOT'].'/db/DB.php');
			$db = new DB();
			$dbh= $db->getConnection();
			$query = "SELECT * FROM " . self::TABLE . " WHERE user_id = :user_id";
			$stm = $dbh->prepare($query);
			$stm->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Marker');
			$stm->bindParam(':user_id', $user_id);
			$stm->execute();
			
			$markers = [];
			while($marker=$stm->fetch())
				array_push($markers, $marker);
			return $markers;

		}catch(PDOException $e) {
			return array();
		}
	}
 }?>
