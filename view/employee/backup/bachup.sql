-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: srdi_system
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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activities` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,'User registered',1,'2025-11-23 13:36:15','2025-11-23 13:36:15'),(2,'User registered',2,'2025-11-23 13:36:26','2025-11-23 13:36:26'),(3,'User registered',3,'2025-11-23 13:43:45','2025-11-23 13:43:45'),(4,'User logged in',3,'2025-11-23 13:53:05','2025-11-23 13:53:05'),(5,'Login attempt',3,'2025-11-23 13:53:05','2025-11-23 13:53:05'),(6,'Pending login attempt',3,'2025-11-23 13:53:05','2025-11-23 13:53:05'),(7,'User logged in',3,'2025-11-23 13:55:58','2025-11-23 13:55:58'),(8,'Login attempt',3,'2025-11-23 13:55:58','2025-11-23 13:55:58'),(9,'User logged in',3,'2025-11-23 13:55:58','2025-11-23 13:55:58'),(10,'User logged in',3,'2025-11-23 13:56:18','2025-11-23 13:56:18'),(11,'Login attempt',3,'2025-11-23 13:56:18','2025-11-23 13:56:18'),(12,'User logged in',3,'2025-11-23 13:56:18','2025-11-23 13:56:18'),(13,'User logged in',3,'2025-11-23 13:57:48','2025-11-23 13:57:48'),(14,'Login attempt',3,'2025-11-23 13:57:48','2025-11-23 13:57:48'),(15,'User logged in',3,'2025-11-23 13:57:48','2025-11-23 13:57:48'),(16,'User logged in',3,'2025-11-23 14:01:01','2025-11-23 14:01:01'),(17,'Login attempt',3,'2025-11-23 14:01:01','2025-11-23 14:01:01'),(18,'User logged in',3,'2025-11-23 14:01:01','2025-11-23 14:01:01'),(19,'User logged in',3,'2025-11-23 14:04:26','2025-11-23 14:04:26'),(20,'Login attempt',3,'2025-11-23 14:04:26','2025-11-23 14:04:26'),(21,'User logged in',3,'2025-11-23 14:04:26','2025-11-23 14:04:26'),(22,'User logged in',3,'2025-11-23 15:05:36','2025-11-23 15:05:36'),(23,'Login attempt',3,'2025-11-23 15:05:36','2025-11-23 15:05:36'),(24,'User logged in',3,'2025-11-23 15:05:36','2025-11-23 15:05:36'),(25,'User logged in',3,'2025-11-23 15:14:19','2025-11-23 15:14:19'),(26,'Login attempt',3,'2025-11-23 15:14:19','2025-11-23 15:14:19'),(27,'User logged in',3,'2025-11-23 15:14:19','2025-11-23 15:14:19'),(28,'User logged in',3,'2025-11-23 15:46:04','2025-11-23 15:46:04'),(29,'User logged in',3,'2025-11-23 15:46:21','2025-11-23 15:46:21'),(30,'User logged in',3,'2025-11-23 15:48:06','2025-11-23 15:48:06'),(31,'User logged in',3,'2025-11-23 15:57:18','2025-11-23 15:57:18'),(32,'User logged in',3,'2025-11-23 15:57:32','2025-11-23 15:57:32'),(33,'User logged in',3,'2025-11-23 16:41:45','2025-11-23 16:41:45'),(34,'User logged in',2,'2025-11-23 16:42:09','2025-11-23 16:42:09'),(35,'User logged in',2,'2025-11-23 16:42:32','2025-11-23 16:42:32'),(36,'User logged in',3,'2025-11-23 16:44:09','2025-11-23 16:44:09'),(37,'User logged in',2,'2025-11-23 16:48:18','2025-11-23 16:48:18'),(38,'User logged in',2,'2025-11-23 16:53:15','2025-11-23 16:53:15'),(39,'User logged in',2,'2025-11-23 17:01:08','2025-11-23 17:01:08'),(40,'User logged in',2,'2025-11-23 17:02:38','2025-11-23 17:02:38'),(41,'User registered',4,'2025-11-23 17:09:36','2025-11-23 17:09:36'),(42,'Pending login attempt',4,'2025-11-23 17:09:41','2025-11-23 17:09:41'),(43,'User logged in',4,'2025-11-23 17:09:55','2025-11-23 17:09:55'),(44,'User registered',5,'2025-11-23 17:17:04','2025-11-23 17:17:04'),(45,'Pending login attempt',5,'2025-11-23 17:17:07','2025-11-23 17:17:07'),(46,'User logged in',5,'2025-11-23 17:17:23','2025-11-23 17:17:23'),(47,'User logged in',5,'2025-11-23 17:23:34','2025-11-23 17:23:34'),(48,'User logged in',5,'2025-11-23 17:25:43','2025-11-23 17:25:43'),(49,'User logged in',5,'2025-11-23 17:29:21','2025-11-23 17:29:21'),(50,'User logged in',5,'2025-11-23 17:29:32','2025-11-23 17:29:32'),(51,'User logged in',5,'2025-11-23 17:29:55','2025-11-23 17:29:55'),(52,'User logged in',5,'2025-11-23 17:31:28','2025-11-23 17:31:28'),(53,'User logged in',5,'2025-11-23 17:31:41','2025-11-23 17:31:41'),(54,'User logged in',5,'2025-11-23 17:31:56','2025-11-23 17:31:56'),(55,'User logged in',5,'2025-11-23 17:33:51','2025-11-23 17:33:51'),(56,'User logged in',5,'2025-11-23 17:34:58','2025-11-23 17:34:58'),(57,'User logged in',5,'2025-11-23 17:35:05','2025-11-23 17:35:05'),(58,'User logged in',5,'2025-11-23 17:35:13','2025-11-23 17:35:13'),(59,'User logged in',4,'2025-11-23 17:35:49','2025-11-23 17:35:49'),(60,'User logged in',5,'2025-11-23 17:43:29','2025-11-23 17:43:29'),(61,'User logged in',4,'2025-11-23 17:55:51','2025-11-23 17:55:51'),(62,'Updated research \\\'Aute architecto adip\\\' status to Approved (Status ID: 2)',4,'2025-11-23 18:05:49','2025-11-23 18:05:49'),(63,'Updated research \\\'Aute architecto adip\\\' status to Approved (Status ID: 2)',4,'2025-11-23 18:05:55','2025-11-23 18:05:55'),(64,'User logged in',5,'2025-11-23 18:11:22','2025-11-23 18:11:22'),(65,'User logged in',4,'2025-11-23 18:12:33','2025-11-23 18:12:33'),(66,'Updated research \\\'Enim iste labore dol\\\' status to Approved)',4,'2025-11-23 18:12:38','2025-11-23 18:12:38'),(67,'Updated research \\\'Enim iste labore dol\\\' status to Approved)',4,'2025-11-23 18:12:41','2025-11-23 18:12:41'),(68,'Updated research \\\'Enim iste labore dol\\\' status to Approved)',4,'2025-11-23 18:14:43','2025-11-23 18:14:43'),(69,'Updated research \\\'Enim iste labore dol\\\' status to Approved)',4,'2025-11-23 18:14:44','2025-11-23 18:14:44'),(70,'Updated research \\\'Enim iste labore dol\\\' status to Approved)',4,'2025-11-23 18:14:47','2025-11-23 18:14:47'),(71,'Updated research \\\'Ut obcaecati aut cul\\\' status to Approved)',4,'2025-11-23 18:14:51','2025-11-23 18:14:51'),(72,'Updated research \\\'Ut obcaecati aut cul\\\' status to Approved)',4,'2025-11-23 18:14:54','2025-11-23 18:14:54'),(73,'Updated research \\\'Ut obcaecati aut cul\\\' status to Approved)',4,'2025-11-23 18:18:34','2025-11-23 18:18:34'),(74,'Updated research \\\'Laboriosam nemo est\\\' status to Approved)',4,'2025-11-23 18:18:36','2025-11-23 18:18:36'),(75,'Updated research \\\'Incididunt aliquam d\\\' status to Approved)',4,'2025-11-23 18:18:56','2025-11-23 18:18:56'),(76,'Updated research \\\'Rerum culpa tempori\\\' status to Approved)',4,'2025-11-23 18:19:10','2025-11-23 18:19:10'),(77,'User logged in',4,'2025-11-23 18:20:03','2025-11-23 18:20:03'),(78,'Updated research \\\'qweqwe\\\' status to Approved)',4,'2025-11-23 18:20:33','2025-11-23 18:20:33'),(79,'Updated research \\\'Sunt hic ea enim omn\\\' status to Approved)',4,'2025-11-23 18:21:15','2025-11-23 18:21:15'),(80,'User logged in',5,'2025-11-23 18:34:54','2025-11-23 18:34:54'),(81,'User logged in',4,'2025-11-23 18:35:07','2025-11-23 18:35:07'),(82,'Updated research \\\'Rerum culpa tempori\\\' to Approved',4,'2025-11-23 18:35:15','2025-11-23 18:35:15'),(83,'Updated research \\\'Rerum culpa tempori\\\' to Revised',4,'2025-11-23 18:35:29','2025-11-23 18:35:29'),(84,'Updated research \\\'Est magnam blanditi\\\' to Revised',4,'2025-11-23 18:38:29','2025-11-23 18:38:29'),(85,'User logged in',3,'2025-11-23 18:51:30','2025-11-23 18:51:30'),(86,'Updated research \\\'qweqwe\\\' status to Unknown)',3,'2025-11-23 18:54:10','2025-11-23 18:54:10'),(87,'Updated research \\\'Rerum culpa tempori\\\' to Revised',3,'2025-11-23 18:58:22','2025-11-23 18:58:22'),(88,'Updated research \\\'Rerum culpa tempori\\\' to Revised',3,'2025-11-23 18:58:34','2025-11-23 18:58:34'),(89,'Updated research \\\'Rerum culpa tempori\\\' to Revised',3,'2025-11-23 18:58:39','2025-11-23 18:58:39'),(90,'Updated research \\\'Rerum culpa tempori\\\' to Revised',3,'2025-11-23 18:59:55','2025-11-23 18:59:55'),(91,'Updated research \\\'Rerum culpa tempori\\\' to Published',3,'2025-11-23 19:00:03','2025-11-23 19:00:03'),(92,'Updated research \\\'Laboriosam nemo est\\\' to Published',3,'2025-11-23 19:09:33','2025-11-23 19:09:33'),(93,'Updated research \\\'Ut obcaecati aut cul\\\' to Revised',3,'2025-11-23 19:09:41','2025-11-23 19:09:41'),(94,'User logged in',2,'2025-11-23 19:13:21','2025-11-23 19:13:21'),(95,'Changed status of Kimberly Nolan from 1 to Approved',2,'2025-11-23 19:36:31','2025-11-23 19:36:31'),(96,'Changed status of Mariam Dudley from 1 to Approved',2,'2025-11-23 19:36:40','2025-11-23 19:36:40'),(97,'User logged in',1,'2025-11-23 19:36:56','2025-11-23 19:36:56'),(98,'User logged in',2,'2025-11-23 19:47:01','2025-11-23 19:47:01'),(99,'User logged in',4,'2025-11-23 19:56:36','2025-11-23 19:56:36'),(100,'Updated research \\\'Labore ipsum dolorem\\\' to Approved',4,'2025-11-23 19:56:43','2025-11-23 19:56:43'),(101,'Updated research \\\'Rerum culpa tempori\\\' to Revised',4,'2025-11-23 19:56:51','2025-11-23 19:56:51'),(102,'User registered',6,'2025-11-24 02:04:46','2025-11-24 02:04:46'),(103,'Pending login attempt',6,'2025-11-24 02:04:50','2025-11-24 02:04:50'),(104,'Pending login attempt',6,'2025-11-24 02:11:38','2025-11-24 02:11:38'),(105,'Pending login attempt',6,'2025-11-24 02:22:56','2025-11-24 02:22:56'),(106,'User logged in',2,'2025-11-24 03:46:46','2025-11-24 03:46:46'),(107,'Changed status of may-an mayo from 1 to Approved',2,'2025-11-24 03:47:06','2025-11-24 03:47:06'),(108,'User logged in',6,'2025-11-24 03:47:39','2025-11-24 03:47:39'),(109,'User logged in',4,'2025-11-24 03:49:50','2025-11-24 03:49:50'),(110,'Updated research \\\'IMPACT WAKANDA\\\' to Approved',4,'2025-11-24 03:50:21','2025-11-24 03:50:21'),(111,'User logged in',3,'2025-11-24 03:51:00','2025-11-24 03:51:00'),(112,'User logged in',2,'2025-11-24 03:53:52','2025-11-24 03:53:52'),(113,'User logged in',2,'2025-11-24 03:55:53','2025-11-24 03:55:53');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `middlename` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Kimberly','Nolan','Cadman Bonner','rurinudiby@mailinator.com','$2y$10$ggrGE98dBhZQXhZCbs5rbe.H6vnwAwfWOyGEWqWQDpyUSm/A5JtIC','Labore porro ipsum l',1,2,'2025-11-23 13:36:15','2025-11-23 19:36:31'),(2,'Maricel','pre','opre','hhuwanaker@mailinator.com','$2y$10$NXzLR0OV9IGQqXDn9OrUSeFnyno282xk0MGJuEK8PshgvhbiziCMK','Et voluptatem volupt',4,2,'2025-11-23 13:36:26','2025-11-23 13:36:26'),(3,'jerome','fernandez','dean','qylaf@mailinator.com','$2y$10$rpjf9C9gDTfPGBX24Ck3e./8TSlJGGWN4jeGQ7tN.6FrxZBcoK9xS','In laudantium dolor',3,2,'2025-11-23 13:43:45','2025-11-23 13:43:45'),(4,'Shina','Apolinar','Marie','qexicivuk@dmmmsu.edu.ph','$2y$10$NooEGwJI2UdfY8j7yIacFOkYYCgU/RCuVlzO7MXIUpB/9LDICzvau','Molestiae consectetu',2,2,'2025-11-23 17:09:36','2025-11-23 17:09:36'),(5,'Mariam','Dudley','Megan Albert','gemi@dmmmsu.edu.ph','$2y$10$XUf8bepj7oaqMVb57nJ89e/c93QTBSus3xjt7cxoL7DzliLuVBncy','Et ad voluptatem ne',1,2,'2025-11-23 17:17:04','2025-11-23 19:36:40'),(6,'may-an','mayo','orine','mayo@dmmmsu.edu.ph','$2y$10$1r5DlmrXR7KMzSHcZx9rY.Fc9RpjFf5.78ioDaeJL.whN/wqIfZjq','santol',1,2,'2025-11-24 02:04:46','2025-11-24 03:47:06');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeestatus`
--

