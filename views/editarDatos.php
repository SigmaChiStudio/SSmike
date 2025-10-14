<?php
// filepath: c:\xampp\htdocs\SSmike\views\editarcliente.php
session_start();
require_once '../controller/conexionUsuario.php';

// Obtener datos del cliente a editar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$datoscliente = null;
if ($id > 0) {
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id = ?");
    $stmt->execute([$id]);
    $datoscliente = $stmt->fetch(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - Ssmike S.A</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/logginstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
</head>
<body class="body">
    <nav>
        <?php require_once('navlay3.php'); ?>
    </nav>
    <center>
        <div class="formulario" style="max-width:600px;margin:40px auto;">
            <h3 style="color:#e65684;">Editar Datos del Cliente</h3>
            <?php if ($datoscliente): ?>
            <form action="../controller/controllerusuario.php" method="post" class="formularioR">
                <input type="hidden" name="id" value="<?php echo $datoscliente->id; ?>">
                <div>
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="nombre" placeholder="Nombres y Apellidos Completos" required value="<?php echo htmlspecialchars($datoscliente->nombre); ?>">
                </div>
                <div>
                    <i class="fas fa-envelope-square icon"></i>
                    <input type="text" name="email" placeholder="Correo Electrónico" required value="<?php echo htmlspecialchars($datoscliente->correo); ?>">
                </div>
                <div>
                    <i class="fas fa-key icon"></i>
                    <input type="password" name="clave" placeholder="Nueva Contraseña (dejar vacío para no cambiar)">
                </div>
                <br>
                <div>
                    <i class="fas fa-envelope-square icon"></i>
                    <input type="text" name="telefono" placeholder="Teléfono/Celular" required value="<?php echo htmlspecialchars($datoscliente->telefono); ?>">
                </div>
                <div>
                    <i class="fas fa-unlock-alt icon"></i>
                    <input type="text" name="direccion" placeholder="Dirección" required value="<?php echo htmlspecialchars($datoscliente->direccion); ?>">
                </div>
                <input type="submit" value="Actualizar Datos" name="editarcliente" class="button">
                <a href="indexcuenta.php?id=<?php echo $datoscliente->id; ?>" class="button1">Cancelar</a>
            </form>
            <?php else: ?>
                <p style="color:red;">Cliente no encontrado.</p>
            <?php endif; ?>
        </div>
    </center>
    <footer>
        <?php require_once('footerlay.php'); ?>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>