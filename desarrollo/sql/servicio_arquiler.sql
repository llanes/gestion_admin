-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2016 a las 15:35:56
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `servicio_arquiler`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `idCaja` int(11) NOT NULL AUTO_INCREMENT,
  `Monto_inicial` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Monto_final` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Fecha_apertura` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Hora_apertura` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `Fecha_cierre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Hora_cierre` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `Apertura` int(11) DEFAULT NULL,
  `Cierre` int(2) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idCaja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `Monto_inicial`, `Monto_final`, `Fecha_apertura`, `Hora_apertura`, `Fecha_cierre`, `Hora_cierre`, `Apertura`, `Cierre`, `Usuario_idUsuario`) VALUES
(1, '0', '', '2016-03-27', '10:44', '', '', 1, 0, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_cobros`
--

CREATE TABLE IF NOT EXISTS `caja_cobros` (
  `idCaja_Cobros` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Monto` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Tipos_Cobros` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Credito_idCredito` int(11) NOT NULL,
  `Caja_idCaja` int(11) NOT NULL,
  PRIMARY KEY (`idCaja_Cobros`),
  KEY `fk_Caja_Cobros_Credito1_idx` (`Credito_idCredito`),
  KEY `fk_Caja_Cobros_Caja1_idx` (`Caja_idCaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_pagos`
--

CREATE TABLE IF NOT EXISTS `caja_pagos` (
  `idCaja_Pagos` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Monto` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Tipos_Pagos` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Caja_idCaja` int(11) NOT NULL,
  `Empleado_idEmpleado` int(11) NOT NULL,
  PRIMARY KEY (`idCaja_Pagos`),
  KEY `fk_Caja_Pagos_Caja1_idx` (`Caja_idCaja`),
  KEY `fk_Caja_Pagos_Empleado1_idx` (`Empleado_idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Descrip` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Categoria`, `Descrip`) VALUES
(1, 'Yellow', 'Profit-focused tangible emulation'),
(2, 'BurlyWood', 'Optimized empowering GraphicalUserInterface'),
(3, 'NavajoWhite', 'Stand-alone asynchronous benchmark'),
(4, 'Beige', 'Intuitive local architecture'),
(5, 'MediumAquaMarine', 'Enterprise-wide value-added throughput'),
(6, 'Azure', 'Optional transitional monitoring'),
(7, 'Green', 'Profit-focused directional success'),
(8, 'NavajoWhite', 'Sharable local moderator'),
(9, 'PaleVioletRed', 'Organized high-level analyzer'),
(10, 'AliceBlue', 'Distributed global GraphicInterface');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Apellidos` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Direccion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ci_ruc` int(15) NOT NULL,
  `Telefono` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Email` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Geo_posicion_idGeo_posicion` int(11) NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `fk_Cliente_Geo_posicion1_idx` (`Geo_posicion_idGeo_posicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `Nombres`, `Apellidos`, `Direccion`, `ci_ruc`, `Telefono`, `Email`, `Geo_posicion_idGeo_posicion`) VALUES
(1, 'Fernando', 'Murillo', 'Carrer Reyes, 20, Entre suelo 6º', 2112, '464179', 'palomino.laia@latinmail.com', 2),
(2, 'Alejandra', 'Ordóñez', 'Travessera Aitor, 851, 9º C', 18228, '17998333', 'iria.luna@latinmail.com', 9),
(3, 'Aroa', 'Concepción', 'Calle Ivan, 14, 65º F', 4518, '11344131', 'noelia.centeno@hotmail.com', 6),
(4, 'Manuel', 'Guevara', 'Avinguda Paula, 0, Bajos', 4394, '2907375', 'andres78@yahoo.com', 7),
(5, 'Lara', 'Pons', 'Travesia Godoy, 0, 3º E', 19695, '15452949', 'miriam.villalba@leon.com', 8),
(6, 'Yago', 'Pardo', 'Travesia Adria, 21, Bajo 8º', 11903, '16592908', 'haro.ivan@abreu.es', 5),
(7, 'Izan', 'Castellano', 'Avenida Salas, 3, 16º D', 11647, '5659992', 'paola.domenech@arredondo.net', 6),
(8, 'Adriana', 'Leyva', 'Rúa Rivero, 060, 14º 2º', 5044, '18814207', 'marrero.bruno@perales.es', 0),
(9, 'Francisco', 'Huerta', 'Ronda Pantoja, 000, 44º E', 13644, '10107362', 'gerard.granados@hispavista.com', 6),
(10, 'Julia', 'Salcedo', 'Carrer Eduardo, 45, 59º D', 2863, '15051276', 'jana.caballero@roca.es', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros_extras`
--

CREATE TABLE IF NOT EXISTS `cobros_extras` (
  `idCobros_Extras` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_Cobros` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Dias_Demora` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  `Presupuesto_Arquiler_idArquiler` int(11) NOT NULL,
  PRIMARY KEY (`idCobros_Extras`),
  KEY `fk_Cobros_Extras_Cliente1_idx` (`Cliente_idCliente`),
  KEY `fk_Cobros_Extras_Presupuesto_Arquiler1_idx` (`Presupuesto_Arquiler_idArquiler`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE IF NOT EXISTS `credito` (
  `idCredito` int(11) NOT NULL AUTO_INCREMENT,
  `Num_Recibo` int(11) NOT NULL,
  `Importe` int(11) DEFAULT NULL,
  `Fecha_Ven` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Fecha_Pago` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Estado_Pago` int(11) DEFAULT NULL,
  `Num_cuota` int(11) DEFAULT NULL,
  `Presupuesto_Arquiler_idArquiler` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  PRIMARY KEY (`idCredito`),
  KEY `fk_Credito_Presupuesto_Arquiler1_idx` (`Presupuesto_Arquiler_idArquiler`),
  KEY `fk_Credito_Cliente1_idx` (`Cliente_idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_arquiler`
--

CREATE TABLE IF NOT EXISTS `detalle_arquiler` (
  `idDetalle_Arquiler` int(11) NOT NULL AUTO_INCREMENT,
  `Cantidad` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Iva` int(11) DEFAULT NULL,
  `Presupuesto_Arquiler_idArquiler` int(11) NOT NULL,
  `Producto_Servicio_idProducto_Servicio` int(11) NOT NULL,
  PRIMARY KEY (`idDetalle_Arquiler`,`Presupuesto_Arquiler_idArquiler`),
  KEY `fk_Detalle_Arquiler_Presupuesto_Arquiler1_idx` (`Presupuesto_Arquiler_idArquiler`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `detalle_arquiler`
--

INSERT INTO `detalle_arquiler` (`idDetalle_Arquiler`, `Cantidad`, `Descripcion`, `Precio`, `Iva`, `Presupuesto_Arquiler_idArquiler`, `Producto_Servicio_idProducto_Servicio`) VALUES
(1, '69', '', 1903, 10, 1, 1),
(2, '90', '', 1017, 10, 1, 2),
(3, '74', '', 1195, 10, 1, 3),
(4, '24', '', 1238, 10, 1, 4),
(5, '42', '', 1956, 10, 1, 5),
(6, '86', '', 1515, 10, 1, 6),
(7, '14', '', 1162, 10, 1, 7),
(8, '79', '', 1397, 10, 1, 8),
(9, '43', '', 1561, 10, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio`
--

CREATE TABLE IF NOT EXISTS `detalle_servicio` (
  `idDetalle_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `Costo` int(11) DEFAULT NULL,
  `Cantidad_detalle` int(11) DEFAULT NULL,
  `Producto_Servicio_idProducto_Servicio` int(11) NOT NULL,
  `Servicio_idServicio` int(11) NOT NULL,
  PRIMARY KEY (`idDetalle_servicio`,`Producto_Servicio_idProducto_Servicio`,`Servicio_idServicio`),
  KEY `fk_Detalle_servicio_Producto_Servicio_idx` (`Producto_Servicio_idProducto_Servicio`),
  KEY `fk_Detalle_servicio_Servicio1_idx` (`Servicio_idServicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=187 ;

--
-- Volcado de datos para la tabla `detalle_servicio`
--

INSERT INTO `detalle_servicio` (`idDetalle_servicio`, `Costo`, `Cantidad_detalle`, `Producto_Servicio_idProducto_Servicio`, `Servicio_idServicio`) VALUES
(2, 1428, 27, 1, 1),
(3, 1144, 20, 2, 1),
(4, 1818, 85, 3, 1),
(5, 1730, 99, 4, 1),
(6, 1679, 36, 5, 1),
(7, 1012, 69, 6, 1),
(8, 1768, 34, 7, 1),
(9, 1955, 21, 8, 1),
(10, 1129, 57, 9, 1),
(12, 1761, 24, 1, 2),
(13, 1240, 52, 2, 2),
(14, 1351, 68, 3, 2),
(15, 1012, 87, 4, 2),
(16, 1328, 12, 5, 2),
(17, 1449, 85, 6, 2),
(18, 1115, 91, 7, 2),
(19, 1463, 58, 8, 2),
(20, 1249, 14, 9, 2),
(22, 1338, 92, 1, 3),
(23, 1283, 23, 2, 3),
(24, 1143, 52, 3, 3),
(25, 1801, 62, 4, 3),
(26, 1537, 30, 5, 3),
(27, 1713, 17, 6, 3),
(28, 1453, 56, 7, 3),
(29, 1501, 62, 8, 3),
(30, 1358, 71, 9, 3),
(42, 1903, 69, 1, 5),
(43, 1017, 90, 2, 5),
(44, 1195, 74, 3, 5),
(45, 1238, 24, 4, 5),
(46, 1956, 42, 5, 5),
(47, 1515, 86, 6, 5),
(48, 1162, 14, 7, 5),
(49, 1397, 79, 8, 5),
(50, 1561, 43, 9, 5),
(62, 1837, 89, 1, 7),
(63, 1279, 97, 2, 7),
(64, 1069, 72, 3, 7),
(65, 1195, 46, 4, 7),
(66, 1533, 98, 5, 7),
(67, 1413, 81, 6, 7),
(68, 1781, 87, 7, 7),
(69, 1349, 25, 8, 7),
(70, 1693, 84, 9, 7),
(72, 1805, 87, 1, 8),
(73, 1432, 57, 2, 8),
(74, 1811, 50, 3, 8),
(75, 1105, 14, 4, 8),
(76, 1623, 34, 5, 8),
(77, 1851, 28, 6, 8),
(78, 1911, 67, 7, 8),
(79, 1639, 90, 8, 8),
(80, 1966, 74, 9, 8),
(82, 1087, 43, 1, 9),
(83, 1271, 18, 2, 9),
(84, 1458, 76, 3, 9),
(85, 1240, 74, 4, 9),
(86, 1303, 84, 5, 9),
(87, 1458, 80, 6, 9),
(88, 1202, 19, 7, 9),
(89, 1754, 62, 8, 9),
(90, 1221, 10, 9, 9),
(92, 1504, 86, 1, 10),
(93, 1387, 79, 2, 10),
(94, 1552, 29, 3, 10),
(95, 1258, 10, 4, 10),
(96, 1887, 25, 5, 10),
(97, 1440, 40, 6, 10),
(98, 1359, 68, 7, 10),
(99, 1688, 68, 8, 10),
(100, 1084, 77, 9, 10),
(102, 1057, 83, 1, 11),
(103, 1260, 59, 2, 11),
(104, 1374, 86, 3, 11),
(105, 1554, 49, 4, 11),
(106, 1066, 78, 5, 11),
(107, 1288, 81, 6, 11),
(108, 1403, 31, 7, 11),
(109, 1107, 49, 8, 11),
(110, 1713, 45, 9, 11),
(122, 1564, 86, 1, 13),
(123, 1665, 24, 2, 13),
(124, 1916, 48, 3, 13),
(125, 1605, 95, 4, 13),
(126, 1658, 24, 5, 13),
(127, 1956, 36, 6, 13),
(128, 1415, 93, 7, 13),
(129, 1829, 24, 8, 13),
(130, 1171, 78, 9, 13),
(142, 1265, 59, 1, 15),
(143, 1315, 87, 2, 15),
(144, 1672, 36, 3, 15),
(145, 1097, 18, 4, 15),
(146, 1365, 47, 5, 15),
(147, 1060, 40, 6, 15),
(148, 1082, 62, 7, 15),
(149, 1070, 100, 8, 15),
(150, 1738, 18, 9, 15),
(151, 1771, 1, 1, 14),
(152, 1169, 2, 2, 14),
(153, 1021, 3, 3, 14),
(154, 1776, 4, 4, 14),
(155, 1281, 5, 5, 14),
(156, 1335, 6, 6, 14),
(157, 1718, 7, 7, 14),
(158, 1352, 8, 8, 14),
(159, 1215, 9, 9, 14),
(160, 1769, 1, 1, 6),
(161, 1821, 2, 2, 6),
(162, 1988, 3, 3, 6),
(163, 1435, 4, 4, 6),
(164, 1488, 5, 5, 6),
(165, 1663, 6, 6, 6),
(166, 1663, 7, 7, 6),
(167, 1179, 8, 8, 6),
(168, 1497, 9, 9, 6),
(169, 1404, 1, 1, 12),
(170, 1380, 2, 2, 12),
(171, 1029, 3, 3, 12),
(172, 1449, 4, 4, 12),
(173, 1062, 5, 5, 12),
(174, 1259, 6, 6, 12),
(175, 1385, 7, 7, 12),
(176, 1812, 8, 8, 12),
(177, 1474, 9, 9, 12),
(178, 1254, 1, 1, 4),
(179, 1175, 2, 2, 4),
(180, 1466, 3, 3, 4),
(181, 1788, 4, 4, 4),
(182, 1789, 5, 5, 4),
(183, 1731, 6, 6, 4),
(184, 1628, 7, 7, 4),
(185, 1479, 8, 8, 4),
(186, 1717, 9, 9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `idEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Apellidos` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Direccion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Telefono` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Sueldo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Cargo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Geo_posicion_idGeo_posicion` int(11) NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  KEY `fk_Empleado_Geo_posicion1_idx` (`Geo_posicion_idGeo_posicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `Nombres`, `Apellidos`, `Direccion`, `Telefono`, `Sueldo`, `Cargo`, `Geo_posicion_idGeo_posicion`) VALUES
(1, 'Sergio', 'Viera', 'Ronda Alma, 6, 81º D', '+34 659 240642', '56.368012', 'Hector', 1),
(2, 'Mohamed', 'Serra', 'Plaza Diego, 766, 2º C', '695 03 1640', '-14.557215', 'Raul', 1),
(3, 'Juan', 'Villar', 'Avinguda Garrido, 5, 7º B', '921-19-6750', '-15.735994', 'Saul', 7),
(4, 'Mohamed', 'Téllez', 'Plaza Nil, 36, 11º B', '687-681379', '80.43888', 'Celia', 4),
(5, 'Pau', 'Sisneros', 'Praza Pérez, 509, 3º C', '+34 692-617294', '30.168041', 'Alejandra', 3),
(6, 'Alex', 'Olmos', 'Avenida Delagarza, 716, 2º D', '+34 978 47 4019', '-23.670028', 'Guillem', 8),
(7, 'Pablo', 'De la torre', 'Avenida Lucia, 00, 3º E', '+34 622 615979', '-47.874671', 'Lola', 5),
(8, 'Miguel Angel', 'Orozco', 'Avenida Nadia, 1, 1º F', '+34 684-85-2825', '86.696339', 'Alberto', 7),
(9, 'Sara', 'Serrato', 'Praza González, 4, 90º E', '+34 974 36 7538', '79.310198', 'Daniela', 2),
(10, 'Gabriela', 'Arias', 'Plaça Ruelas, 0, 45º 3º', '638 204053', '-33.735934', 'Alonso', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Descripcion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Direccion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Telefono` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Email` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `R_U_D` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Timbrado` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Series` varchar(11) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Geo_posicion_idGeo_posicion` int(11) NOT NULL,
  PRIMARY KEY (`idEmpresa`),
  KEY `fk_Empresa_Geo_posicion1_idx` (`Geo_posicion_idGeo_posicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `Nombre`, `Descripcion`, `Direccion`, `Telefono`, `Email`, `R_U_D`, `Timbrado`, `Series`, `Geo_posicion_idGeo_posicion`) VALUES
(4, 'Servicios Karen', 'Servicio de eventos', 'Capitan Miranda', '979789789789', 'Servicios@gmail.com', '506443757-5', '79789789789', '1000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `geo_posicion`
--

CREATE TABLE IF NOT EXISTS `geo_posicion` (
  `idGeo_posicion` int(11) NOT NULL AUTO_INCREMENT,
  `Latitud` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Longitud` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idGeo_posicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `geo_posicion`
--

INSERT INTO `geo_posicion` (`idGeo_posicion`, `Latitud`, `Longitud`) VALUES
(1, '5757575575', '5555575757'),
(36, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Oservacion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idPermiso`, `Descripcion`, `Oservacion`) VALUES
(1, 'admin', 'administrador sistema'),
(2, 'cliente', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_arquiler`
--

CREATE TABLE IF NOT EXISTS `presupuesto_arquiler` (
  `idArquiler` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_expedicion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Fecha_Pre_Arqui` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Monto_Alquiler_Presupuesto` int(11) DEFAULT NULL,
  `Arquiler_Presupuesto` int(11) DEFAULT NULL,
  `Contado_Credito` int(11) DEFAULT NULL,
  `Num_arquiler` int(11) DEFAULT NULL,
  `Fecha_Devolucion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Monto_total_iva` int(11) DEFAULT NULL,
  `Nombre_servicio` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Direccion_evento` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  `Entrega` int(11) NOT NULL,
  `Devolucion` int(11) NOT NULL,
  `Caja_idCaja` int(11) NOT NULL,
  `Geo_posicion_idGeo_posicion` int(11) DEFAULT NULL,
  PRIMARY KEY (`idArquiler`),
  KEY `fk_Presupuesto_Arquiler_Usuario1_idx` (`Usuario_idUsuario`),
  KEY `fk_Presupuesto_Arquiler_Cliente1_idx` (`Cliente_idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `presupuesto_arquiler`
--

INSERT INTO `presupuesto_arquiler` (`idArquiler`, `fecha_expedicion`, `Fecha_Pre_Arqui`, `Monto_Alquiler_Presupuesto`, `Arquiler_Presupuesto`, `Contado_Credito`, `Num_arquiler`, `Fecha_Devolucion`, `Monto_total_iva`, `Nombre_servicio`, `Direccion_evento`, `Usuario_idUsuario`, `Cliente_idCliente`, `Entrega`, `Devolucion`, `Caja_idCaja`, `Geo_posicion_idGeo_posicion`) VALUES
(1, '2016-03-27', '27-03-2016  15:34', 747175, 2, 0, 1, '27-03-2016  15:34', 68, 'LightGray', '', 0, 9, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_servicio`
--

CREATE TABLE IF NOT EXISTS `producto_servicio` (
  `idProducto_Servicio` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` int(11) DEFAULT NULL,
  `Nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Codigo_Barra` int(11) DEFAULT NULL,
  `Descripcion` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Precio_Unitario` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Descuento` int(11) DEFAULT NULL,
  `Iva` int(11) DEFAULT NULL,
  `Img` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Categoria_idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idProducto_Servicio`),
  KEY `fk_Producto_Servicio_Categoria1_idx` (`Categoria_idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `producto_servicio`
--

INSERT INTO `producto_servicio` (`idProducto_Servicio`, `Codigo`, `Nombre`, `Codigo_Barra`, `Descripcion`, `Precio_Unitario`, `Cantidad`, `Descuento`, `Iva`, `Img`, `Categoria_idCategoria`) VALUES
(1, 42797, 'Os Delapaz', 2147483647, 'Streamlined zeroadministration frame', '1172', 1, 81316618, 10, 'http://lorempixel.com/640/480/?36564', 1),
(2, 89753, 'Gaona de Arriba', 2147483647, 'Diverse well-modulated archive', '1846', 2, 78096848, 10, 'http://lorempixel.com/640/480/?51189', 2),
(3, 89569, 'Los Torres de San Pedro', 2147483647, 'Virtual explicit extranet', '1471', 3, 89287093, 10, 'http://lorempixel.com/640/480/?45239', 3),
(4, 72338, 'As Carrero del Vallès', 2147483647, 'User-centric client-driven software', '1775', 4, 58900288, 10, 'http://lorempixel.com/640/480/?31282', 4),
(5, 76117, 'As Orta', 2147483647, 'Integrated high-level firmware', '1435', 5, 53799386, 10, 'http://lorempixel.com/640/480/?17074', 5),
(6, 15368, 'Villa Soler', 2147483647, 'Sharable zerodefect encoding', '1135', 6, 65632729, 10, 'http://lorempixel.com/640/480/?66249', 6),
(7, 35178, 'Las Izquierdo del Pozo', 2147483647, 'Front-line value-added encoding', '1798', 7, 36346831, 10, 'http://lorempixel.com/640/480/?23405', 7),
(8, 31353, 'Las Olivo', 2147483647, 'Integrated national knowledgeuser', '1870', 8, 43827617, 10, 'http://lorempixel.com/640/480/?23631', 8),
(9, 24539, 'Márquez de Ulla', 2147483647, 'Digitized foreground GraphicInterface', '1036', 9, 99714745, 10, 'http://lorempixel.com/640/480/?78570', 9),
(10, 71791, 'San Franco del Bages', 2147483647, 'Fully-configurable coherent encoding', '1678', 10, 52921119, 10, 'http://lorempixel.com/640/480/?36115', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `Servicio` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Monto_total_servicio` float DEFAULT NULL,
  `Descripcion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idServicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `Servicio`, `Monto_total_servicio`, `Descripcion`) VALUES
(1, 'OldLace', 12043, 'Realigned didactic hierarchy'),
(2, 'Red', 6702, 'Assimilated incremental GraphicalUserInterface'),
(3, 'RoyalBlue', 6479, 'Intuitive 24/7 data-warehouse'),
(4, 'DarkGreen', 73166, ''),
(5, 'LightGray', 5341, 'Right-sized disintermediate data-warehouse'),
(6, 'Cyan', 69079, ''),
(7, 'FloralWhite', 6724, 'Balanced heuristic initiative'),
(8, 'LightPink', 5859, 'Upgradable empowering benchmark'),
(9, 'IndianRed ', 7047, 'Right-sized system-worthy openarchitecture'),
(10, 'SaddleBrown', 8961, 'Customizable 24/7 installation'),
(11, 'LightSalmon', 12653, 'Pre-emptive multi-state circuit'),
(12, 'DarkBlue', 63368, ''),
(13, 'Snow', 15172, 'Enhanced grid-enabled service-desk'),
(14, 'Chartreuse', 62468, ''),
(15, 'DimGray', 14924, 'Vision-oriented dynamic groupware');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `ip_address` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('696f480e9038d019b31c377e3f583845dcccb0d6', '::1', 1459089894, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393038393134373b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('334b97ec83d10345d57c3df42fe6948df860d242', '::1', 1459089935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393038393932353b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('88b972dd909747f9fa17e6b8683a5539a8626f07', '::1', 1459091200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393039303930313b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('e53b246b0d354e525d6589a3259236e6ef750cf4', '::1', 1459091517, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393039313233313b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('a54c27d66d4cd419b845cffc5dd73a2041f4e9dc', '::1', 1459091532, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393039313533323b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('9d18b746a43208121d4a7616d7769e08925f3504', '::1', 1459092162, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393039313837333b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('8876ef9dc7e15df5db6fbc71a47a5d944eac8a01', '::1', 1459092495, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393039323139393b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('3330353ed25c0a36c3091a24db86cc140e11e5ae', '::1', 1459092606, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393039323530383b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b),
('aa97e8736cccfb582bc8f326fad93d71dd87b8f1', '::1', 1459107336, 0x5f5f63695f6c6173745f726567656e65726174657c693a313435393130373331343b69645573756172696f7c733a323a223131223b5573756172696f7c733a353a2241646d696e223b456d706c6561646f5f6964456d706c6561646f7c4e3b436c69656e74655f6964436c69656e74657c4e3b5065726d69736f5f69645065726d69736f7c733a313a2231223b636172745f636f6e74656e74737c613a31313a7b733a31303a22636172745f746f74616c223b643a3737333739323b733a31313a22746f74616c5f6974656d73223b643a3532313b733a33323a226263306562326466616639656433376535383133643438643166373230373136223b613a373a7b733a323a226964223b733a313a2231223b733a333a22717479223b643a36393b733a353a227072696365223b643a313137323b733a343a226e616d65223b733a31303a224f732044656c6170617a223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a226263306562326466616639656433376535383133643438643166373230373136223b733a383a22737562746f74616c223b643a38303836383b7d733a33323a223837366239616434653532323263616335356134373965613037663637336334223b613a373a7b733a323a226964223b733a313a2232223b733a333a22717479223b643a39303b733a353a227072696365223b643a313834363b733a343a226e616d65223b733a31353a2247616f6e6120646520417272696261223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a223837366239616434653532323263616335356134373965613037663637336334223b733a383a22737562746f74616c223b643a3136363134303b7d733a33323a223061666130646538393561646135663362343765396237383465363135346632223b613a373a7b733a323a226964223b733a313a2233223b733a333a22717479223b643a37343b733a353a227072696365223b643a313437313b733a343a226e616d65223b733a32333a224c6f7320546f727265732064652053616e20506564726f223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a223061666130646538393561646135663362343765396237383465363135346632223b733a383a22737562746f74616c223b643a3130383835343b7d733a33323a223165653462623933333862393439316466353830633837373737343633343937223b613a373a7b733a323a226964223b733a313a2234223b733a333a22717479223b643a32343b733a353a227072696365223b643a313737353b733a343a226e616d65223b733a32323a224173204361727265726f2064656c2056616c6cc3a873223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a223165653462623933333862393439316466353830633837373737343633343937223b733a383a22737562746f74616c223b643a34323630303b7d733a33323a223162373363333336306234373034313165363232643630326664656433646433223b613a373a7b733a323a226964223b733a313a2235223b733a333a22717479223b643a34323b733a353a227072696365223b643a313433353b733a343a226e616d65223b733a373a224173204f727461223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a223162373363333336306234373034313165363232643630326664656433646433223b733a383a22737562746f74616c223b643a36303237303b7d733a33323a223439613461316266666161393139643533393064366662376134623762356531223b613a373a7b733a323a226964223b733a313a2236223b733a333a22717479223b643a38363b733a353a227072696365223b643a313133353b733a343a226e616d65223b733a31313a2256696c6c6120536f6c6572223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a223439613461316266666161393139643533393064366662376134623762356531223b733a383a22737562746f74616c223b643a39373631303b7d733a33323a226165636462373832343239303536643936343033643430626361333462393138223b613a373a7b733a323a226964223b733a313a2237223b733a333a22717479223b643a31343b733a353a227072696365223b643a313739383b733a343a226e616d65223b733a32323a224c617320497a7175696572646f2064656c20506f7a6f223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a226165636462373832343239303536643936343033643430626361333462393138223b733a383a22737562746f74616c223b643a32353137323b7d733a33323a226361323333366162376164306462663639633961323735376235666631366364223b613a373a7b733a323a226964223b733a313a2238223b733a333a22717479223b643a37393b733a353a227072696365223b643a313837303b733a343a226e616d65223b733a393a224c6173204f6c69766f223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a226361323333366162376164306462663639633961323735376235666631366364223b733a383a22737562746f74616c223b643a3134373733303b7d733a33323a223935653065356662663136643533346361346334373534323930356530663366223b613a373a7b733a323a226964223b733a313a2239223b733a333a22717479223b643a34333b733a353a227072696365223b643a313033363b733a343a226e616d65223b733a31363a224dc3a1727175657a20646520556c6c61223b733a373a226f7074696f6e73223b613a313a7b733a373a22496d706f727465223b733a323a223130223b7d733a353a22726f776964223b733a33323a223935653065356662663136643533346361346334373534323930356530663366223b733a383a22737562746f74616c223b643a34343534383b7d7d);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `idStock` int(11) NOT NULL AUTO_INCREMENT,
  `Cantidad_stock` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Producto_Servicio_idProducto_Servicio` int(11) NOT NULL,
  PRIMARY KEY (`idStock`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`idStock`, `Cantidad_stock`, `Producto_Servicio_idProducto_Servicio`) VALUES
(1, '660', 1),
(2, '537', 2),
(3, '277', 3),
(4, '145', 4),
(5, '754', 5),
(6, '860', 6),
(7, '981', 7),
(8, '367', 8),
(9, '330', 9),
(10, '827', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Password` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Empleado_idEmpleado` int(11) DEFAULT NULL,
  `Permiso_idPermiso` int(11) NOT NULL,
  `Cliente_idCliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_Usuario_Empleado1_idx` (`Empleado_idEmpleado`),
  KEY `fk_Usuario_Permiso1_idx` (`Permiso_idPermiso`),
  KEY `fk_Usuario_Cliente1_idx` (`Cliente_idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Usuario`, `Password`, `Empleado_idEmpleado`, `Permiso_idPermiso`, `Cliente_idCliente`) VALUES
(1, 'naia50', 'Iw:H@E?Sn2_DCEAFKy', NULL, 2, 1),
(2, 'tsanchez', 'N>xvy;=[QmqdfA', NULL, 2, 2),
(3, 'carmen.saldivar', 'jK,{"bUPT/#;bRH1', NULL, 2, 3),
(4, 'gonzalo.batista', '*k.VE#_HlY', NULL, 2, 4),
(5, 'laura.ortega', 'bud?"@jq', NULL, 2, 5),
(6, 'jabad', '''5OaLh', NULL, 2, 6),
(7, 'ypulido', '1|k8IFDX', NULL, 2, 7),
(8, 'ebriseno', 'in*@)[fMl', NULL, 2, 8),
(9, 'covarrubias', ']xk_}tI+2Kao1>;&j##', NULL, 2, 9),
(10, 'lidia.urrutia', '`8oA}P@x.', NULL, 2, 10),
(11, 'Admin', 'Admin.21', NULL, 1, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_Empresa_Geo_posicion1` FOREIGN KEY (`Geo_posicion_idGeo_posicion`) REFERENCES `geo_posicion` (`idGeo_posicion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
