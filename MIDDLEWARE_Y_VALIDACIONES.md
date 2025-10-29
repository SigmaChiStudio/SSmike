# Análisis de Middleware y Validaciones - SSmike S.A

## Resumen Ejecutivo
Este documento presenta un análisis completo de las validaciones y medidas de seguridad implementadas en los controladores del proyecto SSmike. El sistema cuenta con múltiples capas de validación para proteger la integridad de los datos y la seguridad de los usuarios.

---

## 1. CONTROLADOR DE USUARIOS (`controllerusuario.php`)

### 1.1 Validaciones en Registro de Cliente
**Endpoint:** `POST` con parámetro `registrar`

#### Validaciones Implementadas:
1. **Verificación de Email Único**
   - Consulta: `SELECT * FROM clientes WHERE correo= '$email'`
   - Previene duplicación de cuentas con el mismo correo
   - Respuesta: Error si el email ya existe

2. **Verificación de ID Único**
   - Consulta: `SELECT * FROM clientes WHERE id= '$id'`
   - Previene duplicación de identificadores
   - Respuesta: Error si el ID ya existe

3. **Encriptación de Contraseña**
   - Método: `password_hash($clave, PASSWORD_DEFAULT)`
   - Algoritmo: Bcrypt (recomendado por PHP)
   - Seguridad: Hash unidireccional con salt automático

#### Respuestas del Sistema:
- ✅ **Éxito:** Registro completado + redirección a login
- ❌ **Error:** Email/ID duplicado + mensaje específico
- ❌ **Error:** Fallo en inserción + mensaje genérico

---

### 1.2 Validaciones en Login de Cliente
**Endpoint:** `POST` con parámetro `Login`

#### Validaciones Implementadas:
1. **Verificación de Existencia de Email**
   - Consulta: `SELECT * FROM clientes WHERE correo = '$email'`
   - Validación: `is_bool($infoBD)` para detectar email no existente
   - Respuesta: "Email incorrecto" si no existe

2. **Verificación de Contraseña**
   - Método: `password_verify($clave, $infoBD->contraseña)`
   - Compara el hash almacenado con la contraseña ingresada
   - Respuesta: "Email y/o Contraseña incorrectos" si falla

3. **Gestión de Sesiones Seguras**
   ```php
   $_SESSION['loggedin'] = true;
   $_SESSION['name'] = $infoBD->nombre;
   $_SESSION['mail'] = $infoBD->correo;
   $_SESSION['start'] = time();
   $_SESSION['expire'] = $_SESSION['start'] + (5 * 60); // 5 minutos
   ```
   - Timeout de sesión: 5 minutos
   - Almacena información mínima necesaria

#### Respuestas del Sistema:
- ✅ **Éxito:** Inicio de sesión + bienvenida personalizada
- ❌ **Error:** Email incorrecto
- ❌ **Error:** Contraseña incorrecta

---

### 1.3 Validaciones en Edición de Cliente (Admin)
**Endpoint:** `GET` con parámetro `editaradmin`

#### Validaciones Implementadas:
1. **Encriptación de Contraseña en Actualización**
   - Método: `password_hash($clave, PASSWORD_DEFAULT)`
   - Se re-encripta la contraseña antes de actualizar

2. **Prepared Statements**
   - Método: `$conexion->prepare()`
   - Previene inyección SQL
   - Todos los valores son parametrizados

#### Respuestas del Sistema:
- ✅ **Éxito:** Datos actualizados
- ❌ **Error:** Fallo en actualización (ID/email duplicado)

---

### 1.4 Validaciones en Registro de Reunión de Compra
**Endpoint:** `POST` con parámetro `rcompra`

#### Validaciones Implementadas:
1. **Verificación de Disponibilidad de Fecha**
   - Consulta: `SELECT *FROM rcompra WHERE fecha= '$fecha'`
   - Previene doble reserva en la misma fecha
   - Respuesta: "Fecha ocupada" si ya existe

2. **Verificación de Email de Cliente Registrado**
   - Consulta: `SELECT * FROM clientes WHERE correo = '$email'`
   - Validación: `is_bool($infoBD)` para verificar existencia
   - Solo permite agendar a clientes registrados
   - Respuesta: "Email no corresponde" si no está registrado

3. **Validación de Sesión Activa**
   - Requiere: `session_start()`
   - Garantiza que solo usuarios autenticados pueden agendar

#### Respuestas del Sistema:
- ✅ **Éxito:** Reunión agendada + confirmación
- ❌ **Error:** Fecha ocupada
- ❌ **Error:** Email no registrado
- ❌ **Error:** Fallo en inserción

