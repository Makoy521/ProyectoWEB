<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('location:index.php');
    }
    
    if(isset($_POST['enviarBtn'])) {
        try{
                require_once 'DB.php';
                $mensa=$_POST['mensaje'];
                $user = $_POST['user'];
                if($_SESSION['user']['tipo']=='Estandar'){
                    $tipo=1;
                }else{
                    $userr=$user;
                    $tipo=2;
                }

                require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
                $db = new DB();
                $dbh= $db->getConnection();
                    
                $query = 'INSERT INTO mensaje (idUser, texto, tipo) VALUES(:id, :texto, :tipo)';
                $stm = $dbh->prepare($query);
                    
                $stm->bindParam(':id', $user);
                $stm->bindParam(':texto', $mensa);
                $stm->bindParam(':tipo', $tipo);

                $stm->execute();
        } catch(PDOException $e) {
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
    <div class="banner">
        <img src="img/bg.jpg" alt="">
    </div>
    <body>
    <div class="report">
    <?php
        if($_SESSION['user']['tipo']!='Estandar'){
            require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
            $db = new DB();
            $dbh= $db->getConnection();
            $query = 'SELECT * FROM usuario WHERE tipo = "Estandar"';
            $stm = $dbh->prepare($query);
            $stm->execute();

            echo '<p>Seleccionar Usuario:</p>';
            echo '<select name="option" id="selectUser" onchange="cambiarUsuario()">';
            echo '<option value="def">Seleccionar Usuario</option>';
            while ($row=$stm->fetch()) {
                echo '<option value="'.$row['idUscuario'].'">'.$row['usuario'].'</option>';
            }
            echo '</select>';
        }
    ?>
        <script type="text/javascript">
        function cambiarUsuario(){
            var e = document.getElementById("selectUser");
            var strUser = e.options[e.selectedIndex].value;
            if(strUser!='def')
                window.location="Contacto.php?user="+strUser;
        }
        </script>
        <?php 
            require_once($_SERVER['DOCUMENT_ROOT'].'/ProyectoWEB/DB.php');
            
            if($_SESSION['user']['tipo']=='Estandar'){
                $userr = $_SESSION['user']['id'];
            }else{
                if(isset($_POST['enviarBtn'])){
                    $userr = $_POST['user'];
                }else{
                    if(isset($_GET['user']))
                        $userr = $_GET['user'];
                    else
                        $userr="1";
                }
                $db = new DB();
                $dbh= $db->getConnection();
                $query = "SELECT * FROM usuario WHERE idUscuario = ".$userr;
                $stm = $dbh->prepare($query);
                $stm->execute();
                while ($row=$stm->fetch()) {
                    echo '<p class="name-user-msj">'.$row['usuario'].':</p>';
                }
            }

            $db = new DB();
            $dbh= $db->getConnection();
            $query = "SELECT * FROM mensaje WHERE idUser = ".$userr;
            $stm = $dbh->prepare($query);
            
            $stm->execute();
            echo '<div class="mensajes">';
            while ($row=$stm->fetch()) {
                if($row['tipo']==='rec'){
                    $data ='<div class="msj u-msj">
                        <div class="msj-content"><p>'
                            .$row['texto'].
                        '</div> 
                        </p></div>';
                }else{
                    $data ='<div class="msj a-msj">
                        <div class="msj-content"><p>'
                            .$row['texto'].
                        '</p></div> 
                    </div>';
                }
              echo $data;
            } 
            echo '</div>';
        ?>   
        <form method="POST" action="Contacto.php" enctype="multipart/form-data">
          <p>Mensaje:</p>
            <?php
                echo '<input type="hidden" value="'.$userr.'" name="user">'
            ?>
            <textarea id='mens' name="mensaje" cols="50" rows="3"></textarea>
            <input type="submit" value="Enviar" name="enviarBtn">
        </form>
    </div>
    </body>
</html>
