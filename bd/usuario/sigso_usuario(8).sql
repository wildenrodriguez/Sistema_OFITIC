-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2025 a las 11:37:37
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
-- Base de datos: `sigso_usuario`
--
CREATE DATABASE IF NOT EXISTS `sigso_usuario` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sigso_usuario`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL,
  `usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `modulo` varchar(45) NOT NULL,
  `accion_bitacora` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id_bitacora`, `usuario`, `modulo`, `accion_bitacora`, `fecha`, `hora`) VALUES
(1, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:14:38'),
(2, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:15:11'),
(3, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:15:37'),
(4, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:16:43'),
(5, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '18:17:47'),
(6, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '18:18:56'),
(7, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:19:06'),
(8, 'lz2712', 'Edificio', '(lz2712), Ingresó al Módulo de Edificio', '2025-05-15', '18:21:19'),
(9, 'lz2712', 'Edificio', '(lz2712), Ingresó al Módulo de Edificio', '2025-05-15', '18:28:14'),
(10, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:28:17'),
(11, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:28:27'),
(12, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:41:52'),
(13, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '18:45:37'),
(14, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '19:33:07'),
(15, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '19:33:14'),
(16, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '20:31:40'),
(17, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:22:33'),
(18, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:23:38'),
(19, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:24:16'),
(20, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:24:28'),
(21, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:25:36'),
(22, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:26:42'),
(23, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:27:23'),
(24, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:27:27'),
(25, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:37:32'),
(26, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:52:37'),
(27, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:54:20'),
(28, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:55:53'),
(29, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:56:45'),
(30, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '21:56:53'),
(31, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '22:06:10'),
(32, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '22:06:58'),
(33, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '22:07:07'),
(34, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '22:08:17'),
(35, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '22:08:22'),
(36, 'lz2712', 'Cargo', '(lz2712), Se registró un nuevo cargo', '2025-05-15', '22:08:48'),
(37, 'lz2712', 'Cargo', '(lz2712), Se registró un nuevo cargo', '2025-05-15', '22:20:04'),
(38, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '22:29:15'),
(39, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-15', '22:31:51'),
(40, 'lz2712', 'Marca', '(lz2712), Ingresó al Módulo de Marca', '2025-05-15', '22:32:51'),
(41, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '22:33:12'),
(42, 'lz2712', 'Edificio', '(lz2712), Ingresó al Módulo de Edificio', '2025-05-15', '22:33:35'),
(43, 'lz2712', 'Cargo', '(lz2712), Se modificó el registro del cargo', '2025-05-15', '22:35:17'),
(44, 'lz2712', 'Cargo', '(lz2712), Se eliminó un cargo', '2025-05-15', '22:35:22'),
(45, 'lz2712', 'Material', '(lz2712), Ingresó al Módulo de Materiales', '2025-05-15', '22:45:06'),
(46, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '22:45:08'),
(47, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-15', '22:52:21'),
(48, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '23:01:57'),
(49, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:02:13'),
(50, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:10:13'),
(51, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:11:06'),
(52, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:11:06'),
(53, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:11:45'),
(54, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:14:51'),
(55, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:15:26'),
(56, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-15', '23:15:43'),
(57, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:16:41'),
(58, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-15', '23:16:48'),
(59, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '23:22:50'),
(60, 'lz2712', 'Oficina', '(lz2712), Se registró una nueva oficina', '2025-05-15', '23:23:01'),
(61, 'lz2712', 'Oficina', '(lz2712), Se registró una nueva oficina', '2025-05-15', '23:23:42'),
(62, 'lz2712', 'Oficina', '(lz2712), Se registró una nueva oficina', '2025-05-15', '23:24:08'),
(63, 'lz2712', 'Oficina', '(lz2712), Se registró una nueva oficina', '2025-05-15', '23:28:19'),
(64, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '23:28:26'),
(65, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '23:31:21'),
(66, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:31:25'),
(67, 'lz2712', 'Piso', '(lz2712), error al modificar piso', '2025-05-15', '23:31:37'),
(68, 'lz2712', 'Piso', '(lz2712), error al modificar piso', '2025-05-15', '23:32:25'),
(69, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:32:58'),
(70, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:32:59'),
(71, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:33:53'),
(72, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:33:59'),
(73, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:34:55'),
(74, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-15', '23:35:30'),
(75, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:36:38'),
(76, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-15', '23:36:53'),
(77, 'lz2712', 'Piso', '(lz2712), Se eliminó un piso', '2025-05-15', '23:36:58'),
(78, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:45:22'),
(79, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-15', '23:50:34'),
(80, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-15', '23:50:39'),
(81, 'lz2712', 'Edificio', '(lz2712), Ingresó al Módulo de Edificio', '2025-05-15', '23:51:15'),
(82, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-15', '23:51:22'),
(83, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-15', '23:51:26'),
(84, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-15', '23:52:39'),
(85, 'lz2712', 'TipoBien', '(lz2712), Ingresó al Módulo de Tipos de Bien', '2025-05-15', '23:52:57'),
(86, 'lz2712', 'TipoBien', '(lz2712), Se registró un nuevo tipo de bien', '2025-05-15', '23:53:08'),
(87, 'lz2712', 'TipoBien', '(lz2712), Se registró un nuevo tipo de bien', '2025-05-15', '23:53:14'),
(88, 'lz2712', 'TipoBien', '(lz2712), Se modificó el registro del tipo de bien', '2025-05-15', '23:53:27'),
(89, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-15', '23:53:36'),
(90, 'lz2712', 'Bien', '(lz2712), Se registró un nuevo bien', '2025-05-15', '23:54:33'),
(91, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-16', '00:18:49'),
(92, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-16', '00:18:56'),
(93, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-16', '00:19:47'),
(94, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-16', '00:23:06'),
(95, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-16', '00:23:52'),
(96, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-17', '20:09:10'),
(97, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '20:18:30'),
(98, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-17', '20:31:28'),
(99, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:44:31'),
(100, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:44:57'),
(101, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:45:05'),
(102, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:45:09'),
(103, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:45:16'),
(104, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:45:55'),
(105, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:46:00'),
(106, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:46:06'),
(107, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:46:15'),
(108, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:46:18'),
(109, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:46:23'),
(110, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-17', '21:46:44'),
(111, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:46:53'),
(112, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:47:05'),
(113, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:47:09'),
(114, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:47:11'),
(115, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-17', '21:48:35'),
(116, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:52:20'),
(117, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:52:32'),
(118, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:54:35'),
(119, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:54:37'),
(120, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:54:43'),
(121, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '21:54:55'),
(122, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:00:03'),
(123, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:00:05'),
(124, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:03:16'),
(125, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:06:00'),
(158, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-17', '22:47:34'),
(159, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:47:42'),
(166, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-17', '22:50:48'),
(167, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:51:03'),
(168, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:51:08'),
(169, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:51:51'),
(170, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:54:04'),
(171, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:56:21'),
(172, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:56:23'),
(173, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:58:27'),
(174, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-17', '22:59:55'),
(175, 'lz2712', 'Material', '(lz2712), Ingresó al Módulo de Materiales', '2025-05-17', '23:00:09'),
(176, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-17', '23:00:13'),
(177, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-18', '13:35:01'),
(178, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-18', '13:35:11'),
(179, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-18', '13:35:15'),
(180, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-18', '13:35:19'),
(181, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-18', '13:35:23'),
(182, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-18', '13:35:26'),
(183, 'lz2712', 'Material', '(lz2712), Ingresó al Módulo de Materiales', '2025-05-18', '13:35:32'),
(184, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-18', '13:35:33'),
(185, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-18', '13:35:45'),
(186, 'lz2712', 'Material', '(lz2712), Ingresó al Módulo de Materiales', '2025-05-18', '13:36:32'),
(187, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-18', '13:36:35'),
(188, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-18', '13:37:03'),
(189, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-18', '13:37:24'),
(190, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-18', '13:37:37'),
(191, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '13:38:51'),
(192, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '13:41:20'),
(193, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '13:41:32'),
(194, 'lz2712', 'Edificio', '(lz2712), Ingresó al Módulo de Edificio', '2025-05-18', '17:53:54'),
(195, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '17:54:54'),
(196, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '17:55:20'),
(197, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '17:56:04'),
(198, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '17:58:05'),
(199, 'lz2712', 'Unidad', '(lz2712), error al registrar un nuevo unidad', '2025-05-18', '17:58:21'),
(200, 'lz2712', 'Unidad', '(lz2712), error al registrar un nuevo unidad', '2025-05-18', '18:00:38'),
(201, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:01:20'),
(202, 'lz2712', 'Unidad', '(lz2712), Se registró un nuevo unidad', '2025-05-18', '18:01:27'),
(203, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:01:36'),
(204, 'lz2712', 'Unidad', '(lz2712), Se registró un nuevo unidad', '2025-05-18', '18:02:26'),
(205, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:05:57'),
(206, 'lz2712', 'Unidad', '(lz2712), Se registró un nuevo unidad', '2025-05-18', '18:06:35'),
(207, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-18', '18:07:53'),
(208, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-18', '18:08:10'),
(209, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-18', '18:08:36'),
(210, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:10:09'),
(211, 'lz2712', 'Unidad', '(lz2712), Se modificó el registro del unidad', '2025-05-18', '18:10:15'),
(212, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:11:23'),
(213, 'lz2712', 'Unidad', '(lz2712), Se modificó el registro del unidad', '2025-05-18', '18:11:25'),
(214, 'lz2712', 'Unidad', '(lz2712), Se eliminó un unidad', '2025-05-18', '18:11:31'),
(215, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:51:40'),
(216, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:51:46'),
(217, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:56:40'),
(218, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:56:42'),
(219, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:57:17'),
(220, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:57:22'),
(221, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:57:46'),
(222, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:57:48'),
(223, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:58:43'),
(224, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '18:59:46'),
(225, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:00:33'),
(226, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:06:16'),
(227, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:06:20'),
(228, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:07:15'),
(229, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:07:20'),
(230, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:11:51'),
(231, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:12:17'),
(232, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:13:36'),
(233, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:13:37'),
(234, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:13:45'),
(235, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:14:00'),
(236, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:14:19'),
(237, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:14:31'),
(238, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:14:35'),
(239, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:15:07'),
(240, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:16:40'),
(241, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:23:17'),
(242, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:23:21'),
(243, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-18', '19:23:39'),
(244, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-19', '13:41:17'),
(245, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '14:04:06'),
(246, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-19', '14:07:14'),
(247, 'lz2712', 'Rol y Permiso', '(lz2712), Ingresó al Módulo de Roles y Permisos', '2025-05-19', '14:22:33'),
(248, 'lz2712', 'Rol y Permiso', '(lz2712), Ingresó al Módulo de Roles y Permisos', '2025-05-19', '14:22:47'),
(249, 'lz2712', 'Rol y Permiso', '(lz2712), Ingresó al Módulo de Roles y Permisos', '2025-05-19', '14:24:14'),
(250, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:25:57'),
(251, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:33:09'),
(252, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:33:12'),
(253, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:36:24'),
(254, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:36:30'),
(255, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:37:24'),
(256, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:44:47'),
(257, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:44:51'),
(258, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:45:36'),
(259, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:45:40'),
(260, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:45:50'),
(261, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:46:21'),
(262, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:48:51'),
(263, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:52:23'),
(264, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:52:35'),
(265, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:53:13'),
(266, 'lz2712', 'Oficina', '(lz2712), Se modificó el registro de la oficina', '2025-05-19', '14:53:25'),
(267, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '14:55:49'),
(268, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '15:10:49'),
(269, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '15:17:15'),
(270, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:17:25'),
(271, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:20:49'),
(272, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:23:31'),
(273, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:23:34'),
(274, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:23:48'),
(275, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:23:50'),
(276, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:24:47'),
(277, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:24:51'),
(278, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:25:32'),
(279, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:25:59'),
(280, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:26:44'),
(281, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:28:01'),
(282, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:28:05'),
(283, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:30:04'),
(284, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:30:12'),
(285, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:30:41'),
(286, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:33:10'),
(287, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:46:29'),
(288, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '15:46:35'),
(289, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-19', '15:46:43'),
(290, 'lz2712', 'Oficina', '(lz2712), Se registró una nueva oficina', '2025-05-19', '15:47:22'),
(291, 'lz2712', 'Oficina', '(lz2712), Se eliminó una oficina', '2025-05-19', '15:55:27'),
(292, 'lz2712', 'Oficina', '(lz2712), Se restauró la oficina ID: 1', '2025-05-19', '15:55:50'),
(293, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:05:27'),
(294, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:05:29'),
(295, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:05:44'),
(296, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:07:19'),
(297, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:07:42'),
(298, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:07:53'),
(299, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:08:52'),
(300, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:08:58'),
(301, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:09:10'),
(302, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:09:29'),
(303, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:09:36'),
(304, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:09:50'),
(305, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '16:10:12'),
(306, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '16:10:17'),
(307, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '16:10:25'),
(308, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '16:10:29'),
(309, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:10:44'),
(310, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:12:30'),
(311, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:13:02'),
(312, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:13:07'),
(313, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:13:37'),
(314, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:21:56'),
(315, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:22:14'),
(316, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:22:26'),
(317, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '16:22:37'),
(318, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:23:07'),
(319, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:23:09'),
(320, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:23:16'),
(321, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:28:33'),
(322, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:28:47'),
(323, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:33:29'),
(324, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:36:12'),
(325, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:37:24'),
(326, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:39:04'),
(327, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:39:08'),
(328, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:39:22'),
(329, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:40:12'),
(330, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:40:14'),
(331, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:40:26'),
(332, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:41:12'),
(333, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:41:57'),
(334, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:44:19'),
(335, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:44:31'),
(336, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:46:06'),
(337, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:46:21'),
(338, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:47:18'),
(339, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:47:56'),
(340, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:48:02'),
(341, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:49:11'),
(342, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '16:49:19'),
(343, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '16:49:40'),
(344, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:19:18'),
(345, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:21:08'),
(346, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '17:21:24'),
(347, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:22:25'),
(348, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '17:22:42'),
(349, 'lz2712', 'Piso', '(lz2712), Se eliminó un piso', '2025-05-19', '17:23:01'),
(350, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:24:28'),
(351, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:24:33'),
(352, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:25:42'),
(353, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:27:10'),
(354, 'lz2712', 'Piso', '(lz2712), Se eliminó un piso', '2025-05-19', '17:27:38'),
(355, 'lz2712', 'Piso', '(lz2712), Se eliminó un piso', '2025-05-19', '17:27:49'),
(356, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:28:05'),
(357, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:28:09'),
(358, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:28:56'),
(359, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:29:13'),
(360, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:29:44'),
(361, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:29:45'),
(362, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:29:46'),
(363, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:39:28'),
(364, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:39:31'),
(365, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:41:34'),
(366, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:41:37'),
(367, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:42:16'),
(368, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:42:19'),
(369, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-19', '17:48:51'),
(370, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:49:00'),
(371, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-19', '17:49:42'),
(372, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-19', '17:49:58'),
(373, 'lz2712', 'Piso', '(lz2712), Se registró un nuevo piso', '2025-05-19', '17:51:07'),
(374, 'lz2712', 'Piso', '(lz2712), Se modificó el registro del piso', '2025-05-19', '17:51:18'),
(375, 'lz2712', 'Piso', '(lz2712), Se eliminó un piso', '2025-05-19', '17:51:34'),
(376, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-19', '21:34:47'),
(377, 'lz2712', 'Usuario', 'Cerró sesión', '2025-05-19', '21:41:39'),
(378, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-20', '00:49:08'),
(379, 'lz2712', 'Equipo', '(lz2712), Ingresó al Módulo de Equipos', '2025-05-20', '00:49:54'),
(380, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-20', '00:50:03'),
(381, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-20', '00:52:23'),
(382, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-20', '00:53:10'),
(383, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-20', '00:54:22'),
(384, 'lz2712', 'Unidad', '(lz2712), Ingresó al Módulo de Unidad', '2025-05-20', '00:55:21'),
(385, 'lz2712', 'Unidad', '(lz2712), Se registró un nuevo unidad', '2025-05-20', '00:55:33'),
(386, 'lz2712', 'Unidad', '(lz2712), Se modificó el registro del unidad', '2025-05-20', '00:56:01'),
(387, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '00:58:50'),
(388, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '00:59:33'),
(389, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-20', '01:03:32'),
(390, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-20', '01:03:42'),
(391, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '01:03:47'),
(392, 'lz2712', 'Oficina', '(lz2712), Ingresó al Módulo de Oficina', '2025-05-20', '01:03:58'),
(393, 'lz2712', 'Oficina', '(lz2712), Se eliminó una oficina', '2025-05-20', '01:04:13'),
(394, 'lz2712', 'Oficina', '(lz2712), Se restauró la oficina ID: 1', '2025-05-20', '01:04:42'),
(395, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-20', '12:44:50'),
(396, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '12:44:59'),
(397, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '13:13:15'),
(398, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '13:14:52'),
(399, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '13:17:21'),
(400, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '14:38:04'),
(401, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '14:40:51'),
(402, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '14:42:22'),
(403, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '14:42:58'),
(404, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '14:44:17'),
(405, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-20', '14:44:33'),
(406, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-20', '23:25:03'),
(407, 'lz2712', 'Piso', '(lz2712), Ingresó al Módulo de Piso', '2025-05-20', '23:25:09'),
(408, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-21', '13:21:14'),
(409, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '13:21:22'),
(410, 'lz2712', 'Solicitud', '(lz2712), error al enviar la solicitud', '2025-05-21', '13:21:29'),
(411, 'lz2712', 'Solicitud', '(lz2712), error al enviar la solicitud', '2025-05-21', '13:21:56'),
(412, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '13:23:32'),
(413, 'lz2712', 'Solicitud', '(lz2712), error al enviar la solicitud', '2025-05-21', '13:28:57'),
(414, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-21', '14:36:39'),
(415, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:08:30'),
(416, 'lz2712', 'Solicitud', '(lz2712), error al enviar la solicitud', '2025-05-21', '15:08:34'),
(417, 'lz2712', 'Solicitud', '(lz2712), error al enviar la solicitud', '2025-05-21', '15:08:43'),
(418, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:09:15'),
(419, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:09:20'),
(420, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:09:46'),
(421, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:09:49'),
(422, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:13:30'),
(423, 'lz2712', 'Solicitud', '(lz2712), error al enviar la solicitud', '2025-05-21', '15:13:34'),
(424, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:13:44'),
(425, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:13:47'),
(426, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:16:40'),
(427, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:16:44'),
(428, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:17:22'),
(429, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:17:30'),
(430, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:34:54'),
(431, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:35:10'),
(432, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:36:04'),
(433, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:37:05'),
(434, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:37:29'),
(435, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:42:29'),
(436, 'lz2712', 'Solicitud', '(lz2712), envió solicitud no válida', '2025-05-21', '15:42:37'),
(437, 'lz2712', 'Bitácora', '(lz2712), Ingresó al módulo de Bitácora', '2025-05-21', '15:42:53'),
(438, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:42:59'),
(439, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '15:46:37'),
(440, 'lz2712', 'Solicitud', '(lz2712), Realizó una solicitud exitosamente', '2025-05-21', '15:47:17'),
(441, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-21', '17:45:26'),
(442, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '17:45:45'),
(443, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '17:49:33'),
(444, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:00:54'),
(445, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:16:11'),
(446, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:16:13'),
(447, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:20:47'),
(448, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:20:48'),
(449, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:29:28'),
(450, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:36:36'),
(451, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:36:39'),
(452, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:38:28'),
(453, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-21', '18:39:13'),
(454, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '18:39:16'),
(455, 'lz2712', 'Solicitudes', '(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-21', '18:39:20'),
(456, 'lz2712', 'Login/Usuario', '(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-22', '11:18:05'),
(457, 'lz2712', 'Dashboard', '(lz2712), Ingresó al Módulo de Dashboard', '2025-05-22', '11:18:13'),
(458, 'lz2712', 'Dashboard', '(lz2712), Ingresó al Módulo de Dashboard', '2025-05-22', '11:18:27'),
(459, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '11:19:15'),
(460, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '11:31:55'),
(461, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '11:52:31'),
(462, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '11:52:35'),
(463, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:11:35'),
(464, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:12:56'),
(465, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:14:58'),
(466, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:17:20'),
(467, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:22:15'),
(468, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:23:14'),
(469, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:23:49'),
(470, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:31:24'),
(471, 'lz2712', 'Bien', '(lz2712), Se eliminó un bien', '2025-05-22', '12:31:28'),
(472, 'lz2712', 'Bien', '(lz2712), Se restauró el bien Código: JK2450', '2025-05-22', '12:31:35'),
(473, 'lz2712', 'Bien', '(lz2712), Se eliminó un bien', '2025-05-22', '12:31:43'),
(474, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:32:06'),
(475, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:36:33'),
(476, 'lz2712', 'Bien', '(lz2712), Se restauró el bien Código: JK2450', '2025-05-22', '12:36:38'),
(477, 'lz2712', 'Equipo', '(lz2712), Ingresó al Módulo de Equipos', '2025-05-22', '12:37:04'),
(478, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '12:37:08'),
(479, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '14:22:29'),
(480, 'lz2712', 'Bien', '(lz2712), Ingresó al Módulo de Bienes', '2025-05-22', '15:07:57'),
(481, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:22:59'),
(482, 'lz2712', 'Empleado', '(lz2712), Ingresó al Módulo de Empleado', '2025-05-22', '15:24:31'),
(483, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:26:51'),
(484, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:26:59'),
(485, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:27:56'),
(486, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:28:29'),
(487, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:44:57'),
(488, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '15:45:34'),
(489, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:04:37'),
(490, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:15:26'),
(491, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:15:27'),
(492, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:18:03'),
(493, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:18:09'),
(494, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:18:25'),
(495, 'lz2712', 'Ente', '(lz2712), envió solicitud no válida', '2025-05-22', '16:19:13'),
(496, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:20:06'),
(497, 'lz2712', 'Ente', '(lz2712), envió solicitud no válida', '2025-05-22', '16:20:42'),
(498, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:21:05'),
(499, 'lz2712', 'Ente', '(lz2712), error al registrar un nuevo ente', '2025-05-22', '16:21:36'),
(500, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:40:01'),
(501, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:41:54'),
(502, 'lz2712', 'Ente', '(lz2712), error al registrar un nuevo ente', '2025-05-22', '16:43:47'),
(503, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:47:15'),
(504, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:47:21'),
(505, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:48:14'),
(506, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '16:56:53'),
(507, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:04:33'),
(508, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:07:22'),
(509, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:10:03'),
(510, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:12:34'),
(511, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:12:36'),
(512, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:12:48'),
(513, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:15:07'),
(514, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:16:12'),
(515, 'lz2712', 'Ente', '(lz2712), error al modificar Ente', '2025-05-22', '17:17:55'),
(516, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:18:52'),
(517, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:20:45'),
(518, 'lz2712', 'Ente', '(lz2712), error al eliminar un Ente', '2025-05-22', '17:20:54'),
(519, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:20:59'),
(520, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:21:54'),
(521, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:22:36'),
(522, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:23:35'),
(523, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:27:58'),
(524, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:28:00'),
(525, 'lz2712', 'Ente', '(lz2712), error al eliminar un Ente', '2025-05-22', '17:28:09'),
(526, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:28:49'),
(527, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:29:15'),
(528, 'lz2712', 'Ente', '(lz2712), Se eliminó un Ente', '2025-05-22', '17:29:26'),
(529, 'lz2712', 'Ente', '(lz2712), error al modificar Ente', '2025-05-22', '17:30:07'),
(530, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:30:39'),
(531, 'lz2712', 'Ente', '(lz2712), error al modificar Ente', '2025-05-22', '17:31:10'),
(532, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:32:22'),
(533, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:32:27'),
(534, 'lz2712', 'Ente', '(lz2712), Se modificó el registro del Ente', '2025-05-22', '17:32:40'),
(535, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '17:33:47'),
(536, 'lz2712', 'Ente', '(lz2712), Se modificó el registro del Ente', '2025-05-22', '18:17:31'),
(537, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '18:52:17'),
(538, 'lz2712', 'Ente', '(lz2712), Ingresó al Módulo de Ente', '2025-05-22', '19:23:17'),
(539, 'cabrerajorge', 'Notificaciones', '(cabrerajorge), Ingresó al módulo de Notificaciones', '2025-05-29', '00:31:12'),
(540, 'cabrerajorge', 'Notificaciones', '(cabrerajorge), Ingresó al módulo de Notificaciones', '2025-05-29', '00:34:04'),
(541, 'cabrerajorge', 'Notificaciones', '(cabrerajorge), Ingresó al módulo de Notificaciones', '2025-05-29', '00:34:09'),
(542, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:34:11'),
(543, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '00:36:20'),
(544, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:36:29'),
(545, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:36:57'),
(546, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:37:42'),
(547, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '00:37:53'),
(548, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:39:17'),
(549, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:39:31'),
(550, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:39:34'),
(551, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:44:33'),
(552, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '00:44:47'),
(553, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '04:54:20'),
(554, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:05:44'),
(555, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:09:13'),
(556, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:09:20'),
(557, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Ingresó al Módulo de Solicitud', '2025-05-29', '05:09:31');
INSERT INTO `bitacora` (`id_bitacora`, `usuario`, `modulo`, `accion_bitacora`, `fecha`, `hora`) VALUES
(558, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:09:37'),
(559, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:12:23'),
(560, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:12:52'),
(561, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:12:54'),
(562, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:15:46'),
(563, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:16:01'),
(564, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:16:02'),
(565, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:16:22'),
(566, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:16:30'),
(567, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:16:46'),
(568, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:16:50'),
(569, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:18:54'),
(570, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:18:57'),
(571, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:21:23'),
(572, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:21:27'),
(573, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:21:34'),
(574, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:21:35'),
(575, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:21:36'),
(576, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:21:39'),
(577, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:22:23'),
(578, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:22:36'),
(579, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:22:42'),
(580, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:24:23'),
(581, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:24:29'),
(582, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:24:53'),
(583, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:24:57'),
(584, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:25:56'),
(585, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:26:00'),
(586, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:26:03'),
(587, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:26:24'),
(588, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:26:28'),
(589, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:26:30'),
(590, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:26:34'),
(591, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:27:00'),
(592, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:27:36'),
(593, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:27:41'),
(594, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:27:44'),
(595, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:27:48'),
(596, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:29:09'),
(597, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:29:14'),
(598, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:29:16'),
(599, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:29:20'),
(600, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:29:26'),
(601, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:29:45'),
(602, 'cabrerajorge', 'Solicitud', '(cabrerajorge), error al enviar la solicitud', '2025-05-29', '05:29:49'),
(603, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:29:51'),
(604, 'cabrerajorge', 'Solicitud', '(cabrerajorge), error al enviar la solicitud', '2025-05-29', '05:29:55'),
(605, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:30:01'),
(606, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:31:55'),
(607, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:32:01'),
(608, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:32:13'),
(609, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:32:20'),
(610, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:32:22'),
(611, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:32:31'),
(612, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:33:41'),
(613, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:33:42'),
(614, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:33:42'),
(615, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:33:46'),
(616, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:33:51'),
(617, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:34:02'),
(618, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Ingresó al Módulo de Solicitud', '2025-05-29', '05:34:09'),
(619, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Ingresó al Módulo de Solicitud', '2025-05-29', '05:34:46'),
(620, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:34:49'),
(621, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:34:50'),
(622, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:34:56'),
(623, 'cabrerajorge', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-29', '05:35:06'),
(624, 'cabrerajorge', 'Solicitud', '(cabrerajorge), Realizó una solicitud exitosamente', '2025-05-29', '05:35:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre_modulo` varchar(45) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `modulo` varchar(45) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Nuevo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `accion_permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'TECNICO'),
(3, 'SOLICITANTE'),
(4, 'SECRETARIA'),
(5, 'SUPERUSUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombres` varchar(65) NOT NULL,
  `apellidos` varchar(65) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(128) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `cedula`, `id_rol`, `nombres`, `apellidos`, `telefono`, `correo`, `clave`, `foto`) VALUES
