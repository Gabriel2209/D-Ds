-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: clientes
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
-- Table structure for table `t_clientes_datospersonales`
--

DROP TABLE IF EXISTS `t_clientes_datospersonales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_clientes_datospersonales` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `genero` varchar(9) NOT NULL,
  `generos_fav` varchar(1500) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_clientes_datospersonales`
--

LOCK TABLES `t_clientes_datospersonales` WRITE;
/*!40000 ALTER TABLE `t_clientes_datospersonales` DISABLE KEYS */;
INSERT INTO `t_clientes_datospersonales` VALUES (13,'yomilca guerra','1-739-1071','yomilcaguerra@gmail.com','$2y$10$h1QY0noiJu3cBHCcH2TMnuAV1vDOaMekleTBXPjTRlVuyHXzKmapS','1995-08-09','61638666','Femenino','accion'),(15,'omar salazar','8-23-2223','a@teste.com','$2y$10$CN5eIRb1pUzYCa73zKM/oecHcFxzeuFi6O3/p36KpGS9e50agWYmW','2026-03-04','2333333334444445','Masculino','divertidas'),(16,'yomilca guerra','8-888-888','yomil.23@gmail.con','$2y$10$gsVpLx2ABZQ10cM6mtF39Oifmi2BpRJNwgiem6aFStwMYDrN8xrMG','2026-03-03','65698596','Femenino','hola'),(17,'lagrutta alexis','8-11-2233','ale@test.com','$2y$10$NjRqQjTTnEgjN6MwzaDhMew6vsqVZEaaROzZsA3Lo/RSE05QpCyQW','2002-09-02','5076677665','Masculino','aloooo');
/*!40000 ALTER TABLE `t_clientes_datospersonales` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-03  0:51:54
