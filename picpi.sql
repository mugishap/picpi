-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: picpi
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `activity_$username`
--

DROP TABLE IF EXISTS `activity_$username`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_$username` (
  `activity_id` varchar(255) DEFAULT uuid(),
  `count` int(11) NOT NULL AUTO_INCREMENT,
  `activity_time` datetime NOT NULL DEFAULT current_timestamp(),
  `activity_comment` varchar(255) NOT NULL,
  `related` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'READ',
  PRIMARY KEY (`count`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_$username`
--

LOCK TABLES `activity_$username` WRITE;
/*!40000 ALTER TABLE `activity_$username` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity_$username` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` varchar(255) NOT NULL DEFAULT uuid(),
  `comment_time` datetime NOT NULL DEFAULT current_timestamp(),
  `commenter_username` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `post_id` varchar(255) NOT NULL,
  `commenter_id` varchar(255) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES ('37a61d3d-e0f3-11ec-a6cf-900f0c840117','2022-05-31 17:06:15','mugishap','Nice song here!!!','27a2b19d-e0f3-11ec-a6cf-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117'),('499be4d2-e058-11ec-bcd6-900f0c840117','2022-05-30 22:37:30','mugishap','Comments are more than zero now','3e88a5ad-e058-11ec-bcd6-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117'),('5ad71045-e058-11ec-bcd6-900f0c840117','2022-05-30 22:37:59','mugishap','There are some more other bugs!!!','3e88a5ad-e058-11ec-bcd6-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117'),('620a92f2-e01e-11ec-bcd6-900f0c840117','2022-05-30 15:42:43','javis10','Good thinking btw!!!','6fd0ab91-e019-11ec-bcd6-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117'),('630c1aee-e191-11ec-8935-900f0c840117','2022-06-01 11:58:28','mugishap','Probably your mind is even lower than zero','586357f6-e191-11ec-8935-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117'),('90292b2b-e04f-11ec-bcd6-900f0c840117','2022-05-30 21:35:03','mugishap','hhhhhhhhhhh','f08b4f6b-e038-11ec-bcd6-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117'),('a348539e-e01f-11ec-bcd6-900f0c840117','2022-05-30 15:51:42','javis10','I still like my comments','6fd0ab91-e019-11ec-bcd6-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117'),('cdd49528-e19c-11ec-8935-900f0c840117','2022-06-01 13:55:00','javis10','Javis commented tooo','586357f6-e191-11ec-8935-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117'),('ead4ef10-e0f3-11ec-a6cf-900f0c840117','2022-05-31 17:11:16','mugishap','Good song people!!!!','835ddb0d-e0f3-11ec-a6cf-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followers_javis10`
--

DROP TABLE IF EXISTS `followers_javis10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followers_javis10` (
  `follow_id` varchar(255) NOT NULL DEFAULT uuid(),
  `follower_id` varchar(255) NOT NULL,
  `follower_username` varchar(32) NOT NULL,
  `follower_profile` varchar(255) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers_javis10`
--

LOCK TABLES `followers_javis10` WRITE;
/*!40000 ALTER TABLE `followers_javis10` DISABLE KEYS */;
INSERT INTO `followers_javis10` VALUES ('af959185-e02b-11ec-bcd6-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','mugishap','uploads/patrick.png');
/*!40000 ALTER TABLE `followers_javis10` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followers_mugishap`
--

DROP TABLE IF EXISTS `followers_mugishap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followers_mugishap` (
  `follow_id` varchar(255) NOT NULL DEFAULT uuid(),
  `follower_id` varchar(255) NOT NULL,
  `follower_username` varchar(32) NOT NULL,
  `follower_profile` varchar(255) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers_mugishap`
--

LOCK TABLES `followers_mugishap` WRITE;
/*!40000 ALTER TABLE `followers_mugishap` DISABLE KEYS */;
/*!40000 ALTER TABLE `followers_mugishap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `following_javis10`
--

DROP TABLE IF EXISTS `following_javis10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `following_javis10` (
  `follow_id` varchar(255) NOT NULL DEFAULT uuid(),
  `following_id` varchar(255) NOT NULL,
  `following_username` varchar(32) NOT NULL,
  `following_profile` varchar(255) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `following_javis10`
--

LOCK TABLES `following_javis10` WRITE;
/*!40000 ALTER TABLE `following_javis10` DISABLE KEYS */;
/*!40000 ALTER TABLE `following_javis10` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `following_mugishap`
--

DROP TABLE IF EXISTS `following_mugishap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `following_mugishap` (
  `follow_id` varchar(255) NOT NULL DEFAULT uuid(),
  `following_id` varchar(255) NOT NULL,
  `following_username` varchar(32) NOT NULL,
  `following_profile` varchar(255) NOT NULL,
  PRIMARY KEY (`follow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `following_mugishap`
--

LOCK TABLES `following_mugishap` WRITE;
/*!40000 ALTER TABLE `following_mugishap` DISABLE KEYS */;
INSERT INTO `following_mugishap` VALUES ('af76737d-e02b-11ec-bcd6-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117','javis10','uploads/Screenshot from 2022-05-30 07-16-26.png');
/*!40000 ALTER TABLE `following_mugishap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `highlights`
--

DROP TABLE IF EXISTS `highlights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `highlights` (
  `highlight_id` varchar(255) NOT NULL DEFAULT uuid(),
  `highlight_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`highlight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `highlights`
--

LOCK TABLES `highlights` WRITE;
/*!40000 ALTER TABLE `highlights` DISABLE KEYS */;
/*!40000 ALTER TABLE `highlights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `like_id` varchar(255) NOT NULL DEFAULT uuid(),
  `liker_id` varchar(255) DEFAULT NULL,
  `post_id` varchar(255) NOT NULL,
  `liker_profile` varchar(255) NOT NULL,
  `likerusername` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES ('48143182-e01e-11ec-bcd6-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117','6fd0ab91-e019-11ec-bcd6-900f0c840117','uploads/Screenshot from 2022-05-30 07-16-26.png','javis10'),('9b7e523f-e01f-11ec-bcd6-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117','40c926d8-e01e-11ec-bcd6-900f0c840117','uploads/Screenshot from 2022-05-30 07-16-26.png','javis10'),('f6595092-e038-11ec-bcd6-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','f08b4f6b-e038-11ec-bcd6-900f0c840117','uploads/patrick.png','mugishap'),('41b3a67f-e058-11ec-bcd6-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','3e88a5ad-e058-11ec-bcd6-900f0c840117','uploads/patrick.png','mugishap'),('340f2096-e0f3-11ec-a6cf-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','27a2b19d-e0f3-11ec-a6cf-900f0c840117','uploads/patrick.png','mugishap'),('8c1b51be-e0f3-11ec-a6cf-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','835ddb0d-e0f3-11ec-a6cf-900f0c840117','uploads/patrick.png','mugishap'),('5ac962f6-e191-11ec-8935-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','586357f6-e191-11ec-8935-900f0c840117','uploads/patrick.png','mugishap'),('e051c336-e192-11ec-8935-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','cfeb8813-e191-11ec-8935-900f0c840117','uploads/patrick.png','mugishap'),('e4c1d94f-e192-11ec-8935-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','4e3ed155-e0f3-11ec-a6cf-900f0c840117','uploads/patrick.png','mugishap'),('c41ac513-e19c-11ec-8935-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117','4e3ed155-e0f3-11ec-a6cf-900f0c840117','uploads/Screenshot from 2022-05-30 07-16-26.png','javis10'),('c5116352-e19c-11ec-8935-900f0c840117','3443dae2-e019-11ec-bcd6-900f0c840117','586357f6-e191-11ec-8935-900f0c840117','uploads/Screenshot from 2022-05-30 07-16-26.png','javis10');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` varchar(255) NOT NULL DEFAULT uuid(),
  `count` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(32) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`count`),
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES ('4e3ed155-e0f3-11ec-a6cf-900f0c840117',3,'2022-05-31 17:06:53','mugishap','uploads/patrick.png','Shopping cartShopping cart','uploads/shoppingcart.png','image'),('586357f6-e191-11ec-8935-900f0c840117',8,'2022-06-01 11:58:11','mugishap','uploads/patrick.png','Caption😀','uploads/Screenshot from 2022-06-01 11-44-16.png','image'),('cfeb8813-e191-11ec-8935-900f0c840117',9,'2022-06-01 12:01:31','mugishap','uploads/patrick.png','Juno 👏👏','uploads/(3) Juno Kizigenza - Ndarura (Official Music Video) - YouTube.mkv','video'),('0521be8a-e1b2-11ec-8935-900f0c840117',10,'2022-06-01 16:26:52','javis10','uploads/Screenshot from 2022-05-30 07-16-26.png','😀','uploads/(3) INANA - Chriss Eazy (Official Video) - YouTube.mkv','video');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `story_id` varchar(255) NOT NULL DEFAULT uuid(),
  `user_id` varchar(255) NOT NULL,
  `story_time` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(32) NOT NULL,
  `posterprofile` varchar(255) NOT NULL,
  `text` varchar(120) DEFAULT NULL,
  `media` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `remove_date` varchar(255) NOT NULL,
  `count` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`count`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES ('b5c11102-e1ba-11ec-8935-900f0c840117','f0defc8a-e020-11ec-bcd6-900f0c840117','2022-06-01 17:29:04','mugishap','uploads/patrick.png','','uploads/Screenshot from 2022-06-01 11-44-16.png','image','2022-06-02 17:29:04',1);
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` varchar(255) NOT NULL DEFAULT uuid(),
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `telephone` int(10) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(32) DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('3443dae2-e019-11ec-bcd6-900f0c840117','KALISA INEZA','Giovanni',782307144,'uploads/Screenshot from 2022-05-30 07-16-26.png','Male','Rwanda','javis10','gthecoderkalisaineza@gmail.com','3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2','user'),('f0defc8a-e020-11ec-bcd6-900f0c840117','MUGISHA','Precieux',782307144,'uploads/download.jpeg','Male','Rwanda','mugishap','precieuxmugisha@gmail.com','','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-01 19:38:21
