<?php 
// ======================= REGISTRO DE ADMINISTRADOR =======================
// Este bloque procesa el registro de un nuevo administrador desde el formulario de registro de admin.
// Verifica si el correo o el ID ya existen y, si no, inserta el nuevo administrador en la base de datos.
if (isset($_POST['registraradmin'])) {
    $id= $_POST['id'];                // ID del administrador
    $nombre= $_POST['nombre'];        // Nombre del administrador
    $clave=$_POST['clave'];           // Contraseña del administrador
    $correo= $_POST['email'];         // Correo del administrador

    require_once 'conexionUsuario.php'; // Incluye la conexión a la base de datos

    // Verifica si el correo ya está registrado
    $respuesta1 = $conexion->query("SELECT * FROM administradores WHERE correo= '$correo'");
    $info1BD = $respuesta1->fetchAll(PDO::FETCH_OBJ);
    $numero1 = count($info1BD);

    // Verifica si el ID ya está registrado
    $respuesta2 = $conexion->query("SELECT * FROM administradores WHERE id= '$id'");
    $info2BD = $respuesta2->fetchAll(PDO::FETCH_OBJ);
    $numero2 = count($info2BD);

    // Si el correo o el ID ya existen, muestra mensaje de error
    if ($numero1 >=1 || $numero2>=1) {?>
        <!-- HTML de error: correo o ID ya existen -->
        <!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Ssmike S.A.</title>
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
    <?php require_once('../views/navlaycr.php'); ?>
    </nav>
<body class="body">
    <center>
    <br><br><br><br><br><br><br>
    <div class="formulario">
    <div class="contenedor">
    <p style="color:#6d4c41;">El correo y/o el ID que ingresó ya se encuentra registrado.<br>Por favor intente con otro correo y/o ID, o inicie sesión.</p>
        <a class="link" href='../views/registeradmin.php'>Regresar</a> &nbsp;<a class="link" href='../views/logginadmin.php'>Iniciar Sesión</a>
    </div>
    </div>
    </center>
    <br><br><br><br><br><br><br><br><br>
    <footer>
    <?php require_once('../views/footerlay.php'); ?>
    </footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
    <?php
    }else{
        // Si no existen, registra el nuevo administrador
        $passencriptado = password_hash($clave, PASSWORD_DEFAULT); // Encripta la contraseña
        $registro = $conexion ->prepare("INSERT INTO administradores (id, nombre, correo, contraseña) VALUES (?, ?, ?, ?);");
        $resultado = $registro->execute([$id, $nombre, $correo, $passencriptado]);
        if ($resultado ===TRUE) {?>
            <!-- HTML de éxito -->
            <!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Ssmike S.A.</title>
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
    <?php require_once('../views/navlaycr.php'); ?>
</nav>
<body class="body">
    <center>
    <br><br><br><br><br><br><br>
    <div class="formulario">
    <div class="contenedor">
    <p style="color:#6d4c41;">Datos registrados con éxito.</p>
    <a class="link" href='../views/logginadmin.php'>Iniciar Sesión</a>&nbsp;<a class="link" href='../views/index.html'>Continuar sin Iniciar Sesión</a>
    </div>
    </div>
    </center>
    <br><br><br><br><br><br><br><br><br><br>
    <footer>
    <?php require_once('../views/footerlay.php'); ?>
    </footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
        <?php
        }else{?>
            <!-- HTML de error de registro -->
            <!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Ssmike S.A.</title>
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
    <?php require_once('../views/navlaycr.php'); ?>
</nav>
<body class="body">
    <center>
    <br><br><br><br><br><br><br>
    <div class="formulario">
    <div class="contenedor">
    <p style="color:#6d4c41;">No fue posible registrar sus datos. <br>Por favor valide la información e intente de nuevo.</p>
        <a class="link" href='../views/registeradmin.php'>Regresar</a>
    </div>
    </div>
    </center>
    <br><br><br><br><br><br><br><br><br>
    <footer>
    <?php require_once('../views/footerlay.php'); ?>
    </footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
        <?php
        }
    }
}

// ======================= LOGIN DE ADMINISTRADOR =======================
// Este bloque procesa el inicio de sesión de un administrador.
// Verifica el correo y la contraseña, y si son correctos, inicia la sesión y guarda los datos del usuario.
if(isset($_POST['Loginadmin'])){
    session_start();
    $correo = $_POST['email']; // Correo del administrador
    $clave = $_POST['clave'];  // Contraseña ingresada

    require_once 'conexionUsuario.php'; // Incluye la conexión a la base de datos
    $respuesta = $conexion->query("SELECT * FROM administradores WHERE correo = '$correo'");
    $infoBD = $respuesta->fetch(PDO::FETCH_OBJ);

    // Si no existe el correo, muestra mensaje de error
    if (!$infoBD) {?>
        <!-- HTML de error: correo incorrecto -->
        <!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Ssmike S.A.</title>
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
    <?php require_once('../views/navlaycr.php'); ?>
    </nav>
<body class="body">
    <center>
    <br><br><br><br><br><br><br>
    <div class="formulario">
    <div class="contenedor">
    <p style="color:#6d4c41;">Correo incorrecto. <br></p>
        <a class="link" href='../views/logginadmin.php'>Intentar de nuevo</a>
    </div>
    </div>
    </center>
    <br><br><br><br><br><br><br><br><br><br>
    <footer>
    <?php require_once('../views/footerlay.php'); ?>
    </footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
    <?php
    } elseif (password_verify($clave, $infoBD->contraseña)) {
        // Si la contraseña es correcta, inicia sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $infoBD->nombre;
        $_SESSION['mail'] = $infoBD->correo;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5*60);
        ?>
        <!-- HTML de bienvenida -->
        <!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Ssmike S.A.</title>
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
    <?php require_once('../views/navlayadmin.php'); ?>
    </nav>
<body class="body">
    <center>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="formulario">
    <div class="contenedor">
    <h2 style="color:#6d4c41;">Bienvenido(a) <?php echo $_SESSION['name'];?><br></h2>
        <a class="link" href='../views/indexadmin.php'>Ir a la Página de Administrador</a>
    </div>
    </div>
    </center>
    <br><br><br><br><br><br><br><br><br><br>
    <footer>
    <?php require_once('../views/footerlay.php'); ?>
    </footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
    <?php
    } else {?>
        <!-- HTML de error de contraseña -->
        <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Ssmike S.A.</title>
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
<?php require_once('../views/navlaycr.php'); ?>
</nav>
<body class="body">
<center>
<br><br><br><br><br><br><br>
<div class="formulario">
<div class="contenedor">
<p style="color:#6d4c41;">Correo y/o Contraseña incorrectos. <br></p>
    <a class="link" href='../views/logginadmin.php'>Intentar de nuevo</a>
</div>
</div>
</center>
<br><br><br><br><br><br><br><br><br><br>
<footer>
<?php require_once('../views/footerlay.php'); ?>
</footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../model/mail/jqBootstrapValidation.js"></script>
    <script src="../model/mail/contact_me.js"></script>
    <script src="../assets/js/scripts.js"></script>
</body>
</html>
    <?php
    }
}

// ======================= LOGOUT DE ADMINISTRADOR =======================
// Este bloque destruye la sesión y redirige al inicio cuando el administrador cierra sesión.
if (isset($_POST['Logout'])){
    session_start();
    session_destroy();
    header('location: ../index.html');
    exit;
}
?>