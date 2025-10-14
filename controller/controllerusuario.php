<?php
// ======================= EDITAR CLIENTE DESDE GET (ADMIN) =======================
// Permite a un administrador editar los datos de un cliente desde la vista de administración.
// Recibe los datos por GET, actualiza la tabla 'clientes' y muestra un mensaje de éxito o error.
if (isset($_GET['editaradmin'])) {
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $clave = $_GET['clave'];
    $email = $_GET['email'];
    $direccion = $_GET['direccion'];
    $telefono = $_GET['telefono'];

    include_once 'conexionUsuario.php';
    $passencriptado = password_hash($clave, PASSWORD_DEFAULT);
    // Actualiza los datos del cliente en la base de datos
    $actualizar = $conexion->prepare("UPDATE clientes SET nombre = ?, correo = ?, contraseña = ?, telefono = ?, direccion = ? WHERE id = ?");
    $resp = $actualizar->execute([$nombre, $email, $passencriptado, $telefono, $direccion, $id]);

    // Si la actualización fue exitosa, muestra mensaje de éxito, si no, muestra mensaje de error.
    if ($resp === TRUE) {
?>
        <!-- HTML de éxito al actualizar datos del cliente -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <!-- Mensaje de éxito -->
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">Datos actualizados con éxito. <br></p>
                        <a style="color:#6d4c41;"class="link" href='../views/listaclientes.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } else {
    ?>
        <!-- HTML de error al actualizar datos del cliente -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <!-- Mensaje de error -->
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">No fue posible actualizar los datos. <br>
                            Esto puede deberse a que el id o email del usuario ya se encuentra registrado. <br>
                            Por favor verifique los datos e intente de nuevo.</p>
                        <a style="color:#6d4c41;" class="link" href='../views/listaclientes.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    }
}

// ======================= REGISTRO DE CLIENTE =======================
// Procesa el registro de un nuevo cliente desde el formulario de registro.
// Verifica si el correo o el ID ya existen y, si no, inserta el nuevo cliente en la base de datos.
if (isset($_POST['registrar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    require_once 'conexionUsuario.php';
    // Verifica si el correo ya está registrado
    $respuesta1 = $conexion->query("SELECT * FROM clientes WHERE correo= '$email'");
    $info1BD = $respuesta1->fetchAll(PDO::FETCH_OBJ);
    $numero1 = count($info1BD);

    // Verifica si el ID ya está registrado
    $respuesta2 = $conexion->query("SELECT * FROM clientes WHERE id= '$id'");
    $info2BD = $respuesta2->fetchAll(PDO::FETCH_OBJ);
    $numero2 = count($info2BD);

    // Si ambos existen, muestra mensaje de error
    if ($numero1 >= 1 && $numero2 >= 1) { ?>
        <!-- HTML de error: correo e ID ya registrados -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">El email y/o el ID que ingreso ya se encuentra registrado.<br>Por favor intente con otro correo y/o ID, o inicie sesión.</p>
                        <a style="color:#6d4c41;" class="link" href='../views/register.php'>Regresar</a> <br><br>
                        <a style="color:#6d4c41;" class="link" href='../views/loggin.php'>Iniciar Sesión</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } else {
        // Si no existen, registra el nuevo cliente
        $passencriptado = password_hash($clave, PASSWORD_DEFAULT);
        $registro = $conexion->prepare("INSERT INTO clientes (id, nombre, correo, contraseña, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?);");
        $resultado = $registro->execute([$id, $nombre, $email, $passencriptado, $telefono, $direccion]);
        if ($resultado === TRUE) { ?>
            <!-- HTML de éxito al registrar cliente -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <title>Ssmike S.A</title>
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
                    <div class="formulario">
                        <div class="contenedor">
                            <p style="color:#6d4c41;">Datos registrados con exito.</p>
                            <a class="link" href='../views/loggin.php'>Iniciar Sesión</a><br><br>
                            <a class="link" href='../index.html'>Continuar sin Iniciar Sesión</a>
                        </div>
                    </div>
                </center>
                <footer>
                    <?php require_once('../views/footerlay.php'); ?>
                </footer>
                <!-- Scripts -->
            </body>
            </html>
        <?php
        } else { ?>
            <!-- HTML de error al registrar cliente -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <title>Ssmike S.A</title>
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
                    <div class="formulario">
                        <div class="contenedor">
                            <p style="color:#6d4c41;">No fue posible registrar sus datos. <br>Por favor valide la información e intente de nuevo.</p>
                            <a style="color:#6d4c41;" class="link" href='../views/register.php'>Regresar</a>
                        </div>
                    </div>
                </center>
                <footer>
                    <?php require_once('../views/footerlay.php'); ?>
                </footer>
                <!-- Scripts -->
            </body>
            </html>
        <?php
        }
    }
}

// ======================= ELIMINAR CLIENTE =======================
// Elimina un cliente de la base de datos según el ID recibido desde la administración.
if (isset($_POST['eliminar'])) {
    $id = $_GET['id'];
    include_once 'conexionUsuario.php';
    $eliminar = $conexion->prepare("DELETE FROM clientes WHERE id = ?;");
    $respuestael = $eliminar->execute([$id]);
    if ($respuestael === TRUE) {
        // HTML de éxito al eliminar cliente
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">Datos eliminados con éxito. <br></p>
                        <a style="color:#6d4c41;" class="link" href='../views/listaclientes.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } else {
    ?>
        <!-- HTML de error al eliminar cliente -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">No fue posible eliminar los datos. <br></p>
                        <a style="color:#6d4c41;" class="link" href='../views/listaclientes.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    }
}

// ======================= LOGIN DE CLIENTE =======================
// Procesa el inicio de sesión de un cliente.
// Verifica el correo y la contraseña, y si son correctos, inicia la sesión y guarda los datos del usuario.
if (isset($_POST['Login'])) {
    session_start();
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    require_once 'conexionUsuario.php';
    $respuesta = $conexion->query("SELECT * FROM clientes WHERE correo = '$email'");
    $infoBD = $respuesta->fetch(PDO::FETCH_OBJ);

    // Si no existe el correo
    if (is_bool($infoBD)) { ?>
        <!-- HTML de error: email incorrecto -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">Email incorrecto. <br></p>
                        <a class="link" href='../views/loggin.php'>Intentar de nuevo</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } elseif (password_verify($clave, $infoBD->contraseña)) {
        // Si la contraseña es correcta, inicia sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $infoBD->nombre;
        $_SESSION['mail'] = $infoBD->correo;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    ?>
        <!-- HTML de bienvenida -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
            <?php require_once('../views/navlaycr2.php'); ?>
        </nav>
        <body class="body">
            <center>
                <div class="formulario">
                    <div class="contenedor">
                        <h2 style="color:#6d4c41;">Bienvenido(a) <?php echo $_SESSION['name']; ?><br></h2>
                        <br>
                        <a style="color:#6d4c41;" class="link" href='../views/index2.php'>Ir a la Página Principal</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } else { ?>
        <!-- HTML de error: contraseña incorrecta -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">Email y/o Contraseña incorrectos. <br></p>
                        <a class="link" href='../views/loggin.php'>Intentar de nuevo</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    }
}

// ======================= REGISTRO DE REUNIÓN DE COMPRA =======================
// Registra una solicitud de reunión de compra, validando que la fecha no esté ocupada y que el email corresponda a un cliente registrado.
if (isset($_POST['rcompra'])) {
    session_start();
    $ncom = $_POST['ncomcom'];
    $email = $_POST['correocom'];
    $tel = $_POST['telcom'];
    $mensaje = $_POST['mencom'];
    $fecha = $_POST['fechacom'];

    require_once 'conexionUsuario.php';
    $respuesta = $conexion->query("SELECT * FROM clientes WHERE correo = '$email'");
    $infoBD = $respuesta->fetch(PDO::FETCH_OBJ);

    $respuesta2 = $conexion->query("SELECT *FROM rcompra WHERE fecha= '$fecha'");
    $info2BD = $respuesta2->fetchAll(PDO::FETCH_OBJ);
    $numero2 = count($info2BD);

    if ($numero2 >= 1) { ?>
        <!-- HTML de error: fecha ocupada -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
            <?php require_once('../views/navlaycr2.php'); ?>
        </nav>
        <body class="body">
            <center>
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">La fecha solicitada ya se encuentra ocupada. <br>
                            Por favor registre los datos de nuevo. <br></p>
                        <a style="color:#6d4c41;" class="link" href='../views/rcompra.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } elseif (is_bool($infoBD)) { ?>
        <!-- HTML de error: email no corresponde -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
            <?php require_once('../views/navlaycr2.php'); ?>
        </nav>
        <body class="body">
            <center>
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">El email que registró no corresponde al email de la cuenta que inició sesión. <br>
                            Por favor registre los datos de nuevo. <br></p>
                        <a style="color:#6d4c41;" class="link" href='../views/rcompra.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } else {
        $registro = $conexion->prepare("INSERT INTO rcompra (nombre_completo, email, telefono, mensaje, fecha) VALUES (?,?,?,?,?);");
        $resultado = $registro->execute([$ncom, $email, $tel, $mensaje, $fecha]);
        if ($resultado === TRUE) { ?>
            <!-- HTML de éxito al registrar reunión -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <title>Ssmike S.A</title>
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
                <?php require_once('../views/navlaycr2.php'); ?>
            </nav>
            <body class="body">
                <center>
                    <div class="formulario">
                        <div class="contenedor">
                            <h3 style="color:#6d4c41;">Datos registrados con éxito<br></h3>
                            <p style="color:#6d4c41;">Recuerde que la verificación de Reunión deberá llegarle al correo ingresado en los próximos 3 días hábiles, incluyendo su ID de reunión. <br></p>
                            <a class="link" href='../views/index2.php'>Seguir Navegando</a>
                        </div>
                    </div>
                </center>
                <footer>
                    <?php require_once('../views/footerlay.php'); ?>
                </footer>
                <!-- Scripts -->
            </body>
            </html>
        <?php
        } else { ?>
            <!-- HTML de error al registrar reunión -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <title>Ssmike S.A</title>
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
                <?php require_once('../views/navlaycr2.php'); ?>
            </nav>
            <body class="body">
                <center>
                    <div class="formulario">
                        <div class="contenedor">
                            <p style="color:#6d4c41;">No fue posible registrar sus datos.<br> Por favor Intente de nuevo. <br></p>
                            <a style="color:#6d4c41;" class="link" href='../views/rcompra.php'>Regresar</a>
                        </div>
                    </div>
                </center>
                <footer>
                    <?php require_once('../views/footerlay.php'); ?>
                </footer>
                <!-- Scripts -->
            </body>
            </html>
        <?php
        }
    }
}

// ======================= REGISTRO DE PETICIÓN DE MANEJO =======================
// Similar al anterior, pero para la tabla pmanejo.
if (isset($_POST['pmanejo'])) {
    session_start();
    $ncom = $_POST['ncommanejo'];
    $email = $_POST['correomanejo'];
    $tel = $_POST['telmanejo'];
    $mensaje = $_POST['menmanejo'];
    $fecha = $_POST['fechamanejo'];

    require_once 'conexionUsuario.php';
    $respuesta = $conexion->query("SELECT * FROM clientes WHERE correo = '$email'");
    $infoBD = $respuesta->fetch(PDO::FETCH_OBJ);

    $respuesta2 = $conexion->query("SELECT *FROM pmanejo WHERE fecha= '$fecha'");
    $info2BD = $respuesta2->fetchAll(PDO::FETCH_OBJ);
    $numero2 = count($info2BD);

    if ($numero2 >= 1) {
        // HTML de error: fecha ocupada
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
            <?php require_once('../views/navlaycr2.php'); ?>
        </nav>
        <body class="body">
            <center>
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">La fecha solicitada ya se encuentra ocupada. <br>
                            Por favor registre los datos de nuevo. <br></p>
                        <a style="color:#6d4c41;" class="link" href='../views/pmanejo.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } elseif (is_bool($infoBD)) {
    ?>
        <!-- HTML de error: email no corresponde -->
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8" />
            <title>Ssmike S.A</title>
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
            <?php require_once('../views/navlaycr2.php'); ?>
        </nav>
        <body class="body">
            <center>
                <div class="formulario">
                    <div class="contenedor">
                        <p style="color:#6d4c41;">El email que registró no corresponde al email de la cuenta que inició sesión. <br>
                            Por favor registre los datos de nuevo. <br></p>
                        <a style="color:#6d4c41;" class="link" href='../views/pmanejo.php'>Regresar</a>
                    </div>
                </div>
            </center>
            <footer>
                <?php require_once('../views/footerlay.php'); ?>
            </footer>
            <!-- Scripts -->
        </body>
        </html>
    <?php
    } else {
        $registro = $conexion->prepare("INSERT INTO pmanejo (nombre_completo, email, telefono, mensaje, fecha) VALUES (?,?,?,?,?);");
        $resultado = $registro->execute([$ncom, $email, $tel, $mensaje, $fecha]);
        if ($resultado === TRUE) {
        ?>
            <!-- HTML de éxito al registrar petición de manejo -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <title>Ssmike S.A</title>
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
                <?php require_once('../views/navlaycr2.php'); ?>
            </nav>
            <body class="body">
                <center>
                    <div class="formulario">
                        <div class="contenedor">
                            <h3 style="color:#6d4c41;">Datos registrados con éxito<br></h3>
                            <p style="color:#6d4c41;">Recuerde que la verificación de Reunión deberá llegarle al correo ingresado en los próximos 3 días hábiles, incluyendo su ID de reunión. <br></p>
                            <a class="link" href='../views/index2.php'>Seguir Navegando</a>
                        </div>
                    </div>
                </center>
                <footer>
                    <?php require_once('../views/footerlay.php'); ?>
                </footer>
                <!-- Scripts -->
            </body>
            </html>
        <?php
        } else {
        ?>
            <!-- HTML de error al registrar petición de manejo -->
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="utf-8" />
                <title>Ssmike S.A</title>
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
                <?php require_once('../views/navlaycr2.php'); ?>
            </nav>
            <body class="body">
                <center>
                    <div class="formulario">
                        <div class="contenedor">
                            <p style="color:#6d4c41;">No fue posible registrar sus datos.<br> Por favor Intente de nuevo. <br></p>
                            <a style="color:#6d4c41;" class="link" href='../views/pmanejo.php'>Regresar</a>
                        </div>
                    </div>
                </center>
                <footer>
                    <?php require_once('../views/footerlay.php'); ?>
                </footer>
                <!-- Scripts -->
            </body>
            </html>
<?php
        }
    }
}

// ======================= LOGOUT =======================
// Destruye la sesión y redirige al inicio.
if (isset($_POST['Logout'])) {
    session_start();
    session_destroy();
    header('location: ../index.html');
}

// ======================= EDITAR CLIENTE DESDE FORMULARIO POR POST =======================
// Permite a un cliente editar sus propios datos desde el formulario de edición.
// Si el campo contraseña está vacío, no la actualiza.
if (isset($_POST['editarcliente'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $clave = $_POST['clave'];

    require_once 'conexionUsuario.php';

    // Si el campo contraseña está vacío, no la actualices
    if (empty($clave)) {
        $actualizar = $conexion->prepare("UPDATE clientes SET nombre = ?, correo = ?, telefono = ?, direccion = ? WHERE id = ?");
        $resp = $actualizar->execute([$nombre, $email, $telefono, $direccion, $id]);
    } else {
        $passencriptado = password_hash($clave, PASSWORD_DEFAULT);
        $actualizar = $conexion->prepare("UPDATE clientes SET nombre = ?, correo = ?, contraseña = ?, telefono = ?, direccion = ? WHERE id = ?");
        $resp = $actualizar->execute([$nombre, $email, $passencriptado, $telefono, $direccion, $id]);
    }

    // Redirige siempre al indexcuenta.php (o donde prefieras)
    header("Location: ../views/indexcuenta.php?id=$id&msg=actualizado");
    exit;
}
?>