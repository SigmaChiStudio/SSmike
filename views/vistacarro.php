<?php
include '../controller/config.php';
include '../controller/carrito.php';
require_once '../controller/conexion.php'; // <-- Agrega esta línea
// Inicializar el carrito si no existe
if (!isset($_SESSION['CARRITO'])) {
    $_SESSION['CARRITO'] = [];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
        <meta charset="UTF-8">
        <title>LISTA DEL CARRITO - Ssmike S.A</title>
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
        <br>
        <nav>
                <?php
                require_once('navlay5.php');
                ?>
        </nav>
        <br><br>
        <?php

        if (!empty($_SESSION['CARRITO'])) { ?>
                <center>
                        <!--<div class="masthead-heading1 text-uppercase">Ssmike</div>-->
                        <form action="../controller/carrito.php" class="formulario" method="POST">
<br><br><br><br>
                                <h1>LISTA DEL CARRITO</h1>
                            
                                        <table class="table table-carrito">
                                                <tbody>

                                                        <tr>
                                                                <th>Descripción</th>
                                                                <th>Cantidad</th>
                                                                <th>Precio</th>
                                                                <th>Total</th>
                                                                <th>--</th>
                                                        </tr>
                                                        <?php $total = 0; ?>
                                                        <?php foreach ($_SESSION['CARRITO'] as $indice => $item) {
                                                                $id = $item['id'];
                                                                $cantidad = $item['cantidad'];
                                                                // Consulta el producto por ID
                                                                $stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
                                                                $stmt->execute([$id]);
                                                                $producto = $stmt->fetch(PDO::FETCH_OBJ);
                                                                if ($producto) {
                                                                    $subtotal = $producto->precio * $cantidad;
                                                                    $total += $subtotal;
                                                        ?>
                                                        <tr>
                                                                <td><?php echo htmlspecialchars($producto->nombre); ?></td>
                                                                <td><?php echo $cantidad; ?></td>
                                                                <td><?php echo number_format($producto->precio, 2); ?></td>
                                                                <td><?php echo number_format($subtotal, 2); ?></td>
                                                                <td>
                                                                        <form action="../controller/carrito.php" method="post" style="display:inline;">
                                                                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                                                                <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                                                                        </form>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                                }
                                                        }
                                                        ?>
                                                        <tr>
                                                                <td colspan="3" align="right">
                                                                        <h3>Total</h3>
                                                                </td>
                                                                <td align="right">
                                                                        <h3><?php echo number_format($total, 2); ?></h3>
                                                                </td>
                                                                <td></td>
                                                        </tr>
                                                </tbody>
                                        </table>
                              

                        </form>

                <?php } else { ?>
                        <div class="alert alert-warning">
                                <center>No hay productos en el carrito</center>
                        </div>
                <?php } ?>
                <center><a href="index2.php"><button class="btn btn-danger" type="button">Seguir comprando</button></a></center>
                <br><br><br><br>
                </center>
                <br><br>

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


<br>
<br>
<br>
<footer>
        <?php
        require_once('footerlay.php');
        ?>
</footer>

</html>