<?php 
	session_start();
	if(!isset($_SESSION['user']))
    header('location:index.php');
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="styleReportes.css">
<script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />

    <header class="header">
      <div class="contenedor">
        <h1 class="logo">Sistema Reconstruccion</h1>
        <span class="icon-menu" id="btn-menu"></span>
        <nav class="nav" id="nav">
          <ul class="menu">
            <li class="menu__item"><a href="Principal.php" class="menu__link">Inicio</a></li>
            <li class="menu__item"><a href="" class="menu__link select">Crea un reporte</a></li>
            <li class="menu__item"><a href="Contacto.php" class="menu__link">Contacto</a>
            </li>
            <li class="menu__item"><a href="logout.php" class="menu__link">Salir</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
     <div class="report">
      <h1 style="text-align: center; margin-top: 0;">REPORTE</h1>
      <form method="POST" action="upload.php" enctype="multipart/form-data">
          <p>Descripcion del reporte</p>
          <input type="text" name="desc" placeholder=" ">
          <p>Tipo de Reporte:</p>
          <input type="text" name="type" placeholder=" ">
          <p>Indique urgencia:</p>
          <input type="range" name="rango" min="1" max="3" list="lista-rango">
          <datalist id="lista-rango">
            <option value="1" label="Media urgente">
            <option value="2" label="Urgente">
            <option value="3" label="Muy urgente">
          </datalist>
          <input name="uploadedFile" type="file"/>
          
          <div class="mapContainer" style="height: 310px;position: relative;">
          <div id='map' style='width: 280px; height: 300px;'></div>
          <input type="hidden" name="latitud" id="ll">
          <input type="hidden" name="longitud" id="lg">
          <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoiaWduYWNpb2lnbGVzaWFzNDMiLCJhIjoiY2szbzRnemxkMXg2ZjNka28ybmRvcXlkZSJ9.VubgiyQs-uSgZmNpJNnqXw'
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    center: [-110.316120, 24.102782], 
                    zoom: 14
                })

                const onAddMarker= function(e) {
                    if(typeof marker === 'undefined') {
                        marker = new mapboxgl.Marker({
                            draggable: true
                        })
                        
                        .setLngLat(e.lngLat.wrap())
                        .addTo(map)
                        document.querySelector('#ll').value = e.lngLat.wrap().lat
                        document.querySelector('#lg').value = e.lngLat.wrap().lng
                    }
                }

                map.on('click', onAddMarker)
                </script>
          </div>
          <input type="submit" value="Registrar" name="uploadBtn">
        </form>
     </div>
    <div class="banner">
     <img src="img/bg.jpg" alt="">
    </div>
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
  </body>
</html>