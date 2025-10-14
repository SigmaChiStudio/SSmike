<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Ssmike S.A</title>
        <style>
table {
    /*margin-left:240px;*/
    font-size:14px;
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 70%;
  background-color: white;
  border: 1px double black;
}

td, th {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #AFACAC;
}
</style>
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
<nav><?php 
		require_once('navlayadmin3.php');
        ?>
</nav>
<br><br><br>
<body class="body"><br><br><br><br><br><br><br>

<center>
<?php


    if (!isset($_SESSION['loggedin'])){?>
        <br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:white;">Debe iniciar sesión para acceder a esta página. <br></p>
    <a class="link" href='../views/logginadmin.php'>Iniciar Sesión.</a>
        </div>
        </div><?php
    } elseif (time() > ($_SESSION['expire'])){?>
        <br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:white;">Su tiempo de Sesión ha expirado. <br>
        Por favor inicie sesión de nuevo.</p>
    <a class="link" href='../views/logginadmin.php'>Iniciar Sesión.</a>
        </div>
        </div><?php
    } else{?>
        <?php 
include_once '../controller/conexionUsuario.php';
$id = $_GET['id'];
$consulta = $conexion->query("SELECT * FROM clientes WHERE id = $id");
$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);
?>
<h2>Datos del Cliente</h2>
<table class="table-pastel">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Actualizar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $dcliente){?>
            <tr>
                <td><?php echo $dcliente->id?></td>
                <td><?php echo $dcliente->nombre?></td>
                <td><?php echo $dcliente->correo?></td>
                <td><?php echo $dcliente->contraseña?></td>
                <td><?php echo $dcliente->telefono?></td>
                <td><?php echo $dcliente->direccion?></td>
                <td><a class="button1" href="editarcliente.php?id=<?php echo $dcliente->id?>">Editar</a></td>
            </tr>
        <?php }?>
    </tbody>
</table>
<br><br>
        <a class="button" href="index2.php">Regresar</a><?php
        }
    ?>
    
</center>
<br><br><br><br><br><br><br><br><br>
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