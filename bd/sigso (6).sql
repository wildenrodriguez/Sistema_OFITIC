-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2025 a las 23:59:49
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
-- Base de datos: `sigso`
--
CREATE DATABASE IF NOT EXISTS `sigso` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sigso`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bien`
--

CREATE TABLE IF NOT EXISTS `bien` (
  `codigo_bien` varchar(20) NOT NULL,
  `tipo_bien` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `ci_responsable` varchar(12) DEFAULT NULL,
  `id_oficina` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo_bien`),
  KEY `ci_responsable` (`ci_responsable`),
  KEY `id_ubicacion` (`id_oficina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bien`
--

INSERT INTO `bien` (`codigo_bien`, `tipo_bien`, `estado`, `ci_responsable`, `id_oficina`, `estatus`) VALUES
('1', '2', '3', 'V-31843937', 1, 1),
('3', '3', '3', 'V-31843937', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE IF NOT EXISTS `bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `modulo` varchar(45) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `usuario`, `modulo`, `accion`, `fecha`, `hora`) VALUES
(2, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-21', '23:13:18'),
(3, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-22', '14:19:08'),
(4, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-22', '14:48:52'),
(5, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-23', '12:13:22'),
(6, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-24', '11:24:42'),
(7, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-24', '14:24:00'),
(8, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-24', '14:52:50'),
(9, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-24', '14:59:36'),
(10, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-24', '16:37:22'),
(11, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-26', '19:22:23'),
(12, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-26', '19:26:51'),
(13, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-26', '20:46:06'),
(14, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-27', '11:08:51'),
(15, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-27', '11:24:59'),
(16, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-27', '11:27:08'),
(17, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-27', '15:49:34'),
(18, 'cabrerajorge', 'Bitácora', '(cabrerajorge), Ingresó al módulo de Bitácora', '2025-04-27', '20:31:28'),
(19, 'cabrerajorge', 'Bitácora', '(cabrerajorge), Ingresó al módulo de Bitácora', '2025-04-27', '20:31:28'),
(20, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-04-27', '20:31:34'),
(21, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-04-27', '20:31:35'),
(22, 'cabrerajorge', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-28', '11:09:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`codigo`, `nombre`) VALUES
(1, 'OFITIC'),
(3, 'Auditoria '),
(4, 'Administración y finanzas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_hoja`
--

CREATE TABLE IF NOT EXISTS `detalle_hoja` (
  `cod_hoja` int(11) NOT NULL,
  `componente` varchar(40) NOT NULL,
  `detalle` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_hoja`,`componente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE IF NOT EXISTS `edificio` (
  `id_edificio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_edificio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`id_edificio`, `nombre`, `ubicacion`, `estatus`) VALUES
(1, '1', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `cod_unidad` int(11) NOT NULL,
  `cod_dependencia` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cedula`),
  KEY `empleado_ibfk_1` (`cod_unidad`),
  KEY `empleado_ibfk_2` (`cod_dependencia`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`cedula`, `nombre`, `apellido`, `cargo`, `tipo`, `cod_unidad`, `cod_dependencia`, `telefono`, `correo`) VALUES
('V-1234567', 'Maria', 'Peres', '', NULL, 1, 1, '0426-5575858', 'prueba@gmail.com'),
('V-21140325', 'Félix', 'Mujica', '', NULL, 1, 1, '0400-0000000', 'ejemplo@gmail.com'),
('V-30266398', 'Leizer', 'Torrealba', '', NULL, 1, 1, '0416-0506544', 'leizeraponte2020@gmail.com'),
('V-30454597', 'Franklin', 'Fonseca', '', NULL, 1, 1, '0424-5041921', 'franklinjavierfonsecavasquez@gmail.com'),
('V-30587785', 'Mariangel', 'Bokor', '', NULL, 1, 1, '0424-5319088', 'bokorarcangel447@gmail.com'),
('V-31843937', 'Jorge', 'Cabrera', '', NULL, 1, 1, '0424-5567016', 'cabrerajorge2003@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `id_equipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) NOT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `marca` int(11) NOT NULL,
  `nro_bien` varchar(20) DEFAULT NULL,
  `cod_dependencia` int(11) NOT NULL,
  PRIMARY KEY (`id_equipo`),
  KEY `equipo_ibfk_1` (`marca`),
  KEY `equipo_ibfk_2` (`cod_dependencia`),
  KEY `nro_bien` (`nro_bien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_servicio`
--

CREATE TABLE IF NOT EXISTS `hoja_servicio` (
  `cod_hoja` int(11) NOT NULL AUTO_INCREMENT,
  `nro_solicitud` int(11) NOT NULL,
  `tipo_servicio` int(11) NOT NULL,
  `redireccion` int(11) DEFAULT NULL,
  `cedula_tecnico` varchar(12) DEFAULT NULL,
  `resultado` varchar(20) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cod_hoja`),
  KEY `hoja_servicio_ibfk_1` (`nro_solicitud`),
  KEY `hoja_servicio_ibfk_2` (`tipo_servicio`),
  KEY `redireccion` (`redireccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interconexion`
--

CREATE TABLE IF NOT EXISTS `interconexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_switch` varchar(13) NOT NULL,
  `codigo_patch_panel` varchar(13) DEFAULT NULL,
  `puerto_switch` int(11) NOT NULL,
  `puerto_patch` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_switch` (`codigo_switch`),
  KEY `codigo_patch_panel` (`codigo_patch_panel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`codigo`, `nombre`) VALUES
(1, 'Lenovo'),
(2, 'HP'),
(3, 'SAMSUNG'),
(4, 'VIT'),
(5, 'Apple');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL,
  `lugar` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `material_ibfk_1` (`lugar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_materiales`
--

CREATE TABLE IF NOT EXISTS `movimiento_materiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_material` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_material` (`id_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE IF NOT EXISTS `oficina` (
  `id_oficiona` int(11) NOT NULL AUTO_INCREMENT,
  `id_piso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id_oficiona`),
  KEY `id_piso` (`id_piso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `oficina`
--

INSERT INTO `oficina` (`id_oficiona`, `id_piso`, `nombre`, `estatus`) VALUES
(1, 1, '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patch_panel`
--

CREATE TABLE IF NOT EXISTS `patch_panel` (
  `codigo_bien` varchar(13) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `cantidad_puertos` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo_bien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `id_rol` (`id_rol`),
  KEY `id_modulo` (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piso`
--

CREATE TABLE IF NOT EXISTS `piso` (
  `id_piso` int(11) NOT NULL AUTO_INCREMENT,
  `id_edificio` int(11) NOT NULL,
  `nro_piso` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_piso`),
  KEY `id_edificio` (`id_edificio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `piso`
--

INSERT INTO `piso` (`id_piso`, `id_edificio`, `nro_piso`, `estatus`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_conexion`
--

CREATE TABLE IF NOT EXISTS `punto_conexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_patch` varchar(13) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `puerto_patch` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_patch` (`codigo_patch`),
  KEY `id_equipo` (`id_equipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'TECNICO'),
(3, 'SOLICITANTE'),
(4, 'SECRETARIA'),
(5, 'Super usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `nro_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_solicitante` varchar(12) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `resultado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`nro_solicitud`),
  KEY `solicitud_ibfk_1` (`cedula_solicitante`),
  KEY `solicitud_ibfk_2` (`id_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`nro_solicitud`, `cedula_solicitante`, `motivo`, `id_equipo`, `fecha`, `estatus`, `resultado`) VALUES
(2, 'V-1234567', 'Reparar mi equipo', NULL, '2025-04-08 00:00:00', 'Pendiente', NULL),
(3, 'V-1234567', 'Quiero arreglar el PC', NULL, '2025-04-09 00:00:00', 'En Proceso', NULL),
(4, 'V-1234567', 'Quiero arreglar el PC', NULL, '2025-04-09 00:00:00', 'En Proceso', NULL),
(5, 'V-30266398', 'Se daño el pc', NULL, '2025-04-23 00:00:00', 'En Proceso', NULL),
(34, 'V-31843937', 'hjgjh', NULL, '2025-04-27 00:00:00', 'En Proceso', NULL),
(35, 'V-31843937', 'lkjkjk', NULL, '2025-04-27 00:00:00', 'En Proceso', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `switch`
--

CREATE TABLE IF NOT EXISTS `switch` (
  `codigo_bien` varchar(13) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `cantidad_puertos` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo_bien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE IF NOT EXISTS `tipo_servicio` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`codigo`, `nombre`) VALUES
(1, 'Soporte Técnico'),
(2, 'Redes'),
(3, 'Telefonía'),
(4, 'Electrónica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`codigo`, `nombre`) VALUES
(1, 'Gobernación'),
(2, 'Baradidas'),
(3, 'Teatro Juares'),
(4, 'Imprenta de Lara'),
(5, 'Secretaria de Gobierno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre_usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `nombres` varchar(65) NOT NULL,
  `apellidos` varchar(65) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(128) NOT NULL,
  `rol` varchar(15) NOT NULL,
  PRIMARY KEY (`nombre_usuario`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `cedula`, `id_rol`, `nombres`, `apellidos`, `telefono`, `correo`, `clave`, `rol`) VALUES
('cabrerajorge', 'V-31843937', 5, 'Jorge', 'Cabrera', '0424-5567016', 'cabrerajorge2003@gmail.com', '$2y$10$1vXPHPs29V2T.1HVvUHXn.rzC3KfFwxTXbnosxiJRJEWA4ZATIEBm', 'Super usuario'),
('frank30', 'V-30454597', 1, 'Frankling', 'Fonseca', '0424-5041921', 'ranklinjavierfonsecavasquez@gmail.com', '$2y$10$d64FtFMmW8sTyuiKyxD52eN0q9vdBEglqAbOJXUzw80aRB3/uko7K', 'Super usuario'),
('lz2712', 'V-30266398', 1, 'Leizer', 'Torrealba', '0416-0506544', 'leizeraponte2020@gmail.com', '$2y$10$sONqWv4yy5PEeePKYljGXOLjFuJa1lMz9yua.3cMVAHG4hU.75Jpe', 'Super usuario'),
('mari14', 'V-30587785', 1, 'Mariangel', 'Bokor', '0424-5319088', 'bokorarcangel447@gmail.com', '$2y$10$nMQ5inBjrq6FeZbt8sTQk.9Mkx4c.H93TVw.39zCiC3ovXCZoqyaa', 'Super usuario'),
('maria123', 'V-21140325', 1, 'Felix', 'Mujica', '0400-0000000', 'ejemplo@gmail.com', '12345', 'Super usuario'),
('root', 'V-1234567', 1, 'root', 'admin', '0000-0000000', 'prueba@gmail.com', '123', 'Super usuario');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `bien_ibfk_1` FOREIGN KEY (`ci_responsable`) REFERENCES `empleado` (`cedula`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `bien_ibfk_2` FOREIGN KEY (`id_oficina`) REFERENCES `oficina` (`id_oficiona`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_hoja`
--
ALTER TABLE `detalle_hoja`
  ADD CONSTRAINT `detalle_hoja_ibfk_1` FOREIGN KEY (`cod_hoja`) REFERENCES `hoja_servicio` (`cod_hoja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cod_unidad`) REFERENCES `unidad` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`cod_dependencia`) REFERENCES `dependencia` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`tipo`) REFERENCES `tipo_servicio` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marca` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_3` FOREIGN KEY (`nro_bien`) REFERENCES `bien` (`codigo_bien`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_4` FOREIGN KEY (`cod_dependencia`) REFERENCES `dependencia` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hoja_servicio`
--
ALTER TABLE `hoja_servicio`
  ADD CONSTRAINT `hoja_servicio_ibfk_1` FOREIGN KEY (`nro_solicitud`) REFERENCES `solicitud` (`nro_solicitud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoja_servicio_ibfk_2` FOREIGN KEY (`tipo_servicio`) REFERENCES `tipo_servicio` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hoja_servicio_ibfk_3` FOREIGN KEY (`redireccion`) REFERENCES `hoja_servicio` (`cod_hoja`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `interconexion`
--
ALTER TABLE `interconexion`
  ADD CONSTRAINT `interconexion_ibfk_1` FOREIGN KEY (`codigo_switch`) REFERENCES `switch` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `interconexion_ibfk_2` FOREIGN KEY (`codigo_patch_panel`) REFERENCES `patch_panel` (`codigo_bien`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`lugar`) REFERENCES `oficina` (`id_oficiona`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `movimiento_materiales`
--
ALTER TABLE `movimiento_materiales`
  ADD CONSTRAINT `movimiento_materiales_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD CONSTRAINT `oficina_ibfk_1` FOREIGN KEY (`id_piso`) REFERENCES `piso` (`id_piso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `piso`
--
ALTER TABLE `piso`
  ADD CONSTRAINT `piso_ibfk_1` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `punto_conexion`
--
ALTER TABLE `punto_conexion`
  ADD CONSTRAINT `punto_conexion_ibfk_1` FOREIGN KEY (`codigo_patch`) REFERENCES `patch_panel` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `punto_conexion_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`cedula_solicitante`) REFERENCES `empleado` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
