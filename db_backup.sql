-- MySQL dump 10.11
--
-- Host: localhost    Database: 10_kuciel
-- ------------------------------------------------------
-- Server version	5.0.51a-24+lenny5

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Comment`
--

DROP TABLE IF EXISTS `Comment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `comment_body` text NOT NULL,
  `comment_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `User_user_id` int(11) NOT NULL,
  `Post_post_id` int(11) NOT NULL,
  PRIMARY KEY  (`comment_id`),
  KEY `fk_Comment_User1_idx` (`User_user_id`),
  KEY `fk_Comment_Post1_idx` (`Post_post_id`),
  CONSTRAINT `fk_Comment_Post1` FOREIGN KEY (`Post_post_id`) REFERENCES `Post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_User1` FOREIGN KEY (`User_user_id`) REFERENCES `User` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Comment`
--

LOCK TABLES `Comment` WRITE;
/*!40000 ALTER TABLE `Comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Friendship`
--

DROP TABLE IF EXISTS `Friendship`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Friendship` (
  `friendship_id` int(11) NOT NULL auto_increment,
  `friendship_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `friend_1` int(11) NOT NULL,
  `friend_2` int(11) NOT NULL,
  `User_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`friendship_id`),
  UNIQUE KEY `friend_2_UNIQUE` (`friend_2`),
  UNIQUE KEY `friend_1_UNIQUE` (`friend_1`),
  KEY `fk_Friendship_User1_idx` (`User_user_id`),
  CONSTRAINT `fk_Friendship_User1` FOREIGN KEY (`User_user_id`) REFERENCES `User` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Friendship`
--

LOCK TABLES `Friendship` WRITE;
/*!40000 ALTER TABLE `Friendship` DISABLE KEYS */;
/*!40000 ALTER TABLE `Friendship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Like`
--

DROP TABLE IF EXISTS `Like`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Like` (
  `like_id` int(11) NOT NULL auto_increment,
  `Post_post_id` int(11) NOT NULL,
  `User_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`like_id`),
  KEY `fk_Like_Post1_idx` (`Post_post_id`),
  KEY `fk_Like_User1_idx` (`User_user_id`),
  CONSTRAINT `fk_Like_Post1` FOREIGN KEY (`Post_post_id`) REFERENCES `Post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Like_User1` FOREIGN KEY (`User_user_id`) REFERENCES `User` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Like`
--

LOCK TABLES `Like` WRITE;
/*!40000 ALTER TABLE `Like` DISABLE KEYS */;
/*!40000 ALTER TABLE `Like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Message` (
  `message_id` int(11) NOT NULL auto_increment,
  `id_from` int(11) NOT NULL,
  `id_to` int(11) NOT NULL,
  `message_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `msg_body` text NOT NULL,
  `User_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`message_id`),
  UNIQUE KEY `id_from_UNIQUE` (`id_from`),
  UNIQUE KEY `id_to_UNIQUE` (`id_to`),
  KEY `fk_Message_User_idx` (`User_user_id`),
  CONSTRAINT `fk_Message_User` FOREIGN KEY (`User_user_id`) REFERENCES `User` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `Message` DISABLE KEYS */;