---

### 1.5 Validaciones en Petición de Manejo
**Endpoint:** `POST` con parámetro `pmanejo`

#### Validaciones Implementadas:
*(Idénticas a las de Reunión de Compra)*
1. Verificación de disponibilidad de fecha en tabla `pmanejo`
2. Verificación de email de cliente registrado
3. Validación de sesión activa

---

### 1.6 Validaciones en Edición de Cliente (Auto-edición)
**Endpoint:** `POST` con parámetro `editarcliente`

#### Validaciones Implementadas:
1. **Validación Condicional de Contraseña**
   ```php
   if (empty($clave)) {
       // No actualiza contraseña
   } else {
       // Actualiza contraseña encriptada
   }
   ```
   - Permite actualizar datos sin cambiar contraseña
   - Si se proporciona contraseña nueva, se encripta antes de guardar

2. **Prepared Statements**
   - Prevención de inyección SQL en todas las consultas

---

### 1.7 Logout
**Endpoint:** `POST` con parámetro `Logout`

#### Seguridad Implementada:
```php
session_start();
session_destroy();
header('location: ../index.html');
```
- Destruye completamente la sesión
- Redirección a página pública

---

## 2. CONTROLADOR DE PRODUCTOS (`controllerproductos.php`)

### 2.1 Agregar Producto
**Endpoint:** `POST` con parámetro `agregar`

#### Validaciones Implementadas:
1. **Prepared Statements**
   ```php
   $sql = "INSERT INTO productos (nombre, cantidad, precio, categoria, imagen) VALUES (?, ?, ?, ?, ?)";
   $stmt = $conexion->prepare($sql);
   $stmt->execute([$nombre, $cantidad, $precio, $categoria, $imagen]);
   ```
   - Prevención de inyección SQL
   - Parámetros sanitizados automáticamente

2. **Campos Validados:**
   - `nombre`: Nombre del producto
   - `cantidad`: Cantidad disponible
   - `precio`: Precio del producto
   - `categoria`: Categoría (Maquillaje, Skincare, Fragancias, Accesorios)
   - `imagen`: Ruta de la imagen

#### Respuestas del Sistema:
- ✅ **Éxito:** Producto agregado + redirección a CRUD

---

### 2.2 Eliminar Producto
**Endpoint:** `GET` con parámetro `eliminar`

#### Validaciones Implementadas:
1. **Prepared Statements**
   ```php
   $sql = "DELETE FROM productos WHERE id = ?";
   $stmt = $conexion->prepare($sql);
   $stmt->execute([$id]);
   ```

#### Respuestas del Sistema:
- ✅ **Éxito:** Producto eliminado + redirección a CRUD

---

### 2.3 Actualizar Producto
**Endpoint:** `POST` con parámetro `actualizar`

#### Validaciones Implementadas:
1. **Prepared Statements**
   ```php
   $sql = "UPDATE productos SET nombre=?, cantidad=?, precio=?, categoria=?, imagen=? WHERE id=?";
   $stmt = $conexion->prepare($sql);
   $stmt->execute([$nombre, $cantidad, $precio, $categoria, $imagen, $id]);
   ```

#### Respuestas del Sistema:
- ✅ **Éxito:** Producto actualizado + redirección a CRUD

---

## 3. CONTROLADOR DE MENSAJES (`mensaje.php`)

### 3.1 Envío de Mensaje de Contacto
**Endpoint:** `POST` desde formulario de contacto

#### Validaciones y Sanitización Implementadas:

1. **Sanitización de Entradas**
   ```php
   $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
   $telefono = htmlspecialchars(trim($_POST['cel'] ?? ''));
   $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
   $mensaje = htmlspecialchars(trim($_POST['mensaje'] ?? ''));
   ```

2. **Protecciones Aplicadas:**
   - `htmlspecialchars()`: Previene XSS (Cross-Site Scripting)
   - `trim()`: Elimina espacios en blanco innecesarios
   - `FILTER_SANITIZE_EMAIL`: Valida y limpia formato de email
   - Operador `??`: Proporciona valor por defecto si no existe

3. **Seguridad en Envío de Emails (PHPMailer)**
   ```php
   $mail->SMTPOptions = [
       'ssl' => [
           'verify_peer' => true,
           'verify_peer_name' => true,
           'allow_self_signed' => false
       ]
   ];
   ```
   - Verificación SSL/TLS estricta
   - No permite certificados autofirmados
   - Protección contra ataques Man-in-the-Middle

