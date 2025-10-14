<?php
require_once 'conexion.php'; // Incluye la conexión a la base de datos para todas las operaciones CRUD de productos

// ======================= AGREGAR PRODUCTO =======================
// Este bloque se ejecuta cuando se envía el formulario para agregar un nuevo producto desde Crud.php.
// Recibe los datos del formulario por POST, los inserta en la tabla 'productos' y redirige de nuevo al CRUD con un mensaje.
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];         // Nombre del producto
    $cantidad = $_POST['cantidad'];     // Cantidad disponible
    $precio = $_POST['precio'];         // Precio del producto
    $categoria = $_POST['categoria'];   // Categoría (Maquillaje, Skincare, etc.)
    $imagen = $_POST['imagen'];         // Ruta de la imagen del producto

    // Inserta el nuevo producto en la base de datos
    $sql = "INSERT INTO productos (nombre, cantidad, precio, categoria, imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $cantidad, $precio, $categoria, $imagen]);
    // Redirige al CRUD con mensaje de éxito
    header('Location: ../views/Crud.php?msg=agregado');
    exit;
}

// ======================= ELIMINAR PRODUCTO =======================
// Este bloque se ejecuta cuando se solicita eliminar un producto desde Crud.php (por GET).
// Elimina el producto con el ID recibido y redirige al CRUD con un mensaje.
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar']; // ID del producto a eliminar
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$id]);
    // Redirige al CRUD con mensaje de éxito
    header('Location: ../views/Crud.php?msg=eliminado');
    exit;
}

// ======================= ACTUALIZAR PRODUCTO =======================
// Este bloque se ejecuta cuando se envía el formulario para editar un producto desde Crud.php.
// Actualiza los datos del producto en la base de datos y redirige al CRUD con un mensaje.
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];                 // ID del producto a actualizar
    $nombre = $_POST['nombre'];         // Nuevo nombre
    $cantidad = $_POST['cantidad'];     // Nueva cantidad
    $precio = $_POST['precio'];         // Nuevo precio
    $categoria = $_POST['categoria'];   // Nueva categoría
    $imagen = $_POST['imagen'];         // Nueva ruta de imagen

    // Actualiza el producto en la base de datos
    $sql = "UPDATE productos SET nombre=?, cantidad=?, precio=?, categoria=?, imagen=? WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$nombre, $cantidad, $precio, $categoria, $imagen, $id]);
    // Redirige al CRUD con mensaje de éxito
    header('Location: ../views/Crud.php?msg=actualizado');
    exit;
}
?>