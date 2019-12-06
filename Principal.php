<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('location:index.php');
  }
  if(isset($_GET['finish'])){
      require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
			$db = new DB();
			$dbh= $db->getConnection();
      $query = "UPDATE denuncias SET estatus = 'Resuelto' WHERE idDenuncia = :id";
      $stm = $dbh->prepare($query);
			$stm->bindParam(':id', $_GET['finish']);

			$stm->execute();
			$result = $stm->rowCount();

      if($result!=1) {
        echo '<script> alert("Error") </script>';
      } 
  } else if(isset($_GET['delete'])){
      require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
			$db = new DB();
			$dbh= $db->getConnection();
      $query = "DELETE FROM denuncias WHERE idDenuncia = :id";
      $stm = $dbh->prepare($query);
			$stm->bindParam(':id', $_GET['delete']);

			$stm->execute();
			$result = $stm->rowCount();

      if($result != 1) {
        echo '<script> alert("Error") </script>';
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
            <li class="menu__item"><a href="Principal.php" class="menu__link select">Inicio</a></li>
            <li class="menu__item"><a href="Reporte.php" class="menu__link">Crea un reporte</a></li>
            <li class="menu__item"><a href="Contacto.php" class="menu__link">Contacto</a>
            </li>
            <li class="menu__item"><a href="logout.php" class="menu__link">Salir</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="banner">
     <img src="img/bg.jpg" alt="">
      <div class="contenedor">
        <h2 class="banner__titulo">Por ti hacemos una ciudad mejor</h2>
        <p class="banner__txt">Ayudanos a ayudarte</p>
      </div>
    </div>
    <main class="main">
      <div class="denuncias">
        <?php
          require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
          $db = new DB();
          $dbh= $db->getConnection();
          
          if($_SESSION['user']['tipo']=='Estandar'){
            $query = "SELECT * FROM denuncias WHERE idUser =".$_SESSION['user']['id'];
            $stm = $dbh->prepare($query);
            $stm->execute();
  
            while ($row=$stm->fetch()) {
              $data =
              '<div class="report '.$row['estatus'].'">
                <div class="titulo-reporte"> Reporte - '.$row['fecha'].'</div>
                <div class="body-rep">
                  <div class="img-View"><img src="subemesta/'.$row['fotografia'].'"></div>
                  <div class="info">	
                    <ul>
                      <li>Estatus: '.$row['estatus'].'</li>	
                      <li> Problema presentado: '.$row['tipo'].'</li>
                    </ul>
                  </div>	
                </div> 
              </div>';
              echo $data;
            }
          }
          else{
            $query = "SELECT * FROM denuncias";
            $stm = $dbh->prepare($query);
            $stm->execute();
  
            while ($row=$stm->fetch()) {
              $data =
              '<div class="report '.$row['estatus'].'">
                <div class="titulo-reporte"> Reporte - '.$row['fecha'].'</div>
                <div class="body-rep">
                  <div class="img-View"><img src="subemesta/'.$row['fotografia'].'"></div>
                  <div class="info">	
                    <ul>
                    <li>Estatus: '.$row['estatus'].'</li>	
                    <li> Problema presentado: '.$row['tipo'].'</li>
                  </ul>
                  <div class="botones-prin">
                    <a href="Principal.php?finish='.$row['idDenuncia'].'" class="btn btn-primary btn-sm">Terminar</a>
                    <a href="Principal.php?delete='.$row['idDenuncia'].'" class="btn btn-primary btn-sm">Eliminar</a>
                  </div>
                </div>	
              </div> 
            </div>';
            echo $data;
            }
          }
         
        ?>
      </div>
    </main>
    <footer class="footer">
      <div class="contenedor">
        <div class="social">
          <a href="https://www.facebook.com/curatudepresion/" class="icon-facebook"><img src="img/png/facebook.png"></a>
          <a href="https://twitter.com/perritos_hc?lang=es" class="icon-twitter"><img src="img/png/twitter.png"></a>
          <a href="https://www.google.com/search?q=perrito+adorable&source=lnms&tbm=isch&sa=X&ved=2ahUKEwjbtquwxv7lAhUBVK0KHZcQB2cQ_AUoAXoECA4QAw&biw=1360&bih=657#imgrc=5MkAdhxnA3D6qM:" class="icon-gplus"><img src="img/png/google.png"></a>
        </div>
        <p class="copy">&copy; Sistema de reparacion </p>
      </div>
    </footer>
    <script src="menu.js"></script>
    <script type="text/javascript">
      function loadLocation () {
        //inicializamos la funcion y definimos  el tiempo maximo ,las funciones de error y exito.
        navigator.geolocation.getCurrentPosition(viewMap,ViewError,{timeout:1000});
      }
      
      //Funcion de exito
      function viewMap (position) {
        
        var lon = position.coords.longitude;	//guardamos la longitud
        var lat = position.coords.latitude;		//guardamos la latitud
      }
      
      function ViewError (error) {
        alert(error.code);
      }	
      loadLocation();  
    </script>
  </body>
</html>