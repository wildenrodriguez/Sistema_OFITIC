-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sigso_usuario
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `sigso_usuario`
--

/*!40000 DROP DATABASE IF EXISTS `sigso_usuario`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sigso_usuario` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `sigso_usuario`;

--
-- Table structure for table `bien`
--

DROP TABLE IF EXISTS `bien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bien` (
  `codigo_bien` varchar(20) NOT NULL,
  `id_tipo_bien` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  `cedula_empleado` varchar(12) DEFAULT NULL,
  `id_oficina` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`codigo_bien`),
  KEY `id_tipo_bien` (`id_tipo_bien`),
  KEY `cedula_empleado` (`cedula_empleado`),
  KEY `id_marca` (`id_marca`),
  KEY `id_oficina` (`id_oficina`),
  CONSTRAINT `bien_ibfk_1` FOREIGN KEY (`cedula_empleado`) REFERENCES `empleado` (`cedula_empleado`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `bien_ibfk_4` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `bien_ibfk_5` FOREIGN KEY (`id_tipo_bien`) REFERENCES `tipo_bien` (`id_tipo_bien`) ON UPDATE CASCADE,
  CONSTRAINT `bien_ibfk_6` FOREIGN KEY (`id_oficina`) REFERENCES `oficina` (`id_oficina`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bien`
--

LOCK TABLES `bien` WRITE;
/*!40000 ALTER TABLE `bien` DISABLE KEYS */;
INSERT INTO `bien` VALUES ('213',1,2,'asd','Usado','V-1234567',3,1),('JK2450',1,3,'Ejemplo','Usado','V-30587785',2,1);
/*!40000 ALTER TABLE `bien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `modulo` varchar(45) NOT NULL,
  `accion_bitacora` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=748 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:14:38'),(2,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:15:11'),(3,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:15:37'),(4,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:16:43'),(5,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','18:17:47'),(6,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','18:18:56'),(7,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:19:06'),(8,'lz2712','Edificio','(lz2712), Ingresó al Módulo de Edificio','2025-05-15','18:21:19'),(9,'lz2712','Edificio','(lz2712), Ingresó al Módulo de Edificio','2025-05-15','18:28:14'),(10,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:28:17'),(11,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:28:27'),(12,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:41:52'),(13,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','18:45:37'),(14,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','19:33:07'),(15,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','19:33:14'),(16,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','20:31:40'),(17,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:22:33'),(18,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:23:38'),(19,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:24:16'),(20,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:24:28'),(21,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:25:36'),(22,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:26:42'),(23,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:27:23'),(24,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:27:27'),(25,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:37:32'),(26,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:52:37'),(27,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:54:20'),(28,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:55:53'),(29,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:56:45'),(30,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','21:56:53'),(31,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','22:06:10'),(32,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','22:06:58'),(33,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','22:07:07'),(34,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','22:08:17'),(35,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','22:08:22'),(36,'lz2712','Cargo','(lz2712), Se registró un nuevo cargo','2025-05-15','22:08:48'),(37,'lz2712','Cargo','(lz2712), Se registró un nuevo cargo','2025-05-15','22:20:04'),(38,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','22:29:15'),(39,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-15','22:31:51'),(40,'lz2712','Marca','(lz2712), Ingresó al Módulo de Marca','2025-05-15','22:32:51'),(41,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','22:33:12'),(42,'lz2712','Edificio','(lz2712), Ingresó al Módulo de Edificio','2025-05-15','22:33:35'),(43,'lz2712','Cargo','(lz2712), Se modificó el registro del cargo','2025-05-15','22:35:17'),(44,'lz2712','Cargo','(lz2712), Se eliminó un cargo','2025-05-15','22:35:22'),(45,'lz2712','Material','(lz2712), Ingresó al Módulo de Materiales','2025-05-15','22:45:06'),(46,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','22:45:08'),(47,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-15','22:52:21'),(48,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','23:01:57'),(49,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:02:13'),(50,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:10:13'),(51,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:11:06'),(52,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:11:06'),(53,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:11:45'),(54,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:14:51'),(55,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:15:26'),(56,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-15','23:15:43'),(57,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:16:41'),(58,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-15','23:16:48'),(59,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','23:22:50'),(60,'lz2712','Oficina','(lz2712), Se registró una nueva oficina','2025-05-15','23:23:01'),(61,'lz2712','Oficina','(lz2712), Se registró una nueva oficina','2025-05-15','23:23:42'),(62,'lz2712','Oficina','(lz2712), Se registró una nueva oficina','2025-05-15','23:24:08'),(63,'lz2712','Oficina','(lz2712), Se registró una nueva oficina','2025-05-15','23:28:19'),(64,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','23:28:26'),(65,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','23:31:21'),(66,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:31:25'),(67,'lz2712','Piso','(lz2712), error al modificar piso','2025-05-15','23:31:37'),(68,'lz2712','Piso','(lz2712), error al modificar piso','2025-05-15','23:32:25'),(69,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:32:58'),(70,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:32:59'),(71,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:33:53'),(72,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:33:59'),(73,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:34:55'),(74,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-15','23:35:30'),(75,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:36:38'),(76,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-15','23:36:53'),(77,'lz2712','Piso','(lz2712), Se eliminó un piso','2025-05-15','23:36:58'),(78,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:45:22'),(79,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-15','23:50:34'),(80,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-15','23:50:39'),(81,'lz2712','Edificio','(lz2712), Ingresó al Módulo de Edificio','2025-05-15','23:51:15'),(82,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-15','23:51:22'),(83,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-15','23:51:26'),(84,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-15','23:52:39'),(85,'lz2712','TipoBien','(lz2712), Ingresó al Módulo de Tipos de Bien','2025-05-15','23:52:57'),(86,'lz2712','TipoBien','(lz2712), Se registró un nuevo tipo de bien','2025-05-15','23:53:08'),(87,'lz2712','TipoBien','(lz2712), Se registró un nuevo tipo de bien','2025-05-15','23:53:14'),(88,'lz2712','TipoBien','(lz2712), Se modificó el registro del tipo de bien','2025-05-15','23:53:27'),(89,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-15','23:53:36'),(90,'lz2712','Bien','(lz2712), Se registró un nuevo bien','2025-05-15','23:54:33'),(91,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-16','00:18:49'),(92,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-16','00:18:56'),(93,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-16','00:19:47'),(94,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-16','00:23:06'),(95,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-16','00:23:52'),(96,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-17','20:09:10'),(97,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','20:18:30'),(98,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-17','20:31:28'),(99,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:44:31'),(100,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:44:57'),(101,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:45:05'),(102,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:45:09'),(103,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:45:16'),(104,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:45:55'),(105,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:46:00'),(106,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:46:06'),(107,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:46:15'),(108,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:46:18'),(109,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:46:23'),(110,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-17','21:46:44'),(111,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:46:53'),(112,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:47:05'),(113,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:47:09'),(114,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:47:11'),(115,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-17','21:48:35'),(116,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:52:20'),(117,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:52:32'),(118,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:54:35'),(119,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:54:37'),(120,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:54:43'),(121,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','21:54:55'),(122,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:00:03'),(123,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:00:05'),(124,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:03:16'),(125,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:06:00'),(158,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-17','22:47:34'),(159,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:47:42'),(166,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-17','22:50:48'),(167,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:51:03'),(168,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:51:08'),(169,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:51:51'),(170,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:54:04'),(171,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:56:21'),(172,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:56:23'),(173,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:58:27'),(174,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-17','22:59:55'),(175,'lz2712','Material','(lz2712), Ingresó al Módulo de Materiales','2025-05-17','23:00:09'),(176,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-17','23:00:13'),(177,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-18','13:35:01'),(178,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-18','13:35:11'),(179,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-18','13:35:15'),(180,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-18','13:35:19'),(181,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-18','13:35:23'),(182,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-18','13:35:26'),(183,'lz2712','Material','(lz2712), Ingresó al Módulo de Materiales','2025-05-18','13:35:32'),(184,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-18','13:35:33'),(185,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-18','13:35:45'),(186,'lz2712','Material','(lz2712), Ingresó al Módulo de Materiales','2025-05-18','13:36:32'),(187,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-18','13:36:35'),(188,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-18','13:37:03'),(189,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-18','13:37:24'),(190,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-18','13:37:37'),(191,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','13:38:51'),(192,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','13:41:20'),(193,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','13:41:32'),(194,'lz2712','Edificio','(lz2712), Ingresó al Módulo de Edificio','2025-05-18','17:53:54'),(195,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','17:54:54'),(196,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','17:55:20'),(197,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','17:56:04'),(198,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','17:58:05'),(199,'lz2712','Unidad','(lz2712), error al registrar un nuevo unidad','2025-05-18','17:58:21'),(200,'lz2712','Unidad','(lz2712), error al registrar un nuevo unidad','2025-05-18','18:00:38'),(201,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:01:20'),(202,'lz2712','Unidad','(lz2712), Se registró un nuevo unidad','2025-05-18','18:01:27'),(203,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:01:36'),(204,'lz2712','Unidad','(lz2712), Se registró un nuevo unidad','2025-05-18','18:02:26'),(205,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:05:57'),(206,'lz2712','Unidad','(lz2712), Se registró un nuevo unidad','2025-05-18','18:06:35'),(207,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-18','18:07:53'),(208,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-18','18:08:10'),(209,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-18','18:08:36'),(210,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:10:09'),(211,'lz2712','Unidad','(lz2712), Se modificó el registro del unidad','2025-05-18','18:10:15'),(212,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:11:23'),(213,'lz2712','Unidad','(lz2712), Se modificó el registro del unidad','2025-05-18','18:11:25'),(214,'lz2712','Unidad','(lz2712), Se eliminó un unidad','2025-05-18','18:11:31'),(215,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:51:40'),(216,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:51:46'),(217,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:56:40'),(218,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:56:42'),(219,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:57:17'),(220,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:57:22'),(221,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:57:46'),(222,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:57:48'),(223,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:58:43'),(224,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','18:59:46'),(225,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:00:33'),(226,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:06:16'),(227,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:06:20'),(228,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:07:15'),(229,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:07:20'),(230,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:11:51'),(231,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:12:17'),(232,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:13:36'),(233,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:13:37'),(234,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:13:45'),(235,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:14:00'),(236,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:14:19'),(237,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:14:31'),(238,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:14:35'),(239,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:15:07'),(240,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:16:40'),(241,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:23:17'),(242,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:23:21'),(243,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-18','19:23:39'),(244,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-19','13:41:17'),(245,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','14:04:06'),(246,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-19','14:07:14'),(247,'lz2712','Rol y Permiso','(lz2712), Ingresó al Módulo de Roles y Permisos','2025-05-19','14:22:33'),(248,'lz2712','Rol y Permiso','(lz2712), Ingresó al Módulo de Roles y Permisos','2025-05-19','14:22:47'),(249,'lz2712','Rol y Permiso','(lz2712), Ingresó al Módulo de Roles y Permisos','2025-05-19','14:24:14'),(250,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:25:57'),(251,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:33:09'),(252,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:33:12'),(253,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:36:24'),(254,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:36:30'),(255,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:37:24'),(256,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:44:47'),(257,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:44:51'),(258,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:45:36'),(259,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:45:40'),(260,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:45:50'),(261,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:46:21'),(262,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:48:51'),(263,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:52:23'),(264,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:52:35'),(265,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:53:13'),(266,'lz2712','Oficina','(lz2712), Se modificó el registro de la oficina','2025-05-19','14:53:25'),(267,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','14:55:49'),(268,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','15:10:49'),(269,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','15:17:15'),(270,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:17:25'),(271,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:20:49'),(272,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:23:31'),(273,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:23:34'),(274,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:23:48'),(275,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:23:50'),(276,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:24:47'),(277,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:24:51'),(278,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:25:32'),(279,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:25:59'),(280,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:26:44'),(281,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:28:01'),(282,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:28:05'),(283,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:30:04'),(284,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:30:12'),(285,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:30:41'),(286,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:33:10'),(287,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:46:29'),(288,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','15:46:35'),(289,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-19','15:46:43'),(290,'lz2712','Oficina','(lz2712), Se registró una nueva oficina','2025-05-19','15:47:22'),(291,'lz2712','Oficina','(lz2712), Se eliminó una oficina','2025-05-19','15:55:27'),(292,'lz2712','Oficina','(lz2712), Se restauró la oficina ID: 1','2025-05-19','15:55:50'),(293,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:05:27'),(294,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:05:29'),(295,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:05:44'),(296,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:07:19'),(297,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:07:42'),(298,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:07:53'),(299,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:08:52'),(300,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:08:58'),(301,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:09:10'),(302,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:09:29'),(303,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:09:36'),(304,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:09:50'),(305,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','16:10:12'),(306,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','16:10:17'),(307,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','16:10:25'),(308,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','16:10:29'),(309,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:10:44'),(310,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:12:30'),(311,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:13:02'),(312,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:13:07'),(313,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:13:37'),(314,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:21:56'),(315,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:22:14'),(316,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:22:26'),(317,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','16:22:37'),(318,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:23:07'),(319,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:23:09'),(320,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:23:16'),(321,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:28:33'),(322,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:28:47'),(323,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:33:29'),(324,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:36:12'),(325,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:37:24'),(326,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:39:04'),(327,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:39:08'),(328,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:39:22'),(329,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:40:12'),(330,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:40:14'),(331,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:40:26'),(332,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:41:12'),(333,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:41:57'),(334,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:44:19'),(335,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:44:31'),(336,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:46:06'),(337,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:46:21'),(338,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:47:18'),(339,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:47:56'),(340,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:48:02'),(341,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:49:11'),(342,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','16:49:19'),(343,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','16:49:40'),(344,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:19:18'),(345,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:21:08'),(346,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','17:21:24'),(347,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:22:25'),(348,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','17:22:42'),(349,'lz2712','Piso','(lz2712), Se eliminó un piso','2025-05-19','17:23:01'),(350,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:24:28'),(351,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:24:33'),(352,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:25:42'),(353,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:27:10'),(354,'lz2712','Piso','(lz2712), Se eliminó un piso','2025-05-19','17:27:38'),(355,'lz2712','Piso','(lz2712), Se eliminó un piso','2025-05-19','17:27:49'),(356,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:28:05'),(357,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:28:09'),(358,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:28:56'),(359,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:29:13'),(360,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:29:44'),(361,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:29:45'),(362,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:29:46'),(363,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:39:28'),(364,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:39:31'),(365,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:41:34'),(366,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:41:37'),(367,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:42:16'),(368,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:42:19'),(369,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-19','17:48:51'),(370,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:49:00'),(371,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-19','17:49:42'),(372,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-19','17:49:58'),(373,'lz2712','Piso','(lz2712), Se registró un nuevo piso','2025-05-19','17:51:07'),(374,'lz2712','Piso','(lz2712), Se modificó el registro del piso','2025-05-19','17:51:18'),(375,'lz2712','Piso','(lz2712), Se eliminó un piso','2025-05-19','17:51:34'),(376,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-19','21:34:47'),(377,'lz2712','Usuario','Cerró sesión','2025-05-19','21:41:39'),(378,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-20','00:49:08'),(379,'lz2712','Equipo','(lz2712), Ingresó al Módulo de Equipos','2025-05-20','00:49:54'),(380,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-20','00:50:03'),(381,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-20','00:52:23'),(382,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-20','00:53:10'),(383,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-20','00:54:22'),(384,'lz2712','Unidad','(lz2712), Ingresó al Módulo de Unidad','2025-05-20','00:55:21'),(385,'lz2712','Unidad','(lz2712), Se registró un nuevo unidad','2025-05-20','00:55:33'),(386,'lz2712','Unidad','(lz2712), Se modificó el registro del unidad','2025-05-20','00:56:01'),(387,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','00:58:50'),(388,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','00:59:33'),(389,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-20','01:03:32'),(390,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-20','01:03:42'),(391,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','01:03:47'),(392,'lz2712','Oficina','(lz2712), Ingresó al Módulo de Oficina','2025-05-20','01:03:58'),(393,'lz2712','Oficina','(lz2712), Se eliminó una oficina','2025-05-20','01:04:13'),(394,'lz2712','Oficina','(lz2712), Se restauró la oficina ID: 1','2025-05-20','01:04:42'),(395,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-20','12:44:50'),(396,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','12:44:59'),(397,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','13:13:15'),(398,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','13:14:52'),(399,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','13:17:21'),(400,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','14:38:04'),(401,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','14:40:51'),(402,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','14:42:22'),(403,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','14:42:58'),(404,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','14:44:17'),(405,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-20','14:44:33'),(406,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-20','23:25:03'),(407,'lz2712','Piso','(lz2712), Ingresó al Módulo de Piso','2025-05-20','23:25:09'),(408,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-21','13:21:14'),(409,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','13:21:22'),(410,'lz2712','Solicitud','(lz2712), error al enviar la solicitud','2025-05-21','13:21:29'),(411,'lz2712','Solicitud','(lz2712), error al enviar la solicitud','2025-05-21','13:21:56'),(412,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','13:23:32'),(413,'lz2712','Solicitud','(lz2712), error al enviar la solicitud','2025-05-21','13:28:57'),(414,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-21','14:36:39'),(415,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:08:30'),(416,'lz2712','Solicitud','(lz2712), error al enviar la solicitud','2025-05-21','15:08:34'),(417,'lz2712','Solicitud','(lz2712), error al enviar la solicitud','2025-05-21','15:08:43'),(418,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:09:15'),(419,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:09:20'),(420,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:09:46'),(421,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:09:49'),(422,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:13:30'),(423,'lz2712','Solicitud','(lz2712), error al enviar la solicitud','2025-05-21','15:13:34'),(424,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:13:44'),(425,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:13:47'),(426,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:16:40'),(427,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:16:44'),(428,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:17:22'),(429,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:17:30'),(430,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:34:54'),(431,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:35:10'),(432,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:36:04'),(433,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:37:05'),(434,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:37:29'),(435,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:42:29'),(436,'lz2712','Solicitud','(lz2712), envió solicitud no válida','2025-05-21','15:42:37'),(437,'lz2712','Bitácora','(lz2712), Ingresó al módulo de Bitácora','2025-05-21','15:42:53'),(438,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:42:59'),(439,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','15:46:37'),(440,'lz2712','Solicitud','(lz2712), Realizó una solicitud exitosamente','2025-05-21','15:47:17'),(441,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-21','17:45:26'),(442,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','17:45:45'),(443,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','17:49:33'),(444,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:00:54'),(445,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:16:11'),(446,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:16:13'),(447,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:20:47'),(448,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:20:48'),(449,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:29:28'),(450,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:36:36'),(451,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:36:39'),(452,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:38:28'),(453,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-21','18:39:13'),(454,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','18:39:16'),(455,'lz2712','Solicitudes','(lz2712), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-21','18:39:20'),(456,'lz2712','Login/Usuario','(lz2712), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-22','11:18:05'),(457,'lz2712','Dashboard','(lz2712), Ingresó al Módulo de Dashboard','2025-05-22','11:18:13'),(458,'lz2712','Dashboard','(lz2712), Ingresó al Módulo de Dashboard','2025-05-22','11:18:27'),(459,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','11:19:15'),(460,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','11:31:55'),(461,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','11:52:31'),(462,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','11:52:35'),(463,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:11:35'),(464,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:12:56'),(465,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:14:58'),(466,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:17:20'),(467,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:22:15'),(468,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:23:14'),(469,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:23:49'),(470,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:31:24'),(471,'lz2712','Bien','(lz2712), Se eliminó un bien','2025-05-22','12:31:28'),(472,'lz2712','Bien','(lz2712), Se restauró el bien Código: JK2450','2025-05-22','12:31:35'),(473,'lz2712','Bien','(lz2712), Se eliminó un bien','2025-05-22','12:31:43'),(474,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:32:06'),(475,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:36:33'),(476,'lz2712','Bien','(lz2712), Se restauró el bien Código: JK2450','2025-05-22','12:36:38'),(477,'lz2712','Equipo','(lz2712), Ingresó al Módulo de Equipos','2025-05-22','12:37:04'),(478,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','12:37:08'),(479,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','14:22:29'),(480,'lz2712','Bien','(lz2712), Ingresó al Módulo de Bienes','2025-05-22','15:07:57'),(481,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:22:59'),(482,'lz2712','Empleado','(lz2712), Ingresó al Módulo de Empleado','2025-05-22','15:24:31'),(483,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:26:51'),(484,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:26:59'),(485,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:27:56'),(486,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:28:29'),(487,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:44:57'),(488,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','15:45:34'),(489,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:04:37'),(490,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:15:26'),(491,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:15:27'),(492,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:18:03'),(493,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:18:09'),(494,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:18:25'),(495,'lz2712','Ente','(lz2712), envió solicitud no válida','2025-05-22','16:19:13'),(496,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:20:06'),(497,'lz2712','Ente','(lz2712), envió solicitud no válida','2025-05-22','16:20:42'),(498,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:21:05'),(499,'lz2712','Ente','(lz2712), error al registrar un nuevo ente','2025-05-22','16:21:36'),(500,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:40:01'),(501,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:41:54'),(502,'lz2712','Ente','(lz2712), error al registrar un nuevo ente','2025-05-22','16:43:47'),(503,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:47:15'),(504,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:47:21'),(505,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:48:14'),(506,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','16:56:53'),(507,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:04:33'),(508,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:07:22'),(509,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:10:03'),(510,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:12:34'),(511,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:12:36'),(512,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:12:48'),(513,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:15:07'),(514,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:16:12'),(515,'lz2712','Ente','(lz2712), error al modificar Ente','2025-05-22','17:17:55'),(516,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:18:52'),(517,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:20:45'),(518,'lz2712','Ente','(lz2712), error al eliminar un Ente','2025-05-22','17:20:54'),(519,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:20:59'),(520,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:21:54'),(521,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:22:36'),(522,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:23:35'),(523,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:27:58'),(524,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:28:00'),(525,'lz2712','Ente','(lz2712), error al eliminar un Ente','2025-05-22','17:28:09'),(526,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:28:49'),(527,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:29:15'),(528,'lz2712','Ente','(lz2712), Se eliminó un Ente','2025-05-22','17:29:26'),(529,'lz2712','Ente','(lz2712), error al modificar Ente','2025-05-22','17:30:07'),(530,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:30:39'),(531,'lz2712','Ente','(lz2712), error al modificar Ente','2025-05-22','17:31:10'),(532,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:32:22'),(533,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:32:27'),(534,'lz2712','Ente','(lz2712), Se modificó el registro del Ente','2025-05-22','17:32:40'),(535,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','17:33:47'),(536,'lz2712','Ente','(lz2712), Se modificó el registro del Ente','2025-05-22','18:17:31'),(537,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','18:52:17'),(538,'lz2712','Ente','(lz2712), Ingresó al Módulo de Ente','2025-05-22','19:23:17'),(539,'cabrerajorge','Login/Usuario','(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-25','18:33:14'),(540,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','18:33:19'),(541,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','19:10:48'),(542,'cabrerajorge','Servicio','(cabrerajorge), Ingresó al Módulo de Servicios Técnicos','2025-05-25','20:34:45'),(543,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','20:34:49'),(544,'cabrerajorge','Servicio','(cabrerajorge), Ingresó al Módulo de Servicios Técnicos','2025-05-25','20:35:15'),(545,'cabrerajorge','Servicio','(cabrerajorge), Ingresó al Módulo de Servicios Técnicos','2025-05-25','20:36:09'),(546,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','20:36:20'),(547,'cabrerajorge','Solicitud','(cabrerajorge), Realizó una solicitud exitosamente','2025-05-25','20:36:38'),(548,'cabrerajorge','Solicitud','(cabrerajorge), Ingresó al Módulo de Solicitud','2025-05-25','20:37:00'),(549,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','20:37:11'),(550,'cabrerajorge','Solicitud','(cabrerajorge), Ingresó al Módulo de Solicitud','2025-05-25','20:37:14'),(551,'cabrerajorge','Equipo','(cabrerajorge), Ingresó al Módulo de Equipos','2025-05-25','20:37:56'),(552,'cabrerajorge','Equipo','(cabrerajorge), Se registró un nuevo equipo','2025-05-25','20:38:09'),(553,'cabrerajorge','Bien','(cabrerajorge), Ingresó al Módulo de Bienes','2025-05-25','20:38:17'),(554,'cabrerajorge','Bien','(cabrerajorge), Se registró un nuevo bien','2025-05-25','20:38:36'),(555,'cabrerajorge','Equipo','(cabrerajorge), Ingresó al Módulo de Equipos','2025-05-25','20:38:40'),(556,'cabrerajorge','Equipo','(cabrerajorge), Se modificó el registro del equipo','2025-05-25','20:38:49'),(557,'cabrerajorge','Equipo','(cabrerajorge), Se eliminó un equipo','2025-05-25','20:39:30'),(558,'cabrerajorge','Equipo','(cabrerajorge), Se restauró el equipo ID: 2','2025-05-25','20:39:33'),(559,'cabrerajorge','Usuario','Cerró sesión','2025-05-25','20:50:22'),(560,'cabrerajorge','Login/Usuario','(cabrerajorge), Inició sesión, ingresa al perfil para cambiar contraseña','2025-05-25','20:50:25'),(561,'cabrerajorge','Bitácora','(cabrerajorge), Ingresó al módulo de Bitácora','2025-05-25','20:56:54'),(562,'cabrerajorge','Bitácora','(cabrerajorge), Ingresó al módulo de Bitácora','2025-05-25','20:57:32'),(563,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:02:52'),(564,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','21:03:57'),(565,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:19:45'),(566,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:20:55'),(567,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:21:45'),(568,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:22:17'),(569,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:28:30'),(570,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','21:28:35'),(571,'cabrerajorge','Empleado','(cabrerajorge), Ingresó al Módulo de Empleado','2025-05-25','21:31:58'),(572,'cabrerajorge','Bitácora','(cabrerajorge), Ingresó al módulo de Bitácora','2025-05-25','21:36:44'),(573,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:36:51'),(574,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:37:32'),(575,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:46:34'),(576,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:54:22'),(577,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:54:52'),(578,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:55:05'),(579,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:55:18'),(580,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:55:22'),(581,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:55:25'),(582,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:55:30'),(583,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:55:32'),(584,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:55:34'),(585,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:56:39'),(586,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:56:56'),(587,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:57:22'),(588,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','21:57:24'),(589,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:59:04'),(590,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','21:59:28'),(591,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:00:20'),(592,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:00:32'),(593,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:01:13'),(594,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:01:36'),(595,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:01:54'),(596,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:02:32'),(597,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:44'),(598,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:48'),(599,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:50'),(600,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:52'),(601,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:55'),(602,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:57'),(603,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:02:59'),(604,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:03:02'),(605,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:04:44'),(606,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:05:25'),(607,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:05:40'),(608,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:05:54'),(609,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:05:57'),(610,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:05:59'),(611,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:06:21'),(612,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:06:47'),(613,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:06:52'),(614,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:07:14'),(615,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:07:43'),(616,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:07:48'),(617,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:07:51'),(618,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:07:53'),(619,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:07:56'),(620,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:07:59'),(621,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:08:01'),(622,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:08:02'),(623,'cabrerajorge','Bitácora','(cabrerajorge), Ingresó al módulo de Bitácora','2025-05-25','22:08:34'),(624,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:10:29'),(625,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:11:47'),(626,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:11:50'),(627,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:11:52'),(628,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:11:55'),(629,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:11:58'),(630,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:12:00'),(631,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:12:01'),(632,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:16:05'),(633,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:16:15'),(634,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:16:30'),(635,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:16:35'),(636,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:16:38'),(637,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:16:45'),(638,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:16:47'),(639,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:16:48'),(640,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:19:31'),(641,'cabrerajorge','Servicio','(cabrerajorge), Ingresó al Módulo de Servicios Técnicos','2025-05-25','22:19:52'),(642,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:19:53'),(643,'cabrerajorge','Solicitud','(cabrerajorge), Realizó una solicitud exitosamente','2025-05-25','22:20:02'),(644,'cabrerajorge','Servicio','(cabrerajorge), Ingresó al Módulo de Servicios Técnicos','2025-05-25','22:20:06'),(645,'cabrerajorge','Backup','(cabrerajorge), Se importó un backup','2025-05-25','22:20:20'),(646,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:20:24'),(647,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:20:28'),(648,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:20:31'),(649,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:25:29'),(650,'cabrerajorge','Solicitud','(cabrerajorge), Realizó una solicitud exitosamente','2025-05-25','22:25:39'),(651,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:25:49'),(652,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:25:53'),(653,'cabrerajorge','Solicitud','(cabrerajorge), Realizó una solicitud exitosamente','2025-05-25','22:26:01'),(654,'cabrerajorge','Backup','(cabrerajorge), Se importó un backup','2025-05-25','22:26:19'),(655,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:26:34'),(656,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:26:36'),(657,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:27:19'),(658,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','22:27:23'),(659,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:27:25'),(660,'cabrerajorge','Solicitud','(cabrerajorge), Realizó una solicitud exitosamente','2025-05-25','22:27:29'),(661,'cabrerajorge','Dashboard','(cabrerajorge), Ingresó al Módulo de Dashboard','2025-05-25','22:27:31'),(662,'cabrerajorge','Backup','(cabrerajorge), Se importó un backup','2025-05-25','22:27:48'),(663,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:27:51'),(664,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:29:07'),(665,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:29:23'),(666,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:29:28'),(667,'cabrerajorge','Solicitud','(cabrerajorge), Realizó una solicitud exitosamente','2025-05-25','22:29:38'),(668,'cabrerajorge','Backup','(cabrerajorge), Se importó un backup','2025-05-25','22:29:59'),(669,'cabrerajorge','Solicitudes','(cabrerajorge), Ingresó al módulo de Solicitudes, lugar: Mis servicios','2025-05-25','22:30:04'),(670,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:32:39'),(671,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:32:41'),(672,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:32:42'),(673,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:32:43'),(674,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:43:39'),(675,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:43:41'),(676,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:47:04'),(677,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:48:55'),(678,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:49:14'),(679,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:49:16'),(680,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:49:18'),(681,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:49:19'),(682,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:49:22'),(683,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:50:05'),(684,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:50:11'),(685,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:50:12'),(686,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:50:13'),(687,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:50:14'),(688,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:50:43'),(689,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:50:45'),(690,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:50:48'),(691,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:50:50'),(692,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:51:23'),(693,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:52:03'),(694,'cabrerajorge','Backup','(cabrerajorge), error al generar un backup','2025-05-25','22:52:08'),(695,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:53:17'),(696,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:53:18'),(697,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:53:19'),(698,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:53:21'),(699,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:53:45'),(700,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:53:56'),(701,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:53:59'),(702,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:54:00'),(703,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:54:01'),(704,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:54:03'),(705,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:54:27'),(706,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:54:32'),(707,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:55:15'),(708,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:55:21'),(709,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:55:23'),(710,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:55:24'),(711,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:55:24'),(712,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:55:25'),(713,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:55:26'),(714,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:56:32'),(715,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:58:27'),(716,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:58:28'),(717,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:58:29'),(718,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:58:32'),(719,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:58:39'),(720,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:59:03'),(721,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:59:05'),(722,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:59:06'),(723,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','22:59:07'),(724,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','22:59:10'),(725,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:00:19'),(726,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:00:42'),(727,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:01:03'),(728,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:01:04'),(729,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:01:05'),(730,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:02:23'),(731,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:04:28'),(732,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:04:33'),(733,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:04:35'),(734,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:04:41'),(735,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:05:51'),(736,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:05:55'),(737,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:05:57'),(738,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:05:58'),(739,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:05:59'),(740,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:06:25'),(741,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:06:27'),(742,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:06:31'),(743,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:06:54'),(744,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:06:56'),(745,'cabrerajorge','Backup','(cabrerajorge), Se generó un nuevo backup','2025-05-25','23:07:00'),(746,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:07:09'),(747,'cabrerajorge','Backup','(cabrerajorge), Se eliminó un backup','2025-05-25','23:07:10');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'Técnico',1),(2,'Director de Telefonía',0);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dependencia`
--

DROP TABLE IF EXISTS `dependencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ente` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_ente` (`id_ente`),
  CONSTRAINT `dependencia_ibfk_1` FOREIGN KEY (`id_ente`) REFERENCES `ente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependencia`
--

LOCK TABLES `dependencia` WRITE;
/*!40000 ALTER TABLE `dependencia` DISABLE KEYS */;
INSERT INTO `dependencia` VALUES (1,1,'OFITIC',1),(2,1,'Contraloría',1);
/*!40000 ALTER TABLE `dependencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_hoja`
--

DROP TABLE IF EXISTS `detalle_hoja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_hoja` (
  `codigo_hoja_servicio` int(11) NOT NULL,
  `componente` varchar(100) DEFAULT NULL,
  `detalle` varchar(200) DEFAULT NULL,
  `id_movimiento_material` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_hoja_servicio`),
  KEY `id_movimiento_material` (`id_movimiento_material`),
  CONSTRAINT `detalle_hoja_ibfk_1` FOREIGN KEY (`codigo_hoja_servicio`) REFERENCES `hoja_servicio` (`codigo_hoja_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_hoja_ibfk_2` FOREIGN KEY (`id_movimiento_material`) REFERENCES `movimiento_materiales` (`id_movimiento_material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_hoja`
--

LOCK TABLES `detalle_hoja` WRITE;
/*!40000 ALTER TABLE `detalle_hoja` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_hoja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `cedula_empleado` varchar(12) NOT NULL,
  `nombre_empleado` varchar(45) NOT NULL,
  `apellido_empleado` varchar(45) NOT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_unidad` int(11) NOT NULL,
  `telefono_empleado` varchar(15) DEFAULT NULL,
  `correo_empleado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cedula_empleado`),
  KEY `empleado_ibfk_1` (`id_unidad`),
  KEY `tipo` (`id_cargo`),
  KEY `empleado_ibfk_4` (`id_servicio`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `tipo_servicio` (`id_tipo_servicio`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`id_unidad`) REFERENCES `unidad` (`id_unidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES ('V-1234567','Maria','Peres',NULL,NULL,1,'0426-5575858','prueba@gmail.com'),('V-21140325','Félix','Mujica',NULL,NULL,1,'0400-0000000','ejemplo@gmail.com'),('V-30266398','Leizer','Torrealba',NULL,NULL,1,'0416-0506544','leizeraponte2020@gmail.com'),('V-30454597','Franklin','Fonseca',NULL,NULL,1,'0424-5041921','franklinjavierfonsecavasquez@gmail.com'),('V-30587785','Mariangel','Bokor',NULL,NULL,1,'0424-5319088','bokorarcangel447@gmail.com'),('V-31843937','Jorge','Cabrera',NULL,NULL,1,'0424-5567016','cabrerajorge2003@gmail.com');
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ente`
--

DROP TABLE IF EXISTS `ente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `nombre_responsable` varchar(65) DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ente`
--

LOCK TABLES `ente` WRITE;
/*!40000 ALTER TABLE `ente` DISABLE KEYS */;
INSERT INTO `ente` VALUES (1,'Gobernación','','','',1),(3,'Teatro Juaréz','','','',1),(4,'Parque Baradida','Carrera 18 con calle 55 y 54','0251-0070881','Ricardo Guzmán',1);
/*!40000 ALTER TABLE `ente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_equipo` varchar(45) DEFAULT NULL,
  `serial` varchar(45) DEFAULT NULL,
  `codigo_bien` varchar(20) DEFAULT NULL,
  `id_unidad` int(11) DEFAULT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_equipo`),
  UNIQUE KEY `serial` (`serial`),
  KEY `equipo_ibfk_2` (`id_unidad`),
  KEY `nro_bien` (`codigo_bien`),
  CONSTRAINT `equipo_ibfk_3` FOREIGN KEY (`codigo_bien`) REFERENCES `bien` (`codigo_bien`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `equipo_ibfk_4` FOREIGN KEY (`id_unidad`) REFERENCES `unidad` (`id_unidad`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES (2,'12123','3123','JK2450',1,1);
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoja_servicio`
--

DROP TABLE IF EXISTS `hoja_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hoja_servicio` (
  `codigo_hoja_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nro_solicitud` int(11) NOT NULL,
  `id_tipo_servicio` int(11) NOT NULL,
  `redireccion` int(11) DEFAULT NULL,
  `cedula_tecnico` varchar(12) NOT NULL,
  `fecha_resultado` datetime NOT NULL,
  `resultado_hoja_servicio` varchar(45) DEFAULT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `estatus` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codigo_hoja_servicio`),
  KEY `hoja_servicio_ibfk_1` (`nro_solicitud`),
  KEY `hoja_servicio_ibfk_2` (`id_tipo_servicio`),
  KEY `redireccion` (`redireccion`),
  KEY `id_tipo_servicio` (`id_tipo_servicio`),
  KEY `cedula_tecnico` (`cedula_tecnico`),
  CONSTRAINT `hoja_servicio_ibfk_1` FOREIGN KEY (`nro_solicitud`) REFERENCES `solicitud` (`nro_solicitud`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hoja_servicio_ibfk_2` FOREIGN KEY (`cedula_tecnico`) REFERENCES `empleado` (`cedula_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hoja_servicio_ibfk_3` FOREIGN KEY (`id_tipo_servicio`) REFERENCES `tipo_servicio` (`id_tipo_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hoja_servicio_ibfk_4` FOREIGN KEY (`redireccion`) REFERENCES `hoja_servicio` (`codigo_hoja_servicio`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoja_servicio`
--

LOCK TABLES `hoja_servicio` WRITE;
/*!40000 ALTER TABLE `hoja_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `hoja_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interconexion`
--

DROP TABLE IF EXISTS `interconexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interconexion` (
  `id_interconexion` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_switch` varchar(20) NOT NULL,
  `codigo_patch_panel` varchar(20) NOT NULL,
  `puerto_switch` int(11) NOT NULL,
  `puerto_patch_panel` int(11) NOT NULL,
  PRIMARY KEY (`id_interconexion`),
  KEY `codigo_switch` (`codigo_switch`),
  KEY `codigo_patch_panel_2` (`codigo_patch_panel`),
  CONSTRAINT `interconexion_ibfk_1` FOREIGN KEY (`codigo_switch`) REFERENCES `switch` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `interconexion_ibfk_2` FOREIGN KEY (`codigo_patch_panel`) REFERENCES `patch_panel` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interconexion`
--

LOCK TABLES `interconexion` WRITE;
/*!40000 ALTER TABLE `interconexion` DISABLE KEYS */;
/*!40000 ALTER TABLE `interconexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_marca` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'Lenovo',1),(2,'HP',1),(3,'SAMSUNG',1),(4,'VIT',1),(5,'Apple',1),(6,'OPPO',0);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `id_material` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion` int(11) DEFAULT NULL,
  `nombre_material` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_material`),
  KEY `material_ibfk_1` (`ubicacion`),
  CONSTRAINT `material_ibfk_1` FOREIGN KEY (`ubicacion`) REFERENCES `oficina` (`id_oficina`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulo`
--

DROP TABLE IF EXISTS `modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre_modulo` varchar(45) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulo`
--

LOCK TABLES `modulo` WRITE;
/*!40000 ALTER TABLE `modulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento_materiales`
--

DROP TABLE IF EXISTS `movimiento_materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimiento_materiales` (
  `id_movimiento_material` int(11) NOT NULL AUTO_INCREMENT,
  `id_material` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_movimiento_material`),
  KEY `id_material` (`id_material`),
  CONSTRAINT `movimiento_materiales_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento_materiales`
--

LOCK TABLES `movimiento_materiales` WRITE;
/*!40000 ALTER TABLE `movimiento_materiales` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimiento_materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificacion`
--

DROP TABLE IF EXISTS `notificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `modulo` varchar(45) NOT NULL,
  `mensaje` int(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Nuevo',
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombre_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificacion`
--

LOCK TABLES `notificacion` WRITE;
/*!40000 ALTER TABLE `notificacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oficina`
--

DROP TABLE IF EXISTS `oficina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oficina` (
  `id_oficina` int(11) NOT NULL AUTO_INCREMENT,
  `id_piso` int(11) NOT NULL,
  `nombre_oficina` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_oficina`),
  KEY `id_piso` (`id_piso`),
  CONSTRAINT `oficina_ibfk_1` FOREIGN KEY (`id_piso`) REFERENCES `piso` (`id_piso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oficina`
--

LOCK TABLES `oficina` WRITE;
/*!40000 ALTER TABLE `oficina` DISABLE KEYS */;
INSERT INTO `oficina` VALUES (1,1,'Taller 1',1),(2,2,'Taller 2',1),(3,1,'Oficina',1),(4,1,'Depósito',1),(5,3,'Taller de Electrónica',1);
/*!40000 ALTER TABLE `oficina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patch_panel`
--

DROP TABLE IF EXISTS `patch_panel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patch_panel` (
  `codigo_bien` varchar(20) NOT NULL,
  `serial` varchar(45) NOT NULL,
  `tipo_patch_panel` varchar(45) NOT NULL,
  `cantidad_puertos` int(11) NOT NULL,
  PRIMARY KEY (`codigo_bien`),
  UNIQUE KEY `serial` (`serial`),
  KEY `codigo_bien` (`codigo_bien`),
  CONSTRAINT `patch_panel_ibfk_1` FOREIGN KEY (`codigo_bien`) REFERENCES `bien` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patch_panel`
--

LOCK TABLES `patch_panel` WRITE;
/*!40000 ALTER TABLE `patch_panel` DISABLE KEYS */;
/*!40000 ALTER TABLE `patch_panel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `accion_permiso` varchar(100) NOT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `id_rol` (`id_rol`),
  KEY `id_modulo` (`id_modulo`),
  CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `piso`
--

DROP TABLE IF EXISTS `piso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `piso` (
  `id_piso` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_piso` varchar(45) NOT NULL,
  `nro_piso` varchar(10) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_piso`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `piso`
--

LOCK TABLES `piso` WRITE;
/*!40000 ALTER TABLE `piso` DISABLE KEYS */;
INSERT INTO `piso` VALUES (1,'Planta Baja','0',1),(2,'Piso','1',0),(3,'Piso','1',1),(4,'Sótano','2',1),(5,'Piso','2',1),(6,'Piso','3',1),(7,'Sótano','1',1),(8,'Piso','4',1),(9,'Piso','5',1),(10,'Piso','6',1),(11,'Piso','7',1),(12,'Terraza','10',1),(13,'Sótano','3',1),(14,'Sótano','4',1),(15,'Sótano','5',0),(16,'Sótano','6',0),(17,'Sótano','7',0),(18,'Terraza','8',0);
/*!40000 ALTER TABLE `piso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punto_conexion`
--

DROP TABLE IF EXISTS `punto_conexion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `punto_conexion` (
  `id_punto_conexion` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_patch_panel` varchar(20) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `puerto_patch_panel` int(11) NOT NULL,
  PRIMARY KEY (`id_punto_conexion`),
  KEY `codigo_patch` (`codigo_patch_panel`),
  KEY `id_equipo` (`id_equipo`),
  CONSTRAINT `punto_conexion_ibfk_1` FOREIGN KEY (`codigo_patch_panel`) REFERENCES `patch_panel` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `punto_conexion_ibfk_2` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `punto_conexion`
--

LOCK TABLES `punto_conexion` WRITE;
/*!40000 ALTER TABLE `punto_conexion` DISABLE KEYS */;
/*!40000 ALTER TABLE `punto_conexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'ADMINISTRADOR'),(2,'TECNICO'),(3,'SOLICITANTE'),(4,'SECRETARIA'),(5,'SUPERUSUARIO');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud` (
  `nro_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `cedula_solicitante` varchar(12) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `estado_solicitud` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `resultado_solicitud` varchar(20) DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`nro_solicitud`),
  KEY `solicitud_ibfk_1` (`cedula_solicitante`),
  KEY `solicitud_ibfk_2` (`id_equipo`),
  CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`cedula_solicitante`) REFERENCES `empleado` (`cedula_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud`
--

LOCK TABLES `solicitud` WRITE;
/*!40000 ALTER TABLE `solicitud` DISABLE KEYS */;
INSERT INTO `solicitud` VALUES (2,'V-1234567','Reparar mi equipo',NULL,'2025-04-08 00:00:00','Pendiente',NULL,1),(3,'V-1234567','Quiero arreglar el PC',NULL,'2025-04-09 00:00:00','En Proceso',NULL,1),(4,'V-1234567','Quiero arreglar el PC',NULL,'2025-04-09 00:00:00','En Proceso',NULL,1),(5,'V-30266398','Se daño el pc',NULL,'2025-04-23 00:00:00','En Proceso',NULL,1),(34,'V-31843937','hjgjh',NULL,'2025-04-27 00:00:00','En Proceso',NULL,1),(35,'V-31843937','lkjkjk',NULL,'2025-04-27 00:00:00','En Proceso',NULL,1),(37,'V-30266398','No me agarra internet el pc',NULL,'2025-05-21 15:13:47','En Proceso',NULL,1),(38,'V-30266398','No me agarra internet el pc',NULL,'2025-05-21 15:17:29','En Proceso',NULL,1),(39,'V-30266398','Arreglen el router otra vez',NULL,'2025-05-21 15:35:09','En Proceso',NULL,1),(40,'V-30266398','Cambiar de red',NULL,'2025-05-21 15:36:03','En Proceso',NULL,1),(41,'V-30266398','Cambiar la impresora',NULL,'2025-05-21 15:37:04','En Proceso',NULL,1),(42,'V-30266398','PC no prende',NULL,'2025-05-21 15:47:15','En Proceso',NULL,0),(43,'V-31843937','Se me daño el equipo',NULL,'2025-05-25 20:36:38','En Proceso',NULL,0),(44,'V-31843937','Pure',NULL,'2025-05-25 22:20:02','En Proceso',NULL,0),(45,'V-31843937','Borrador',NULL,'2025-05-25 22:25:39','En Proceso',NULL,0);
/*!40000 ALTER TABLE `solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `switch`
--

DROP TABLE IF EXISTS `switch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `switch` (
  `codigo_bien` varchar(20) NOT NULL,
  `serial` varchar(45) NOT NULL,
  `cantidad_puertos` int(11) NOT NULL,
  PRIMARY KEY (`codigo_bien`),
  UNIQUE KEY `serial` (`serial`),
  CONSTRAINT `switch_ibfk_1` FOREIGN KEY (`codigo_bien`) REFERENCES `bien` (`codigo_bien`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `switch`
--

LOCK TABLES `switch` WRITE;
/*!40000 ALTER TABLE `switch` DISABLE KEYS */;
/*!40000 ALTER TABLE `switch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_bien`
--

DROP TABLE IF EXISTS `tipo_bien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_bien` (
  `id_tipo_bien` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_bien` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_bien`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_bien`
--

LOCK TABLES `tipo_bien` WRITE;
/*!40000 ALTER TABLE `tipo_bien` DISABLE KEYS */;
INSERT INTO `tipo_bien` VALUES (1,'Electrónico',1),(2,'Mueble',1);
/*!40000 ALTER TABLE `tipo_bien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servicio` (
  `id_tipo_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_servicio` varchar(45) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT INTO `tipo_servicio` VALUES (1,'Soporte Técnico',0),(2,'Redes',0),(3,'Telefonía',0),(4,'Electrónica',0);
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad`
--

DROP TABLE IF EXISTS `unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_dependencia` int(11) NOT NULL,
  `nombre_unidad` varchar(45) NOT NULL,
  `estatus` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_unidad`),
  KEY `id_dependencia` (`id_dependencia`),
  CONSTRAINT `unidad_ibfk_1` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad`
--

LOCK TABLES `unidad` WRITE;
/*!40000 ALTER TABLE `unidad` DISABLE KEYS */;
INSERT INTO `unidad` VALUES (1,1,'Bienes',1),(2,1,'Seguridad',1);
/*!40000 ALTER TABLE `unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `nombre_usuario` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nombres` varchar(65) NOT NULL,
  `apellidos` varchar(65) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(128) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`nombre_usuario`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `cedula_2` (`cedula`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('cabrerajorge','V-31843937',5,'Jorge','Cabrera','0424-5567016','cabrerajorge2003@gmail.com','$2y$10$1vXPHPs29V2T.1HVvUHXn.rzC3KfFwxTXbnosxiJRJEWA4ZATIEBm','assets/img/foto-perfil/V-31843937.jpg'),('frank30','V-30454597',1,'Frankling','Fonseca','0424-5041921','ranklinjavierfonsecavasquez@gmail.com','$2y$10$d64FtFMmW8sTyuiKyxD52eN0q9vdBEglqAbOJXUzw80aRB3/uko7K',''),('lz2712','V-30266398',1,'Leizer','Torrealba','0416-0506544','leizeraponte2020@gmail.com','$2y$10$sONqWv4yy5PEeePKYljGXOLjFuJa1lMz9yua.3cMVAHG4hU.75Jpe','assets/img/foto-perfil/V-30266398.png'),('mari14','V-30587785',1,'Mariangel','Bokor','0424-5319088','bokorarcangel447@gmail.com','$2y$10$nMQ5inBjrq6FeZbt8sTQk.9Mkx4c.H93TVw.39zCiC3ovXCZoqyaa',''),('maria123','V-21140325',1,'Felix','Mujica','0400-0000000','ejemplo@gmail.com','12345',''),('root','V-1234567',1,'root','admin','0000-0000000','prueba@gmail.com','123','');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-25 23:07:17