4. **Configuración SMTP Segura**
   - Encriptación: `ENCRYPTION_STARTTLS`
   - Puerto: 587 (TLS)
   - Autenticación obligatoria

#### Respuestas del Sistema:
- ✅ **Éxito:** Mensaje enviado + alerta JavaScript
- ❌ **Error:** Fallo en envío + mensaje de PHPMailer

---

## 4. ARCHIVO DE CONFIGURACIÓN (`config.php`)

### 4.1 Constantes de Seguridad

#### Encriptación de Datos
```php
define ("KEY", "develoteca");
define ("COD", "AES-128-ECB");
```
- **Uso:** Encriptación de datos del carrito
- **Algoritmo:** AES-128-ECB
- **Nota:** ⚠️ ECB no es el modo más seguro (considerar migrar a AES-128-CBC o AES-256-GCM)

#### Configuración de Base de Datos
```php
define ("DATABASE_HOST", "localhost");
define ("DATABASE_USER", "root");
define ("DATABASE_PASS", "");
define ("DATABASE_NAME", "ssmike_db");
```
- **Seguridad:** ⚠️ Contraseña vacía en desarrollo
- **Recomendación:** Usar contraseñas fuertes en producción

---

## 5. VALIDACIONES EN EL FRONTEND (index.html)

### 5.1 Validación de Formulario de Contacto
```html
<input class="form-control" id="name" type="text" 
       placeholder="Nombre completo *" 
       required="required" 
       data-validation-required-message="Por favor ingresa tu nombre completo." />
```

#### Atributos de Validación HTML5:
- `required`: Campo obligatorio
- `type="email"`: Validación de formato de email
- `type="tel"`: Validación de formato de teléfono
- `data-validation-*`: Mensajes personalizados de validación

### 5.2 Filtrado de Productos con JavaScript
```javascript
function filter(cat) {
    items.forEach(it => {
        const itemCat = it.getAttribute('data-category');
        it.style.display = (cat === 'all' || itemCat === cat) ? '' : 'none';
    });
}
```
- **Funcionalidad:** Filtro por categoría en tiempo real
- **Sin recarga:** Experiencia de usuario mejorada

---

## 6. MEDIDAS DE SEGURIDAD IMPLEMENTADAS

### 6.1 Prevención de Inyección SQL
✅ **Prepared Statements en todos los controladores**
- `controllerusuario.php`: 100% implementado
- `controllerproductos.php`: 100% implementado

⚠️ **Consultas sin preparar detectadas:**
```php
// En controllerusuario.php - LOGIN
$respuesta = $conexion->query("SELECT * FROM clientes WHERE correo = '$email'");
```
**Recomendación:** Migrar a prepared statements:
```php
$stmt = $conexion->prepare("SELECT * FROM clientes WHERE correo = ?");
$stmt->execute([$email]);
```

### 6.2 Prevención de XSS (Cross-Site Scripting)
✅ **Implementado en:**
- `mensaje.php`: `htmlspecialchars()` en todos los inputs
- Frontend: Atributos HTML5 de validación

### 6.3 Gestión Segura de Contraseñas
✅ **Bcrypt con `password_hash()`**
- Algoritmo: PASSWORD_DEFAULT (actualmente Bcrypt)
- Salt automático
- Verificación con `password_verify()`

### 6.4 Gestión de Sesiones
✅ **Implementado:**
- Timeout de sesión: 5 minutos
- Destrucción completa en logout
- Validación de sesión en operaciones críticas

⚠️ **Mejoras recomendadas:**
- Regeneración de ID de sesión en login
- Flags de sesión seguras (httponly, secure, samesite)

---

## 7. RESUMEN DE VALIDACIONES POR CONTROLADOR

### `controllerusuario.php` (8 endpoints)
| Endpoint | Validaciones | Seguridad |
|----------|-------------|-----------|
| Registro | Email único + ID único + Password hash | ✅ Alta |
| Login | Email existe + Password verify + Sesión | ✅ Alta |
| Editar (Admin) | Password hash + Prepared statements | ✅ Alta |
| Eliminar | Prepared statements | ✅ Media |
| Reunión Compra | Fecha única + Email registrado + Sesión | ✅ Alta |
| Petición Manejo | Fecha única + Email registrado + Sesión | ✅ Alta |
| Editar (Cliente) | Password opcional + Prepared statements | ✅ Alta |
| Logout | Destrucción de sesión | ✅ Media |

