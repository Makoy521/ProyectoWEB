<?php 
session_start();

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Registrar')
{
    require_once 'DB.php';

    $desc=$_POST['desc'];
    $fecha = date("Y-m-d H:i:s");
    $lat=$_POST['latitud'];
    $long=$_POST['longitud'];
    $rango=$_POST['rango'];
    $tipo=$_POST['type'];
    $range=$_POST['rango'];
    $imagen='default.jpg';
    $estado='Pendiente';

    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
    {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)){
            $uploadFileDir = './subemesta/';
            $dest_path = $uploadFileDir . $newFileName;
            if(move_uploaded_file($fileTmpPath, $dest_path)){
                echo 'Check';
            }
            else{
                echo 'Error';
            }
        }
        $imagen=$newFileName;
    }
    else{
        if($_FILES['uploadedFile']['error']==4){
            $message = 'OK';
        }else{
            $message = 'Ha ocurrido un error subiendo el archivo.';
            $message .= 'Error:' . $_FILES['uploadedFile']['error']; 
        }   
    }

    if($desc!='' && $lat!='' && $long!='' && $tipo!=''){
        require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
        $db = new DB();
        $dbh= $db->getConnection();
        
        $query = 'INSERT INTO denuncias (iduser, tipo, importancia, fecha, comentario, fotografia, latitud, longitud, estatus)
            VALUES(:id, :tipo, :impor, :fecha ,:com , :foto, :lat, :lon, :est)';
        $stm = $dbh->prepare($query);
        
        $stm->bindParam(':id', $_SESSION['user']['id']);
        $stm->bindParam(':tipo', $tipo);
        $stm->bindParam(':impor', $range);
        $stm->bindParam(':fecha', $fecha);
        $stm->bindParam(':com', $desc);
        $stm->bindParam(':foto', $imagen);
        $stm->bindParam(':lat', $lat);
        $stm->bindParam(':lon', $long);
        $stm->bindParam(':est', $estado);

        $stm->execute();

        header('location:Principal.php');
    }else{
        header('location:Reporte.php');
    }
}else{
    echo 'Error';
}
foreach($_POST as $campo => $valor){
    echo "<br />- ". $campo ." = ". $valor;
}
?>