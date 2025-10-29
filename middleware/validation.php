<?php
/**
 * UTILIDADES DE VALIDACIÓN Y SANITIZACIÓN - SSmike S.A
 * 
 * Este archivo contiene funciones auxiliares para validar y sanitizar
 * entradas de usuario, previniendo vulnerabilidades comunes.
 * 
 * @version 1.0
 * @author SSmike Development Team
 */

/**
 * Sanitiza una cadena de texto
 * Elimina espacios en blanco y previene XSS
 * 
 * @param string $input Cadena a sanitizar
 * @return string Cadena sanitizada
 */
function sanitizeString($input) {
    if (!is_string($input)) {
        return '';
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Valida y sanitiza un email
 * 
 * @param string $email Email a validar
 * @return string|false Email sanitizado o false si es inválido
 */
function validateEmail($email) {
    $email = trim($email);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    }
    
    return false;
}

/**
 * Valida un número de teléfono
 * Acepta formatos: +57XXXXXXXXXX, 57XXXXXXXXXX, XXXXXXXXXX
 * 
 * @param string $phone Teléfono a validar
 * @return bool True si es válido
 */
function validatePhone($phone) {
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    
    // Validar longitud mínima (10 dígitos)
    if (strlen($phone) < 10) {
        return false;
    }
    
    // Patrón para Colombia: +57XXXXXXXXXX o XXXXXXXXXX
    $pattern = '/^(\+?57)?[3][0-9]{9}$/';
    return preg_match($pattern, $phone) === 1;
}

/**
 * Valida que una cadena no esté vacía después de sanitizar
 * 
 * @param string $input Cadena a validar
 * @param int $minLength Longitud mínima requerida
 * @return bool True si es válida
 */
function validateNotEmpty($input, $minLength = 1) {
    $sanitized = sanitizeString($input);
    return strlen($sanitized) >= $minLength;
}

/**
 * Valida y sanitiza un número entero
 * 
 * @param mixed $input Valor a validar
 * @param int $min Valor mínimo permitido
 * @param int $max Valor máximo permitido
 * @return int|false Número validado o false si es inválido
 */
function validateInteger($input, $min = null, $max = null) {
    $value = filter_var($input, FILTER_VALIDATE_INT);
    
    if ($value === false) {
        return false;
    }
    
    if ($min !== null && $value < $min) {
        return false;
    }
    
    if ($max !== null && $value > $max) {
        return false;
    }
    
    return $value;
}

/**
 * Valida y sanitiza un número decimal
 * 
 * @param mixed $input Valor a validar
 * @param float $min Valor mínimo permitido
 * @param float $max Valor máximo permitido
 * @return float|false Número validado o false si es inválido
 */
function validateFloat($input, $min = null, $max = null) {
    $value = filter_var($input, FILTER_VALIDATE_FLOAT);
    
    if ($value === false) {
        return false;
    }
    
    if ($min !== null && $value < $min) {
        return false;
    }
    
    if ($max !== null && $value > $max) {
        return false;
    }
    
    return $value;
}

/**
 * Valida una fecha en formato YYYY-MM-DD
 * 
 * @param string $date Fecha a validar
 * @return bool True si es válida
 */
function validateDate($date) {
    $date = trim($date);
    
    if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date)) {
        return false;
    }
    
    $parts = explode('-', $date);
    return checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0]);
}

/**
 * Valida una fecha/hora en formato YYYY-MM-DD HH:MM:SS
 * 
 * @param string $datetime Fecha/hora a validar
 * @return bool True si es válida
 */
function validateDateTime($datetime) {
    $datetime = trim($datetime);
    
    if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $datetime)) {
        return false;
    }
    
    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
    return $dt && $dt->format('Y-m-d H:i:s') === $datetime;
}

/**
 * Valida que una categoría sea válida
 * 
 * @param string $category Categoría a validar
 * @return bool True si es válida
 */
function validateCategory($category) {
    $validCategories = ['Maquillaje', 'Skincare', 'Fragancias', 'Accesorios'];
    return in_array($category, $validCategories, true);
}

