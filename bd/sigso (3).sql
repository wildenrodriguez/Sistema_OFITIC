-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-04-2025 a las 05:17:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bien`
--

CREATE TABLE `bien` (
  `codigo_bien` varchar(13) NOT NULL,
  `tipo_bien` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `ci_responsable` varchar(12) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_nopad_ci DEFAULT NULL,
  `modulo` varchar(45) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id`, `usuario`, `modulo`, `accion`, `fecha`, `hora`) VALUES
(2, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-04-21', '23:13:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE `dependencia` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
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

CREATE TABLE `detalle_hoja` (
  `cod_hoja` int(11) NOT NULL,
  `componente` varchar(40) NOT NULL,
  `detalle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE `edificio` (
  `id_edificio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cod_unidad` int(11) NOT NULL,
  `cod_dependencia` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`cedula`, `nombre`, `apellido`, `cod_unidad`, `cod_dependencia`, `telefono`, `correo`) VALUES
('V-1234567', 'Maria', 'Peres', 1, 1, '0426-5575858', 'prueba@gmail.com'),
('V-21140325', 'Félix', 'Mujica', 1, 1, '0400-0000000', 'ejemplo@gmail.com'),
('V-30266398', 'Leizer', 'Torrealba', 1, 1, '0416-0506544', 'leizeraponte2020@gmail.com'),
('V-30454597', 'Franklin', 'Fonseca', 1, 1, '0424-5041921', 'franklinjavierfonsecavasquez@gmail.com'),
('V-30587785', 'Mariangel', 'Bokor', 1, 1, '0424-5319088', 'bokorarcangel447@gmail.com'),
('V-31843937', 'Jorge', 'Cabrera', 1, 1, '0424-5567016', 'cabrerajorge2003@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `marca` int(11) NOT NULL,
  `nro_bien` varchar(20) DEFAULT NULL,
  `dependencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoja_servicio`
--

CREATE TABLE `hoja_servicio` (
  `cod_hoja` int(11) NOT NULL,
  `nro_solicitud` int(11) NOT NULL,
  `tipo_servicio` int(11) NOT NULL,
  `redireccion` int(11) DEFAULT NULL,
  `cedula_tecnico` varchar(12) DEFAULT NULL,
  `resultado` varchar(20) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interconexion`
--

CREATE TABLE `interconexion` (
  `id` int(11) NOT NULL,
  `codigo_switch` varchar(13) NOT NULL,
  `codigo_patch_panel` varchar(13) DEFAULT NULL,
  `puerto_switch` int(2) NOT NULL,
  `puerto_patch` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oficina`
--

CREATE TABLE `oficina` (
  `id_oficiona` int(11) NOT NULL,
  `id_piso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patch_panel`
--

CREATE TABLE `patch_panel` (
  `codigo_bien` varchar(13) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `cantidad_puertos` int(2) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piso`
--

CREATE TABLE `piso` (
  `id_piso` int(11) NOT NULL,
  `id_edificio` int(2) NOT NULL,
  `nro_piso` int(2) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_conexion`
--

CREATE TABLE `punto_conexion` (
  `id` int(11) NOT NULL,
  `codigo_patch` varchar(13) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `puerto_patch` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'TECNICO'),
(3, 'SOLICITANTE'),
(4, 'SECRETARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `nro_solicitud` int(11) NOT NULL,
  `cedula_solicitante` varchar(12) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `estatus` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `resultado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`nro_solicitud`, `cedula_solicitante`, `motivo`, `id_equipo`, `fecha`, `estatus`, `resultado`) VALUES
(2, 'V-1234567', 'Reparar mi equipo', NULL, '2025-04-08', 'Pendiente', NULL),
(3, 'V-1234567', 'Quiero arreglar el PC', NULL, '2025-04-09', 'En Proceso', NULL),
(4, 'V-1234567', 'Quiero arreglar el PC', NULL, '2025-04-09', 'En Proceso', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `switch`
--

CREATE TABLE `switch` (
  `codigo_bien` varchar(13) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `cantidad_puertos` int(2) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico`
--

CREATE TABLE `tecnico` (
  `cedula` varchar(12) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `unidad` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_nopad_ci NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `nombres` varchar(65) NOT NULL,
  `apellidos` varchar(65) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(128) NOT NULL,
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `cedula`, `id_rol`, `nombres`, `apellidos`, `telefono`, `correo`, `clave`, `rol`) VALUES
('cabrerajorge', 'V-31843937', 1, 'Jorge', 'Cabrera', '0424-5567016', 'cabrerajorge2003@gmail.com', '$2y$10$1vXPHPs29V2T.1HVvUHXn.rzC3KfFwxTXbnosxiJRJEWA4ZATIEBm', 'Super usuario'),
('frank30', 'V-30454597', 1, 'Frankling', 'Fonseca', '0424-5041921', 'ranklinjavierfonsecavasquez@gmail.com', '$2y$10$d64FtFMmW8sTyuiKyxD52eN0q9vdBEglqAbOJXUzw80aRB3/uko7K', 'Super usuario'),
('lz2712', 'V-30266398', 1, 'Leizer', 'Torrealba', '0416-0506544', 'leizeraponte2020@gmail.com', '$2y$10$sONqWv4yy5PEeePKYljGXOLjFuJa1lMz9yua.3cMVAHG4hU.75Jpe', 'Super usuario'),
('mari14', 'V-30587785', 1, 'Mariangel', 'Bokor', '0424-5319088', 'bokorarcangel447@gmail.com', '$2y$10$nMQ5inBjrq6FeZbt8sTQk.9Mkx4c.H93TVw.39zCiC3ovXCZoqyaa', 'Super usuario'),
('maria123', 'V-21140325', 1, 'Felix', 'Mujica', '0400-0000000', 'ejemplo@gmail.com', '12345', 'Super usuario'),
('root', 'V-1234567', 1, 'root', 'admin', '0000-0000000', 'prueba@gmail.com', '123', 'Super usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bien`
--
ALTER TABLE `bien`
  ADD PRIMARY KEY (`codigo_bien`),
  ADD KEY `ci_responsable` (`ci_responsable`),
  ADD KEY `id_ubicacion` (`id_ubicacion`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `detalle_hoja`
--
ALTER TABLE `detalle_hoja`
  ADD PRIMARY KEY (`cod_hoja`,`componente`);

--
-- Indices de la tabla `edificio`
--
ALTER TABLE `edificio`
  ADD PRIMARY KEY (`id_edificio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `empleado_ibfk_1` (`cod_unidad`),
  ADD KEY `empleado_ibfk_2` (`cod_dependencia`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `equipo_ibfk_1` (`marca`),
  ADD KEY `equipo_ibfk_2` (`dependencia`);

--
-- Indices de la tabla `hoja_servicio`
--
ALTER TABLE `hoja_servicio`
  ADD PRIMARY KEY (`cod_hoja`),
  ADD KEY `hoja_servicio_ibfk_1` (`nro_solicitud`),
  ADD KEY `hoja_servicio_ibfk_2` (`tipo_servicio`),
  ADD KEY `redireccion` (`redireccion`);

--
-- Indices de la tabla `interconexion`
--
ALTER TABLE `interconexion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_switch` (`codigo_switch`),
  ADD KEY `codigo_patch_panel` (`codigo_patch_panel`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`id_oficiona`),
  ADD KEY `id_piso` (`id_piso`);

--
-- Indices de la tabla `patch_panel`
--
ALTER TABLE `patch_panel`
  ADD PRIMARY KEY (`codigo_bien`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `piso`
--
ALTER TABLE `piso`
  ADD PRIMARY KEY (`id_piso`),
  ADD KEY `id_edificio` (`id_edificio`);

--
-- Indices de la tabla `punto_conexion`
--
ALTER TABLE `punto_conexion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codigo_patch` (`codigo_patch`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`nro_solicitud`),
  ADD KEY `solicitud_ibfk_1` (`cedula_solicitante`),
  ADD KEY `solicitud_ibfk_2` (`id_equipo`);

--
-- Indices de la tabla `switch`
--
ALTER TABLE `switch`
  ADD PRIMARY KEY (`codigo_bien`);

--
-- Indices de la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`cedula`),
  ADD KEY `tecnico_ibfk_2` (`tipo`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `edificio`
--
ALTER TABLE `edificio`
  MODIFY `id_edificio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hoja_servicio`
--
ALTER TABLE `hoja_servicio`
  MODIFY `cod_hoja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `interconexion`
--
ALTER TABLE `interconexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `oficina`
--
ALTER TABLE `oficina`
  MODIFY `id_oficiona` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `piso`
--
ALTER TABLE `piso`
  MODIFY `id_piso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `punto_conexion`
--
ALTER TABLE `punto_conexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `nro_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `bien_ibfk_1` FOREIGN KEY (`ci_responsable`) REFERENCES `empleado` (`cedula`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `bien_ibfk_2` FOREIGN KEY (`id_ubicacion`) REFERENCES `oficina` (`id_oficiona`) ON DELETE SET NULL ON UPDATE SET NULL;

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
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`cod_dependencia`) REFERENCES `dependencia` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marca` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_ibfk_2` FOREIGN KEY (`dependencia`) REFERENCES `dependencia` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD CONSTRAINT `tecnico_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `empleado` (`cedula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tecnico_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `tipo_servicio` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
