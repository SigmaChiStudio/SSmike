<?php 
session_start();
include_once '../controller/conexionUsuario.php';

if (isset($_POST['eliminar_id'])) {
    $id = $_POST['eliminar_id'];
    $eliminar = $conexion->prepare("DELETE FROM clientes WHERE id = ?");
    $eliminar->execute([$id]);
    // Opcional: mensaje de éxito
    echo "<script>alert('Cliente eliminado correctamente');window.location='listaclientes.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8" />
        <title>Administrador - Ssmike S.A</title>
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

td[data-label="Contraseña"], th[style*="Contraseña"] {
    max-width: 90px;
    width: 90px;
    text-align: center;
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
		require_once('navlayadmin2.php');
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
$consulta = $conexion->query('SELECT * FROM clientes');
$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);
?>
<h2>Listado de Clientes</h2>
<table class="table table-hover clientes-listado">
  <thead style="background-color:#7B7777;">
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Email</th>
      <th style="width:90px;">Contraseña</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Actualizar</th>
      <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach ($clientes as $cliente){?>
            <tr>
    <td data-label="Id"><?php echo $cliente->id?></td>
    <td data-label="Nombre"><?php echo $cliente->nombre?></td>
    <td data-label="Email"><?php echo $cliente->correo?></td>
    <td data-label="Contraseña" style="max-width:90px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
        <span class="pass-hide" id="pass-<?php echo $cliente->id; ?>">
            <?php echo substr($cliente->contraseña, 0, 6); ?>...
        </span>
        <span class="pass-full" id="full-<?php echo $cliente->id; ?>" style="display:none;">
            <?php echo $cliente->contraseña; ?>
        </span>
        <button type="button" class="toggle-pass" onclick="togglePass(<?php echo $cliente->id; ?>)" style="background:none;border:none;cursor:pointer;">
            <i class="fas fa-eye"></i>
        </button>
    </td>
    <td data-label="Teléfono"><?php echo $cliente->telefono?></td>
    <td data-label="Dirección"><?php echo $cliente->direccion?></td>
    <td data-label="Actualizar"><a class="button1" href="editarcliente.php?id=<?php echo $cliente->id?>">Editar</a></td>
    <td data-label="Eliminar">
        <form method="post" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
            <input type="hidden" name="eliminar_id" value="<?php echo $cliente->id; ?>">
            <button type="submit" class="button1">Eliminar</button>
        </form>
    </td>
</tr>
        <?php
        }?>
    </tbody>
</table>
<br><br>
        <a class="button" href="indexadmin.php">Regresar</a><?php
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
        <script>
function togglePass(id) {
    var hide = document.getElementById('pass-' + id);
    var full = document.getElementById('full-' + id);
    if (hide.style.display === 'none') {
        hide.style.display = '';
        full.style.display = 'none';
    } else {
        hide.style.display = 'none';
        full.style.display = '';
    }
}
</script>
</body>
</html>