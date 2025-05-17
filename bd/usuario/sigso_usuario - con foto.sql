-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 00:42:52
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
(168, '', 'Bitácora', '(cabrerajorge), Ingresó al módulo de Bitácora', '2025-05-15', '18:43:32'),
(169, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:43:46'),
(170, '', 'Edificio', '(cabrerajorge), Ingresó al Módulo de Edificio', '2025-05-15', '18:44:01'),
(171, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:44:03'),
(172, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:45:29'),
(173, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:45:38'),
(174, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:45:53'),
(175, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:47:21'),
(176, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '18:47:33'),
(177, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:52:23'),
(178, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '18:55:11'),
(179, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '18:56:55'),
(180, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '18:57:55'),
(181, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '19:07:35'),
(182, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '19:09:01'),
(183, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '19:09:06'),
(184, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '19:09:08'),
(185, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '19:09:10'),
(186, '', 'Cargo', '(cabrerajorge), Se registró un nuevo cargo', '2025-05-15', '19:09:23'),
(187, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '19:12:50'),
(188, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '19:15:39'),
(189, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '19:16:47'),
(190, '', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-15', '19:25:58'),
(191, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '19:26:04'),
(192, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '19:31:51'),
(193, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '20:33:18'),
(194, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '20:38:41'),
(195, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '20:39:53'),
(196, '', 'Edificio', '(cabrerajorge), Ingresó al Módulo de Edificio', '2025-05-15', '21:43:27'),
(197, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:43:31'),
(198, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '21:43:50'),
(199, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:43:59'),
(200, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:47:17'),
(201, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:47:20'),
(202, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:47:23'),
(203, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:47:23'),
(204, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:47:24'),
(205, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:47:42'),
(206, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '21:49:18'),
(207, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '21:49:20'),
(208, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:49:21'),
(209, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '21:49:33'),
(210, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:51:09'),
(211, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '21:51:15'),
(212, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:51:47'),
(213, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '21:51:53'),
(214, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '21:54:09'),
(215, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '21:56:36'),
(216, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '21:58:47'),
(217, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:03'),
(218, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '22:02:07'),
(219, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:19'),
(220, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:20'),
(221, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '22:02:24'),
(222, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:27'),
(223, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:28'),
(224, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:28'),
(225, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:29'),
(226, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:30'),
(227, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:30'),
(228, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:31'),
(229, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:31'),
(230, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:32'),
(231, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:02:34'),
(232, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:03:09'),
(233, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:03:10'),
(234, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '22:03:13'),
(235, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:03:19'),
(236, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '22:04:17'),
(237, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:05:10'),
(238, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:05:13'),
(239, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:06:24'),
(240, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:06:27'),
(241, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:08:32'),
(242, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:10:01'),
(243, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:10:04'),
(244, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:10:07'),
(245, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:10:09'),
(246, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:10:29'),
(247, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '22:11:34'),
(248, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:11:35'),
(249, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:11:39'),
(250, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:12:05'),
(251, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:12:26'),
(252, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:12:31'),
(253, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:07'),
(254, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:08'),
(255, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:09'),
(256, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:10'),
(257, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:11'),
(258, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:12'),
(259, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:13:20'),
(260, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:13'),
(261, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:17'),
(262, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:44'),
(263, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:47'),
(264, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:49'),
(265, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:58'),
(266, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:14:59'),
(267, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:15:00'),
(268, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:15:09'),
(269, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:15:10'),
(270, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:16:12'),
(271, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:16:14'),
(272, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:16:17'),
(273, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:16:38'),
(274, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:16:39'),
(275, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:16:58'),
(276, '', 'Oficina', '(cabrerajorge), error al eliminar una oficina', '2025-05-15', '22:17:04'),
(277, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:17:26'),
(278, '', 'Oficina', '(cabrerajorge), error al eliminar una oficina', '2025-05-15', '22:18:11'),
(279, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:18:53'),
(280, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:18:58'),
(281, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:19:15'),
(282, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:19:18'),
(283, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:19:22'),
(284, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:19:31'),
(285, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:19:34'),
(286, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:20:08'),
(287, '', 'Oficina', '(cabrerajorge), error al registrar una nueva oficina', '2025-05-15', '22:20:12'),
(288, '', 'Oficina', '(cabrerajorge), error al modificar oficina', '2025-05-15', '22:20:21'),
(289, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:20:56'),
(290, '', 'Oficina', '(cabrerajorge), Se registró una nueva oficina', '2025-05-15', '22:21:00'),
(291, '', 'Oficina', '(cabrerajorge), Se eliminó una oficina', '2025-05-15', '22:21:11'),
(292, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:21:24'),
(293, '', 'Oficina', '(cabrerajorge), Se modificó el registro de la oficina', '2025-05-15', '22:21:34'),
(294, '', 'Oficina', '(cabrerajorge), Se modificó el registro de la oficina', '2025-05-15', '22:21:38'),
(295, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:22:21'),
(296, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:22:59'),
(297, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:23:09'),
(298, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:25:31'),
(299, '', 'Oficina', '(cabrerajorge), Se restauró la oficina ID: 2', '2025-05-15', '22:25:39'),
(300, '', 'Oficina', '(cabrerajorge), Se eliminó una oficina', '2025-05-15', '22:25:47'),
(301, '', 'Oficina', '(cabrerajorge), Se eliminó una oficina', '2025-05-15', '22:25:50'),
(302, '', 'Oficina', '(cabrerajorge), Se restauró la oficina ID: 2', '2025-05-15', '22:25:56'),
(303, '', 'Oficina', '(cabrerajorge), Se restauró la oficina ID: 1', '2025-05-15', '22:25:59'),
(304, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:32:37'),
(305, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '22:32:45'),
(306, '', 'Material', '(cabrerajorge), Ingresó al Módulo de Materiales', '2025-05-15', '22:32:48'),
(307, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:33:01'),
(308, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '22:33:43'),
(309, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '22:34:40'),
(310, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '22:34:41'),
(311, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '22:34:44'),
(312, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '22:35:06'),
(313, '', 'TipoBien', '(cabrerajorge), Ingresó al Módulo de Tipos de Bien', '2025-05-15', '22:46:52'),
(314, '', 'TipoBien', '(cabrerajorge), Ingresó al Módulo de Tipos de Bien', '2025-05-15', '22:48:15'),
(315, '', 'TipoBien', '(cabrerajorge), Ingresó al Módulo de Tipos de Bien', '2025-05-15', '22:48:17'),
(316, '', 'TipoBien', '(cabrerajorge), Se registró un nuevo tipo de bien', '2025-05-15', '22:48:30'),
(317, '', 'TipoBien', '(cabrerajorge), Se modificó el registro del tipo de bien', '2025-05-15', '22:48:35'),
(318, '', 'TipoBien', '(cabrerajorge), Se eliminó un tipo de bien', '2025-05-15', '22:48:41'),
(319, '', 'TipoBien', '(cabrerajorge), Se restauró el tipo de bien ID: 1', '2025-05-15', '22:48:45'),
(320, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '22:48:50'),
(321, '', 'Bien', '(cabrerajorge), Se registró un nuevo bien', '2025-05-15', '22:49:01'),
(322, '', 'Bien', '(cabrerajorge), Se eliminó un bien', '2025-05-15', '22:50:03'),
(323, '', 'Bien', '(cabrerajorge), Se restauró el bien Código: 102', '2025-05-15', '22:50:06'),
(324, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '22:51:00'),
(325, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '22:57:09'),
(326, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '22:57:19'),
(327, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:57:22'),
(328, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '22:57:26'),
(329, NULL, 'Oficina', '(), Ingresó al Módulo de Oficina', '2025-05-15', '23:23:38'),
(330, NULL, 'Oficina', '(), Ingresó al Módulo de Oficina', '2025-05-15', '23:23:41'),
(331, NULL, 'Oficina', '(), Ingresó al Módulo de Oficina', '2025-05-15', '23:23:43'),
(332, NULL, 'Solicitudes', '(), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-15', '23:24:02'),
(333, '', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-15', '23:24:13'),
(334, '', 'Solicitudes', '(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios', '2025-05-15', '23:24:15'),
(335, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:25:37'),
(336, '', 'Oficina', '(cabrerajorge), Se registró una nueva oficina', '2025-05-15', '23:25:54'),
(337, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:28:47'),
(338, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:37'),
(339, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:38'),
(340, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:39'),
(341, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:39'),
(342, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:40'),
(343, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:41'),
(344, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:46'),
(345, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:46'),
(346, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:29:47'),
(347, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:30:34'),
(348, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:30:35'),
(349, '', 'Piso', '(cabrerajorge), Ingresó al Módulo de Piso', '2025-05-15', '23:30:37'),
(350, '', 'Edificio', '(cabrerajorge), Ingresó al Módulo de Edificio', '2025-05-15', '23:30:41'),
(351, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-15', '23:30:45'),
(352, '', 'Oficina', '(cabrerajorge), Se modificó el registro de la oficina', '2025-05-15', '23:30:51'),
(353, '', 'Oficina', '(cabrerajorge), Se eliminó una oficina', '2025-05-15', '23:31:54'),
(354, '', 'Bien', '(cabrerajorge), Ingresó al Módulo de Bienes', '2025-05-15', '23:50:31'),
(355, '', 'Bien', '(cabrerajorge), error al registrar un nuevo bien', '2025-05-15', '23:50:45'),
(356, '', 'Bien', '(cabrerajorge), Se registró un nuevo bien', '2025-05-15', '23:51:06'),
(357, '', 'Bien', '(cabrerajorge), Se eliminó un bien', '2025-05-15', '23:51:21'),
(358, '', 'Bien', '(cabrerajorge), Se restauró el bien Código: 213', '2025-05-15', '23:52:08'),
(359, '', 'TipoBien', '(cabrerajorge), Ingresó al Módulo de Tipos de Bien', '2025-05-15', '23:52:53'),
(360, '', 'TipoBien', '(cabrerajorge), Se eliminó un tipo de bien', '2025-05-15', '23:52:59'),
(361, '', 'TipoBien', '(cabrerajorge), Se restauró el tipo de bien ID: 1', '2025-05-15', '23:53:02'),
(362, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:04:28'),
(363, '', 'TipoBien', '(cabrerajorge), Ingresó al Módulo de Tipos de Bien', '2025-05-16', '00:05:33'),
(364, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:05:36'),
(365, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:05:36'),
(366, '', 'Equipo', '(cabrerajorge), Se registró un nuevo equipo', '2025-05-16', '00:05:43'),
(367, '', 'Equipo', '(cabrerajorge), Se eliminó un equipo', '2025-05-16', '00:05:46'),
(368, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:06:57'),
(369, '', 'Equipo', '(cabrerajorge), Se registró un nuevo equipo', '2025-05-16', '00:07:03'),
(370, '', 'Equipo', '(cabrerajorge), error al eliminar un equipo', '2025-05-16', '00:07:07'),
(371, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:11:34'),
(372, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:11:36'),
(373, '', 'Equipo', '(cabrerajorge), Se eliminó un equipo', '2025-05-16', '00:11:42'),
(374, '', 'Equipo', '(cabrerajorge), Se eliminó un equipo', '2025-05-16', '00:11:46'),
(375, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:12:11'),
(376, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:12:12'),
(377, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:12:33'),
(378, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:12:37'),
(379, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:13:25'),
(380, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:13:28'),
(381, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:13:34'),
(382, '', 'Equipo', '(cabrerajorge), Se registró un nuevo equipo', '2025-05-16', '00:13:42'),
(383, '', 'Equipo', '(cabrerajorge), Se modificó el registro del equipo', '2025-05-16', '00:15:20'),
(384, '', 'Equipo', '(cabrerajorge), Ingresó al Módulo de Equipos', '2025-05-16', '00:15:25'),
(385, '', 'Equipo', '(cabrerajorge), Se modificó el registro del equipo', '2025-05-16', '00:15:38'),
(386, '', 'Material', '(cabrerajorge), Ingresó al Módulo de Materiales', '2025-05-16', '00:25:36'),
(387, '', 'Material', '(cabrerajorge), Ingresó al Módulo de Materiales', '2025-05-16', '00:25:58'),
(388, '', 'Material', '(cabrerajorge), Ingresó al Módulo de Materiales', '2025-05-16', '00:26:01'),
(389, '', 'Backup', '(cabrerajorge), Se generó un nuevo backup', '2025-05-16', '00:26:08'),
(390, '', 'Backup', '(cabrerajorge), Se eliminó un backup', '2025-05-16', '00:26:52'),
(391, '', 'Oficina', '(cabrerajorge), Ingresó al Módulo de Oficina', '2025-05-16', '00:28:31'),
(392, '', 'Oficina', '(cabrerajorge), Se restauró la oficina ID: 3', '2025-05-16', '00:30:00'),
(393, '', 'Login/Usuario', '(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña', '2025-05-17', '17:24:32');

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
('', 'V-31843937', 5, 'Jorge', 'Cabrera', '0424-5567016', 'cabrerajorge2003@gmail.com', '$2y$10$1vXPHPs29V2T.1HVvUHXn.rzC3KfFwxTXbnosxiJRJEWA4ZATIEBm', 'assets/img/foto-perfil/V-31843937.png'),
('frank30', 'V-30454597', 1, 'Frankling', 'Fonseca', '0424-5041921', 'ranklinjavierfonsecavasquez@gmail.com', '$2y$10$d64FtFMmW8sTyuiKyxD52eN0q9vdBEglqAbOJXUzw80aRB3/uko7K', ''),
('lz2712', 'V-30266398', 1, 'Leizer', 'Torrealba', '0416-0506544', 'leizeraponte2020@gmail.com', '$2y$10$sONqWv4yy5PEeePKYljGXOLjFuJa1lMz9yua.3cMVAHG4hU.75Jpe', ''),
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
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

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
