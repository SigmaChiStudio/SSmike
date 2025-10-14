<!DOCTYPE html>
<html lang="es">
<?php
require_once '../controller/conexion.php'; // o la ruta correcta
?>
<head>
    <meta charset="utf-8" />
    <title>Iniciar Sesión como Administrador - Ssmike S.A</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="../assets/css/logginstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <link rel="icon" type="image/x-icon" href="../model/img/navbar-logo.png" />
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

</head>
<nav>
    <?php
    require_once('navlay3.php');
    ?>
</nav>
<br><br><br>

<body class="body">
    <br><br><br><br>
    <center>
        <!--<div class="masthead-heading1 text-uppercase">Ssmike</div>-->
        <form action="../controller/controllerusuario2.php" class="formulario" method="post">

            <h2 style="color:white;">Inicia Sesión como Administrador</h2>
            <div class="contendedor">
                <div>
                    <i class="fas fa-envelope-square icon"></i>
                    <input type="text" placeholder="Correo Electrónico" name="email" required>
                </div>
                <br>
                <div>
                    <i class="fas fa-key icon"></i>
                    <input type="password" placeholder="Contraseña" name="clave" required>
                </div>
                <br><br>
                <input type="submit" value="Iniciar Sesión" class="button" name="Loginadmin">
                <p style="color: #6d4c41;">Al registrarse, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
                <p style="color: #6d4c41;">¿No eres un Usuario Administrador? <a style="color: #6d4c41;" class="link" href="../index.html">Sigue Navegando.</a></p>
            </div>
        </form>
    </center>
    <br><br><br><br>
    <footer>
        <?php
        require_once('footerlay.php');
        ?>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Contact form JS-->
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <!-- Core theme JS-->
    <script src="../assets/js/scripts.js"></script>
</body>

</html>
