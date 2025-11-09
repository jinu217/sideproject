-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sideproject
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `app_state_current_user`
--

LOCK TABLES `app_state_current_user` WRITE;
/*!40000 ALTER TABLE `app_state_current_user` DISABLE KEYS */;
INSERT INTO `app_state_current_user` VALUES (1,1);
/*!40000 ALTER TABLE `app_state_current_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `badge`
--

LOCK TABLES `badge` WRITE;
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;
INSERT INTO `badge` VALUES (1,'FIRST_COMPLETE','첫 완주','처음으로 프로젝트를 완료했습니다.'),(2,'RATING_45_PLUS','별점 4.5+','평균 별점 4.5 이상을 달성했습니다.'),(3,'FIVE_COMPLETED','5회 완주','완료 프로젝트 5건 달성');
/*!40000 ALTER TABLE `badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (3,'AI/데이터/IT'),(4,'게임'),(5,'교육'),(1,'금융'),(15,'라이프스타일'),(11,'모빌리티'),(7,'미디어/컨텐츠/OTT'),(9,'부동산'),(14,'뷰티'),(6,'소셜/커뮤니티'),(8,'아커머스'),(12,'여행'),(13,'패션'),(10,'핀테크'),(2,'헬스케어');
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'기획자'),(2,'디자이너'),(3,'백엔드'),(4,'프론트엔드');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,1,'AI 스터디툴 만들기','할 사람 오쇼','COMPLETED','2025-11-09 02:00:03.537371','2025-11-09 02:00:21.373950','2025-11-09 01:57:44.293739','2025-11-09 02:00:21.373950'),(2,1,'AI 스터디툴 만들기','할 사람 오쇼','COMPLETED','2025-11-09 02:05:47.471371','2025-11-09 02:05:51.801805','2025-11-09 01:58:56.505419','2025-11-09 02:05:51.801805'),(3,1,'AI 스터디툴 만들기123','할 사람 오쇼','RECRUITING',NULL,NULL,'2025-11-09 01:59:22.660642','2025-11-09 02:40:33.161657');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_domain`
--

LOCK TABLES `project_domain` WRITE;
/*!40000 ALTER TABLE `project_domain` DISABLE KEYS */;
INSERT INTO `project_domain` VALUES (1,3),(2,3),(3,3);
/*!40000 ALTER TABLE `project_domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_evaluation`
--

LOCK TABLES `project_evaluation` WRITE;
/*!40000 ALTER TABLE `project_evaluation` DISABLE KEYS */;
INSERT INTO `project_evaluation` VALUES (1,2,3,1,5,'개못하네요','2025-11-09 02:06:08.480607'),(2,2,2,1,1,'개못하네요1','2025-11-09 02:06:36.964258'),(3,1,2,1,1,'개못하네요','2025-11-09 02:06:52.836303'),(4,1,3,1,4,'개못하네요1','2025-11-09 02:07:06.932520');
/*!40000 ALTER TABLE `project_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_member`
--

LOCK TABLES `project_member` WRITE;
/*!40000 ALTER TABLE `project_member` DISABLE KEYS */;
INSERT INTO `project_member` VALUES (1,1,1,'LEADER',NULL,'ACCEPTED','2025-11-09 01:57:44.296971','2025-11-09 01:57:44.296971'),(2,1,2,'MEMBER',3,'ACCEPTED','2025-11-09 01:58:28.307008','2025-11-09 01:58:39.424797'),(3,2,1,'LEADER',NULL,'ACCEPTED','2025-11-09 01:58:56.516291','2025-11-09 01:58:56.516291'),(4,3,1,'LEADER',NULL,'ACCEPTED','2025-11-09 01:59:22.671192','2025-11-09 01:59:22.671192'),(5,1,3,'MEMBER',2,'ACCEPTED','2025-11-09 01:59:42.562660','2025-11-09 01:59:52.035161'),(6,2,2,'MEMBER',3,'ACCEPTED','2025-11-09 02:05:02.501614','2025-11-09 02:05:21.968136'),(7,2,3,'MEMBER',2,'ACCEPTED','2025-11-09 02:05:11.894329','2025-11-09 02:05:23.785945');
/*!40000 ALTER TABLE `project_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_position_need`
--

LOCK TABLES `project_position_need` WRITE;
/*!40000 ALTER TABLE `project_position_need` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_position_need` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_purpose`
--

LOCK TABLES `project_purpose` WRITE;
/*!40000 ALTER TABLE `project_purpose` DISABLE KEYS */;
INSERT INTO `project_purpose` VALUES (1,2),(2,2),(3,2);
/*!40000 ALTER TABLE `project_purpose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_tool_need`
--

LOCK TABLES `project_tool_need` WRITE;
/*!40000 ALTER TABLE `project_tool_need` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_tool_need` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `purpose`
--

LOCK TABLES `purpose` WRITE;
/*!40000 ALTER TABLE `purpose` DISABLE KEYS */;
INSERT INTO `purpose` VALUES (6,'기타'),(1,'부입'),(5,'역량 형성'),(4,'취미/재미'),(3,'취업'),(2,'포트폴리오');
/*!40000 ALTER TABLE `purpose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tool`
--

LOCK TABLES `tool` WRITE;
/*!40000 ALTER TABLE `tool` DISABLE KEYS */;
INSERT INTO `tool` VALUES (17,'DEV','Django'),(13,'DEV','Express'),(20,'DEV','Firebase'),(21,'DEV','Flutter'),(11,'DEV','Go'),(19,'DEV','GraphQL'),(7,'DEV','Java'),(1,'DEV','JavaScript'),(12,'DEV','Kotlin'),(15,'DEV','MongoDB'),(14,'DEV','MySQL'),(10,'DEV','Nestjs'),(6,'DEV','Nextjs'),(9,'DEV','Nodejs'),(18,'DEV','php'),(16,'DEV','Python'),(3,'DEV','React'),(23,'DEV','ReactNative'),(8,'DEV','Spring'),(5,'DEV','Svelte'),(22,'DEV','Swift'),(2,'DEV','TypeScript'),(24,'DEV','Unity'),(4,'DEV','Vue'),(26,'DESIGN','Adobe After Effects'),(28,'DESIGN','Adobe Illustrator'),(30,'DESIGN','Adobe InDesign'),(29,'DESIGN','Adobe Photoshop'),(27,'DESIGN','Adobe Premiere Pro'),(47,'DESIGN','AutoCAD'),(32,'DESIGN','Blender'),(31,'DESIGN','Canva'),(38,'DESIGN','CapCut'),(33,'DESIGN','Cinema 4D'),(50,'DESIGN','CLO 3D'),(34,'DESIGN','DALL-E 3'),(37,'DESIGN','Final Cut Pro'),(42,'DESIGN','Framer'),(49,'DESIGN','Fusion 360'),(52,'DESIGN','Glyphs'),(54,'DESIGN','Hotjar'),(51,'DESIGN','Marvelous Designer'),(53,'DESIGN','Maze'),(36,'DESIGN','Midjourney'),(40,'DESIGN','Miro'),(55,'DESIGN','Procreate'),(41,'DESIGN','protopie'),(48,'DESIGN','Rhinoceros'),(35,'DESIGN','Runway'),(46,'DESIGN','SketchUp'),(44,'DESIGN','Unity'),(45,'DESIGN','Unreal Engine'),(39,'DESIGN','VREW'),(43,'DESIGN','Webflow'),(25,'DESIGN','피그마');
/*!40000 ALTER TABLE `tool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'유저1','PM/기획 관심','/img/u1.png',2.00,4,'2025-11-09 01:41:04.117624','2025-11-09 02:07:06.937392'),(2,'유저2','PM/기획 관심있음','/img/u1.png',0.00,0,'2025-11-09 01:41:04.117624','2025-11-09 02:21:09.471413'),(3,'유저3','디자이너','/img/u3.png',0.00,0,'2025-11-09 01:41:04.117624','2025-11-09 01:41:04.117624');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_badge`
--

LOCK TABLES `user_badge` WRITE;
/*!40000 ALTER TABLE `user_badge` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_badge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_position`
--

LOCK TABLES `user_position` WRITE;
/*!40000 ALTER TABLE `user_position` DISABLE KEYS */;
INSERT INTO `user_position` VALUES (1,1),(2,4),(3,2);
/*!40000 ALTER TABLE `user_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_tool`
--

LOCK TABLES `user_tool` WRITE;
/*!40000 ALTER TABLE `user_tool` DISABLE KEYS */;
INSERT INTO `user_tool` VALUES (2,2),(2,3),(3,25);
/*!40000 ALTER TABLE `user_tool` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-09 10:34:50
