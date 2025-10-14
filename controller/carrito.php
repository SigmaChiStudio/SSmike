<?php
// Inicia la sesión si aún no está activa
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

// Variable para mensajes (no se usa en este archivo, pero puede ser útil para notificaciones)
$mensaje = "";

// Inicializa el carrito en la sesión si aún no existe
// El carrito es un array de productos, cada uno con 'id' y 'cantidad'
if (!isset($_SESSION['CARRITO'])) {
    $_SESSION['CARRITO'] = [];
}

// Si se recibe una acción desde un formulario (Agregar o Eliminar)
if(isset($_POST['btnAccion'])){
    switch($_POST['btnAccion']){
        case 'Agregar':
            // Al agregar un producto al carrito:
            // - Obtiene el ID del producto y la cantidad (por defecto 1)
            $ID = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $CANTIDAD = isset($_POST['cantidad']) && is_numeric($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;

            // Busca si el producto ya está en el carrito
            $encontrado = false;
            foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                if ($producto['id'] === $ID) {
                    // Si ya está, suma la cantidad
                    $_SESSION['CARRITO'][$indice]['cantidad'] += $CANTIDAD;
                    $encontrado = true;
                    break;
                }
            }
            // Si no está, lo agrega como nuevo producto al carrito
            if (!$encontrado) {
                $_SESSION['CARRITO'][] = [
                    'id' => $ID,
                    'cantidad' => $CANTIDAD
                ];
            }
            break;

        case "Eliminar":
            // Al eliminar un producto del carrito:
            // - Busca el producto por su ID y lo elimina del array
            if(isset($_POST['id'])){
                $ID = intval($_POST['id']);
                foreach($_SESSION['CARRITO'] as $indice => $producto){
                    if($producto['id'] === $ID){
                        unset($_SESSION['CARRITO'][$indice]);
                        // Reindexa el array para evitar huecos en los índices
                        $_SESSION['CARRITO'] = array_values($_SESSION['CARRITO']);
                        break;
                    }
                }
            }
            break;
    }
    // Después de cualquier acción, redirige a la vista del carrito para evitar reenvíos de formulario
    header('Location: ../views/vistacarro.php');
    exit;
}
?>