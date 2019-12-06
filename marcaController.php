<?php 
session_start();
	if(!isset($_SESSION['user']))
		header('location: index.php');
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['lat']) && isset($_POST['lng'])) {
			require_once($_SERVER['DOCUMENT_ROOT'].'/models/Marker.php');
			try {
				$m = new Marker();
				$m->lat = $_POST['lat'];
				$m->lng = $_POST['lng'];
				$m->user_id =  $_SESSION['user']['id'];
				$rowCount = $m->save();

				if($rowCount === 1) 
					header('location:home.php?status=1');
				else
					header('location:home.php?status=-1');
			}catch(PDOException $e) {
				header('location:home.php?status=-1');
			}catch(Exception $e)
			{
				header('location:home.php?status=-2');
			}
		}
	} else if($_SERVER['REQUEST_METHOD'] === 'GET') {
		require_once($_SERVER['DOCUMENT_ROOT'].'/models/Marker.php');
		$markers = Marker::findByUser($_SESSION['user']['id']);
		header('Content-Type: application/json');
		echo json_encode(array('markers' => $markers));
	}
 ?>