-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-08-2024 a las 12:21:05
-- Versión del servidor: 10.11.8-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u337428268_getresi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicashab`
--

CREATE TABLE `caracteristicashab` (
  `id_caracteristica` int(11) NOT NULL,
  `nombre_carac` varchar(20) NOT NULL,
  `id_cat_habit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicashab`
--

INSERT INTO `caracteristicashab` (`id_caracteristica`, `nombre_carac`, `id_cat_habit`) VALUES
(1, 'No disponible', 1),
(2, 'Privado', 1),
(3, 'Compartido', 1),
(4, 'Comunitario', 1),
(5, 'No disponible', 2),
(6, 'Privado', 2),
(7, 'Compartido', 2),
(8, 'No dispone de cocina', 3),
(9, 'Cocina completa', 3),
(10, 'Ktichenette (sin fue', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicasresi`
--

CREATE TABLE `caracteristicasresi` (
  `id_caracteristica` int(11) NOT NULL,
  `nombre_carac` varchar(100) NOT NULL,
  `id_cat_resi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicasresi`
--

INSERT INTO `caracteristicasresi` (`id_caracteristica`, `nombre_carac`, `id_cat_resi`) VALUES
(1, 'Servicio de limpieza', 1),
(2, 'Lavanderia', 1),
(3, 'Impresora', 1),
(4, 'Servicio de mantenimiento', 1),
(5, 'Servicio de vending', 1),
(6, 'Seguridad 24h', 1),
(7, 'Servicios de sábanas y toallas', 1),
(8, 'Atención 24h', 1),
(9, 'Programa de actividades', 1),
(10, 'Escritorio/Zona de trabajo', 1),
(11, 'Calefaccion', 1),
(12, 'Aire acondicionado', 1),
(13, 'TV en habitacion', 1),
(14, 'WIFI', 1),
(15, 'Parking', 1),
(16, 'Servicio de paqueteria', 1),
(17, 'Cambio de sábanas y toallas', 2),
(18, 'Aire acondicionado', 2),
(19, 'Electricidad', 2),
(20, 'Agua', 2),
(21, 'Pisicina', 3),
(22, 'Gimnasio', 3),
(23, 'Pistas deportivas', 3),
(24, 'Comedor', 3),
(25, 'Zona de estudio', 3),
(26, 'Terraza', 3),
(27, 'Jardín', 3),
(28, 'Lavandería', 3),
(29, 'Ascensor', 3),
(30, 'Cocina común', 3),
(31, 'Utensilios de cocina', 3),
(32, 'Cafeteria', 3),
(33, 'Sala de juegos', 3),
(34, 'Sala de televisión', 3),
(35, 'Sala de cine', 3),
(36, 'Parking de bicicletas', 3),
(37, 'Parking de motos', 3),
(38, 'Parking de coches', 3),
(39, 'Lavadora', 3),
(40, 'Secadora', 3),
(41, 'Amueblado', 3),
(42, 'Balcón', 3),
(43, 'Utensilios de limpieza', 3),
(44, 'Lavaplatos', 3),
(45, 'Horno', 3),
(46, 'Salón comedor', 3),
(47, 'Zona de almacenaje', 3),
(48, 'Pensión completa (7 días)', 4),
(49, 'Media pensión (7 días)', 4),
(50, 'Pensión completa (7 días)', 4),
(51, 'Media pensión (5 días)', 4),
(52, 'Servicio de comedor', 4),
(53, 'Desayuno', 4),
(54, 'Pensión completa', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriashab`
--

CREATE TABLE `categoriashab` (
  `id_cat_habit` int(11) NOT NULL,
  `nombre_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriashab`
--

INSERT INTO `categoriashab` (`id_cat_habit`, `nombre_cat`) VALUES
(1, 'Baño'),
(2, 'Acceso cocina'),
(3, 'Tipo de cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriasresi`
--

CREATE TABLE `categoriasresi` (
  `id_cat_resi` int(11) NOT NULL,
  `nombre_cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriasresi`
--

INSERT INTO `categoriasresi` (`id_cat_resi`, `nombre_cat`) VALUES
(1, 'servicios'),
(2, 'suministros'),
(3, 'instalaciones'),
(4, 'comidas'),
(5, 'preguntas frecuentes'),
(6, 'fotos'),
(7, 'habitaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciu` int(11) NOT NULL,
  `nombre_ciu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciu`, `nombre_ciu`) VALUES
(1, 'a coruña'),
(2, 'alicante'),
(3, 'almeria'),
(4, 'barcelona'),
(5, 'bilbao'),
(6, 'cáceres'),
(7, 'cádiz'),
(8, 'córdoba'),
(9, 'donostia'),
(10, 'elche'),
(11, 'granada'),
(12, 'huesca'),
(13, 'las palmas'),
(14, 'león'),
(15, 'madrid'),
(16, 'málaga'),
(17, 'murcia'),
(18, 'mallorca'),
(19, 'oviedo'),
(20, 'pamplona'),
(21, 'santander'),
(22, 'salamanca'),
(23, 'sevilla'),
(24, 'tarragona'),
(25, 'toledo'),
(26, 'valencia'),
(27, 'valladolid'),
(28, 'vigo'),
(29, 'vitoria'),
(30, 'zaragoza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_hab` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `disponibilidad` tinyint(4) NOT NULL DEFAULT 0,
  `precio` int(11) NOT NULL,
  `id_resi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_hab`, `nombre`, `descripcion`, `capacidad`, `disponibilidad`, `precio`, `id_resi`) VALUES
(1, 'a', 'a', 1, 1, 32, 6),
(2, 'a', 'a', 2, 1, 23, 6),
(3, 'habitacion 1', 'hola', 1, 1, 34, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_con_caracteristicas`
--

CREATE TABLE `habitacion_con_caracteristicas` (
  `id_hab` int(11) NOT NULL,
  `id_caracteristica` int(11) NOT NULL,
  `id_cat_habit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion_con_fotos`
--

CREATE TABLE `habitacion_con_fotos` (
  `id_hab` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `contenido` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_resi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `nombre`) VALUES
(1, 'ROLE_EMPRESA'),
(2, 'ROLE_ESTUDIANTE'),
(3, 'ROLE_RESIDENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `pregunta`) VALUES
(20, 'Normas específicas del alojamiento'),
(27, 'Política de cancelación'),
(19, 'Política de emergencias e incidencias'),
(15, 'Política de invitados'),
(6, '¿Cierra en algún momento del año?'),
(3, '¿Cómo funciona el comedor?'),
(28, '¿Cómo se realizan los pagos?'),
(24, '¿Cuál es el coste de la reserva, matrícula y/o fianza?'),
(21, '¿Cuál es la estancia mínima?'),
(4, '¿Hay servicio de lavandería?¿Cómo funciona?'),
(5, '¿Hay servicio de limpieza?¿Cómo funciona?'),
(9, '¿Hay servicio de paquetería?¿Cómo funciona?'),
(8, '¿Hay servicio de parking?¿Cómo funciona?'),
(10, '¿Horario de alojamiento?'),
(11, '¿Presenta algún tipo de adaptabilidad?'),
(7, '¿Proporciona sábanas y toallas?'),
(17, '¿Puedo personalizar mi habitación?'),
(26, '¿Puedo venir acompañado de amigo, pareja o familia?'),
(2, '¿Qué adaptaciones de menú ofrecen?'),
(18, '¿Qué ocurre si hay un desperfecto o imprevisto en la habitación?'),
(29, '¿Qué pasa si me voy antes de lo previsto'),
(25, '¿Qué pasa si no me aceptan en la universidad?'),
(16, '¿Qué pasa si pierdo la llave de mi habitación?'),
(23, '¿Qué perfiles acepta?'),
(22, '¿Requisitos de admisión?'),
(14, '¿Se admiten instrumentos?'),
(12, '¿Se admiten mascotas?'),
(13, '¿Se puede fumar?'),
(1, '¿Tipos de servicio de comida?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencias`
--

CREATE TABLE `residencias` (
  `id_resi` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `contenido` varchar(500) NOT NULL,
  `nombre_resi` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `coordenadas` point DEFAULT NULL,
  `id_ciu` int(11) NOT NULL,
  `destacada` tinyint(4) DEFAULT 0,
  `estado` enum('ENTREGADO','ACEPTADO','RECHAZADO') DEFAULT NULL,
  `Clave` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `residencias`
--

INSERT INTO `residencias` (`id_resi`, `id_usuario`, `url`, `contenido`, `nombre_resi`, `ubicacion`, `latitud`, `longitud`, `coordenadas`, `id_ciu`, `destacada`, `estado`, `Clave`) VALUES
(2, 1, 'www.manuresi.es', 'La Residencia Manuel Becerra, ubicada en la encantadora ciudad de Murcia, se erige como un símbolo de acogida y comodidad para aquellos que buscan un hogar temporal o permanente en esta vibrante región del sureste español.\r\n\r\nCon una arquitectura que comb', 'Residencia Manuel Becerra', 'Calle Velazquez', 43.34204256239978, -8.402882920465007, NULL, 1, 1, 'ACEPTADO', 0),
(3, 1, 'www.residenciaparaiso.es', 'La Residencia Paraíso, situada en la hermosa región de Murcia, es mucho más que un simple lugar de alojamiento; es un refugio donde la tranquilidad y el confort se combinan para crear una experiencia inolvidable. Rodeada de exuberantes paisajes y bañada p', 'Residencia Paraiso', 'Calle Burgos', 43.32928487020988, -8.401599626188887, NULL, 1, 1, 'ACEPTADO', 0),
(5, 1, 'www.pilgrimresi.es', 'La Residencia Pilgrim, ubicada en la pintoresca región de Murcia, se erige como un refugio acogedor y apacible para aquellos peregrinos y viajeros en busca de descanso y renovación espiritual. Situada en un entorno tranquilo y rodeada de naturaleza, esta ', 'Residencia Pilgrim', '', 43.328754489486364, -8.388151403570674, NULL, 1, 1, 'ACEPTADO', 0),
(6, 6, 'www.avegroup.es', 'El Complejo Residencial Avelina, ubicado en el corazón de la dinámica ciudad de Madrid, se erige como un oasis de modernidad y confort en medio del bullicio urbano. Con su arquitectura vanguardista y su diseño meticuloso, este complejo ofrece un ambiente ', 'Complejo Residencial Avelina ', 'a', 40.47178697708016, -3.688577302535051, NULL, 15, 0, 'ACEPTADO', 0),
(8, 10, 'www.residenciasmatias.es', 'La Residencia Matías, enclavada en la vibrante metrópolis de Madrid, se presenta como un refugio acogedor y hogareño para aquellos que buscan una experiencia de vida cómoda y enriquecedora en la capital española. Con una historia arraigada en la hospitali', 'Residencia Matias', 'g', 40.41269017556057, -3.662136553724875, NULL, 15, 0, 'ACEPTADO', 0),
(9, 11, 'www.residenciaelhuerto.es', 'La Residencia El Huerto, situada en el corazón de Madrid, emerge como un oasis de tranquilidad y confort en medio del bullicio urbano. Con su arquitectura tradicional y su entorno ajardinado, esta residencia ofrece un ambiente sereno y acogedor para aquel', 'Residencia El Huerto', 'h', 40.43426049543956, -3.711249775892679, NULL, 15, 0, 'ACEPTADO', 0),
(10, 15, 'www.residencialopedevega.es', 'La Residencia Lope de Vega, emplazada en el corazón histórico de Madrid, es más que un simple lugar de residencia; es un refugio donde la tradición se fusiona con la modernidad para crear un ambiente único y acogedor. Inspirada por el ilustre poeta del Si', 'Residencia Lope De Vega', 'l', NULL, NULL, NULL, 15, 0, 'ENTREGADO', 0),
(11, 6, NULL, 'Es una residencia muy luminosa', 'Residencia Uno', 'Calle de la Costa del Sol, 15', NULL, NULL, NULL, 15, 0, 'ENTREGADO', 0),
(12, 6, NULL, 'asffs', 'kkk', 'calle Santa eugenia', 36.7398888, -2.6196284, NULL, 15, 0, 'ENTREGADO', 17245572),
(13, 6, NULL, 'ddd', 'ramos\'', 'Calle Londres 21', 40.4316325, -3.6688671, NULL, 15, 0, 'ENTREGADO', 46301419),
(14, 24, NULL, 'a', 'hola', 'calle de la costa del sol, 3', 40.4725591, -3.6528833, NULL, 15, 0, 'RECHAZADO', 90525494),
(15, 25, NULL, 'hola buenas', 'iFP', 'Calle de Julian Camarillo, 6', 40.4338705, -3.6312801, NULL, 15, 0, 'RECHAZADO', 87670594);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencia_con_caracteristicas`
--

CREATE TABLE `residencia_con_caracteristicas` (
  `id_resi` int(11) NOT NULL,
  `id_caracteristica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `residencia_con_caracteristicas`
--

INSERT INTO `residencia_con_caracteristicas` (`id_resi`, `id_caracteristica`) VALUES
(2, 1),
(3, 2),
(5, 1),
(5, 2),
(6, 2),
(6, 3),
(6, 4),
(6, 18),
(6, 19),
(6, 25),
(6, 26),
(6, 27),
(6, 28),
(6, 29),
(6, 30),
(6, 31),
(6, 50),
(14, 10),
(14, 11),
(14, 19),
(14, 20),
(14, 24),
(14, 25),
(14, 26),
(14, 49),
(14, 50),
(15, 6),
(15, 7),
(15, 10),
(15, 11),
(15, 18),
(15, 19),
(15, 24),
(15, 39),
(15, 49),
(15, 50),
(15, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencia_con_fotos`
--

CREATE TABLE `residencia_con_fotos` (
  `id_resi` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `fotos_principales` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `residencia_con_fotos`
--

INSERT INTO `residencia_con_fotos` (`id_resi`, `foto`, `fotos_principales`) VALUES
(14, 'alicante.jpg', 0),
(14, 'almeria.jpg', 0),
(6, 'avelina1.jpg', 0),
(6, 'avelina2.jpg\r\n', 0),
(6, 'avelina3.jpg', 0),
(6, 'avelina4.jpg', 0),
(6, 'avelina5.jpeg\r\n', 0),
(6, 'avelina6.jpg', 0),
(6, 'avelinaPrincipal.jpg\r\n\r\n\r\n', 1),
(14, 'barcelona.jpg', 0),
(14, 'bilbao.jpg', 0),
(14, 'caceres.jpg', 0),
(15, 'COLONIES BRUXELLES RUE.png', 1),
(8, 'huerto1.jpg', 0),
(8, 'huerto2.jpg', 0),
(8, 'huerto3.jpg', 0),
(8, 'huerto4.jpg', 0),
(8, 'huerto5.jpeg', 0),
(8, 'huerto6.jpg', 0),
(8, 'huertoPrincipal.jpg', 1),
(2, 'manu1.jpg', 0),
(2, 'manu2.jpg', 0),
(2, 'manu3.jpg', 0),
(2, 'manu4.jpg', 0),
(2, 'manu5.jpg', 0),
(2, 'manu6.jpg', 0),
(2, 'manuPrincipal.jpg', 1),
(8, 'mati1.jpg', 0),
(8, 'mati2.jpg', 0),
(9, 'mati3.jpg', 0),
(9, 'mati4.jpg', 0),
(9, 'mati5.jpeg', 0),
(9, 'mati6.jpg', 0),
(9, 'matiPrincipal.jpg', 1),
(3, 'para1.jpg', 0),
(3, 'para2.jpg', 0),
(3, 'para3.jpg', 0),
(3, 'para4.jpg', 0),
(3, 'para5.jpg', 0),
(3, 'para6.jpg', 0),
(3, 'paraPrincipal.jpg', 1),
(5, 'pi1.jpg', 0),
(5, 'pi2.jpg', 0),
(5, 'pi3.jpg', 0),
(5, 'pi4.jpg', 0),
(5, 'pi5.jpg', 0),
(5, 'pi6.jpg', 0),
(5, 'piPrincipal.jpg', 1),
(14, 'SalonBlanco.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residencia_con_preguntas`
--

CREATE TABLE `residencia_con_preguntas` (
  `id_resi` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `id_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `residencia_con_preguntas`
--

INSERT INTO `residencia_con_preguntas` (`id_resi`, `respuesta`, `id_pregunta`) VALUES
(2, 'no tiene comida', 1),
(2, 'a', 2),
(2, 'a', 3),
(2, 'a', 4),
(2, 'a', 5),
(2, 'a', 6),
(2, 'a', 7),
(2, 'a', 8),
(2, 'a', 9),
(2, 'a', 10),
(2, 'a', 11),
(2, 'a', 12),
(2, 'a', 13),
(2, 'a', 14),
(2, 'a', 15),
(2, 'a', 16),
(2, 'a', 17),
(2, 'a', 18),
(2, 'a', 19),
(2, 'a', 20),
(3, 'a', 1),
(3, 'a', 2),
(3, 'a', 3),
(3, 'a', 4),
(3, 'a', 5),
(3, 'a', 6),
(3, 'a', 7),
(3, 'a', 8),
(3, 'a', 9),
(3, 'a', 10),
(3, 'a', 11),
(3, 'a', 12),
(3, 'a', 13),
(3, 'a', 14),
(3, 'a', 15),
(3, 'a', 16),
(3, 'a', 17),
(3, 'a', 18),
(3, 'a', 19),
(3, 'a', 20),
(5, 'a', 1),
(5, 'a', 2),
(5, 'a', 3),
(5, 'a', 4),
(5, 'a', 5),
(5, 'a', 6),
(5, 'a', 7),
(5, 'a', 8),
(5, 'a', 9),
(5, 'a', 10),
(5, 'a', 11),
(5, 'a', 12),
(5, 'a', 13),
(5, 'a', 14),
(5, 'a', 15),
(5, 'a', 16),
(5, 'a', 17),
(5, 'a', 18),
(5, 'a', 19),
(5, 'a', 20),
(6, 'asd', 1),
(6, 'asd', 2),
(6, 'asd', 3),
(6, 'asd', 4),
(6, 'asd', 5),
(6, 'asd', 6),
(6, 'asd', 7),
(6, 'asd', 8),
(6, 'asd', 9),
(6, 'asd', 10),
(6, 'asd', 11),
(6, 'asd', 12),
(6, 'asd', 13),
(6, 'asd', 14),
(6, 'asd', 15),
(6, 'asd', 16),
(6, 'asd', 17),
(6, 'asd', 18),
(6, 'asd', 19),
(6, 'asd', 20),
(6, 'sad', 21),
(6, 'asd', 22),
(6, 'asd', 23),
(6, 'asd', 24),
(6, 'asd', 25),
(6, 'asd', 26),
(6, 'asd', 27),
(6, 'asd', 28),
(6, 'asd', 29),
(8, 'a', 1),
(8, 'a', 2),
(8, 'a', 3),
(8, 'a', 4),
(8, 'a', 5),
(8, 'a', 6),
(8, 'a', 7),
(8, 'a', 8),
(8, 'a', 9),
(8, 'a', 10),
(8, 'a', 11),
(8, 'a', 12),
(8, 'a', 13),
(8, 'a', 14),
(8, 'a', 15),
(8, 'a', 16),
(8, 'a', 17),
(8, 'a', 18),
(8, 'a', 19),
(8, 'a', 20),
(9, 'a', 1),
(9, 'a', 2),
(9, 'a', 3),
(9, 'a', 4),
(9, 'a', 5),
(9, 'a', 6),
(9, 'a', 7),
(9, 'a', 8),
(9, 'a', 9),
(9, 'a', 10),
(9, 'a', 11),
(9, 'a', 12),
(9, 'a', 13),
(9, 'a', 14),
(9, 'a', 15),
(9, 'a', 16),
(9, 'a', 17),
(9, 'a', 18),
(9, 'a', 19),
(9, 'a', 20),
(14, 'no tiene comida', 1),
(14, 'a', 2),
(14, 'a', 3),
(14, 'a', 4),
(14, 'a', 5),
(14, 'a', 6),
(14, 'a', 7),
(14, 'a', 8),
(14, 'a', 9),
(14, 'a', 10),
(14, 'a', 11),
(14, 'a', 12),
(14, 'a', 13),
(14, 'a', 14),
(14, 'a', 15),
(14, 'a', 16),
(14, 'a', 17),
(14, 'a', 18),
(14, 'a', 19),
(14, 'sss', 20),
(14, 'sad', 21),
(14, 'asd', 22),
(14, 'asd', 23),
(14, 'asd', 24),
(14, 'asd', 25),
(14, 'asd', 26),
(14, 'asd', 27),
(14, 'asd', 28),
(14, 'asd', 29),
(15, 'no tiene comida', 1),
(15, 'a', 2),
(15, 'a', 3),
(15, 'a', 4),
(15, 'a', 5),
(15, 'a', 6),
(15, 'a', 7),
(15, 'a', 8),
(15, 'a', 9),
(15, 'a', 10),
(15, 'a', 11),
(15, 'a', 12),
(15, 'a', 13),
(15, 'a', 14),
(15, 'a', 15),
(15, 'a', 16),
(15, 'a', 17),
(15, 'a', 18),
(15, 'a', 19),
(15, 'si', 20),
(15, 'sad', 21),
(15, 'asd', 22),
(15, 'asd', 23),
(15, 'asd', 24),
(15, 'asd', 25),
(15, 'asd', 26),
(15, 'asd', 27),
(15, 'asd', 28),
(15, 'asd', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_hab` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_beneficio`
--

CREATE TABLE `tipo_beneficio` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_beneficio`
--

INSERT INTO `tipo_beneficio` (`id`, `nombre`) VALUES
(1, 'Snowboard'),
(2, 'Goiko'),
(3, 'RBF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `matriculado` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo`, `contraseña`, `nombre`, `apellidos`, `telefono`, `id_perfil`, `matriculado`) VALUES
(1, 'a@a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', '1', 2, 1),
(5, 'f@f', '8fa14cdd754f91cc6554c9e71929cce7', 'f', 'f', '123', 2, 1),
(6, 'e@e', 'e1671797c52e15f763380b45e841ec32', 'e', 'e', '123123', 3, 0),
(8, 'g@g', 'b2f5ff47436671b6e533d8dc3614845d', 'g', 'g', '213132', 1, 0),
(10, 'v@v', '9e3669d19b675bd57058fd4664205d2a', 'v', 'v', '67', 3, 0),
(11, 'h@h', '2510c39011c5be704182423e3a695e91', 'h', 'h', '3', 3, 0),
(15, 'o@o', 'd95679752134a2d9eb61dbd7b91c4bcc', 'o', 'o', '123', 3, 0),
(16, 'b@b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b', '123', 1, 0),
(17, 'mario.viviani@gamingresidences.com', '3f1b7ccad63d40a7b4c27dda225bf941', 'Mario', 'Viviani', '639004695', 2, 0),
(18, 'ramos@ramos.es', '81dc9bdb52d04dc20036dbd8313ed055', 'sergio', 'ramos', '691653325', 2, 0),
(19, 'si@si.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Álvaro', 'Hola hola', '646309324', 2, 0),
(22, 'mario.viviani@getresi.es', '3a28ce9b86409d6d2267fa48c8ae3688', 'Mario', 'Viviani', '639004695', 3, 0),
(23, 'nikita@gmail.com', '202cb962ac59075b964b07152d234b70', 'Alberto', 'Oliva', '234323332343', 3, 0),
(24, 'ases@gmail.com', '202cb962ac59075b964b07152d234b70', 'yo', 'apellidos', '34567765432', 3, 0),
(25, 'tomas@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 'tomas', 'escudero', '64784468', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_beneficios`
--

CREATE TABLE `usuarios_beneficios` (
  `id_usuario` int(20) NOT NULL,
  `id_beneficio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicashab`
--
ALTER TABLE `caracteristicashab`
  ADD PRIMARY KEY (`id_caracteristica`),
  ADD KEY `id_cat_habit` (`id_cat_habit`);

--
-- Indices de la tabla `caracteristicasresi`
--
ALTER TABLE `caracteristicasresi`
  ADD PRIMARY KEY (`id_caracteristica`),
  ADD KEY `id_cat_resi` (`id_cat_resi`);

--
-- Indices de la tabla `categoriashab`
--
ALTER TABLE `categoriashab`
  ADD PRIMARY KEY (`id_cat_habit`);

--
-- Indices de la tabla `categoriasresi`
--
ALTER TABLE `categoriasresi`
  ADD PRIMARY KEY (`id_cat_resi`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciu`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_hab`),
  ADD KEY `id_resi` (`id_resi`);

--
-- Indices de la tabla `habitacion_con_caracteristicas`
--
ALTER TABLE `habitacion_con_caracteristicas`
  ADD PRIMARY KEY (`id_hab`,`id_caracteristica`),
  ADD KEY `id_caracteristica` (`id_caracteristica`);

--
-- Indices de la tabla `habitacion_con_fotos`
--
ALTER TABLE `habitacion_con_fotos`
  ADD PRIMARY KEY (`foto`),
  ADD KEY `id_hab` (`id_hab`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_resi` (`id_resi`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD UNIQUE KEY `pregunta` (`pregunta`);

--
-- Indices de la tabla `residencias`
--
ALTER TABLE `residencias`
  ADD PRIMARY KEY (`id_resi`),
  ADD UNIQUE KEY `nombre_resi` (`nombre_resi`),
  ADD UNIQUE KEY `ubicacion` (`ubicacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_ciu` (`id_ciu`);

--
-- Indices de la tabla `residencia_con_caracteristicas`
--
ALTER TABLE `residencia_con_caracteristicas`
  ADD PRIMARY KEY (`id_resi`,`id_caracteristica`),
  ADD KEY `id_caracteristica` (`id_caracteristica`);

--
-- Indices de la tabla `residencia_con_fotos`
--
ALTER TABLE `residencia_con_fotos`
  ADD PRIMARY KEY (`foto`),
  ADD KEY `id_resi` (`id_resi`);

--
-- Indices de la tabla `residencia_con_preguntas`
--
ALTER TABLE `residencia_con_preguntas`
  ADD PRIMARY KEY (`id_resi`,`id_pregunta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_hab` (`id_hab`);

--
-- Indices de la tabla `tipo_beneficio`
--
ALTER TABLE `tipo_beneficio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- Indices de la tabla `usuarios_beneficios`
--
ALTER TABLE `usuarios_beneficios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_beneficio` (`id_beneficio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicashab`
--
ALTER TABLE `caracteristicashab`
  MODIFY `id_caracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `caracteristicasresi`
--
ALTER TABLE `caracteristicasresi`
  MODIFY `id_caracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `categoriashab`
--
ALTER TABLE `categoriashab`
  MODIFY `id_cat_habit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoriasresi`
--
ALTER TABLE `categoriasresi`
  MODIFY `id_cat_resi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_hab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `residencias`
--
ALTER TABLE `residencias`
  MODIFY `id_resi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_beneficio`
--
ALTER TABLE `tipo_beneficio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracteristicashab`
--
ALTER TABLE `caracteristicashab`
  ADD CONSTRAINT `caracteristicashab_ibfk_1` FOREIGN KEY (`id_cat_habit`) REFERENCES `categoriashab` (`id_cat_habit`);

--
-- Filtros para la tabla `caracteristicasresi`
--
ALTER TABLE `caracteristicasresi`
  ADD CONSTRAINT `caracteristicasresi_ibfk_1` FOREIGN KEY (`id_cat_resi`) REFERENCES `categoriasresi` (`id_cat_resi`);

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`id_resi`) REFERENCES `residencias` (`id_resi`);

--
-- Filtros para la tabla `habitacion_con_caracteristicas`
--
ALTER TABLE `habitacion_con_caracteristicas`
  ADD CONSTRAINT `habitacion_con_caracteristicas_ibfk_1` FOREIGN KEY (`id_hab`) REFERENCES `habitaciones` (`id_hab`),
  ADD CONSTRAINT `habitacion_con_caracteristicas_ibfk_2` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicashab` (`id_caracteristica`);

--
-- Filtros para la tabla `habitacion_con_fotos`
--
ALTER TABLE `habitacion_con_fotos`
  ADD CONSTRAINT `habitacion_con_fotos_ibfk_1` FOREIGN KEY (`id_hab`) REFERENCES `habitaciones` (`id_hab`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_resi`) REFERENCES `residencias` (`id_resi`);

--
-- Filtros para la tabla `residencias`
--
ALTER TABLE `residencias`
  ADD CONSTRAINT `residencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `residencias_ibfk_2` FOREIGN KEY (`id_ciu`) REFERENCES `ciudades` (`id_ciu`);

--
-- Filtros para la tabla `residencia_con_caracteristicas`
--
ALTER TABLE `residencia_con_caracteristicas`
  ADD CONSTRAINT `residencia_con_caracteristicas_ibfk_1` FOREIGN KEY (`id_resi`) REFERENCES `residencias` (`id_resi`),
  ADD CONSTRAINT `residencia_con_caracteristicas_ibfk_2` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristicasresi` (`id_caracteristica`);

--
-- Filtros para la tabla `residencia_con_fotos`
--
ALTER TABLE `residencia_con_fotos`
  ADD CONSTRAINT `residencia_con_fotos_ibfk_1` FOREIGN KEY (`id_resi`) REFERENCES `residencias` (`id_resi`);

--
-- Filtros para la tabla `residencia_con_preguntas`
--
ALTER TABLE `residencia_con_preguntas`
  ADD CONSTRAINT `residencia_con_preguntas_ibfk_1` FOREIGN KEY (`id_resi`) REFERENCES `residencias` (`id_resi`),
  ADD CONSTRAINT `residencia_con_preguntas_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id_pregunta`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `solicitudes_ibfk_2` FOREIGN KEY (`id_hab`) REFERENCES `habitaciones` (`id_hab`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
