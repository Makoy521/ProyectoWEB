<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="styleReportes.css">
<link href="https://file.myfontastic.com/t5tNwfwUapz4yDzK3B6sfe/icons.css" rel="stylesheet">
    <header class="header">
      <div class="contenedor">
        <h1 class="logo">Sistema Reconstruccion</h1>
        <span class="icon-menu" id="btn-menu"></span>
        <nav class="nav" id="nav">
          <ul class="menu">
            <li class="menu__item"><a href="/" class="menu__link select">Inicio</a></li>
            <li class="menu__item"><a href="reportes.php" class="menu__link">Tus reportes</a></li>
            <li class="menu__item"><a href="" class="menu__link">Comunidad</a></li>
            <li class="menu__item"><a href="contacto.php" class="menu__link">Contacto</a>
            </li>
            <li class="menu__item"><a href="logout.php" class="menu__link">salir</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
     <div class="report">
      <h1 style="text-align: center; margin-top: 0;">REPORTE</h1>
        <form>
          <p>Nombre del reporte</p>
          <input type="text" name="" placeholder=" ">
          <p>Descripcion del reporte</p>
          <input type="text" name="" placeholder=" ">
          <p>Indique urgencia:</p>
          <input type="range" name="rango" min="1" max="3" list="lista-rango">
          <datalist id="lista-rango">
            <option value="1" label="Media urgente">
            <option value="2" label="Urgente">
            <option value="3" label="Muy urgente">
          </datalist>
          <input type="file" name="archivo">
          <input type="submit" name="" value="enviar">
        </form>
     </div>
    <div class="banner">
     <img src="img/bg.jpg" alt="">
    </div>
    <footer class="footer">
      <div class="contenedor">
        <div class="social">
          <a href="#" class="icon-facebook"></a>
          <a href="#" class="icon-twitter"></a>
          <a href="#" class="icon-gplus"></a>
          <a href="#" class="icon-vine"></a>
        </div>
        <p class="copy">&copy; Sistema de reparacion </p>
      </div>
    </footer>
    <script src="menu.js"></script>
  </body>
</html>