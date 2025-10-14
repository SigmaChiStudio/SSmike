<?php
// Archivo de configuración global para el proyecto SSmike.
// Aquí se definen constantes que se usan en todo el sistema para seguridad y conexión a la base de datos.

/**
 * KEY y COD:
 * Constantes utilizadas para la encriptación y desencriptación de datos sensibles,
 * como los datos del carrito de compras o información de usuario.
 * - KEY: Clave secreta para cifrado.
 * - COD: Algoritmo de cifrado (AES-128-ECB en este caso).
 */
define ("KEY", "develoteca");
define ("COD", "AES-128-ECB");

/**
 * DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME:
 * Constantes para la conexión a la base de datos MySQL.
 * Permiten centralizar y modificar fácilmente las credenciales según el entorno (local o hosting).
 * - DATABASE_HOST: Dirección del servidor de base de datos (localhost en desarrollo).
 * - DATABASE_USER: Usuario de la base de datos.
 * - DATABASE_PASS: Contraseña del usuario de la base de datos.
 * - DATABASE_NAME: Nombre de la base de datos utilizada por el proyecto.
 */
define ("DATABASE_HOST", "localhost");
define ("DATABASE_USER", "root");
define ("DATABASE_PASS", "");
define ("DATABASE_NAME", "ssmike_db"); // Actualizado a la nueva base de datos

// Este archivo debe ser incluido en los scripts que requieran acceso a la base de datos o funciones de cifrado.
?>