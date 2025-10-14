# SSmike S.A - Tienda de Productos de Belleza 💄✨

![SSmike Logo](model/img/navbar-logo.png)

## Descripción del Proyecto

**SSmike S.A** es una plataforma de comercio electrónico especializada en productos de belleza femenina. El proyecto ofrece una experiencia completa de compra online con catálogo de productos organizados por categorías, sistema de usuarios, carrito de compras y panel administrativo.

### Características Principales

- 🛍️ **Catálogo de productos** con más de 170 productos de belleza
- 🔍 **Sistema de filtros** por categorías (Maquillaje, Skincare, Fragancias, Accesorios)
- 👥 **Sistema de usuarios** con registro y autenticación
- 🛒 **Carrito de compras** funcional
- 👨‍💼 **Panel administrativo** para gestión de productos y clientes
- 📱 **Diseño responsive** adaptable a dispositivos móviles
- ✉️ **Sistema de contacto** con formulario integrado

## Tecnologías Utilizadas

### Frontend
- **HTML5** - Estructura semántica
- **CSS3** - Estilos y diseño responsive
- **JavaScript** - Interactividad y filtros dinámicos
- **Bootstrap 4** - Framework CSS para diseño responsive
- **FontAwesome** - Iconografía
- **jQuery** - Manipulación del DOM

### Backend
- **PHP 8.2** - Lógica del servidor
- **MySQL** - Base de datos relacional
- **PDO** - Conexión y consultas a la base de datos

### Herramientas de Desarrollo
- **XAMPP** - Servidor local de desarrollo
- **phpMyAdmin** - Administración de base de datos

## Estructura del Proyecto

```
SSmike/
├── index.html                 # Página principal
├── ssmike_db.sql             # Archivo de base de datos
├── README.md                 # Documentación del proyecto
├── assets/                   # Recursos estáticos
│   ├── css/
│   │   ├── styles.css       # Estilos principales
│   │   └── logginstyle.css  # Estilos de formularios
│   └── js/
│       └── scripts.js       # JavaScript personalizado
├── controller/               # Lógica de negocio
│   ├── conexion.php         # Configuración de base de datos
│   ├── controllerusuario.php # Gestión de usuarios
│   ├── controllerproductos.php # Gestión de productos
│   ├── carrito.php          # Lógica del carrito
│   └── mensaje.php          # Procesamiento de contacto
├── model/                   # Modelos y recursos
│   ├── img/                 # Imágenes del sitio
│   │   ├── products/        # Imágenes de productos
│   │   ├── team/           # Fotos del equipo
│   │   └── about/          # Imágenes institucionales
│   └── mail/               # Scripts de correo
├── views/                   # Vistas y páginas
│   ├── loggin.php          # Página de inicio de sesión
│   ├── register.php        # Página de registro
│   ├── index2.php          # Dashboard de usuario
│   ├── indexadmin.php      # Panel administrativo
│   ├── vistacarro.php      # Vista del carrito
│   └── [otros archivos de vista]
└── vendor/                  # Dependencias (PHPMailer)
```

## Base de Datos

### Tablas Principales

1. **productos** - Catálogo de productos con categorías y precios
2. **clientes** - Información de usuarios registrados
3. **administradores** - Usuarios con privilegios administrativos
4. **carrito** - Items del carrito de cada usuario
5. **mensajes** - Mensajes de contacto recibidos

### Diagrama de Relaciones
```
clientes (1) ←→ (N) carrito (N) ←→ (1) productos
```

## Instalación y Configuración

### Requisitos Previos
- **XAMPP** (Apache + MySQL + PHP 8.2+)
- **Navegador web** moderno
- **phpMyAdmin** (incluido en XAMPP)

### Pasos de Instalación

1. **Clonar o descargar el repositorio**
   ```bash
   git clone https://github.com/SigmaChiStudio/SSmike.git
   ```

