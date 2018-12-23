-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sport
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10

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
-- Table structure for table `athlete`
--

DROP TABLE IF EXISTS `athlete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `athlete` (
  `id_athlete` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `id_club` int(5) unsigned NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `fam_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_athlete`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `athlete`
--

LOCK TABLES `athlete` WRITE;
/*!40000 ALTER TABLE `athlete` DISABLE KEYS */;
INSERT INTO `athlete` VALUES (1,1,'ÐÐ»ÐµÐºÑÐ°Ð½Ð´Ñ€','Ð¨Ð½Ð°Ñ€'),(2,1,'ÐÐ»ÐµÐºÑÐµÐ¹','Ð›Ð¸Ñ‚Ð°Ñƒ'),(3,3,'Ð¡ÐµÑ€Ð³ÐµÐ¹','ÐšÑƒÑ‚Ð¸Ð»Ð¸Ð½'),(4,1,'Ð¡ÐµÑ€Ð³ÐµÐ¹','ÐšÐ¾Ð»ÐµÑÐ¾Ð²'),(5,1,'Ð˜Ð²Ð°Ð½','Ð”Ñ€Ð°Ð½Ð¸Ñ‡Ð½Ð¸ÐºÐ¾Ð²'),(6,2,'ÐÐ»ÐµÐ½Ð°','Ð§Ð¸Ñ€ÐºÐ¾Ð²Ð°');
/*!40000 ALTER TABLE `athlete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `building` (
  `id_building` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_type` int(5) unsigned NOT NULL,
  `name_building` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_building`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
INSERT INTO `building` VALUES (1,1,'Ð’Ð Ð—'),(2,2,'Ð‘Ð¸Ð¹ÑÐºÐ¸Ð¹'),(3,1,'ÐŸÐ¾Ð»Ð¸Ñ‚ÐµÑ…');
/*!40000 ALTER TABLE `building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat`
--

DROP TABLE IF EXISTS `cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat` (
  `id_cat` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name_cat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat`
--

LOCK TABLES `cat` WRITE;
/*!40000 ALTER TABLE `cat` DISABLE KEYS */;
INSERT INTO `cat` VALUES (1,'III'),(2,'II'),(3,'I'),(4,'ÐšÐœÐ¡'),(5,'ÐœÐ¡'),(6,'ÐœÐ¡ÐœÐš');
/*!40000 ALTER TABLE `cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id_sport` int(5) unsigned NOT NULL,
  `id_athlete` int(5) unsigned NOT NULL,
  `id_cat` int(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,1,3),(2,2,4),(3,3,3),(1,4,2),(1,5,1),(6,6,2);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `char_build`
--

DROP TABLE IF EXISTS `char_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `char_build` (
  `id_building` int(5) unsigned NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `pole_ww` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `char_build`
--

LOCK TABLES `char_build` WRITE;
/*!40000 ALTER TABLE `char_build` DISABLE KEYS */;
INSERT INTO `char_build` VALUES (1,'Ð¢Ð¸Ð¿ Ð¿Ð¾ÐºÑ€Ñ‹Ñ‚Ð¸Ñ','Ð“Ð°Ð·Ð¾Ð½'),(1,'ÐšÐ¾Ð»Ð¸Ñ‡ÐµÑÑ‚Ð²Ð¾ Ð¼ÐµÑÑ‚','1500'),(1,'Ð Ð°Ð·Ð¼ÐµÑ€','150Ð¥20'),(2,'Ð’Ñ‹ÑÐ¾Ñ‚Ð° Ð¿Ð¾Ñ‚Ð¾Ð»ÐºÐ°','8'),(2,'Ð Ð°Ð·Ð¼ÐµÑ€','20X3'),(2,'Ð¢Ð¸Ð¿ Ð¿Ð¾ÐºÑ€Ñ‹Ñ‚Ð¸Ñ','Ð”ÐµÑ€ÐµÐ²Ð¾'),(2,'ÐšÐ¾Ð»Ð¸Ñ‡ÐµÑÑ‚Ð²Ð¾ Ð¼ÐµÑÑ‚','20'),(3,'Ð¢Ð¸Ð¿ Ð¿Ð¾ÐºÑ€Ñ‹Ñ‚Ð¸Ñ','Ð³Ð°Ð·Ð¾Ð½'),(3,'ÐšÐ¾Ð»Ð¸Ñ‡ÐµÑÑ‚Ð²Ð¾ Ð¼ÐµÑÑ‚','1000'),(3,'Ð Ð°Ð·Ð¼ÐµÑ€','100Ð¥50');
/*!40000 ALTER TABLE `char_build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `id_club` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name_club` varchar(80) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `fam_name` varchar(40) DEFAULT NULL,
  `site` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_club`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
INSERT INTO `club` VALUES (1,'Ð‘Ð¢Ð˜',NULL,NULL,NULL),(2,'Ð”Ð¸Ð½Ð°Ð¼Ð¾',NULL,NULL,NULL),(3,'Ð¦Ð¡ÐšÐ',NULL,NULL,NULL);
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest`
--

DROP TABLE IF EXISTS `contest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest` (
  `id_contest` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_sport` int(5) unsigned NOT NULL,
  `id_org` int(5) unsigned NOT NULL,
  `id_building` int(5) unsigned NOT NULL,
  `date_contest` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_contest`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest`
--

LOCK TABLES `contest` WRITE;
/*!40000 ALTER TABLE `contest` DISABLE KEYS */;
INSERT INTO `contest` VALUES (8,1,1,2,'12.12.2012');
/*!40000 ALTER TABLE `contest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equivalent`
--

DROP TABLE IF EXISTS `equivalent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equivalent` (
  `id_sport` int(5) unsigned NOT NULL,
  `id_trainer` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equivalent`
--

LOCK TABLES `equivalent` WRITE;
/*!40000 ALTER TABLE `equivalent` DISABLE KEYS */;
INSERT INTO `equivalent` VALUES (1,1),(2,1),(3,2),(4,3),(4,4),(6,5),(4,6),(5,6);
/*!40000 ALTER TABLE `equivalent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `org_contest`
--

DROP TABLE IF EXISTS `org_contest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `org_contest` (
  `id_org` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_org`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `org_contest`
--

LOCK TABLES `org_contest` WRITE;
/*!40000 ALTER TABLE `org_contest` DISABLE KEYS */;
INSERT INTO `org_contest` VALUES (1,'ÐÐ´Ð¼Ð¸Ð½Ð¸ÑÑ‚Ñ€Ð°Ñ†Ð¸Ñ Ð³Ð¾Ñ€Ð¾Ð´Ð°'),(2,'Ð¡Ðš Ð—Ð°Ñ€Ñ'),(3,'1 ÐºÐ°Ð½Ð°Ð»');
/*!40000 ALTER TABLE `org_contest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `play`
--

DROP TABLE IF EXISTS `play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `play` (
  `id_athlete` int(4) unsigned NOT NULL,
  `id_sport` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `play`
--

LOCK TABLES `play` WRITE;
/*!40000 ALTER TABLE `play` DISABLE KEYS */;
INSERT INTO `play` VALUES (1,1),(2,2),(3,3),(4,1),(5,1),(6,6);
/*!40000 ALTER TABLE `play` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id_contest` int(5) unsigned NOT NULL,
  `id_athlete` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (8,1),(8,4),(8,5);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pole`
--

DROP TABLE IF EXISTS `pole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pole` (
  `id_type` int(5) unsigned NOT NULL,
  `opisanie` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pole`
--

LOCK TABLES `pole` WRITE;
/*!40000 ALTER TABLE `pole` DISABLE KEYS */;
INSERT INTO `pole` VALUES (1,'Ð¢Ð¸Ð¿ Ð¿Ð¾ÐºÑ€Ñ‹Ñ‚Ð¸Ñ'),(1,'ÐšÐ¾Ð»Ð¸Ñ‡ÐµÑÑ‚Ð²Ð¾ Ð¼ÐµÑÑ‚'),(1,'Ð Ð°Ð·Ð¼ÐµÑ€'),(2,'Ð’Ñ‹ÑÐ¾Ñ‚Ð° Ð¿Ð¾Ñ‚Ð¾Ð»ÐºÐ°'),(2,'Ð Ð°Ð·Ð¼ÐµÑ€'),(2,'Ð¢Ð¸Ð¿ Ð¿Ð¾ÐºÑ€Ñ‹Ñ‚Ð¸Ñ'),(2,'ÐšÐ¾Ð»Ð¸Ñ‡ÐµÑÑ‚Ð²Ð¾ Ð¼ÐµÑÑ‚');
/*!40000 ALTER TABLE `pole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priz`
--

DROP TABLE IF EXISTS `priz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priz` (
  `id_contest` int(5) unsigned NOT NULL,
  `I_mesto` int(5) unsigned NOT NULL,
  `II_mesto` int(5) unsigned NOT NULL,
  `III_mesto` int(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priz`
--

LOCK TABLES `priz` WRITE;
/*!40000 ALTER TABLE `priz` DISABLE KEYS */;
INSERT INTO `priz` VALUES (8,4,1,5);
/*!40000 ALTER TABLE `priz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport` (
  `id_sport` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name_sport` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_sport`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport`
--

LOCK TABLES `sport` WRITE;
/*!40000 ALTER TABLE `sport` DISABLE KEYS */;
INSERT INTO `sport` VALUES (1,'Ð–Ð¸Ð¼ ÑˆÑ‚Ð°Ð½Ð³Ð¸ Ð»ÐµÐ¶Ð°'),(2,'ÐŸÐ°ÑƒÑÑ€Ð»Ð¸Ñ„Ñ‚Ð¸Ð½Ð³'),(3,'ÐÐ°ÑÑ‚Ð¾Ð»ÑŒÐ½Ñ‹Ð¹ Ñ‚ÐµÐ½Ð½Ð¸Ñ'),(4,'Ð¤ÑƒÑ‚Ð±Ð¾Ð»'),(5,'Ð’Ð¾Ð»ÐµÐ¹Ð±Ð¾Ð»'),(6,'Ð¨Ð°Ñ…Ð¼Ð°Ñ‚Ñ‹');
/*!40000 ALTER TABLE `sport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainer` (
  `id_trainer` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `fam_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_trainer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainer`
--

LOCK TABLES `trainer` WRITE;
/*!40000 ALTER TABLE `trainer` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training` (
  `id_athlete` int(5) unsigned NOT NULL,
  `id_trainer` int(4) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `training`
--

LOCK TABLES `training` WRITE;
/*!40000 ALTER TABLE `training` DISABLE KEYS */;
INSERT INTO `training` VALUES (1,1),(2,1),(3,2),(4,1),(5,1),(6,5);
/*!40000 ALTER TABLE `training` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_building`
--

DROP TABLE IF EXISTS `type_building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_building` (
  `id_type` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name_type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_building`
--

LOCK TABLES `type_building` WRITE;
/*!40000 ALTER TABLE `type_building` DISABLE KEYS */;
INSERT INTO `type_building` VALUES (1,'Ð¡Ñ‚Ð°Ð´Ð¸Ð¾Ð½'),(2,'Ð¡Ð¿Ð¾Ñ€Ñ‚Ð¸Ð²Ð½Ñ‹Ð¹ Ð·Ð°Ð»');
/*!40000 ALTER TABLE `type_building` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-04-04 21:44:01