DROP TABLE IF EXISTS `employeestatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employeestatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statusName` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeestatus`
--

LOCK TABLES `employeestatus` WRITE;
/*!40000 ALTER TABLE `employeestatus` DISABLE KEYS */;
INSERT INTO `employeestatus` VALUES (1,'pending','2025-11-23 13:38:26','2025-11-23 13:38:26'),(2,'approved','2025-11-23 13:38:26','2025-11-23 13:38:26'),(3,'rejected','2025-11-23 13:38:37','2025-11-23 13:38:37');
/*!40000 ALTER TABLE `employeestatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employeetype`
--

DROP TABLE IF EXISTS `employeetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employeetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employeetype`
--

LOCK TABLES `employeetype` WRITE;
/*!40000 ALTER TABLE `employeetype` DISABLE KEYS */;
INSERT INTO `employeetype` VALUES (1,'researcher','2025-11-23 13:48:51','2025-11-23 13:48:51'),(2,'section_head','2025-11-23 13:48:51','2025-11-23 13:48:51'),(3,'division_chief','2025-11-23 13:50:17','2025-11-23 13:50:17'),(4,'admin','2025-11-23 14:35:41','2025-11-23 14:35:41');
/*!40000 ALTER TABLE `employeetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'Welcome, Kimberly! Your account has been created.',1,0,'2025-11-23 13:36:15','2025-11-23 13:36:15'),(2,'Welcome, Cyrus! Your account has been created.',2,0,'2025-11-23 13:36:26','2025-11-23 13:36:26'),(3,'Welcome, Lucian! Your account has been created.',3,0,'2025-11-23 13:43:45','2025-11-23 13:43:45'),(4,'New research uploaded by Lucian Francis: Magna praesentium si',3,0,'2025-11-23 16:17:28','2025-11-23 16:17:28'),(5,'New research uploaded by Kimberly Nolan, Cyrus Atkins: Voluptatem exercitat',3,0,'2025-11-23 16:28:31','2025-11-23 16:28:31'),(6,'New research uploaded by You: Est magnam blanditi',3,0,'2025-11-23 16:41:16','2025-11-23 16:41:16'),(7,'New research uploaded by Lucian Francis: Incididunt aliquam d',2,0,'2025-11-23 16:44:27','2025-11-23 16:44:27'),(8,'New research uploaded by You: Incididunt aliquam d',3,0,'2025-11-23 16:44:27','2025-11-23 16:44:27'),(9,'New research uploaded by Lucian Francis: Proident dolores de',2,0,'2025-11-23 16:47:58','2025-11-23 16:47:58'),(10,'Welcome, Jonas! Your account has been created.',4,0,'2025-11-23 17:09:36','2025-11-23 17:09:36'),(11,'New research uploaded by You: Enim iste labore dol',4,0,'2025-11-23 17:16:36','2025-11-23 17:16:36'),(12,'Welcome, Mariam! Your account has been created.',5,0,'2025-11-23 17:17:04','2025-11-23 17:17:04'),(13,'New research uploaded by You: Aute architecto adip',5,0,'2025-11-23 17:17:31','2025-11-23 17:17:31'),(14,'New research uploaded by You: Sunt hic ea enim omn',5,0,'2025-11-23 17:50:17','2025-11-23 17:50:17'),(15,'New research uploaded by Mariam Dudley: Sunt hic ea enim omn',2,0,'2025-11-23 17:50:17','2025-11-23 17:50:17'),(16,'New research uploaded by Mariam Dudley: Sunt hic ea enim omn',4,0,'2025-11-23 17:50:17','2025-11-23 17:50:17'),(17,'Your research \\\'Aute architecto adip\\\' has been Approved by Jonas Francis (Status ID: 2)',5,0,'2025-11-23 18:05:49','2025-11-23 18:05:49'),(18,'Your research \\\'Aute architecto adip\\\' has been Approved by Jonas Francis (Status ID: 2)',5,0,'2025-11-23 18:05:55','2025-11-23 18:05:55'),(19,'Your research \\\'Enim iste labore dol\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:12:38','2025-11-23 18:12:38'),(20,'Your research \\\'Enim iste labore dol\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:12:41','2025-11-23 18:12:41'),(21,'Your research \\\'Enim iste labore dol\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:14:43','2025-11-23 18:14:43'),(22,'Your research \\\'Enim iste labore dol\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:14:44','2025-11-23 18:14:44'),(23,'Your research \\\'Enim iste labore dol\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:14:47','2025-11-23 18:14:47'),(24,'Your research \\\'Ut obcaecati aut cul\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:14:51','2025-11-23 18:14:51'),(25,'Your research \\\'Ut obcaecati aut cul\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:14:54','2025-11-23 18:14:54'),(26,'Your research \\\'Ut obcaecati aut cul\\\' has been Approved by Jonas Francis)',4,0,'2025-11-23 18:18:34','2025-11-23 18:18:34'),(27,'Your research \\\'Laboriosam nemo est\\\' has been Approved by Jonas Francis)',2,0,'2025-11-23 18:18:36','2025-11-23 18:18:36'),(28,'Your research \\\'Incididunt aliquam d\\\' has been Approved by Jonas Francis)',3,0,'2025-11-23 18:18:56','2025-11-23 18:18:56'),(29,'Your research \\\'Rerum culpa tempori\\\' has been Approved by Jonas Francis)',2,0,'2025-11-23 18:19:10','2025-11-23 18:19:10'),(30,'Your research \\\'qweqwe\\\' has been Approved by Jonas Francis)',0,0,'2025-11-23 18:20:33','2025-11-23 18:20:33'),(31,'Your research \\\'Sunt hic ea enim omn\\\' has been Approved by Jonas Francis)',5,0,'2025-11-23 18:21:15','2025-11-23 18:21:15'),(32,'Your research \\\'Rerum culpa tempori\\\' has been Approved by Jonas Francis.',2,0,'2025-11-23 18:35:15','2025-11-23 18:35:15'),(33,'Your research \\\'Rerum culpa tempori\\\' has been Revised by Jonas Francis.',2,0,'2025-11-23 18:35:29','2025-11-23 18:35:29'),(34,'Your research \\\'Est magnam blanditi\\\' has been Revised by Jonas Francis.',3,0,'2025-11-23 18:38:29','2025-11-23 18:38:29'),(35,'Your research \\\'qweqwe\\\' has been Unknown by Lucian Francis)',0,0,'2025-11-23 18:54:10','2025-11-23 18:54:10'),(36,'Your research \\\'Rerum culpa tempori\\\' has been Revised by Lucian Francis.',2,0,'2025-11-23 18:58:22','2025-11-23 18:58:22'),(37,'Your research \\\'Rerum culpa tempori\\\' has been Revised by Lucian Francis.',2,0,'2025-11-23 18:58:34','2025-11-23 18:58:34'),(38,'Your research \\\'Rerum culpa tempori\\\' has been Revised by Lucian Francis.',2,0,'2025-11-23 18:58:39','2025-11-23 18:58:39'),(39,'Your research \\\'Rerum culpa tempori\\\' has been Revised by Lucian Francis.',2,0,'2025-11-23 18:59:55','2025-11-23 18:59:55'),(40,'Your research \\\'Rerum culpa tempori\\\' has been Published by Lucian Francis.',2,0,'2025-11-23 19:00:03','2025-11-23 19:00:03'),(41,'Your research \\\'Laboriosam nemo est\\\' has been Published by Lucian Francis.',2,0,'2025-11-23 19:09:33','2025-11-23 19:09:33'),(42,'Your research \\\'Ut obcaecati aut cul\\\' has been Revised by Lucian Francis.',4,0,'2025-11-23 19:09:41','2025-11-23 19:09:41'),(43,'Your account status has been Approved by admin.',1,0,'2025-11-23 19:36:31','2025-11-23 19:36:31'),(44,'Your account status has been Approved by admin.',5,0,'2025-11-23 19:36:40','2025-11-23 19:36:40'),(45,'New research uploaded by You: Labore ipsum dolorem',1,0,'2025-11-23 19:44:43','2025-11-23 19:44:43'),(46,'New research uploaded by Kimberly Nolan: Labore ipsum dolorem',2,0,'2025-11-23 19:44:43','2025-11-23 19:44:43'),(47,'New research uploaded by Kimberly Nolan: Labore ipsum dolorem',4,0,'2025-11-23 19:44:43','2025-11-23 19:44:43'),(48,'Your research \\\'Labore ipsum dolorem\\\' has been Approved by Jonas Francis.',1,0,'2025-11-23 19:56:43','2025-11-23 19:56:43'),(49,'Your research \\\'Rerum culpa tempori\\\' has been Revised by Jonas Francis.',2,0,'2025-11-23 19:56:51','2025-11-23 19:56:51'),(50,'Welcome, may-an! Your account has been created.',6,0,'2025-11-24 02:04:46','2025-11-24 02:04:46'),(51,'Your account status has been Approved by admin.',6,0,'2025-11-24 03:47:06','2025-11-24 03:47:06'),(52,'New research uploaded by You: IMPACT WAKANDA',6,0,'2025-11-24 03:48:44','2025-11-24 03:48:44'),(53,'New research uploaded by may-an mayo: IMPACT WAKANDA',2,0,'2025-11-24 03:48:44','2025-11-24 03:48:44'),(54,'New research uploaded by may-an mayo: IMPACT WAKANDA',4,0,'2025-11-24 03:48:44','2025-11-24 03:48:44'),(55,'Your research \\\'IMPACT WAKANDA\\\' has been Approved by Jonas Francis.',6,0,'2025-11-24 03:50:21','2025-11-24 03:50:21');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `research` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `filePath` varchar(200) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `member` varchar(255) NOT NULL,
  `compliance` text NOT NULL,
  `comment` text NOT NULL,
  `desisyon_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research`
