# Middleware - SSmike S.A

Este directorio contiene los archivos de middleware para la aplicación SSmike, incluyendo autenticación, autorización y validaciones.

## Archivos

### 1. `auth.php` - Middleware de Autenticación

Proporciona funciones para gestionar la autenticación y autorización de usuarios.

#### Funciones principales:

- **`configureSecureSession()`**: Configura opciones de sesión seguras (httponly, samesite, secure)
- **`isAuthenticated()`**: Verifica si el usuario tiene una sesión válida
- **`requireAuth()`**: Middleware que requiere autenticación (redirige si no está autenticado)
- **`requireAdmin()`**: Middleware que requiere rol de administrador
- **`isAdmin()`**: Verifica si el usuario actual es administrador
- **`regenerateSessionId()`**: Regenera el ID de sesión después del login
- **`getCurrentUserEmail()`**: Obtiene el email del usuario actual
- **`getCurrentUserName()`**: Obtiene el nombre del usuario actual
- **`logout()`**: Cierra la sesión de forma segura
- **`validateUserEmail()`**: Valida que un email pertenezca al usuario actual
- **`setUserRole()`**: Establece el rol del usuario en la sesión
- **`preventCacheAccess()`**: Previene acceso mediante caché del navegador

#### Ejemplo de uso:

```php
<?php
require_once '../middleware/auth.php';

// Página que requiere autenticación
requireAuth();

// Obtener datos del usuario
$userName = getCurrentUserName();
$userEmail = getCurrentUserEmail();

// Verificar si es admin
if (isAdmin()) {
    // Código para administradores
}
?>
```

Para páginas de administrador:

```php
<?php
require_once '../middleware/auth.php';

// Requiere rol de administrador
requireAdmin();

// Prevenir acceso desde caché
preventCacheAccess();
?>
```

---

### 2. `validation.php` - Utilidades de Validación

Proporciona funciones para validar y sanitizar entradas de usuario.

#### Funciones principales:

##### Sanitización:
- **`sanitizeString()`**: Sanitiza cadenas de texto, previene XSS
- **`sanitizeArray()`**: Sanitiza arrays completos según reglas

##### Validación de Datos Básicos:
- **`validateEmail()`**: Valida y sanitiza emails
- **`validatePhone()`**: Valida números de teléfono colombianos
- **`validateNotEmpty()`**: Valida que una cadena no esté vacía
- **`validateInteger()`**: Valida números enteros con rango opcional
- **`validateFloat()`**: Valida números decimales con rango opcional

##### Validación de Fechas:
- **`validateDate()`**: Valida fechas en formato YYYY-MM-DD
- **`validateDateTime()`**: Valida fecha/hora en formato YYYY-MM-DD HH:MM:SS

##### Validaciones Específicas:
- **`validateCategory()`**: Valida categorías de productos
- **`validatePasswordStrength()`**: Valida fortaleza de contraseña
- **`validateImageExtension()`**: Valida extensiones de imágenes
- **`validateUrl()`**: Valida URLs
- **`validateIdExists()`**: Verifica que un ID exista en la base de datos

##### Protección CSRF:
- **`generateCsrfToken()`**: Genera token CSRF para formularios
- **`validateCsrfToken()`**: Valida token CSRF

#### Ejemplo de uso:

```php
<?php
require_once '../middleware/validation.php';

// Validar registro de usuario
if (isset($_POST['registrar'])) {
    // Sanitizar entradas
    $nombre = sanitizeString($_POST['nombre']);
    $email = validateEmail($_POST['email']);
    
    if ($email === false) {
        die("Email inválido");
    }
    
    // Validar teléfono
    if (!validatePhone($_POST['telefono'])) {
        die("Teléfono inválido");
    }
    
    // Validar contraseña
    $passwordCheck = validatePasswordStrength($_POST['clave']);
    if (!$passwordCheck['valid']) {
        echo "Errores en la contraseña:<br>";
        foreach ($passwordCheck['errors'] as $error) {
            echo "- $error<br>";
        }
        exit;
    }
    
    // Proceder con el registro...
}
?>
```

Ejemplo con CSRF:

```html
<!-- En el formulario -->
<?php
require_once '../middleware/validation.php';
$csrfToken = generateCsrfToken();
?>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
    <!-- Otros campos... -->
</form>
```

```php
<!-- En el controlador -->
<?php
if (isset($_POST['enviar'])) {
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die("Token CSRF inválido");
    }
    
    // Procesar formulario...
}
?>
```

---

## Integración con Controladores Existentes

### Paso 1: Actualizar `controllerusuario.php`

Agregar al inicio del archivo:

```php
<?php
require_once '../middleware/auth.php';
require_once '../middleware/validation.php';

// Configurar sesión segura
configureSecureSession();
```

En el bloque de login, después de verificar contraseña:

