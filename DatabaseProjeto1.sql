-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: phpprojeto01
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `tb_admin.online`
--

DROP TABLE IF EXISTS `tb_admin.online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_admin.online` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_admin.online`
--

LOCK TABLES `tb_admin.online` WRITE;
/*!40000 ALTER TABLE `tb_admin.online` DISABLE KEYS */;
INSERT INTO `tb_admin.online` VALUES (35,'::1','2021-08-04 12:21:45','610ab0104663a'),(36,'::1','2021-08-04 12:21:45','610ab0104663a');
/*!40000 ALTER TABLE `tb_admin.online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_admin.usuarios`
--

DROP TABLE IF EXISTS `tb_admin.usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_admin.usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_admin.usuarios`
--

LOCK TABLES `tb_admin.usuarios` WRITE;
/*!40000 ALTER TABLE `tb_admin.usuarios` DISABLE KEYS */;
INSERT INTO `tb_admin.usuarios` VALUES (3,'admin','admin',NULL,'603987ecc0624.jpg','Natanael Aguilar Barreto',2),(4,'Marcus','marcus','viniciusaguilarbarreto@gmail.com','','Marcus Vinicius Aguilar Barreto',1);
/*!40000 ALTER TABLE `tb_admin.usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_admin.visitas`
--

DROP TABLE IF EXISTS `tb_admin.visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_admin.visitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_admin.visitas`
--

LOCK TABLES `tb_admin.visitas` WRITE;
/*!40000 ALTER TABLE `tb_admin.visitas` DISABLE KEYS */;
INSERT INTO `tb_admin.visitas` VALUES (1,'::1','2017-06-12'),(2,'192.168.0.2','2017-06-11'),(3,'::1','2017-06-13'),(4,'::1','2017-06-13'),(5,'::1','2017-06-13'),(6,'::1','2017-06-13'),(7,'::1','2017-06-14'),(8,'::1','2017-06-14'),(9,'::1','2017-06-16'),(10,'::1','2017-06-20'),(11,'::1','2017-06-20'),(12,'::1','2017-06-20'),(13,'::1','2017-06-20'),(14,'::1','2017-06-26'),(15,'::1','2017-06-27'),(16,'::1','2017-07-03'),(17,'::1','2021-07-15'),(18,'::1','2021-07-18'),(19,'::1','2021-08-04');
/*!40000 ALTER TABLE `tb_admin.visitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.autor`
--

DROP TABLE IF EXISTS `tb_site.autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.autor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` text,
  `foto` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.autor`
--

LOCK TABLES `tb_site.autor` WRITE;
/*!40000 ALTER TABLE `tb_site.autor` DISABLE KEYS */;
INSERT INTO `tb_site.autor` VALUES (1,'Natanael Aguilar Barreto','O menino é genial, o loco irmao tataki						','60f0c399e5512.jpg');
/*!40000 ALTER TABLE `tb_site.autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.categorias`
--

DROP TABLE IF EXISTS `tb_site.categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.categorias`
--

LOCK TABLES `tb_site.categorias` WRITE;
/*!40000 ALTER TABLE `tb_site.categorias` DISABLE KEYS */;
INSERT INTO `tb_site.categorias` VALUES (3,'Geral','geral',3),(5,'Educação','educacao',4),(7,'Extras','extras',7),(8,'Cotidiano','cotidiano',8),(9,'Saúde','saude',9);
/*!40000 ALTER TABLE `tb_site.categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.depoimentos`
--

DROP TABLE IF EXISTS `tb_site.depoimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.depoimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` varchar(255) NOT NULL,
  `order_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.depoimentos`
--

LOCK TABLES `tb_site.depoimentos` WRITE;
/*!40000 ALTER TABLE `tb_site.depoimentos` DISABLE KEYS */;
INSERT INTO `tb_site.depoimentos` VALUES (8,'Guilherme','Olá, funcionando','19/09/2019',11),(9,'João','Olá, funcionando legal!','15-07-2021',10),(12,'Guilherme Grillo','Depoimento de teste','25/05/1993',12),(13,'Joao','outro depoimento editado','25/05/1993',13),(14,'Natanael Aguilar Barreto','Interessante esse site!				','15/07/2021',14);
/*!40000 ALTER TABLE `tb_site.depoimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.especialidades`
--

DROP TABLE IF EXISTS `tb_site.especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.especialidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `descricao` text,
  `class` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.especialidades`
--

LOCK TABLES `tb_site.especialidades` WRITE;
/*!40000 ALTER TABLE `tb_site.especialidades` DISABLE KEYS */;
INSERT INTO `tb_site.especialidades` VALUES (1,'HTML5','Vestibulum sit amet nisi vitae nibh finibus porttitor. Duis in. 				','fab fa-html5'),(2,'CSS','Vestibulum sit amet nisi vitae nibh finibus porttitor. Duis in. 				','fab fa-css3'),(3,'JS','Vestibulum sit amet nisi vitae nibh finibus porttitor. Duis in. 				','fab fa-js');
/*!40000 ALTER TABLE `tb_site.especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.noticias`
--

DROP TABLE IF EXISTS `tb_site.noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.noticias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `conteudo` text,
  `capa` varchar(255) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `data` varchar(30) DEFAULT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.noticias`
--

LOCK TABLES `tb_site.noticias` WRITE;
/*!40000 ALTER TABLE `tb_site.noticias` DISABLE KEYS */;
INSERT INTO `tb_site.noticias` VALUES (10,'COVID-19','covid-19','<p>Perigoso</p>','60f0ff66e2f6b.jpg','Saúde','03/02/1999',10),(11,'Brasil','brasil','<p>N&atilde;o venceu a copa!</p>','60f0ff8adc47f.jpg','Extras','05/03/2021',11);
/*!40000 ALTER TABLE `tb_site.noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.servicos`
--

DROP TABLE IF EXISTS `tb_site.servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.servicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `servico` text NOT NULL,
  `data` varchar(30) DEFAULT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.servicos`
--

LOCK TABLES `tb_site.servicos` WRITE;
/*!40000 ALTER TABLE `tb_site.servicos` DISABLE KEYS */;
INSERT INTO `tb_site.servicos` VALUES (8,'Mysql					','15/07/2021',8);
/*!40000 ALTER TABLE `tb_site.servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_site.slides`
--

DROP TABLE IF EXISTS `tb_site.slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_site.slides` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_site.slides`
--

LOCK TABLES `tb_site.slides` WRITE;
/*!40000 ALTER TABLE `tb_site.slides` DISABLE KEYS */;
INSERT INTO `tb_site.slides` VALUES (11,'2','60f0b9d15ef2d.jpg',11),(12,'3','60f0b9d9973d4.jpg',12),(13,'4','60f0b9e568c5d.jpg',13),(14,'5','60f0b9f5d620c.jpg',14);
/*!40000 ALTER TABLE `tb_site.slides` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-04 12:26:51
