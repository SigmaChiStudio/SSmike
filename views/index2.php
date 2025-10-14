<?php
session_start();
?>
<?php
include '../controller/config.php';
include '../controller/conexion.php';
include '../controller/carrito.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ssmike S.A</title>
    <link rel="icon" type="image/x-icon" href="../model/img/navbar-logo.png" />
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="../assets/css/styles.css" rel="stylesheet" />
</head>
<?php if (!isset($_SESSION['loggedin'])) { ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8" />
        <title>Administrador - Ssmike S.A</title>
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

        <center>
            <br><br><br><br><br><br><br><br><br><br><br>
            <div class="formulario">
                <div class="contenedor">

                    <p style="color:white;">Debe iniciar sesión para acceder a esta página. <br></p>
                    <a class="link" href='../views/loggin.php'>Iniciar Sesión.</a>
                </div>
            </div>
        </center>
        <br><br><br><br><br><br><br><br>
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

    </html><?php
        } elseif (time() > ($_SESSION['expire'])) { ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8" />
        <title>Administrador - Ssmike S.A</title>
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

        <center>
            <br><br><br><br><br><br><br><br><br><br>
            <div class="formulario">
                <div class="contenedor">

                    <p style="color:white;">Su tiempo de Sesión ha expirado. <br>
                        Por favor inicie sesión de nuevo.</p>
                    <a class="link" href='../views/loggin.php'>Iniciar Sesión.</a>
                </div>
        </center>
        </div><br><br><br><br><br><br><br><br>
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

    </html><?php
        } else { ?><nav>
        <?php
            require_once('navlay2.php');
        ?>
    </nav>
    <header>
        <?php
            require_once('headerlay.php');
        ?>
    </header>

    <body id="page-top">

        <body>
            <?php
            require_once('sectionlay2.php');
            ?>
        </body>
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
    <?php } ?>
    </body>

</html>