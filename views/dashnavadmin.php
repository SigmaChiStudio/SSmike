<nav style="background-color:#464646;" class="navbar navbar-expand-lg navbar-dark fixed-top nav" id="mainNav">
            <div class="container">
                <a style="font-size: 16px;" class="navbar-brand js-scroll-trigger" id="navbar-brand2" href="index.html">Ssmike <br><center><img src="../model/img/navbar-logo.png" /></a></center><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu<i class="fas fa-bars ml-1"></i></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <li class="nav-item"><p class="nav-link js-scroll-trigger"><?php echo $_SESSION['name'];?></p></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="indexadmin.php">ADMINISTRAR</a></li>
                        <li class="nav-item"><form action="../controller/controllerusuario2.php" method="post"><input type="submit" class="nav-link js-scroll-trigger" style="color:#dc3545;" value="CERRAR SESIÓN" name="Logout"></form></li>
                    </ul>
</div>
            </div>
        </nav>