('cabrerajorge', 'V-31843937', 5, 'Jorge', 'Cabrera', '0424-5567016', 'cabrerajorge2003@gmail.com', '$2y$10$1vXPHPs29V2T.1HVvUHXn.rzC3KfFwxTXbnosxiJRJEWA4ZATIEBm', ''),
('frank30', 'V-30454597', 1, 'Frankling', 'Fonseca', '0424-5041921', 'ranklinjavierfonsecavasquez@gmail.com', '$2y$10$d64FtFMmW8sTyuiKyxD52eN0q9vdBEglqAbOJXUzw80aRB3/uko7K', ''),
('lz2712', 'V-30266398', 1, 'Leizer', 'Torrealba', '0416-0506544', 'leizeraponte2020@gmail.com', '$2y$10$sONqWv4yy5PEeePKYljGXOLjFuJa1lMz9yua.3cMVAHG4hU.75Jpe', 'assets/img/foto-perfil/V-30266398.png'),
('mari14', 'V-30587785', 1, 'Mariangel', 'Bokor', '0424-5319088', 'bokorarcangel447@gmail.com', '$2y$10$nMQ5inBjrq6FeZbt8sTQk.9Mkx4c.H93TVw.39zCiC3ovXCZoqyaa', ''),
('maria123', 'V-21140325', 1, 'Felix', 'Mujica', '0400-0000000', 'ejemplo@gmail.com', '12345', ''),
('root', 'V-1234567', 1, 'root', 'admin', '0000-0000000', 'prueba@gmail.com', '123', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `cedula_2` (`cedula`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=625;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
