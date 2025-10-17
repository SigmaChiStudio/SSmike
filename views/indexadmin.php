<?php 
session_start();
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
		require_once('navlayadmin2.php');
        ?>
</nav>
<br><br><br>
<body class="body">
		<br><br><br><br>
	<center>
    <?php


    if (!isset($_SESSION['loggedin'])){?>
        <br><br><br><br><br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:#6d4c41;">Debe iniciar sesión para acceder a esta página. <br></p>
    <a class="link" href='../views/logginadmin.php'>Iniciar Sesión.</a>
        </div>
        </div><?php
    } elseif (time() > ($_SESSION['expire'])){?>
        <br><br><br><br><br><br><br><br>
        <div class="formulario">
        <div class="contenedor">

        <p style="color:#6d4c41;">Su tiempo de Sesión ha expirado. <br>
        Por favor inicie sesión de nuevo.</p>
    <a class="link" href='../views/logginadmin.php'>Iniciar Sesión.</a>
        </div>
        </div><?php
    } else{?>
        <br><br><br><br><br><br>
        <div class="formulario">
        <div class="contenedor">
        
        <p style="color:#6d4c41;">Por favor seleccione que acción desea efectuar. </p><br>
    <a class="button" href='../views/listaclientes.php'>Ver Clientes</a>
    <a class="button" href='Crud.php'>Administrar productos</a>
        </div>
        </div><?php
        }
    ?>



</center>
<br><br><br><br><br><br><br><br>

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

<?php
if (isset($_GET['productos'])) {
    require_once '../controller/conexion.php';
    include 'Crud.php';
}
?>

<?php if (isset($_GET['productos'])): ?>
    <?php
    require_once '../controller/conexion.php';

    // Si se va a editar, obtener datos del producto
    $editando = false;
    if (isset($_GET['editar'])) {
        $editando = true;
        $codigo = $_GET['editar'];
        $stmt = $conexion->prepare("SELECT * FROM accesorios WHERE codigo_producto=?");
        $stmt->execute([$codigo]);
        $productoEditar = $stmt->fetch(PDO::FETCH_OBJ);
    }
    ?>

    <!-- Formulario para agregar/editar producto -->
    <div class="formulario" style="max-width:600px;margin:auto;">
        <h3><?php echo $editando ? 'Editar' : 'Agregar'; ?> Producto</h3>
        <form method="post" action="../controller/controllerproductos.php">
            <?php if ($editando): ?>
                <input type="hidden" name="codigo_producto" value="<?php echo $productoEditar->codigo_producto; ?>">
            <?php endif; ?>
            <input type="text" name="producto" placeholder="Nombre" required value="<?php echo $editando ? $productoEditar->producto : ''; ?>"><br>
            <input type="text" name="precio" placeholder="Precio" required value="<?php echo $editando ? $productoEditar->Precio : ''; ?>"><br>
            <input type="text" name="talla" placeholder="Talla" value="<?php echo $editando ? $productoEditar->Talla : ''; ?>"><br>
            <input type="text" name="color" placeholder="Color" value="<?php echo $editando ? $productoEditar->color : ''; ?>"><br>
            <input type="text" name="material" placeholder="Material" value="<?php echo $editando ? $productoEditar->material : ''; ?>"><br>
            <textarea name="descripcion" placeholder="Descripción"><?php echo $editando ? $productoEditar->descripción : ''; ?></textarea><br>
            <input type="text" name="imagen" placeholder="URL Imagen" value="<?php echo $editando ? $productoEditar->imagen : ''; ?>"><br>
            <button type="submit" class="button" name="<?php echo $editando ? 'actualizar' : 'agregar'; ?>">
                <?php echo $editando ? 'Actualizar' : 'Agregar'; ?>
            </button>
            <?php if ($editando): ?>
                <a href="indexadmin.php" class="button1">Cancelar</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Listado de productos -->
    <div style="max-width:90%;margin:auto;">
        <h3>Productos</h3>
        <table class="table table-hover clientes-listado">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Material</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $productos = $conexion->query("SELECT * FROM accesorios")->fetchAll(PDO::FETCH_OBJ);
            foreach ($productos as $prod): ?>
                <tr>
                    <td><?php echo $prod->codigo_producto; ?></td>
                    <td><?php echo $prod->producto; ?></td>
                    <td><?php echo $prod->Precio; ?></td>
                    <td><?php echo $prod->Talla; ?></td>
                    <td><?php echo $prod->color; ?></td>
                    <td><?php echo $prod->material; ?></td>
                    <td><?php echo $prod->descripción; ?></td>
                    <td>
                        <?php if ($prod->imagen): ?>
                            <img src="<?php echo $prod->imagen; ?>" alt="" style="width:50px;height:50px;object-fit:cover;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="indexadmin.php?editar=<?php echo $prod->codigo_producto; ?>" class="button1">Editar</a>
                        <a href="../controller/controllerproductos.php?eliminar=<?php echo $prod->codigo_producto; ?>" class="button1" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<footer>
<?php 
		require_once('footerlay.php');
        ?>
</footer>