```php
if (password_verify($clave, $infoBD->contraseña)) {
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['name'] = $infoBD->nombre;
    $_SESSION['mail'] = $infoBD->correo;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    
    // NUEVO: Establecer rol y regenerar ID de sesión
    setUserRole($infoBD->rol ?? 'user'); // Asumiendo que existe campo rol
    regenerateSessionId();
    
    // ... resto del código
}
```

### Paso 2: Proteger Páginas en `views/`

Ejemplo para `views/indexcuenta.php`:

```php
<?php
require_once '../middleware/auth.php';

// Requiere autenticación
requireAuth();

// Prevenir acceso desde caché
preventCacheAccess();

// Resto del código de la página...
?>
```

Ejemplo para páginas de administrador:

```php
<?php
require_once '../middleware/auth.php';

// Requiere rol de administrador
requireAdmin();

// Prevenir acceso desde caché
preventCacheAccess();

// Resto del código de la página...
?>
```

### Paso 3: Actualizar Validaciones en `controllerproductos.php`

```php
<?php
require_once '../middleware/validation.php';

// En el bloque de agregar producto
if (isset($_POST['agregar'])) {
    // Sanitizar y validar entradas
    $nombre = sanitizeString($_POST['nombre']);
    $cantidad = validateInteger($_POST['cantidad'], 0, 999999);
    $precio = validateFloat($_POST['precio'], 0);
    $categoria = sanitizeString($_POST['categoria']);
    $imagen = sanitizeString($_POST['imagen']);
    
    // Validar categoría
    if (!validateCategory($categoria)) {
        header('Location: ../views/Crud.php?msg=categoria_invalida');
        exit;
    }
    
    // Validar campos obligatorios
    if ($cantidad === false || $precio === false) {
        header('Location: ../views/Crud.php?msg=datos_invalidos');
        exit;
    }
    
    // Validar extensión de imagen
    if (!validateImageExtension($imagen)) {
        header('Location: ../views/Crud.php?msg=imagen_invalida');
        exit;
    }
    
    // Insertar en base de datos...
}
?>
```

---

## Mejores Prácticas

### 1. Siempre usar `requireAuth()` en páginas protegidas

```php
<?php
require_once '../middleware/auth.php';
requireAuth();
?>
```

### 2. Sanitizar TODAS las entradas de usuario

```php
$nombre = sanitizeString($_POST['nombre']);
$email = validateEmail($_POST['email']);
```

### 3. Usar prepared statements en consultas SQL

```php
// MAL ❌
$query = "SELECT * FROM users WHERE email = '$email'";

// BIEN ✅
$stmt = $conexion->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
```

### 4. Validar tipos de datos antes de usar

```php
$cantidad = validateInteger($_POST['cantidad'], 0, 9999);
if ($cantidad === false) {
    die("Cantidad inválida");
}
```

### 5. Proteger formularios con CSRF tokens

```php
// Generar token
$token = generateCsrfToken();

// Validar token
if (!validateCsrfToken($_POST['csrf_token'])) {
    die("Token inválido");
}
```

---

## Configuración de Seguridad Adicional

### En producción, agregar en `.htaccess`:

```apache
# Proteger archivos sensibles
<Files "config.php">
    Order Allow,Deny
    Deny from all
</Files>

# Headers de seguridad
Header set X-Content-Type-Options "nosniff"
Header set X-Frame-Options "SAMEORIGIN"
Header set X-XSS-Protection "1; mode=block"
Header set Referrer-Policy "strict-origin-when-cross-origin"

# HTTPS redirect (solo en producción)
# RewriteEngine On
# RewriteCond %{HTTPS} off
# RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### En `config.php`, agregar verificación de entorno:

```php
<?php
// Configuración según entorno
$isProduction = ($_SERVER['SERVER_NAME'] !== 'localhost');

if ($isProduction) {
    // Producción: mostrar errores solo en logs
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', '/path/to/error.log');
    
    // Configurar sesión segura
    ini_set('session.cookie_secure', 1);
} else {
    // Desarrollo: mostrar errores
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
?>
```

---

## Testing

### Pruebas de Autenticación:

1. Intentar acceder a página protegida sin login
2. Verificar redirección a login
3. Hacer login válido
4. Verificar acceso a página protegida
5. Esperar timeout de sesión
6. Verificar cierre automático de sesión

### Pruebas de Validación:

1. Enviar formulario con email inválido
2. Enviar formulario con contraseña débil
3. Enviar formulario con teléfono inválido
4. Enviar formulario con XSS attack (`<script>alert('XSS')</script>`)
5. Verificar que todos los inputs sean sanitizados

---

## Soporte

Para preguntas o problemas con el middleware, contactar al equipo de desarrollo de SSmike.

**Última actualización:** 2025-10-29  
**Versión:** 1.0
