<nav style="background-color:#464646;" class="navbar navbar-expand-lg navbar-dark fixed-top nav" id="mainNav">
    <div class="container">
        <a style="font-size: 30px;" class="navbar-brand js-scroll-trigger" id="navbar-brand2" href="index2.php"><img src="../model/img/navbar-logo.png" alt="Logo Ssmike" /> Ssmike <br></a>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
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