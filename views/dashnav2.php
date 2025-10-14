<nav style="background-color:#464646;" class="navbar navbar-expand-lg navbar-dark nav" id="mainNav">
    <div class="container">
        <a style="font-size: 16px;" class="navbar-brand js-scroll-trigger" id="navbar-brand2" href="index.html">Ssmike</a> <br>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <p class="nav-link js-scroll-trigger"><?php echo $_SESSION['name']; ?></p>
                    </li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="indexcuenta.php">EDITAR CUENTA</a></li>
                    <li class="nav-item">
                        <form class="background-color:#464646" action="../controller/controllerusuario.php" method="post"><input type="submit" class="nav-link js-scroll-trigger" style="color:#dc3545;" value="CERRAR SESIÓN" name="Logout"></form>
                    </li>
                    <li style="nav-item"><a class="navbar-brand js-scroll-trigger" id="navbar-brand2" href="#page-top"><img src="../model/img/carrito.png" />(<?php echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']); ?>)</a></li>
                </ul>
            </div>
    </div>
</nav>