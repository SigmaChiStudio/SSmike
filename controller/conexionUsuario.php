<?php 
// Este archivo establece la conexión a la base de datos para operaciones relacionadas con usuarios y clientes.
// Se utiliza en formularios de registro, login, edición y consultas de clientes.

// Variables de conexión para entorno local (XAMPP)
$usuario0 = "root"; // Usuario de la base de datos (por defecto en XAMPP)
$clave0 = "";       // Contraseña de la base de datos (vacía por defecto en XAMPP)
$nombreBD0 = "ssmike_db"; // Nombre de la base de datos del proyecto

try {
    // Crea una nueva conexión PDO a la base de datos MySQL usando las variables anteriores.
    // El objeto $conexion se usará en todo el proyecto para ejecutar consultas SQL.
    $conexion = new PDO('mysql:host=localhost;dbname=' .$nombreBD0, $usuario0, $clave0);
    // Si la conexión es exitosa, el código continúa normalmente.
    // Puedes descomentar la siguiente línea para mostrar un mensaje de éxito en pruebas locales:
    // echo'<script>alert("Conexion exitosa")</script>';
} catch (Exception $error) {
    // Si ocurre un error al conectar, muestra el mensaje de error.
    // Esto ayuda a depurar problemas de conexión en desarrollo.
    echo "Error en conexión con base de datos: " . $error->getMessage();
}
?>