2. **Ubicar el proyecto en el directorio de XAMPP**
   ```
   Copiar la carpeta SSmike a: C:\xampp\htdocs\
   ```

3. **Iniciar servicios de XAMPP**
   - Abrir XAMPP Control Panel
   - Iniciar **Apache** y **MySQL**

4. **Configurar la base de datos**
   - Acceder a http://localhost/phpmyadmin
   - Crear una nueva base de datos llamada `ssmike_db`
   - Importar el archivo `ssmike_db.sql`

5. **Verificar configuración de conexión**
   - Revisar el archivo `controller/conexion.php`
   - Ajustar credenciales si es necesario:
   ```php
   define('DATABASE_HOST', 'localhost');
   define('DATABASE_USER', 'root');
   define('DATABASE_PASS', '');
   define('DATABASE_NAME', 'ssmike_db');
   ```

6. **Acceder a la aplicación**
   - URL Principal: http://localhost/SSmike/
   - Panel Admin: http://localhost/SSmike/views/logginadmin.php

## Credenciales de Acceso

### Administrador
- **Email:** admin@ejemplo.com
- **Contraseña:** admin123

### Usuario de Prueba
Los usuarios se pueden registrar desde la interfaz web.

## Funcionalidades por Rol

### Usuario Cliente
- ✅ Navegación del catálogo de productos
- ✅ Filtrado por categorías
- ✅ Registro e inicio de sesión
- ✅ Agregar productos al carrito
- ✅ Visualizar carrito de compras
- ✅ Enviar mensajes de contacto
- ✅ Gestión de perfil personal

### Administrador
- ✅ Todas las funciones de cliente
- ✅ Gestión de productos (CRUD)
- ✅ Administración de usuarios
- ✅ Visualización de mensajes de contacto
- ✅ Control de inventario
- ✅ Panel de administración completo

## Categorías de Productos

1. **Maquillaje** (110+ productos)
   - Bases y correctores
   - Labiales y brillos
   - Sombras y paletas
   - Máscaras de pestañas
   - Delineadores
   - Polvos y rubores

2. **Skincare** (35+ productos)
   - Limpiadores faciales
   - Cremas hidratantes
   - Serums y tratamientos
   - Mascarillas
   - Protectores solares

3. **Fragancias** (15+ productos)
   - Perfumes femeninos
   - Eau de parfum
   - Fragancias de diseñador

4. **Accesorios** (13+ productos)
   - Brochas de maquillaje
   - Esponjas y herramientas
   - Sets de aplicación

## Marcas Disponibles

- Samy Cosmetics
- L'Oréal París
- CeraVe
- Carolina Herrera
- Jean Paul Gaultier
- Ariana Grande
- Lattafa
- Ruby Rose
- Colorissimo
- Y muchas más...

## Contacto y Soporte

### Información del Proyecto
- **Empresa:** SSmike S.A
- **Propósito:** Proyecto educativo de e-commerce
- **Licencia:** Uso académico

### Equipo de Desarrollo
- **Valentina Gómez** - Líder de Proyecto
- **Camila Torres** - Desarrolladora Web
- **Juan Pérez** - Diseñador Gráfico
- **Sofía Ramírez** - Productora Visual
- **Andrés Castillo** - Analista de Datos

## Notas Importantes

⚠️ **AVISO EDUCATIVO**: Este proyecto es desarrollado con fines educativos. Todo el contenido (imágenes, información de productos, etc.) es utilizado únicamente para demostración y aprendizaje. No se busca la venta real de productos.

## Contribuciones

Este es un proyecto académico. Para sugerencias o mejoras, puedes:
1. Crear un issue en el repositorio
2. Enviar un pull request
3. Contactar al equipo de desarrollo

## Licencia

Este proyecto está desarrollado con fines educativos y de aprendizaje. Todos los derechos de las imágenes y marcas pertenecen a sus respectivos propietarios.

---

**© 2025 SSmike S.A - Todos los derechos reservados**

*"Descubre tu belleza con nuestra selección de productos"*