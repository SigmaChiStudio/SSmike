<?php
/**
 * MIDDLEWARE DE AUTENTICACIÓN - SSmike S.A
 * 
 * Este archivo contiene funciones middleware para validar la autenticación
 * y autorización de usuarios en el sistema.
 * 
 * Uso:
 * - Incluir este archivo al inicio de páginas protegidas
 * - Llamar a requireAuth() para validar sesión de usuario
 * - Llamar a requireAdmin() para validar sesión de administrador
 * 
 * @version 1.0
 * @author SSmike Development Team
 */

/**
 * Configura las opciones de sesión segura
 * Debe llamarse antes de session_start()
 */
function configureSecureSession() {
    // Solo en producción con HTTPS
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', 1);
    }
    
    // Prevenir acceso a cookies desde JavaScript
    ini_set('session.cookie_httponly', 1);
    
    // Prevenir ataques CSRF
    ini_set('session.cookie_samesite', 'Strict');
    
    // Regenerar ID de sesión periódicamente
    ini_set('session.gc_maxlifetime', 300); // 5 minutos
}

/**
 * Verifica si el usuario ha iniciado sesión
 * Valida el estado de la sesión y el timeout
 * 
 * @return bool True si la sesión es válida, False en caso contrario
 */
function isAuthenticated() {
    // Iniciar sesión si no está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        configureSecureSession();
        session_start();
    }
    
    // Verificar si existe la variable de sesión loggedin
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        return false;
    }
    
    // Verificar timeout de sesión
    if (isset($_SESSION['expire']) && time() > $_SESSION['expire']) {
        return false;
    }
    
    // Renovar tiempo de expiración
    $_SESSION['expire'] = time() + (5 * 60); // 5 minutos
    
    return true;
}

/**
 * Middleware: Requiere que el usuario esté autenticado
 * Redirige al login si la sesión no es válida
 * 
 * @param string $redirectUrl URL de redirección personalizada (opcional)
 */
function requireAuth($redirectUrl = '../views/loggin.php') {
    if (!isAuthenticated()) {
        // Destruir sesión inválida
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        
        // Redirigir al login con mensaje
        $timeout = isset($_SESSION['expire']) && time() > $_SESSION['expire'] ? '1' : '0';
        header("Location: $redirectUrl?timeout=$timeout");
        exit;
    }
}

/**
 * Middleware: Requiere que el usuario sea administrador
 * Redirige a página de acceso denegado si no es admin
 * 
 * @param string $redirectUrl URL de redirección personalizada (opcional)
 */
function requireAdmin($redirectUrl = '../views/paginanodisp.php') {
    // Primero verificar autenticación
    requireAuth();
    
    // Verificar rol de administrador
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: $redirectUrl");
        exit;
    }
}

/**
 * Verifica si el usuario es administrador
 * 
 * @return bool True si es admin, False en caso contrario
 */
function isAdmin() {
    return isAuthenticated() && 
           isset($_SESSION['role']) && 
           $_SESSION['role'] === 'admin';
}

/**
 * Regenera el ID de sesión para prevenir ataques de fijación
 * Debe llamarse después de un login exitoso
 */
function regenerateSessionId() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}

/**
 * Obtiene el email del usuario actual
 * 
 * @return string|null Email del usuario o null si no está autenticado
 */
function getCurrentUserEmail() {
    return isAuthenticated() && isset($_SESSION['mail']) ? $_SESSION['mail'] : null;
}

/**
 * Obtiene el nombre del usuario actual
 * 
 * @return string|null Nombre del usuario o null si no está autenticado
 */
function getCurrentUserName() {
    return isAuthenticated() && isset($_SESSION['name']) ? $_SESSION['name'] : null;
}

/**
 * Cierra la sesión del usuario de forma segura
 * 
 * @param string $redirectUrl URL de redirección después del logout
 */
function logout($redirectUrl = '../index.html') {
    if (session_status() === PHP_SESSION_ACTIVE) {
        // Limpiar todas las variables de sesión
        $_SESSION = array();
        
        // Destruir la cookie de sesión
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        // Destruir la sesión
        session_destroy();
    }
    
    // Redirigir
    header("Location: $redirectUrl");
    exit;
}

/**
 * Valida que un email pertenezca al usuario actual
 * Útil para prevenir que usuarios modifiquen datos de otros
 * 
 * @param string $email Email a validar
 * @return bool True si el email coincide con el usuario actual
 */
function validateUserEmail($email) {
    $currentEmail = getCurrentUserEmail();
    return $currentEmail !== null && $currentEmail === $email;
}

/**
 * Establece el rol del usuario en la sesión
 * Debe llamarse después del login exitoso
 * 
 * @param string $role Rol del usuario ('user' o 'admin')
 */
function setUserRole($role) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION['role'] = $role;
    }
}

/**
 * Middleware: Protege contra acceso después del logout
 * Previene el acceso mediante el botón "Atrás" del navegador
 */
function preventCacheAccess() {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
}

/**
 * Ejemplo de uso en una página protegida:
 * 
 * <?php
 * require_once '../middleware/auth.php';
 * 
 * // Para páginas de usuario autenticado
 * requireAuth();
 * 
 * // Para páginas de administrador
 * requireAdmin();
 * 
 * // Prevenir acceso desde caché
 * preventCacheAccess();
 * ?>
 */
?>
