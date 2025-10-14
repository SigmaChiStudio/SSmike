<?php 
// session_start();  // Elimina o comenta esta línea
require_once('../controller/conexion.php');

// Si se va a editar un producto, obtenemos sus datos
$productoEditar = null;
if (isset($_GET['editar'])) {
    $idEditar = intval($_GET['editar']);
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$idEditar]);
    $productoEditar = $stmt->fetch(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Administrador - Ssmike S.A</title>
    <style>
table {
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
.input-cantidad {
    background: #fff0f6;
    border: 2px solid #e65684;
    border-radius: 8px;
    color: #e65684;
    font-weight: bold;
    font-size: 1.1em;
    padding: 8px 12px;
    outline: none;
    box-shadow: 0 1px 4px #f8bbd033;
    transition: border-color 0.2s;
}
.input-cantidad:focus {
    border-color: #c2185b;
    background: #ffe4ec;
}
</style>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/logginstyle.css">
    <link rel="icon" type="image/x-icon" href="../model/img/navbar-logo.png" />
    <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
</head>
<nav>
    <?php require_once('navlayadmin2.php'); ?>
</nav>
<br><br><br>
<body class="body"><br><br>
<center>
    <div class="formulario" style="max-width:600px;margin:30px auto 40px auto;">
        <h3><?php echo $productoEditar ? 'Editar Producto' : 'Agregar Producto'; ?></h3>
        <form method="post" action="../controller/controllerproductos.php">
            <?php if ($productoEditar): ?>
                <input type="hidden" name="id" value="<?php echo $productoEditar->id; ?>">
            <?php endif; ?>
            <input type="text" name="nombre" placeholder="Nombre" required value="<?php echo $productoEditar ? htmlspecialchars($productoEditar->nombre) : ''; ?>"><br>
            <input type="number" name="cantidad" placeholder="Cantidad" min="1" required class="input-cantidad" value="<?php echo $productoEditar ? $productoEditar->cantidad : ''; ?>"><br><br>
            <input type="text" name="precio" placeholder="Precio" required value="<?php echo $productoEditar ? $productoEditar->precio : ''; ?>"><br>
            <input type="text" name="categoria" placeholder="Categoría" required value="<?php echo $productoEditar ? htmlspecialchars($productoEditar->categoria) : ''; ?>"><br>
            <input type="text" name="imagen" placeholder="URL Imagen" required value="<?php echo $productoEditar ? htmlspecialchars($productoEditar->imagen) : ''; ?>"><br>
            <?php if ($productoEditar): ?>
                <button type="submit" class="button" name="actualizar">Actualizar</button>
                <a href="Crud.php" class="button1">Cancelar</a>
            <?php else: ?>
                <button type="submit" class="button" name="agregar">Agregar</button>
            <?php endif; ?>
        </form>
    </div>
    <!-- Listado de productos -->
    <div style="max-width:90%;margin:auto;">
        <h3>Productos</h3>
        <table class="table table-hover productos-listado">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $productos = $conexion->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_OBJ);
            foreach ($productos as $prod): ?>
                <tr>
                    <td><?php echo $prod->id; ?></td>
                    <td><?php echo htmlspecialchars($prod->nombre); ?></td>
                    <td><?php echo $prod->cantidad; ?></td>
                    <td><?php echo $prod->precio; ?></td>
                    <td><?php echo htmlspecialchars($prod->categoria); ?></td>
                    <td>
                        <?php if ($prod->imagen): ?>
                            <img src="<?php echo htmlspecialchars($prod->imagen); ?>" alt="" style="width:50px;height:50px;object-fit:cover;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="Crud.php?editar=<?php echo $prod->id; ?>" class="button1">Editar</a>
                        <a href="../controller/controllerproductos.php?eliminar=<?php echo $prod->id; ?>" class="button1" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <br><br><br><br><br><br><br><br><br>
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
</center>
</body>
<footer>
    <?php require_once('footerlay.php'); ?>
</footer>
</html>