/**
 * Valida la fortaleza de una contraseña
 * Requisitos:
 * - Mínimo 8 caracteres
 * - Al menos una letra mayúscula
 * - Al menos una letra minúscula
 * - Al menos un número
 * 
 * @param string $password Contraseña a validar
 * @return array ['valid' => bool, 'errors' => array]
 */
function validatePasswordStrength($password) {
    $errors = [];
    
    if (strlen($password) < 8) {
        $errors[] = 'La contraseña debe tener al menos 8 caracteres';
    }
    
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'La contraseña debe contener al menos una letra mayúscula';
    }
    
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = 'La contraseña debe contener al menos una letra minúscula';
    }
    
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'La contraseña debe contener al menos un número';
    }
    
    return [
        'valid' => empty($errors),
        'errors' => $errors
    ];
}

/**
 * Valida una extensión de archivo de imagen
 * 
 * @param string $filename Nombre del archivo
 * @return bool True si la extensión es válida
 */
function validateImageExtension($filename) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($extension, $allowedExtensions, true);
}

/**
 * Valida una URL
 * 
 * @param string $url URL a validar
 * @return bool True si es válida
 */
function validateUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Valida que un ID sea numérico y exista en la base de datos
 * 
 * @param mixed $id ID a validar
 * @param PDO $conexion Conexión a la base de datos
 * @param string $table Tabla donde buscar
 * @param string $column Columna del ID
 * @return bool True si existe
 */
function validateIdExists($id, $conexion, $table, $column = 'id') {
    $id = validateInteger($id);
    
    if ($id === false) {
        return false;
    }
    
    try {
        $stmt = $conexion->prepare("SELECT COUNT(*) FROM $table WHERE $column = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Sanitiza un array de datos según reglas específicas
 * 
 * @param array $data Array de datos a sanitizar
 * @param array $rules Reglas de sanitización
 * @return array Array sanitizado
 * 
 * Ejemplo de reglas:
 * [
 *     'nombre' => 'string',
 *     'email' => 'email',
 *     'cantidad' => 'int',
 *     'precio' => 'float'
 * ]
 */
function sanitizeArray($data, $rules) {
    $sanitized = [];
    
    foreach ($rules as $field => $type) {
        if (!isset($data[$field])) {
            $sanitized[$field] = null;
            continue;
        }
        
        switch ($type) {
            case 'string':
                $sanitized[$field] = sanitizeString($data[$field]);
                break;
            case 'email':
                $sanitized[$field] = validateEmail($data[$field]);
                break;
            case 'int':
                $sanitized[$field] = validateInteger($data[$field]);
                break;
            case 'float':
                $sanitized[$field] = validateFloat($data[$field]);
                break;
            default:
                $sanitized[$field] = $data[$field];
        }
    }
    
    return $sanitized;
}

/**
 * Genera un token CSRF
 * 
 * @return string Token generado
 */
function generateCsrfToken() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    $_SESSION['csrf_token_time'] = time();
    
    return $token;
}

/**
 * Valida un token CSRF
 * 
 * @param string $token Token a validar
 * @param int $maxAge Edad máxima del token en segundos (default: 3600)
 * @return bool True si es válido
 */
function validateCsrfToken($token, $maxAge = 3600) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time'])) {
        return false;
    }
    
    // Verificar tiempo de expiración
    if (time() - $_SESSION['csrf_token_time'] > $maxAge) {
        return false;
    }
    
    // Verificar token
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Ejemplo de uso completo:
 * 
 * <?php
 * require_once '../middleware/validation.php';
 * 
 * // Sanitizar datos del formulario
 * $nombre = sanitizeString($_POST['nombre']);
 * $email = validateEmail($_POST['email']);
 * $telefono = validatePhone($_POST['telefono']);
 * 
 * // Validar contraseña
 * $passwordCheck = validatePasswordStrength($_POST['password']);
 * if (!$passwordCheck['valid']) {
 *     foreach ($passwordCheck['errors'] as $error) {
 *         echo $error . "<br>";
 *     }
 * }
 * 
 * // Validar categoría
 * if (!validateCategory($_POST['categoria'])) {
 *     die("Categoría inválida");
 * }
 * ?>
 */
?>
