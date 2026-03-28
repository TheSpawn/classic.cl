-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: classic_cms_ddbb
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cms_alianza`
--

DROP TABLE IF EXISTS `cms_alianza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_alianza` (
  `ali_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `ali_nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ali_descripcion` text COLLATE utf8mb4_general_ci,
  `ali_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ali_ubicacion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ali_fechas` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ali_tipo` enum('PRINCIPAL','SECUNDARIA') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'PRINCIPAL',
  `ali_invitaciones` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ali_stats` text COLLATE utf8mb4_general_ci,
  `ali_orden` int NOT NULL DEFAULT '0',
  `ali_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ali_id`),
  KEY `idx_alianza_sitio_tipo` (`sit_id`,`ali_tipo`,`ali_orden`),
  CONSTRAINT `cms_alianza_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_contenido`
--

DROP TABLE IF EXISTS `cms_contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_contenido` (
  `con_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `con_seccion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `con_clave` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `con_valor` text COLLATE utf8mb4_general_ci,
  `con_tipo` enum('TEXTO','HTML','JSON') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'TEXTO',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `idx_contenido_sitio_seccion` (`sit_id`,`con_seccion`),
  CONSTRAINT `cms_contenido_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_documento`
--

DROP TABLE IF EXISTS `cms_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_documento` (
  `doc_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `doc_titulo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `doc_categoria` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doc_archivo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `doc_descripcion` text COLLATE utf8mb4_general_ci,
  `doc_orden` int NOT NULL DEFAULT '0',
  `doc_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `idx_documento_sitio_cat` (`sit_id`,`doc_categoria`,`doc_orden`),
  CONSTRAINT `cms_documento_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_evento`
--

DROP TABLE IF EXISTS `cms_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_evento` (
  `eve_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `eve_titulo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `eve_slug` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `eve_fecha` date DEFAULT NULL,
  `eve_fecha_fin` date DEFAULT NULL,
  `eve_hora` time DEFAULT NULL,
  `eve_hora_fin` time DEFAULT NULL,
  `eve_ubicacion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eve_venue` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eve_estado` enum('PRONTO','ABIERTO','CERRADO') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'PRONTO',
  `eve_descripcion_corta` text COLLATE utf8mb4_general_ci,
  `eve_descripcion` text COLLATE utf8mb4_general_ci,
  `eve_icono` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eve_imagen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eve_video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eve_vende_entradas` tinyint(1) NOT NULL DEFAULT '1',
  `eve_orden` int NOT NULL DEFAULT '0',
  `eve_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`eve_id`),
  UNIQUE KEY `eve_slug` (`eve_slug`),
  KEY `idx_evento_sitio_activo` (`sit_id`,`eve_activo`,`eve_orden`),
  CONSTRAINT `cms_evento_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_evento_highlight`
--

DROP TABLE IF EXISTS `cms_evento_highlight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_evento_highlight` (
  `hig_id` int unsigned NOT NULL AUTO_INCREMENT,
  `eve_id` int unsigned NOT NULL,
  `hig_texto` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `hig_orden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`hig_id`),
  KEY `cms_evento_highlight_eve_id_foreign` (`eve_id`),
  CONSTRAINT `cms_evento_highlight_eve_id_foreign` FOREIGN KEY (`eve_id`) REFERENCES `cms_evento` (`eve_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_evento_meta`
--

DROP TABLE IF EXISTS `cms_evento_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_evento_meta` (
  `met_id` int unsigned NOT NULL AUTO_INCREMENT,
  `eve_id` int unsigned NOT NULL,
  `met_icono` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `met_texto` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `met_orden` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`met_id`),
  KEY `cms_evento_meta_eve_id_foreign` (`eve_id`),
  CONSTRAINT `cms_evento_meta_eve_id_foreign` FOREIGN KEY (`eve_id`) REFERENCES `cms_evento` (`eve_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_galeria`
--

DROP TABLE IF EXISTS `cms_galeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_galeria` (
  `gal_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `gal_titulo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `gal_descripcion` text COLLATE utf8mb4_general_ci,
  `gal_imagen_portada` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gal_orden` int NOT NULL DEFAULT '0',
  `gal_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`gal_id`),
  KEY `cms_galeria_sit_id_foreign` (`sit_id`),
  CONSTRAINT `cms_galeria_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_hito`
--

DROP TABLE IF EXISTS `cms_hito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_hito` (
  `hit_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `hit_anio` int NOT NULL,
  `hit_titulo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `hit_descripcion` text COLLATE utf8mb4_general_ci,
  `hit_imagen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hit_icono` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hit_orden` int NOT NULL DEFAULT '0',
  `hit_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`hit_id`),
  KEY `idx_hito_sitio_orden` (`sit_id`,`hit_orden`),
  CONSTRAINT `cms_hito_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_imagen`
--

DROP TABLE IF EXISTS `cms_imagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_imagen` (
  `ima_id` int unsigned NOT NULL AUTO_INCREMENT,
  `gal_id` int unsigned NOT NULL,
  `ima_archivo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ima_titulo` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ima_alt` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ima_orden` int NOT NULL DEFAULT '0',
  `ima_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ima_id`),
  KEY `cms_imagen_gal_id_foreign` (`gal_id`),
  CONSTRAINT `cms_imagen_gal_id_foreign` FOREIGN KEY (`gal_id`) REFERENCES `cms_galeria` (`gal_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_partner`
--

DROP TABLE IF EXISTS `cms_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_partner` (
  `par_id` int unsigned NOT NULL AUTO_INCREMENT,
  `par_nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `par_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `par_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `par_orden` int NOT NULL DEFAULT '0',
  `par_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_partner_sitio`
--

DROP TABLE IF EXISTS `cms_partner_sitio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_partner_sitio` (
  `par_id` int unsigned NOT NULL,
  `sit_id` int unsigned NOT NULL,
  PRIMARY KEY (`par_id`,`sit_id`),
  KEY `cms_partner_sitio_sit_id_foreign` (`sit_id`),
  CONSTRAINT `cms_partner_sitio_par_id_foreign` FOREIGN KEY (`par_id`) REFERENCES `cms_partner` (`par_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_partner_sitio_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_precio`
--

DROP TABLE IF EXISTS `cms_precio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_precio` (
  `pre_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_id` int unsigned NOT NULL,
  `eve_id` int unsigned DEFAULT NULL,
  `pre_nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pre_monto` int NOT NULL,
  `pre_moneda` varchar(3) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'CLP',
  `pre_fecha_inicio` date DEFAULT NULL,
  `pre_fecha_fin` date DEFAULT NULL,
  `pre_caracteristicas` text COLLATE utf8mb4_general_ci,
  `pre_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pre_id`),
  KEY `cms_precio_sit_id_foreign` (`sit_id`),
  KEY `idx_precio_evento` (`eve_id`,`pre_activo`,`pre_fecha_inicio`),
  CONSTRAINT `cms_precio_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_precio_evento` FOREIGN KEY (`eve_id`) REFERENCES `cms_evento` (`eve_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_sitio`
--

DROP TABLE IF EXISTS `cms_sitio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_sitio` (
  `sit_id` int unsigned NOT NULL AUTO_INCREMENT,
  `sit_nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sit_slug` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sit_dominio` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sit_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sit_email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sit_color_primario` varchar(7) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '#000000',
  `sit_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sit_id`),
  UNIQUE KEY `sit_slug` (`sit_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_usuario`
--

DROP TABLE IF EXISTS `cms_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_usuario` (
  `usu_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `usu_apellido` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `usu_email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `usu_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `usu_rol` enum('SUPERADMIN','ADMIN','EDITOR') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'EDITOR',
  `usu_activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  UNIQUE KEY `usu_email` (`usu_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms_usuario_sitio`
--

DROP TABLE IF EXISTS `cms_usuario_sitio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_usuario_sitio` (
  `usu_id` int unsigned NOT NULL,
  `sit_id` int unsigned NOT NULL,
  PRIMARY KEY (`usu_id`,`sit_id`),
  KEY `cms_usuario_sitio_sit_id_foreign` (`sit_id`),
  CONSTRAINT `cms_usuario_sitio_sit_id_foreign` FOREIGN KEY (`sit_id`) REFERENCES `cms_sitio` (`sit_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_usuario_sitio_usu_id_foreign` FOREIGN KEY (`usu_id`) REFERENCES `cms_usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-28 19:26:29
