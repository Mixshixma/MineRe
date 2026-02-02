CREATE DATABASE  IF NOT EXISTS `ventas_anonimas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ventas_anonimas`;
-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ventas_anonimas
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `categoria` enum('Tecnología','Hogar','Moda','Salud','Hobby','Otros') DEFAULT 'Otros',
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` enum('Nuevo','Usado') DEFAULT 'Usado',
  `pais` varchar(150) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `token` varchar(64) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` VALUES (1,'XIAOMI REDMI NOTE 14 4G','Tecnología','Este equipo se encuentra nuevo y sin ningún detalle, es solo que no me gustan los Xiaomi.',190.00,'Nuevo','Ecuador','brian12@gmail.com','https://system.pepezone.ec//files/up/imgProducts/11288_XIAOMI-REDMI-NOTE-14-NEGRO-8GB-256GB_1112025123255PM.JPG','f01d8a','2026-02-01 21:20:46'),(2,'CORREA CALVIN KLEIN TALLA SM','Moda','El precio NO es negociable.',35.00,'Nuevo','Ecuador','+593987654321','https://i.ibb.co/CNS6tBW/IMG-20250804-230829.jpg','e3f4e2','2026-02-02 03:11:09'),(3,'ZAPATOS PUMA ROJOS TALLA 34','Moda','No estoy pidiendo mucho por ellos por ser usados anteriormente. Puede contactarme por telegram a @user4512 o whatts por +54123456789',15.00,'Usado','México','toni44@outlook.com','https://i.ibb.co/PZ1110cy/IMG-20250720-210747.jpg','f98441','2026-02-02 03:16:55');
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-01 22:57:17