--

LOCK TABLES `research` WRITE;
/*!40000 ALTER TABLE `research` DISABLE KEYS */;
INSERT INTO `research` VALUES (1,'qweqwe','qweqwe','1763914443_StartUp-Business-SmartCam.pdf','2025-11-26','2025-12-05','Cyrus Atkins, Kimberly Nolan, Lucian Francis','','',3,5,0,1,'2025-11-23 16:14:03','2025-11-23 18:54:10'),(2,'qweqwe','qweqwe','1763914473_StartUp-Business-SmartCam.pdf','2025-11-26','2025-12-05','Cyrus Atkins, Kimberly Nolan, Lucian Francis','','',0,1,0,1,'2025-11-23 16:14:33','2025-11-23 16:14:33'),(3,'qweqwe','qweqwe','1763914476_StartUp-Business-SmartCam.pdf','2025-11-26','2025-12-05','Cyrus Atkins, Kimberly Nolan, Lucian Francis','','',0,1,0,1,'2025-11-23 16:14:36','2025-11-23 16:14:36'),(4,'Voluptatum omnis omn','Quia illo aliqua Do','1763914493_StartUp-Business-SmartCam.pdf','2024-03-17','2015-12-03','Lucian Francis','','',0,1,0,1,'2025-11-23 16:14:53','2025-11-23 16:14:53'),(5,'Voluptatum omnis omn','Quia illo aliqua Do','1763914543_StartUp-Business-SmartCam.pdf','2024-03-17','2015-12-03','Lucian Francis','','',0,1,0,1,'2025-11-23 16:15:43','2025-11-23 16:15:43'),(6,'Repudiandae deserunt','Ratione in laudantiu','1763914562_StartUp-Business-SmartCam.pdf','2002-01-22','1971-05-08','Cyrus Atkins, Kimberly Nolan, Cyrus Atkins','','',0,1,0,1,'2025-11-23 16:16:02','2025-11-23 16:16:02'),(7,'Magna praesentium si','Aut voluptatibus tem','1763914648_StartUp-Business-SmartCam.pdf','1975-03-26','1979-04-04','Lucian Francis','','',0,1,0,1,'2025-11-23 16:17:28','2025-11-23 16:17:28'),(8,'Voluptatem exercitat','Sit ut aliqua Assu','1763915311_StartUp-Business-SmartCam.pdf','2015-07-09','1994-12-22','Kimberly Nolan, Cyrus Atkins','','',0,1,3,1,'2025-11-23 16:28:31','2025-11-23 16:28:31'),(9,'Est magnam blanditi','Enim incididunt minu','1763916076_StartUp-Business-SmartCam.pdf','1988-02-26','1993-06-26','Cyrus Atkins','1763923109_StartUp-Business-SmartCam.pdf','eqeqw',4,3,3,1,'2025-11-23 16:41:16','2025-11-23 18:38:29'),(10,'Incididunt aliquam d','Recusandae Ipsam la','1763916267_StartUp-Business-SmartCam.pdf','1973-08-21','1991-08-20','Cyrus Atkins','','',4,2,3,1,'2025-11-23 16:44:27','2025-11-23 18:18:56'),(11,'Proident dolores de','Exercitationem dolor','1763916478_StartUp-Business-SmartCam.pdf','1970-01-17','1971-12-08','Cyrus Atkins','','',0,1,3,1,'2025-11-23 16:47:58','2025-11-23 16:47:58'),(12,'Aut dolor soluta ten','Inventore quaerat eu','1763917112_StartUp-Business-SmartCam.pdf','2001-12-08','2000-06-13','Lucian Francis','','',0,1,2,1,'2025-11-23 16:58:32','2025-11-23 16:58:32'),(13,'Ex ullam architecto ','Lorem laborum volupt','1763917342_StartUp-Business-SmartCam.pdf','1989-07-18','1989-05-28','Kimberly Nolan','','',0,1,2,1,'2025-11-23 17:02:22','2025-11-23 17:02:22'),(14,'Rerum culpa tempori','Exercitationem ut ne','1763917368_StartUp-Business-SmartCam.pdf','2022-05-04','2019-03-04','Kimberly Nolan','1763927811_StartUp-Business-SmartCam.pdf','ewqew',4,3,2,1,'2025-11-23 17:02:48','2025-11-23 19:56:51'),(15,'Rerum culpa tempori','Exercitationem ut ne','1763917445_StartUp-Business-SmartCam.pdf','2022-05-04','2019-03-04','Kimberly Nolan','1763922928_StartUp-Business-SmartCam.pdf','meow',4,3,2,1,'2025-11-23 17:04:05','2025-11-23 18:35:28'),(16,'Rerum culpa tempori','Exercitationem ut ne','1763917640_StartUp-Business-SmartCam.pdf','2022-05-04','2019-03-04','Kimberly Nolan','1763924395_StartUp-Business-SmartCam.pdf','qwew',3,4,2,1,'2025-11-23 17:07:20','2025-11-23 18:59:55'),(17,'Rerum culpa tempori','Exercitationem ut ne','1763917651_StartUp-Business-SmartCam.pdf','2022-05-04','2019-03-04','Kimberly Nolan','','',3,5,2,1,'2025-11-23 17:07:31','2025-11-23 19:00:03'),(18,'Laboriosam nemo est','Voluptas nostrud lab','1763917663_StartUp-Business-SmartCam.pdf','2011-03-25','2004-02-02','Kimberly Nolan','','',3,5,2,1,'2025-11-23 17:07:43','2025-11-23 19:09:33'),(19,'Ut obcaecati aut cul','Quisquam laboriosam','1763917807_StartUp-Business-SmartCam.pdf','2009-01-21','1998-08-28','Kimberly Nolan','1763924981_SUMMARY-OF-KEY-TOPICS-FOR-FINALS-ISAE-108-SY-2025-2026.pdf','meow',3,4,4,1,'2025-11-23 17:10:07','2025-11-23 19:09:41'),(20,'Enim iste labore dol','Maiores qui quae vel','1763918063_StartUp-Business-SmartCam.pdf','1981-10-11','2018-12-29','Cyrus Atkins','','',4,2,4,1,'2025-11-23 17:14:23','2025-11-23 18:14:47'),(21,'Enim iste labore dol','Maiores qui quae vel','1763918196_StartUp-Business-SmartCam.pdf','1981-10-11','2018-12-29','Cyrus Atkins','','',4,2,4,1,'2025-11-23 17:16:36','2025-11-23 18:14:43'),(22,'Aute architecto adip','Alias quas fuga Eve','1763918251_StartUp-Business-SmartCam.pdf','1990-04-22','1986-07-07','Lucian Francis','','',4,2,5,1,'2025-11-23 17:17:31','2025-11-23 18:05:55'),(23,'Sunt hic ea enim omn','Incidunt tenetur pl','1763920217_StartUp-Business-SmartCam.pdf','2007-09-07','2011-03-26','Jonas Francis','','',4,2,5,1,'2025-11-23 17:50:17','2025-11-23 18:21:15'),(24,'Labore ipsum dolorem','Fuga Laboriosam sa','1763927083_StartUp-Business-SmartCam.pdf','1985-10-22','2021-08-15','Mariam Dudley','','',4,2,1,1,'2025-11-23 19:44:43','2025-11-23 19:56:43'),(25,'IMPACT WAKANDA','SDD,A DSDEDDS','1763956124_SUMMARY-OF-KEY-TOPICS-FOR-FINALS-ISAE-108-SY-2025-2026.pdf','2025-11-05','2025-11-27','Cyrus Atkins','','',4,2,6,1,'2025-11-24 03:48:44','2025-11-24 03:50:21');
/*!40000 ALTER TABLE `research` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `researchstatus`
--

DROP TABLE IF EXISTS `researchstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `researchstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statusName` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `researchstatus`
--

LOCK TABLES `researchstatus` WRITE;
/*!40000 ALTER TABLE `researchstatus` DISABLE KEYS */;
INSERT INTO `researchstatus` VALUES (1,'pending','2025-11-23 13:52:06','2025-11-23 13:52:06'),(2,'approved','2025-11-23 13:52:06','2025-11-23 13:52:06'),(3,'revised','2025-11-23 13:52:18','2025-11-23 13:52:18'),(4,'cancelled','2025-11-23 13:52:18','2025-11-23 13:52:18'),(5,'published','2025-11-23 13:52:29','2025-11-23 13:52:29');
/*!40000 ALTER TABLE `researchstatus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-24 11:59:12
