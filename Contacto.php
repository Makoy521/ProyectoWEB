<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('location:index.php');
    }
    
    if(isset($_POST['enviarBtn'])) {
        if(empty($_POST['enviarBtn'])) {
            echo 'The task cannot be empty';
        } else  {
            try{
                require_once 'DB.php';
                $mensa=$_POST['mensaje'];
                $tipo=1;

                require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
                $db = new DB();
                $dbh= $db->getConnection();
                    
                $query = 'INSERT INTO mensaje (idUser, texto, tipo) VALUES(:id, :texto, :tipo)';
                $stm = $dbh->prepare($query);
                    
                $stm->bindParam(':id', $_SESSION['user']['id']);
                $stm->bindParam(':texto', $mensa);
                $stm->bindParam(':tipo', $tipo);

                $stm->execute();
            } catch(PDOException $e) {
                showError('An error occurred while trying to save the task');
            }					
        }
    }
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="stylePrincipal.css">
<link href="https://file.myfontastic.com/t5tNwfwUapz4yDzK3B6sfe/icons.css" rel="stylesheet">
    <header class="header">
      <div class="contenedor">
        <h1 class="logo">Sistema Reconstruccion</h1>
        <span class="icon-menu" id="btn-menu"></span>
        <nav class="nav" id="nav">
          <ul class="menu">
            <li class="menu__item"><a href="Principal.php" class="menu__link">Inicio</a></li>
            <li class="menu__item"><a href="Reporte.php" class="menu__link">Crea un reporte</a></li>
            <li class="menu__item"><a href="Contacto.php" class="menu__link select">Contacto</a>
            </li>
            <li class="menu__item"><a href="logout.php" class="menu__link">Salir</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <body>
    <div class="report">
        <?php 
            require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
            $db = new DB();
            $dbh= $db->getConnection();
            
            $query = "SELECT * FROM mensaje WHERE idUser = ".$_SESSION['user']['id'];
            $stm = $dbh->prepare($query);
            
            $stm->execute();
            while ($row=$stm->fetch()) {
                if($row['tipo']==1){
                    $data ='<div class="user-msj">
                        <div class="msj-content">'
                            .$row['texto'].
                        '</div> 
                    </div>';
                }else{
                    $data ='<div class="adm-msj">
                        <div class="msj-content">'
                            .$row['texto'].
                        '</div> 
                    </div>';
                }
              echo $data;
            } 
        ?>   
        <form method="POST" action="Contacto.php" enctype="multipart/form-data">
          <p>Mensaje:</p>
          <textarea id='mens' name="mensaje" cols="40" rows="3"></textarea>
          <input type="submit" value="Enviar" name="enviarBtn">
        </form>
    </div>
    <div class="banner">
        <img src="img/bg.jpg" alt="">
    </div>
    </body>
</html>
