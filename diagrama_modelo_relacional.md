# Diagrama Modelo Relacional - Base de Datos SSmike

## Descripción
Este diagrama muestra la estructura y relaciones de la base de datos SSmike, un sistema de e-commerce para productos de belleza y cosmética.

```mermaid
---
title: Modelo Relacional Base de Datos SSmike
---
erDiagram
    CLIENTES {
        int id PK "Identificador único del cliente"
        varchar nombre "Nombre completo del cliente"
        varchar correo UK "Correo electrónico único"
        varchar telefono "Número de teléfono"
        varchar direccion "Dirección del cliente"
        varchar contraseña "Contraseña encriptada"
    }
    
    PRODUCTOS {
        int id PK "Identificador único del producto"
        varchar nombre "Nombre del producto"
        int cantidad "Stock disponible"
        decimal precio "Precio del producto"
        varchar categoria "Categoría del producto"
        varchar imagen "Ruta de la imagen del producto"
    }
    
    CARRITO {
        int id PK "Identificador único del registro"
        int cliente_id FK "Referencia al cliente"
        int producto_id FK "Referencia al producto"
        int cantidad "Cantidad del producto en el carrito"
        timestamp fecha "Fecha de adición al carrito"
    }
    
    ADMINISTRADORES {
        int id PK "Identificador único del administrador"
        varchar nombre "Nombre del administrador"
        varchar correo UK "Correo electrónico único"
        varchar contraseña "Contraseña encriptada"
    }
    
    MENSAJES {
        int id PK "Identificador único del mensaje"
        varchar nombre "Nombre del remitente"
        varchar correo "Correo del remitente"
        varchar telefono "Teléfono del remitente"
        text mensaje "Contenido del mensaje"
        timestamp fecha "Fecha de envío del mensaje"
    }
    
    %% Relaciones principales
    CLIENTES ||--o{ CARRITO : "gestiona"
    PRODUCTOS ||--o{ CARRITO : "incluye"
    
    %% Relaciones conceptuales del sistema
    ADMINISTRADORES }o..o{ PRODUCTOS : "administra"
    ADMINISTRADORES }o..o{ CLIENTES : "gestiona"
    ADMINISTRADORES }o..o{ MENSAJES : "revisa"
    CLIENTES }o..o{ MENSAJES : "envía"
    
    %% Estilos con colores de texto mejorados
    classDef clientTable fill:#e1f5fe,stroke:#01579b,stroke-width:3px,color:#000
    classDef productTable fill:#f3e5f5,stroke:#4a148c,stroke-width:3px,color:#000
    classDef cartTable fill:#e8f5e8,stroke:#1b5e20,stroke-width:3px,color:#000
    classDef adminTable fill:#fff3e0,stroke:#e65100,stroke-width:3px,color:#000
    classDef messageTable fill:#fce4ec,stroke:#880e4f,stroke-width:3px,color:#000
    
    class CLIENTES clientTable
    class PRODUCTOS productTable
    class CARRITO cartTable
    class ADMINISTRADORES adminTable
    class MENSAJES messageTable
```

## Descripción de las Entidades

### CLIENTES
- **Propósito**: Almacena información de los usuarios registrados en el sistema
- **Características**: 
  - Cada cliente tiene un ID único autoincremental
  - El correo electrónico es único (constraint UNIQUE)
  - Las contraseñas se almacenan encriptadas

### PRODUCTOS
- **Propósito**: Catálogo completo de productos disponibles en la tienda
- **Categorías disponibles**:
  - Maquillaje (bases, labiales, sombras, etc.)
  - Skincare (limpiadores, cremas, sueros, etc.)
  - Fragancias (perfumes y eau de parfum)
  - Accesorios (brochas, esponjas, herramientas)
- **Características**:
  - Control de inventario mediante el campo `cantidad`
  - Precios con precisión decimal
  - Imágenes almacenadas como rutas de archivo

### CARRITO
- **Propósito**: Gestiona los productos que los clientes agregan antes de realizar la compra
- **Características**:
  - Relación muchos a muchos entre clientes y productos
  - Cada registro incluye la cantidad específica
  - Timestamp para rastrear cuándo se agregó cada producto
  - Cascada en eliminación (si se elimina cliente o producto, se eliminan sus registros del carrito)

### ADMINISTRADORES
- **Propósito**: Gestión de usuarios con privilegios administrativos
- **Características**:
  - Sistema de autenticación separado de los clientes
  - Correo único para evitar duplicados
  - Contraseñas encriptadas para seguridad

### MENSAJES
- **Propósito**: Sistema de contacto para comunicación con la empresa
- **Características**:
  - No requiere registro previo
  - Almacena datos de contacto del remitente
  - Timestamp automático para organización cronológica

## Relaciones del Sistema

### Relaciones Principales (Identificativas)
1. **CLIENTES → CARRITO** (1:N)
   - Un cliente puede tener múltiples productos en su carrito
   - Relación identificativa con eliminación en cascada

2. **PRODUCTOS → CARRITO** (1:N)
   - Un producto puede estar en múltiples carritos
   - Relación identificativa con eliminación en cascada

### Relaciones Conceptuales (No Identificativas)
3. **ADMINISTRADORES → PRODUCTOS** (N:M)
   - Los administradores gestionan el catálogo de productos
   - Pueden crear, editar y eliminar productos

4. **ADMINISTRADORES → CLIENTES** (N:M)
   - Los administradores supervisan las cuentas de clientes
   - Pueden gestionar usuarios y resolver incidencias

5. **ADMINISTRADORES → MENSAJES** (N:M)
   - Los administradores revisan y responden mensajes
   - Sistema de atención al cliente

6. **CLIENTES → MENSAJES** (N:M)
   - Los clientes pueden enviar múltiples mensajes de contacto
   - No requiere autenticación, es un sistema abierto

## Características del Sistema

- **Seguridad**: Contraseñas encriptadas con hash
- **Integridad referencial**: Claves foráneas con restricciones CASCADE
- **Escalabilidad**: Diseño preparado para crecimiento del catálogo
- **Trazabilidad**: Timestamps en operaciones críticas
- **Flexibilidad**: Estructura que permite futuras extensiones