<nav class="navbar navbar-expand-lg navbar-dark fixed-top nav" id="mainNav">
    <div class="container" style="margin-left: 0px;">
        <a style="font-size: 30px;" class="navbar-brand js-scroll-trigger" id="navbar-brand2" href="index2.php"><img src="../model/img/navbar-logo.png" alt="Logo Ssmike" /> Ssmike <br></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#collection">SERVICIO</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#products-grid">CATÁLOGO</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">CONÓCENOS</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#team">EQUIPO</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">CONTÁCTENOS</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="indexcuenta.php">EDITAR CUENTA</a></li>
                <li class="nav-item">
                    <form class="background-color:#464646" action="../controller/controllerusuario.php" method="post"><input type="submit" class="nav-link js-scroll-trigger" style="color:#dc3545;" value="CERRAR SESIÓN" name="Logout"></form>
                </li>
<!-- Ejemplo de botón de carrito en el nav -->
<li class="nav-item">
  <a class="nav-link js-scroll-trigger" href="../views/vistacarro.php">
    <span class="cart-icon-wrapper">
        <img src="../model/img/carrito.png" alt="Carrito" class="cart-img" />
      <?php
        $cantidad = 0;
        if (isset($_SESSION['CARRITO'])) {
          foreach ($_SESSION['CARRITO'] as $item) {
            $cantidad += $item['cantidad'];
          }
        }
        if ($cantidad > 0) {
          echo '<span class="cart-count-badge">'.$cantidad.'</span>';
        }
      ?>
    </span>
    
  </a>
</li>            </ul>
        </div>
    </div><!-- esta pagina sirve para cuando esta la sesion iniciada y la pagina esta dentro del index-->
</nav>