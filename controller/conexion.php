<?php
// Definición de constantes para la conexión a la base de datos.
// Estas constantes permiten cambiar fácilmente las credenciales según el entorno (local o hosting).
if (!defined('DATABASE_HOST')) define('DATABASE_HOST', 'localhost'); // Host de la base de datos (localhost en desarrollo)
if (!defined('DATABASE_USER')) define('DATABASE_USER', 'root');      // Usuario de la base de datos (root por defecto en XAMPP)
if (!defined('DATABASE_PASS')) define('DATABASE_PASS', '');          // Contraseña de la base de datos (vacía por defecto en XAMPP)
if (!defined('DATABASE_NAME')) define('DATABASE_NAME', 'ssmike_db'); // Nombre de la base de datos del proyecto

/**
 * Función para crear una conexión PDO a la base de datos MySQL.
 * Utiliza las constantes definidas arriba para los parámetros de conexión.
 * Configura el charset a utf8mb4 y establece opciones para manejo de errores y fetch por defecto como objeto.
 * Si la conexión falla, muestra un mensaje de error y detiene la ejecución.
 * 
 * @return PDO Objeto de conexión PDO listo para usar en consultas.
 */
function pdo_connect_mysql() {
    $host = DATABASE_HOST;
    $user = DATABASE_USER;
    $pass = DATABASE_PASS;
    $db   = DATABASE_NAME;
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,         // Devuelve resultados como objetos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa consultas preparadas reales de MySQL
    ];
    try {
         return new PDO($dsn, $user, $pass, $options); // Retorna la conexión PDO lista para usar
    } catch (PDOException $e) {
         // Si hay un error, muestra el mensaje y detiene el script
         exit('Error al conectar a la base de datos: ' . $e->getMessage());
    }
}

// Crea la conexión global $conexion para ser utilizada en todo el proyecto
$conexion = pdo_connect_mysql();
?>