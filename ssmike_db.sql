-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2025 a las 21:23:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ssmike_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `correo`, `contraseña`) VALUES
(0, 'Admin', 'admin@ejemplo.com', '$2y$10$Ftwj3zyKHMkzcIllmL./x.kWsG0i9qSnx5Q3sylPmDVWvFojRZTIu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `cantidad`, `precio`, `categoria`, `imagen`) VALUES
(110, 'Aceite hidratante para labios Jelly Wow-Pinkies Up', 10, 23200.00, 'Maquillaje', '../model/img/products/Aceite hidratante para labios Jelly Wow-Pinkies Up.jpg'),
(111, 'Aleta dentro de la paleta', 10, 38700.00, 'Maquillaje', '../model/img/products/Aleta dentro de la paleta.jpg'),
(112, 'Bálsamo Labial Kiss My Lips Cereza', 10, 9400.00, 'Maquillaje', '../model/img/products/Bálsamo Labial Kiss My Lips Cereza.webp'),
(113, 'Base de maquillaje hidratante Skinfinite-Lino', 10, 42500.00, 'Maquillaje', '../model/img/products/Base de maquillaje hidratante Skinfinite-Lino.jpg'),
(114, 'Base líquida acabado natural', 10, 32900.00, 'Maquillaje', '../model/img/products/Base líquida acabado natural.webp'),
(115, 'Base Liquida Dream Blend', 10, 37500.00, 'Maquillaje', '../model/img/products/Base Liquida Dream Blend.webp'),
(116, 'Base Líquida Essential', 10, 13900.00, 'Maquillaje', '../model/img/products/Base Líquida Essential.webp'),
(117, 'Base Líquida Go Bright! Samy', 10, 25830.00, 'Maquillaje', '../model/img/products/Base Líquida Go Bright! Samy.webp'),
(118, 'Base Líquida Mate Natural', 10, 25200.00, 'Maquillaje', '../model/img/products/Base Líquida Mate Natural.webp'),
(119, 'Base Líquida Matificante Samy', 10, 26530.00, 'Maquillaje', '../model/img/products/Base liquida matificante samy.webp'),
(120, 'Base Líquida Resist', 10, 22700.00, 'Maquillaje', '../model/img/products/Base Líquida Resist.webp'),
(121, 'Base Polvo Resist', 10, 18130.00, 'Maquillaje', '../model/img/products/Base Polvo Resist.webp'),
(122, 'Bronceador líquido mate Sun Beam-Golden Sun', 10, 23200.00, 'Maquillaje', '../model/img/products/Bronceador líquido mate Sun Beam-Golden Sun.jpg'),
(123, 'Bronceador Sunside-Dawn Glow', 10, 23200.00, 'Maquillaje', '../model/img/products/Bronceador Sunside-Dawn Glow.jpg'),
(124, 'Bubble Kiss Bálsamo labial-Berries', 10, 23200.00, 'Maquillaje', '../model/img/products/Bubble Kiss Bálsamo labial-Berries.jpg'),
(125, 'Cera para cejas Samy', 10, 24700.00, 'Maquillaje', '../model/img/products/Cera para cejas Samy.webp'),
(126, 'Complexion Pro-Lino', 10, 42500.00, 'Maquillaje', '../model/img/products/Complexion Pro-Lino.jpg'),
(127, 'Corrector de color y corrector Multi-Fix-Vainilla', 10, 36700.00, 'Maquillaje', '../model/img/products/Corrector de color y corrector Multi-Fix-Vainilla.jpg'),
(128, 'Corrector Essential', 10, 10950.00, 'Maquillaje', '../model/img/products/Corrector Essential.webp'),
(129, 'Corrector liquido', 10, 22900.00, 'Maquillaje', '../model/img/products/Corrector liquido.webp'),
(130, 'Corrector líquido de cobertura media', 10, 21900.00, 'Maquillaje', '../model/img/products/Corrector líquido de cobertura media.webp'),
(131, 'Corrector Líquido Mate Natural', 10, 14150.00, 'Maquillaje', '../model/img/products/Corrector Líquido Mate Natural.webp'),
(132, 'Corrector Líquido Resist', 10, 17700.00, 'Maquillaje', '../model/img/products/Corrector Líquido Resist.webp'),
(133, 'Corrector Líquido Samy', 10, 13230.00, 'Maquillaje', '../model/img/products/Corrector Líquido Samy.webp'),
(134, 'Corrector Multi-Fix y Corrector de Color-Dulce de Leche', 10, 36700.00, 'Maquillaje', '../model/img/products/Corrector Multi-Fix y Corrector de Color-Dulce de Leche.jpg'),
(135, 'Delineador De Ojos Catfight Eyeliner Samy', 10, 20700.00, 'Maquillaje', '../model/img/products/Delineador De Ojos Catfight Eyeliner Samy.webp'),
(136, 'Delineador de pestañas All Eyes On You-color negro', 10, 17400.00, 'Maquillaje', '../model/img/products/Delineador de pestañas All Eyes On You-color negro.jpg'),
(137, 'Delineador Glitter De Ojos', 10, 21900.00, 'Maquillaje', '../model/img/products/DELINEADOR GLITTER DE OJOS.webp'),
(138, 'Delineador Líquido Colores Melu', 10, 16500.00, 'Maquillaje', '../model/img/products/DELINEADOR LÍQUIDO COLORES MELU.webp'),
(139, 'Delineador Líquido Colorissimo', 10, 16150.00, 'Maquillaje', '../model/img/products/Delineador Líquido Colorissimo.webp'),
(140, 'Delineador Líquido De Ojos A Prueba De Agua Samy', 10, 22000.00, 'Maquillaje', '../model/img/products/Delineador Líquido De Ojos A Prueba De Agua Samy.webp'),
(141, 'Delineador Líquido Resist', 10, 20150.00, 'Maquillaje', '../model/img/products/Delineador Líquido Resist.webp'),
(142, 'Delineador Plumón Resist', 10, 23150.00, 'Maquillaje', '../model/img/products/Delineador Plumón Resist.webp'),
(143, 'Fijador De Maquillaje Samy 80Ml', 10, 39100.00, 'Maquillaje', '../model/img/products/Fijador De Maquillaje Samy 80Ml.webp'),
(144, 'Fluff Line Lápiz de Cejas', 10, 15400.00, 'Maquillaje', '../model/img/products/Fluff Line Lápiz de Cejas-Auburn.jpg'),
(145, 'Gel para cejas', 10, 18900.00, 'Maquillaje', '../model/img/products/Gel para cejas.webp'),
(146, 'Iluminador Cremoso Luminous Glance Samy', 10, 9200.00, 'Maquillaje', '../model/img/products/Iluminador Cremoso Luminous Glance Samy.webp'),
(147, 'Iluminador en espuma Cosmic Crystal-vainilla Skeye', 10, 19300.00, 'Maquillaje', '../model/img/products/Iluminador en espuma Cosmic Crystal-vainilla Skeye.jpg'),
(148, 'Iluminador Líquido Samy Para Ojos Y Rostro', 10, 22600.00, 'Maquillaje', '../model/img/products/Iluminador Líquido Samy Para Ojos Y Rostro.webp'),
(149, 'Iluminador marmolado efecto glow natural', 10, 26900.00, 'Maquillaje', '../model/img/products/Iluminador marmolado efecto glow natural.webp'),
(150, 'Iluminador Moonside-Cosmic Stream', 10, 23200.00, 'Maquillaje', '../model/img/products/Iluminador Moonside-Cosmic Stream.jpg'),
(151, 'Iluminador- Sombra Individual Twinkle Touch', 10, 18500.00, 'Maquillaje', '../model/img/products/Iluminador- Sombra Individual Twinkle Touch.webp'),
(152, 'Labial Brillante Resist OH Q Brillo', 10, 18900.00, 'Maquillaje', '../model/img/products/LABIAL BRILLANTE RESIST OH Q BRILLO.webp'),
(153, 'Labial Duo Kiss', 10, 25900.00, 'Maquillaje', '../model/img/products/Labial Duo Kiss.webp'),
(154, 'Labial En Barra Mate Samy', 10, 16400.00, 'Maquillaje', '../model/img/products/Labial En Barra Mate Samy.webp'),
(155, 'Labial Líquido Cremoso Samy', 10, 17400.00, 'Maquillaje', '../model/img/products/Labial Líquido Cremoso Samy.webp'),
(156, 'Labial Líquido Mate Feels', 10, 20900.00, 'Maquillaje', '../model/img/products/LABIAL LÍQUIDO MATE FEELS.webp'),
(157, 'Labial Mate Colorissimo 4G', 10, 12950.00, 'Maquillaje', '../model/img/products/Labial Mate Colorissimo 4G.webp'),
(158, 'Labial Retráctil Mate Cremoso Samy', 10, 20400.00, 'Maquillaje', '../model/img/products/Labial Retráctil Mate Cremoso Samy.webp'),
(159, 'Lápiz Delineador De Cejas Fantastic', 10, 9500.00, 'Maquillaje', '../model/img/products/Lápiz Delineador De Cejas Fantastic.webp'),
(160, 'Lápiz delineador de ojos mate EZ Glide', 10, 15400.00, 'Maquillaje', '../model/img/products/Lápiz delineador de ojos mate EZ Glide.jpg'),
(161, 'Lápiz labial brillante Mirror Kiss-aduéñate de tu brillo', 10, 27000.00, 'Maquillaje', '../model/img/products/Lápiz labial brillante Mirror Kiss-aduéñate de tu brillo.jpg'),
(163, 'Lápiz para cejas retráctil Samy', 10, 30800.00, 'Maquillaje', '../model/img/products/Lapiz para cejas retractil Samy.webp'),
(164, 'Lashlighter Up & Out Máscara de pestañas', 10, 23200.00, 'Maquillaje', '../model/img/products/Lashlighter Up & Out Máscara de pestañas.jpg'),
(165, 'Lip Glow', 10, 20900.00, 'Maquillaje', '../model/img/products/Lip Glow.webp'),
(166, 'Lip oil', 10, 17900.00, 'Maquillaje', '../model/img/products/Lip oil.webp'),
(167, 'Maquillaje Hidratante Base Líquida Samy', 10, 10780.00, 'Maquillaje', '../model/img/products/Maquillaje Hidratante Base Líquida Samy.webp'),
(168, 'Máscara Curvas Perfectas Lavable', 10, 24200.00, 'Maquillaje', '../model/img/products/Mascara curvas perfectas lavable.webp'),
(169, 'Máscara De Pestañas Samy Iconic Curl', 10, 24000.00, 'Maquillaje', '../model/img/products/Máscara De Pestañas Samy Iconic Curl.webp'),
(170, 'Máscara De Pestañas Samy Iconic Length', 10, 24000.00, 'Maquillaje', '../model/img/products/Máscara De Pestañas Samy Iconic Length.webp'),
(171, 'Máscara De Pestañas Samy Iconic Volume', 10, 24000.00, 'Maquillaje', '../model/img/products/Máscara De Pestañas Samy Iconic Volume.webp'),
(172, 'Máscara de pestañas todo en uno-lavable-color negro', 10, 32900.00, 'Maquillaje', '../model/img/products/Máscara de pestañas todo en uno-lavable-color negro.jpg'),
(173, 'Máscara Pestañas Al Infinitto Negro Intenso', 10, 25000.00, 'Maquillaje', '../model/img/products/Máscara Pestañas Al Infinitto Negro Intenso.webp'),
(174, 'Máscara Pestañas Efecto Total 6', 10, 21600.00, 'Maquillaje', '../model/img/products/Máscara Pestañas Efecto Total 6.webp'),
(175, 'Paleta de bayas', 10, 34800.00, 'Maquillaje', '../model/img/products/Paleta de bayas.jpg'),
(176, 'Paleta De Correctores De Color Y Contornos Medium Dark Samy', 10, 25700.00, 'Maquillaje', '../model/img/products/Paleta De Correctores De Color Y Contornos Medium Dark Samy.webp'),
(177, 'Paleta De Sombras Para Ojos Melu', 10, 38500.00, 'Maquillaje', '../model/img/products/PALETA DE SOMBRAS PARA OJOS MELU.webp'),
(178, 'Paleta de Sombras Radiant Eyes', 10, 42900.00, 'Maquillaje', '../model/img/products/Paleta de Sombras Radiant Eyes.webp'),
(179, 'Paleta Para Contornos Compacta Samy', 10, 30800.00, 'Maquillaje', '../model/img/products/Paleta Para Contornos Compacta Samy.webp'),
(180, 'Paleta Sombras X 30 #Providencia 2 Samy', 10, 89900.00, 'Maquillaje', '../model/img/products/Paleta Sombras X 30 Providencia 2 Samy.webp'),
(181, 'Paleta x 30 sombras Sunset Glam Samy', 10, 89900.00, 'Maquillaje', '../model/img/products/Paleta x 30 sombras Sunset Glam Samy.webp'),
(182, 'Pestañina Duo Magenta', 10, 25500.00, 'Maquillaje', '../model/img/products/Pestañina Duo Magenta.webp'),
(183, 'Pestañina Selfie Melu', 10, 22500.00, 'Maquillaje', '../model/img/products/PESTAÑINA SELFIE MELU.webp'),
(184, 'Polvo Bronceador', 10, 18150.00, 'Maquillaje', '../model/img/products/Polvo Bronceador.webp'),
(185, 'Polvo Compacto Banana Samy', 10, 14350.00, 'Maquillaje', '../model/img/products/Polvo Compacto Banana Samy.webp'),
(186, 'Polvo Compacto Bronceador Iluminador Samy', 10, 30200.00, 'Maquillaje', '../model/img/products/Polvo Compacto Bronceador Iluminador Samy.webp'),
(187, 'Polvo Compacto Bronceador Luminoso Samy', 10, 20500.00, 'Maquillaje', '../model/img/products/Polvo Compacto Bronceador Luminoso Samy.webp'),
(188, 'Polvo Compacto Bronceador Mate Samy', 10, 20500.00, 'Maquillaje', '../model/img/products/Polvo Compacto Bronceador Mate Samy.webp'),
(189, 'Polvo compacto con Filtro Solar Wendy 01', 10, 9900.00, 'Maquillaje', '../model/img/products/Polvo compacto con Filtro Solar Wendy 01.webp'),
(190, 'Polvo Compacto De Arroz', 10, 16950.00, 'Maquillaje', '../model/img/products/Polvo Compacto De Arroz.webp'),
(191, 'Polvo Compacto Essential', 10, 9400.00, 'Maquillaje', '../model/img/products/Polvo Compacto Essential.webp'),
(192, 'Polvo Compacto Matificante Samy', 10, 14280.00, 'Maquillaje', '../model/img/products/Polvo Compacto Matificante Samy.webp'),
(193, 'Polvo Compacto Melu', 10, 15500.00, 'Maquillaje', '../model/img/products/POLVO COMPACTO MELU.webp'),
(194, 'Polvo Compacto Piel Mixta A Grasa Samy', 10, 19460.00, 'Maquillaje', '../model/img/products/Polvo Compacto Piel Mixta A Grasa Samy.webp'),
(195, 'Polvo fijador refrescante Hydro-Touch', 10, 26000.00, 'Maquillaje', '../model/img/products/Polvo fijador refrescante Hydro-Touch.jpg'),
(196, 'Polvo suelto iluminador Samy', 10, 24700.00, 'Maquillaje', '../model/img/products/Polvo suelto iluminador Samy.webp'),
(197, 'Polvo Suelto Melu', 10, 32900.00, 'Maquillaje', '../model/img/products/POLVO SUELTO MELU.webp'),
(198, 'Polvo Suelto Rosado Samy 8 Gr', 10, 23700.00, 'Maquillaje', '../model/img/products/Polvo Suelto Rosado Samy 8 Gr.webp'),
(199, 'Polvo Suelto Translúcido Matte Touch Samy 7 G', 10, 15400.00, 'Maquillaje', '../model/img/products/Polvo Suelto Translucido Matte Touch Samy 7 G.webp'),
(200, 'Polvos fijadores sueltos translúcidos Blur in a Bottle', 10, 23200.00, 'Maquillaje', '../model/img/products/Polvos fijadores sueltos translúcidos Blur in a Bottle.jpg'),
(201, 'Pomada para Cejas Extra Brow Hazel', 10, 20900.00, 'Maquillaje', '../model/img/products/Pomada para Cejas Extra Brow Hazel.webp'),
(202, 'Prebase hidratante Good Grip', 10, 38700.00, 'Maquillaje', '../model/img/products/Prebase hidratante Good Grip.jpg'),
(203, 'Prebase hidratante Good Grip de arándanos y AHA', 10, 38700.00, 'Maquillaje', '../model/img/products/Prebase hidratante Good Grip de arándanos y AHA.jpg'),
(204, 'Primer Facial SKIN PERFECT', 10, 32500.00, 'Maquillaje', '../model/img/products/Primer Facial SKIN PERFECT.webp'),
(205, 'Primer Hidratante 26 Gr', 10, 29900.00, 'Maquillaje', '../model/img/products/Primer Hidratante 26 Gr.webp'),
(206, 'Primer Matificante Samy 30 Gr', 10, 39900.00, 'Maquillaje', '../model/img/products/Primer Matificante Samy 30 Gr.webp'),
(207, 'Puff Paleta para Cejas-Olive', 10, 23200.00, 'Maquillaje', '../model/img/products/Puff Paleta para Cejas-Olive.jpg'),
(208, 'Rubor Compacto Champagne', 10, 8150.00, 'Maquillaje', '../model/img/products/Rubor Compacto Champagne.webp'),
(209, 'Rubor Compacto Creamy Cheeks', 10, 20500.00, 'Maquillaje', '../model/img/products/Rubor Compacto Creamy Cheeks.webp'),
(210, 'Rubor en barra Buttery Bliss-Cherry Pick', 10, 23200.00, 'Maquillaje', '../model/img/products/Rubor en barra Buttery Bliss-Cherry Pick.jpg'),
(211, 'Rubor en Barra Dreamy Cheeks', 10, 23500.00, 'Maquillaje', '../model/img/products/Rubor en Barra Dreamy Cheeks.webp'),
(212, 'Rubor líquido Color Bloom con acabado mate-Risky Business', 10, 23200.00, 'Maquillaje', '../model/img/products/Rubor líquido Color Bloom con acabado mate-Risky Business.jpg'),
(213, 'Sérum para cejas y pestañas Samy', 10, 21100.00, 'Maquillaje', '../model/img/products/Sérum para cejas y pestañas Samy.webp'),
(214, 'SHIMMER BRICK MELU', 10, 29900.00, 'Maquillaje', '../model/img/products/SHIMMER BRICK MELU.webp'),
(215, 'Sombra Individual Mi Crush Color', 10, 11950.00, 'Maquillaje', '../model/img/products/Sombra Individual Color Mi Crush.webp'),
(216, 'Sombra Sexteto Mi Match', 10, 24250.00, 'Maquillaje', '../model/img/products/Sombra Sexteto Mi Match.webp'),
(217, 'Tinta de Cejas Resist', 10, 20000.00, 'Maquillaje', '../model/img/products/Tinta de Cejas Resist.webp'),
(218, 'Tinta En Crema Ruby Rose', 10, 23500.00, 'Maquillaje', '../model/img/products/TINTA EN CREMA RUBY ROSE.webp'),
(219, 'Gel De Limpieza Facial Ruby Skin Colageno', 0, 28900.00, 'Skincare', '../model/img/products/GEL DE LIMPIEZA FACIAL RUBY SKIN COLAGENO.webp'),
(220, 'Crema Hidratante Facial Ruby Skin Colageno', 0, 31900.00, 'Skincare', '../model/img/products/CREMA HIDRATANTE FACIAL RUBY SKIN COLAGENO.webp'),
(221, 'Bruma Facial Hidratante Ruby Skin Colageno', 0, 31900.00, 'Skincare', '../model/img/products/BRUMA FACIAL HIDRATANTE RUBY SKIN COLAGENO.webp'),
(222, 'Agua Micelar Todo en 1', 0, 33200.00, 'Skincare', '../model/img/products/Agua Micelar Todo en 1.webp'),
(223, 'Agua Micelar Pure Active', 0, 21500.00, 'Skincare', '../model/img/products/Agua Micelar Pure Active.jpg'),
(224, 'Agua Micelar Bifásica', 0, 40000.00, 'Skincare', '../model/img/products/Garnier Agua Micelar Bifásica.webp'),
(225, 'Gel Limpiador y Exfoliante de Arcilla 3 en 1', 0, 38600.00, 'Skincare', '../model/img/products/Gel Limpiador y Exfoliante de Arcilla 3 en 1.png'),
(226, 'Serum Anti Manchas con Vitamina C', 0, 39500.00, 'Skincare', '../model/img/products/Serum Anti Manchas con Vitamina C.webp'),
(227, 'Crema Hidratante 3 en 1 200 ml', 0, 19000.00, 'Skincare', '../model/img/products/Crema Hidratante 3 en 1 200 ml.webp'),
(228, 'Crema Hidratante Tono Uniforme con Vitamina C', 0, 51600.00, 'Skincare', '../model/img/products/Crema Hidratante Tono Uniforme con Vitamina C.jpg'),
(229, 'Crema de Ojos Anti-ojeras', 0, 51000.00, 'Skincare', '../model/img/products/Crema de Ojos Anti-ojeras.webp'),
(230, 'Mascarilla en tela Hidra Bomb Té Verde Matificante', 0, 16950.00, 'Skincare', '../model/img/products/Mascarilla en tela Hidra Bomb Té Verde Matificante.webp'),
(231, 'Mascarilla en Tela Hidra Bomb Calmante', 0, 16950.00, 'Skincare', '../model/img/products/Mascarilla en Tela Hidra Bomb Calmante.webp'),
(232, 'Mascarilla en tela Hidra Bomb Granada Revitalizante', 0, 16950.00, 'Skincare', '../model/img/products/Mascarilla en tela Hidra Bomb Granada Revitalizante.png'),
(233, 'Mascarilla en tela Pure Carbon Efecto Detox', 0, 16950.00, 'Skincare', '../model/img/products/Mascarilla en tela Pure Carbon Efecto Detox.webp'),
(234, 'Gel Limpiador Espumoso', 0, 103350.00, 'Skincare', '../model/img/products/Gel Limpiador Espumoso.webp'),
(235, 'Limpiador Hidratante', 0, 72800.00, 'Skincare', '../model/img/products/Limpiador Hidratante.webp'),
(236, 'SA Limpiador Anti Rugosidades', 0, 65900.00, 'Skincare', '../model/img/products/SA Limpiador Anti Rugosidades.webp'),
(237, 'CeraVe Loción Facial Hidratante AM FPS 30', 0, 76500.00, 'Skincare', '../model/img/products/CeraVe Loción Facial Hidratante AM FPS 30.webp'),
(238, 'CeraVe Loción Facial Hidratante PM', 0, 76500.00, 'Skincare', '../model/img/products/CeraVe Loción Facial Hidratante PM.webp'),
(239, 'CeraVe Gel Facial Hidratante con Ácido Hialurónico', 0, 76000.00, 'Skincare', '../model/img/products/CeraVe Gel Facial Hidratante con Ácido Hialurónico.webp'),
(240, 'Limpiador Control Imperfecciones', 0, 88500.00, 'Skincare', '../model/img/products/Limpiador Control Imperfecciones.webp'),
(241, 'Gel Control Imperfecciones', 0, 65100.00, 'Skincare', '../model/img/products/Gel Control Imperfecciones.webp'),
(242, 'Sérum Retinol Anti-Marcas', 0, 86000.00, 'Skincare', '../model/img/products/Sérum Retinol Anti-Marcas.webp'),
(243, 'Kit pure skin Anti acné', 0, 50000.00, 'Skincare', '../model/img/products/Kit pure skin Anti acné.jpg'),
(244, 'Kit facial rose hyaluronic acid', 0, 84000.00, 'Skincare', '../model/img/products/Kit facial rose hyaluronic acid.jpg'),
(245, 'Kit arroz blanco', 0, 84000.00, 'Skincare', '../model/img/products/Kit arroz blanco.jpg'),
(246, 'Kit vc bioaqua', 0, 55000.00, 'Skincare', '../model/img/products/Kit vc bioaqua.jpg'),
(247, 'kit Centella asiática', 0, 84000.00, 'Skincare', '../model/img/products/kit Centella asiática.jpg'),
(248, 'Kit hidratación intensiva', 0, 63000.00, 'Skincare', '../model/img/products/Kit hidratación intensiva.jpg'),
(249, 'Corrector Aanti-arrugas Intensivo Hidratante Y Unificador', 0, 266950.00, 'Skincare', '../model/img/products/CORRECTOR ANTI-ARRUGAS INTENSIVO HIDRATANTE Y UNIFICADOR.webp'),
(250, 'Serum concentrado antiarrugas, reparador y regenerador incluso para pieles sensibles', 0, 239900.00, 'Skincare', '../model/img/products/Serum concentrado antiarrugas, reparador y regenerador incluso para pieles sensibles.webp'),
(251, 'ANTHELIOS UVMUNE 400FLUIDO INVISIBLE FPS50+', 0, 91600.00, 'Skincare', '../model/img/products/ANTHELIOS UVMUNE 400.webp'),
(252, 'ANTHELIOS AGE CORRECT FPS 50', 0, 104000.00, 'Skincare', '../model/img/products/ANTHELIOS AGE CORRECT FPS 50.webp'),
(253, 'DESMAQUILLANTE PURIFICANTE Y LIMPIADOR FACIAL PARA PIELES GRASAS', 0, 142100.00, 'Skincare', '../model/img/products/DESMAQUILLANTE PURIFICANTE Y LIMPIADOR FACIAL PARA PIELES GRASAS.webp'),
(254, 'AGUA MICELAR ULTRA PIEL SENSIBLE', 0, 114100.00, 'Skincare', '../model/img/products/AGUA MICELAR.png'),
(255, 'La Bomba 80ml Eau de Parfum', 0, 599000.00, 'Fragancias', '../model/img/products/La Bomba Carolina Herrera.jpg'),
(256, 'Very Good Girl 80 ml Eau de Parfum', 0, 681000.00, 'Fragancias', '../model/img/products/Very Good Girl 80 ml Eau de Parfum.webp'),
(257, '212 VIP Black 100ml Eau de Parfum', 0, 519000.00, 'Fragancias', '../model/img/products/212 VIP Black 100ml Eau de Parfum.png'),
(258, 'Bad Boy 100ml Eau de Toilette', 0, 551000.00, 'Fragancias', '../model/img/products/Bad Boy 100ml Eau de Toilette.webp'),
(259, 'Le Male Eau de Toilette', 0, 519000.00, 'Fragancias', '../model/img/products/Le Male.jpg'),
(260, 'Le Male Elixir Parfum', 0, 594000.00, 'Fragancias', '../model/img/products/Le Male Elixir.jpg'),
(261, 'Eau de Parfum La Belle', 0, 600000.00, 'Fragancias', '../model/img/products/Gaultier Divine Eau de Parfum.webp'),
(262, 'Gaultier Divine Eau de Parfum', 0, 739000.00, 'Fragancias', '../model/img/products/Gaultier Divine Eau de Parfum.webp'),
(263, 'Cloud Ariana Grande', 0, 339900.00, 'Fragancias', '../model/img/products/Cloud Ariana Grande 100ml.jpg'),
(264, 'Thank U Next Ariana Grande', 0, 350000.00, 'Fragancias', '../model/img/products/Thank U Next Ariana Grande.webp'),
(265, 'Ari Eau De Parfum', 0, 329900.00, 'Fragancias', '../model/img/products/Ari Eau De Parfum.jpg'),
(266, 'Moonlight Ariana Grande', 0, 129900.00, 'Fragancias', '../model/img/products/Moonlight Ariana Grande.jpg'),
(267, 'Lattafa Yara EDP', 0, 179900.00, 'Fragancias', '../model/img/products/lattafa-yara.webp'),
(268, 'Lattafa Yara Candy EDP', 0, 179900.00, 'Fragancias', '../model/img/products/lattafa-yara-candy.webp'),
(270, 'Lattafa Fakhar Rose EDP', 0, 167000.00, 'Fragancias', '../model/img/products/Perfume_Fakhar_Rose_Lattafa_EDP.webp'),
(271, 'Set De Brochas Samy X 12 Und #Providencia', 0, 99900.00, 'Accesorios', '../model/img/products/Set De Brochas Samy X 12 Und Providencia.webp'),
(272, 'Pad Limpiador De Brochas Flower Samy', 0, 12300.00, 'Accesorios', '../model/img/products/Pad Limpiador De Brochas Flower Samy.webp'),
(273, 'Set de brochas x 10 und Rainbow Collection', 0, 90000.00, 'Accesorios', '../model/img/products/Set de brochas x 10 und Rainbow Collection.webp'),
(274, 'Esponja De Maquillaje X1 Und', 0, 12300.00, 'Accesorios', '../model/img/products/Esponja De Maquillaje X1 Und.webp'),
(275, 'Kit Esponjas De Maquillaje X2 Und Samy', 0, 23900.00, 'Accesorios', '../model/img/products/Kit Esponjas De Maquillaje X2 Und Samy.webp'),
(276, 'Encrespador De Pestañas Samy', 0, 12100.00, 'Accesorios', '../model/img/products/Encrespador De Pestañas Samy.webp'),
(277, 'Juego de brochas y estuche Glam 101 Face Essentials', 0, 30900.00, 'Accesorios', '../model/img/products/Juego de brochas y estuche Glam 101 Face Essentials.jpg'),
(278, 'Juego de brochas Glam Fam', 0, 34800.00, 'Accesorios', '../model/img/products/Juego de brochas Glam Fam.jpg'),
(279, 'Borla de polvo lista para usar al instante', 0, 10800.00, 'Accesorios', '../model/img/products/Borla de polvo lista para usar al instante.jpg'),
(280, 'Esponja de belleza universal definitiva', 0, 6900.00, 'Accesorios', '../model/img/products/Esponja de belleza universal definitiva.jpg'),
(281, 'Rizador de pestañas', 0, 9600.00, 'Accesorios', '../model/img/products/Rizador de pestañas.jpg'),
(282, 'Soft Blender Feels - Ruby Rose', 0, 21900.00, 'Accesorios', '../model/img/products/SOFT BLENDER FEELS - RUBY ROSE.webp'),
(283, 'Brochas Ruby Rose', 0, 20900.00, 'Accesorios', '../model/img/products/Brochas Ruby Rose.webp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
