<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar - Ssmike S.A</title>
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
			<?php 
			require_once('navlayadmin2.php');
			?>
		</nav>
                <br><br>
        <?php 
        include_once '../controller/conexionUsuario.php';
        $id = $_GET['id'];
        $respuesta5 = $conexion->query("SELECT * FROM clientes WHERE id = $id");
        $datoscliente = $respuesta5->fetch(PDO::FETCH_OBJ);
        ?>
	<center>
	<!--<div class="masthead-heading1 text-uppercase">Ssmike</div>-->
	<form action="../controller/controllerusuario.php" class="formulario" method="get">

                <h3 style="color:#6d4c41;">Editar Datos del Cliente</h3>
                <p style="color:#6d4c41;">Recuerde que no es posible cambiar de ID</p>
		<div class="contendedor">
                <div class="input-contenedor">
             <i class="fas fa-unlock-alt icon"></i>
             <input type="text" placeholder="Documento de Identidad" name="id" required value="<?php echo $datoscliente->id?>">
		    </div>
		<div class="input-contenedor">
             <i class="fas fa-user icon"></i>
             <input type="text" placeholder="Nombres y Apellidos Completos" name="nombre" required value="<?php echo $datoscliente->nombre?>">
                    </div>
		    <div class="input-contenedor">
             <i class="fas fa-envelope-square icon"></i><br>
             <input type="text" placeholder="Correo Electronico" name="email" required value="<?php echo $datoscliente->correo?>">
                    </div>
                    <div class="input-contenedor">
            <i class="fas fa-key icon"></i>
             <input type="password" placeholder="Contraseña" name="clave" required value="<?php echo $datoscliente->contraseña?>">
            </div>
		    <div class="input-contenedor">
             <i class="fas fa-envelope-square icon"></i>
             <input type="text" placeholder="Télefono/Celular" name="telefono" required value="<?php echo $datoscliente->telefono ?>">
		    </div>
		    <div class="input-contenedor">
             <i class="fas fa-unlock-alt icon"></i>
             <input type="text" placeholder="Dirección" name="direccion" required value="<?php echo $datoscliente->direccion ?>">
		    </div>
		    <input type="submit" value="Actualizar Datos" name="editaradmin" class="button">
		    <p style="color: #6d4c41;">Al registrarse, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
		</div>
	   </form>
</center>
<br><br>
<footer>
<?php 
		require_once('footerlay.php');
        ?>
</footer>
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