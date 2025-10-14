<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse - Ssmike S.A</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/logginstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="../model/img/navbar-logo.png" />
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
</head>
<body class="body">
<br><br><br><br>
<nav>
    <?php require_once('navlay3.php'); ?>
</nav>
<br><br>
<center>
    <form action="../controller/controllerusuario2.php" class="formulario" method="post">
        <h1>Regístrate</h1>
        <div class="contendedor">
            <div class="input-contenedor">
                <i class="fas fa-unlock-alt icon"></i>
                <input type="text" placeholder="Documento de Identidad" name="id" required>
            </div>
            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="Nombres y Apellidos Completos" name="nombre" required>
            </div>
            <div class="input-contenedor">
                <i class="fas fa-envelope-square icon"></i><br>
                <input type="text" placeholder="Correo Electronico" name="email" required>
            </div>
            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Contraseña" name="clave" required>
            </div>
            <!-- Si tu tabla administradores solo tiene id, nombre, correo, contraseña, elimina los siguientes campos -->
            <!--
            <div class="input-contenedor">
                <i class="fas fa-envelope-square icon"></i>
                <input type="text" placeholder="Télefono/Celular" name="telefono">
            </div>
            <div class="input-contenedor">
                <i class="fas fa-unlock-alt icon"></i>
                <input type="text" placeholder="Dirección" name="direccion">
            </div>
            -->
            <input type="submit" value="Registrarse" name="registraradmin" class="button">
            <p style="color: white;">Al registrarse, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p style="color: white;">¿Ya tienes una cuenta? <a style="color: white;" class="link" href="logginadmin.php">Iniciar sesión</a></p>
        </div>
    </form>
</center>
<br><br>
<footer>
    <?php require_once('footerlay.php'); ?>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="../model/mail/jqBootstrapValidation.js"></script>
<script src="../model/mail/contact_me.js"></script>
<script src="../assets/js/scripts.js"></script>
</body>
</html>