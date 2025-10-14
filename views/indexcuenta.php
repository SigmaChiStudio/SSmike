<?php 
session_start();

if (isset($_POST['editarcliente'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $clave = $_POST['clave'];

    require_once '../controller/conexionUsuario.php';

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
		require_once('navlayadmin3.php');
        ?>
</nav>
<br><br><br>
<body class="body">
		<br><br><br><br>
	<center>
    <?php
include_once '../controller/conexionUsuario.php';
$consulta = $conexion->query("SELECT * FROM clientes");
$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);

    if (!isset($_SESSION['loggedin'])){?>
        <br><br><br><br><br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:white;">Debe iniciar sesión para acceder a esta página. <br></p>
    <a class="link" href='../views/loggin.php'>Iniciar Sesión.</a>
        </div>
        </div><?php
    } elseif (time() > ($_SESSION['expire'])){?>
        <br><br><br><br><br><br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:white;">Su tiempo de Sesión ha expirado. <br>
        Por favor inicie sesión de nuevo.</p>
    <a class="link" href='../views/loggin.php'>Iniciar Sesión.</a>
        </div>
        </div><?php
    } else{
        $cliente_id = null;
        if (isset($_SESSION['mail'])) {
            $correo = $_SESSION['mail'];
            $stmt = $conexion->prepare("SELECT id FROM clientes WHERE correo = ?");
            $stmt->execute([$correo]);
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            if ($row) {
                $cliente_id = $row->id;
            }
        }?>
        <br><br><br><br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:white;">Por favor seleccione que acción desea efectuar. </p><br>
    <a class="button" href='editarDatos.php?id=<?php echo $cliente_id; ?>'>Ver Datos.</a><br>
        </div>
        </div><?php
        }
    ?>



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
</html>