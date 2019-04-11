CREATE DATABASE  IF NOT EXISTS `newvolunteer` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `newvolunteer`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: newvolunteer
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

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
-- Table structure for table `activitiy`
--

DROP TABLE IF EXISTS `activitiy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activitiy` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `hoster` int(11) NOT NULL DEFAULT '0',
  `title` varchar(45) NOT NULL,
  `summary` varchar(140) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `peoplenum` int(10) unsigned NOT NULL DEFAULT '0',
  `alltime` int(10) unsigned NOT NULL DEFAULT '0',
  `contact` varchar(45) NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '1 -  默认状态 表示开启\n0 - 被删除，不显示 用>0筛选可显示的活动\n2 - 无法参与\n10位数以上 - 时间戳，结束日期（不可申请认证的日期',
  `starttime` int(12) unsigned NOT NULL,
  `volunteertimemin` float NOT NULL DEFAULT '1' COMMENT '单位为小时',
  `volunteertimemax` float NOT NULL DEFAULT '1',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(12) unsigned NOT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `aid_UNIQUE` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activitiy`
--

LOCK TABLES `activitiy` WRITE;
/*!40000 ALTER TABLE `activitiy` DISABLE KEYS */;
/*!40000 ALTER TABLE `activitiy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stuid` varchar(10) NOT NULL,
  `level` int(10) unsigned NOT NULL DEFAULT '1',
  `yuan` int(10) unsigned NOT NULL DEFAULT '1',
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  `lastupdate` varchar(10) NOT NULL DEFAULT '0',
  `lasttime` datetime NOT NULL DEFAULT '2017-11-11 11:11:11',
  PRIMARY KEY (`adminid`),
  UNIQUE KEY `adminid_UNIQUE` (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'031630226',6,0,1,'0','2017-11-11 11:11:11');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoster`
--

DROP TABLE IF EXISTS `hoster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hoster` (
  `hid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hostname` varchar(45) NOT NULL,
  `hostnickname` varchar(45) NOT NULL,
  PRIMARY KEY (`hid`),
  UNIQUE KEY `hid_UNIQUE` (`hid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoster`
--

LOCK TABLES `hoster` WRITE;
/*!40000 ALTER TABLE `hoster` DISABLE KEYS */;
/*!40000 ALTER TABLE `hoster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join`
--

DROP TABLE IF EXISTS `join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `join` (
  `jid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stuid` varchar(10) NOT NULL,
  `aid` int(10) unsigned NOT NULL,
  `timelong` float NOT NULL DEFAULT '0',
  `status` int(10) unsigned NOT NULL COMMENT '0 - 未认证\n>10位 认证时间',
  `optadmin` varchar(10) NOT NULL DEFAULT '0',
  `opttime` datetime NOT NULL DEFAULT '2017-11-11 11:11:11',
  PRIMARY KEY (`jid`),
  UNIQUE KEY `jid_UNIQUE` (`jid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join`
--

LOCK TABLES `join` WRITE;
/*!40000 ALTER TABLE `join` DISABLE KEYS */;
/*!40000 ALTER TABLE `join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `typeid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typename` varchar(45) NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`typeid`),
  UNIQUE KEY `typeid_UNIQUE` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stuid` varchar(10) NOT NULL,
  `uname` varchar(16) NOT NULL,
  `gender` varchar(1) NOT NULL DEFAULT '男',
  `status` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(13) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid_UNIQUE` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-17 16:54:06