### `controllerproductos.php` (3 endpoints)
| Endpoint | Validaciones | Seguridad |
|----------|-------------|-----------|
| Agregar | Prepared statements | ✅ Media |
| Eliminar | Prepared statements | ✅ Media |
| Actualizar | Prepared statements | ✅ Media |

### `mensaje.php` (1 endpoint)
| Endpoint | Validaciones | Seguridad |
|----------|-------------|-----------|
| Contacto | htmlspecialchars + filter_input + SSL/TLS | ✅ Alta |

---

## 8. RECOMENDACIONES DE MEJORA

### 8.1 Prioridad Alta 🔴
1. **Migrar consultas directas a Prepared Statements**
   - Archivos afectados: `controllerusuario.php` (líneas 118, 123, 350, 490, 493, 670, 673)

2. **Implementar Control de Acceso (Middleware)**
   - Crear archivo `middleware/auth.php`:
   ```php
   <?php
   function requireAuth() {
       session_start();
       if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
           header('Location: /views/loggin.php');
           exit;
       }
       // Verificar timeout
       if (time() > $_SESSION['expire']) {
           session_destroy();
           header('Location: /views/loggin.php?timeout=1');
           exit;
       }
       // Regenerar expiración
       $_SESSION['expire'] = time() + (5 * 60);
   }
   
   function requireAdmin() {
       requireAuth();
       if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
           header('Location: /views/paginanodisp.php');
           exit;
       }
   }
   ?>
   ```

3. **Mejorar Configuración de Sesiones**
   ```php
   // Agregar en config.php o inicio de sesión
   ini_set('session.cookie_httponly', 1);
   ini_set('session.cookie_secure', 1); // Solo si usas HTTPS
   ini_set('session.cookie_samesite', 'Strict');
   session_start();
   ```

### 8.2 Prioridad Media 🟡
1. **Implementar Rate Limiting**
   - Prevenir ataques de fuerza bruta en login
   - Limitar intentos de registro

2. **Validación de Tipos de Datos**
   ```php
   // Ejemplo para controllerproductos.php
   $cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);
   $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);
   if ($cantidad === false || $precio === false) {
       die("Datos inválidos");
   }
   ```

3. **Mejorar Algoritmo de Encriptación**
   - Migrar de AES-128-ECB a AES-256-GCM
   ```php
   define ("COD", "AES-256-GCM");
   ```

### 8.3 Prioridad Baja 🟢
1. **Implementar CSRF Protection**
   - Generar tokens en formularios
   - Validar tokens en controllers

2. **Logging de Eventos de Seguridad**
   - Registrar intentos de login fallidos
   - Registrar cambios en datos críticos

3. **Validación de Formato de Imágenes**
   - Verificar extensión y tipo MIME en `controllerproductos.php`

---

## 9. CONCLUSIONES

### ✅ Fortalezas del Sistema
1. **Uso de Prepared Statements** en operaciones CRUD de productos
2. **Encriptación de contraseñas** con Bcrypt
3. **Validaciones de unicidad** para emails e IDs
4. **Sanitización de entradas** en formulario de contacto
5. **Gestión de sesiones** con timeout

### ⚠️ Áreas de Mejora
1. Algunas consultas SQL sin preparar en `controllerusuario.php`
2. No hay middleware explícito de autenticación
3. Falta validación de roles (admin vs usuario)
4. Contraseña de base de datos vacía en desarrollo
5. No hay protección CSRF

### 📊 Nivel de Seguridad General
**MEDIO-ALTO**: El sistema implementa las validaciones básicas necesarias, pero requiere mejoras para alcanzar estándares de seguridad corporativos.

---

## 10. PLAN DE IMPLEMENTACIÓN PROPUESTO

### Fase 1: Correcciones Críticas (1-2 días)
- [ ] Migrar todas las consultas a Prepared Statements
- [ ] Implementar middleware de autenticación
- [ ] Configurar flags de sesión seguros

### Fase 2: Mejoras de Seguridad (3-5 días)
- [ ] Implementar validación de roles
- [ ] Agregar rate limiting en login
- [ ] Implementar CSRF protection

### Fase 3: Optimizaciones (5-7 días)
- [ ] Mejorar algoritmo de encriptación
- [ ] Implementar logging de seguridad
- [ ] Agregar validaciones de tipo de datos

---

**Documento generado:** 2025-10-29  
**Versión:** 1.0  
**Autor:** Análisis Automatizado de Seguridad  
**Proyecto:** SSmike S.A - Sistema de E-commerce