/*!40000 ALTER TABLE `Message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Post` (
  `post_id` int(11) NOT NULL auto_increment,
  `post_body` text NOT NULL,
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `User_user_id` int(11) NOT NULL,
  PRIMARY KEY  (`post_id`),
  KEY `fk_Post_User1_idx` (`User_user_id`),
  CONSTRAINT `fk_Post_User1` FOREIGN KEY (`User_user_id`) REFERENCES `User` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (1,'asdasd','2015-02-19 11:31:59',1),(2,'asddsa','2015-02-19 13:19:36',1),(3,'zzzzzz','2015-02-19 13:22:06',2),(4,'ddd','2015-02-19 14:44:08',2),(5,'uuuuuu','2015-02-19 15:03:17',2),(6,'aaa','2015-02-20 08:05:03',2),(7,'body','2015-02-20 08:49:53',2),(8,'body','2015-02-20 08:51:18',2),(9,'nowe body','2015-02-20 09:21:13',2),(10,'nowe body','2015-02-20 09:21:33',2),(11,'nowe body','2015-02-20 09:21:46',2),(12,'NOWSZEEE body','2015-02-20 17:16:22',2),(13,'nowe body','2015-02-20 09:22:21',2),(14,'nowe body','2015-02-20 09:25:37',2),(15,'bez taga','2015-02-20 09:28:41',2),(16,'bez taga2','2015-02-20 09:29:01',2),(17,'bez taga2','2015-02-20 09:29:08',2),(18,'bez taga2','2015-02-20 09:30:14',2),(19,'bez taga2','2015-02-20 09:30:55',2),(20,'bez taga2','2015-02-20 09:35:18',2),(21,'bez taga2','2015-02-20 09:39:54',2),(22,'tag','2015-02-20 09:40:24',2),(23,'tag','2015-02-20 09:40:49',2),(24,'tag','2015-02-20 09:42:11',2),(25,'tag','2015-02-20 09:57:24',2),(26,'tagg','2015-02-20 10:10:53',2),(27,'asdasd','2015-02-20 10:15:31',2),(28,'asdasd','2015-02-20 10:17:20',2),(29,'asdasd','2015-02-20 10:17:30',2),(30,'asdasd','2015-02-20 10:18:36',2),(31,'asdasd','2015-02-20 10:18:55',2),(32,'asd','2015-02-20 10:19:33',2),(33,'asd','2015-02-20 10:19:42',2),(34,'asd','2015-02-20 10:19:46',2),(35,'aaa','2015-02-20 10:21:14',1),(36,'aaa','2015-02-20 10:23:00',1),(37,'aaa','2015-02-20 10:23:13',1),(38,'aaa','2015-02-20 10:23:30',1),(39,'aaa','2015-02-20 10:24:52',1),(40,'bbb','2015-02-20 10:25:11',1),(41,'bbb','2015-02-20 10:27:01',1),(42,'bbb','2015-02-20 10:27:17',1),(43,'bbb','2015-02-20 10:28:58',1),(44,'zzz','2015-02-20 10:31:22',1),(45,'zzz','2015-02-20 10:34:37',1),(46,'zzz','2015-02-20 10:35:41',1),(47,'zzz','2015-02-20 10:35:48',1),(48,'zzz','2015-02-20 10:37:49',1),(52,'persist','2015-02-20 10:42:24',1),(54,'POST','2015-02-20 10:51:49',1),(55,'tagataga','2015-02-20 10:53:37',1),(57,'tagataga','2015-02-20 10:54:54',1),(58,'awaria','2015-02-20 11:43:22',1),(59,'awaria2','2015-02-20 11:43:59',1),(60,'awaria266','2015-02-20 18:32:29',1),(61,'awaria3','2015-02-20 11:49:44',1),(62,'awaria3','2015-02-20 11:50:49',1),(63,'awaria43','2015-02-20 11:51:30',1),(64,'swieze','2015-02-20 11:51:49',1),(65,'Nowy post z dodanym tagiem','2015-02-20 15:22:47',1),(66,'asdasdsadsad','2015-02-20 15:24:06',1),(67,'tag','2015-02-20 15:27:26',1),(68,'awarrrrr','2015-02-20 16:24:22',1),(69,'ZAKTUALIZOWANE body','2015-02-20 16:46:07',1),(70,'ZAKTUALIZOWANE body','2015-02-20 16:46:37',1),(71,'ZAKTUALIZOWANE body','2015-02-20 16:47:39',1),(72,'NOWSZE body','2015-02-20 16:50:21',1),(73,'NOWSZE body','2015-02-20 16:53:11',1),(74,'TAG','2015-02-20 17:48:23',1),(75,'kupasna','2015-02-20 17:49:48',1),(76,'nowszebody','2015-02-20 21:29:49',1),(77,'xxx','2015-02-20 22:42:23',1),(78,'tag','2015-02-20 23:40:29',1);
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Post_Tags`
--

DROP TABLE IF EXISTS `Post_Tags`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Post_Tags` (
  `post_tag_id` int(11) NOT NULL auto_increment,
  `Tag_tag_id` int(11) NOT NULL,
  `Post_post_id` int(11) NOT NULL,
  PRIMARY KEY  (`post_tag_id`),
  KEY `fk_Post_Tags_Tag1_idx` (`Tag_tag_id`),
  KEY `fk_Post_Tags_Post1_idx` (`Post_post_id`),
  CONSTRAINT `fk_Post_Tags_Post1` FOREIGN KEY (`Post_post_id`) REFERENCES `Post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Post_Tags_Tag1` FOREIGN KEY (`Tag_tag_id`) REFERENCES `Tag` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Post_Tags`
--

LOCK TABLES `Post_Tags` WRITE;
/*!40000 ALTER TABLE `Post_Tags` DISABLE KEYS */;
INSERT INTO `Post_Tags` VALUES (1,18,55),(2,19,58),(3,19,60),(4,20,62),(5,20,63),(6,21,64),(7,22,65),(8,22,66),(9,1,67),(10,19,68),(11,23,69),(12,23,70),(13,23,71),(14,24,72),(15,24,73),(16,24,12),(17,1,74),(18,25,75),(19,25,75),(20,25,75),(21,26,76),(22,26,76),(23,26,76),(24,4,77),(25,1,78);
/*!40000 ALTER TABLE `Post_Tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tag`
--

DROP TABLE IF EXISTS `Tag`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `Tag` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag_name` varchar(45) default NULL,
  PRIMARY KEY  (`tag_id`),
  UNIQUE KEY `tag_name_UNIQUE` (`tag_name`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
INSERT INTO `Tag` VALUES (3,NULL),(11,'aaa'),(15,'aaaddd'),(20,'awaria3'),(19,'AWARYYJ'),(12,'kolejnytag'),(26,'krolowa'),(24,'NOWSZY'),(14,'nowy'),(2,'nowy tag'),(21,'swieze'),(1,'tag'),(18,'tagataga'),(25,'tagokupa'),(22,'tagowalnia'),(4,'xxx'),(23,'ZAKTUALIZOWANY TAG'),(13,'zzz');
/*!40000 ALTER TABLE `Tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `User` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(45) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(45) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birth_date` date NOT NULL,
  `city` varchar(45) NOT NULL,
  `phone` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'asd','a8f5f167f44f4964e6c998dee827110c','asd@asd.pl','f','2015-02-13','asdasdsa','999999999'),(2,'kuciel','79a9e5fe6194ae82c607a713b703a63a','asd@asd.pl','f','2015-02-13','asdasd','999999999'),(3,'dsa','c91c03ea6c46a86cbc019be3d71d0a1a','asd@asd.pl','m','2015-02-14','dsadsa','999999999'),(4,'zzzzzz','453e41d218e071ccfb2d1c99ce23906a','asd@asd.pl','m','2015-02-07','zzzzzz','999999999'),(5,'xxxxxx','dad3a37aa9d50688b5157698acfd7aee','asd@asd.pl','m','2015-02-14','xxxxxx','999999999');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-21  0:11:58
