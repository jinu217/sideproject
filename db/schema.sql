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
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_state_current_user`
--

DROP TABLE IF EXISTS `app_state_current_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_state_current_user` (
  `singleton_id` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`singleton_id`),
  KEY `fk_as_user` (`user_id`),
  CONSTRAINT `fk_as_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `badge`
--

DROP TABLE IF EXISTS `badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `badge` (
  `badge_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`badge_id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domain` (
  `domain_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`domain_id`),
  UNIQUE KEY `uk_domain_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `position_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `uk_position_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `project_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `leader_id` bigint(20) unsigned NOT NULL,
  `title` varchar(120) NOT NULL,
  `content` text DEFAULT NULL,
  `status` enum('RECRUITING','CLOSED','COMPLETED') NOT NULL DEFAULT 'RECRUITING',
  `closed_at` datetime(6) DEFAULT NULL,
  `completed_at` datetime(6) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`project_id`),
  KEY `fk_prj_leader` (`leader_id`),
  FULLTEXT KEY `ft_project_title` (`title`),
  CONSTRAINT `fk_prj_leader` FOREIGN KEY (`leader_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_domain`
--

DROP TABLE IF EXISTS `project_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_domain` (
  `project_id` bigint(20) unsigned NOT NULL,
  `domain_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`domain_id`),
  KEY `fk_pd_dom` (`domain_id`),
  CONSTRAINT `fk_pd_dom` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`domain_id`),
  CONSTRAINT `fk_pd_prj` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_evaluation`
--

DROP TABLE IF EXISTS `project_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_evaluation` (
  `evaluation_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `rater_user_id` bigint(20) unsigned NOT NULL,
  `ratee_user_id` bigint(20) unsigned NOT NULL,
  `score` tinyint(3) unsigned NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`evaluation_id`),
  UNIQUE KEY `uk_once` (`project_id`,`rater_user_id`,`ratee_user_id`),
  KEY `fk_ev_rater` (`rater_user_id`),
  KEY `fk_ev_ratee` (`ratee_user_id`),
  CONSTRAINT `fk_ev_prj` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ev_ratee` FOREIGN KEY (`ratee_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ev_rater` FOREIGN KEY (`rater_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_member`
--

DROP TABLE IF EXISTS `project_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_member` (
  `project_member_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` enum('LEADER','MEMBER') NOT NULL DEFAULT 'MEMBER',
  `position_id` tinyint(3) unsigned DEFAULT NULL,
  `status` enum('APPLIED','ACCEPTED','REJECTED','CANCELED','LEFT') NOT NULL DEFAULT 'APPLIED',
  `applied_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `decided_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`project_member_id`),
  UNIQUE KEY `uk_pm_project_user` (`project_id`,`user_id`),
  KEY `idx_pm_prj_status` (`project_id`,`status`),
  KEY `fk_pm_user` (`user_id`),
  KEY `fk_pm_pos` (`position_id`),
  CONSTRAINT `fk_pm_pos` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pm_prj` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pm_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_position_need`
--

DROP TABLE IF EXISTS `project_position_need`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_position_need` (
  `project_id` bigint(20) unsigned NOT NULL,
  `position_id` tinyint(3) unsigned NOT NULL,
  `needed_count` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`position_id`),
  KEY `fk_ppn_pos` (`position_id`),
  CONSTRAINT `fk_ppn_pos` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`),
  CONSTRAINT `fk_ppn_prj` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_purpose`
--

DROP TABLE IF EXISTS `project_purpose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_purpose` (
  `project_id` bigint(20) unsigned NOT NULL,
  `purpose_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`purpose_id`),
  KEY `fk_pp_pur` (`purpose_id`),
  CONSTRAINT `fk_pp_prj` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pp_pur` FOREIGN KEY (`purpose_id`) REFERENCES `purpose` (`purpose_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `project_tool_need`
--

DROP TABLE IF EXISTS `project_tool_need`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_tool_need` (
  `project_id` bigint(20) unsigned NOT NULL,
  `tool_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`tool_id`),
  KEY `fk_ptn_tool` (`tool_id`),
  CONSTRAINT `fk_ptn_prj` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ptn_tool` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`tool_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purpose`
--

DROP TABLE IF EXISTS `purpose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purpose` (
  `purpose_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`purpose_id`),
  UNIQUE KEY `uk_purpose_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tool`
--

DROP TABLE IF EXISTS `tool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tool` (
  `tool_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `kind` enum('DEV','DESIGN') NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`tool_id`),
  UNIQUE KEY `uk_tool_kind_name` (`kind`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(40) NOT NULL,
  `intro` varchar(500) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `trust_score` decimal(4,2) NOT NULL DEFAULT 0.00,
  `ratings_count` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_badge`
--

DROP TABLE IF EXISTS `user_badge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_badge` (
  `user_id` bigint(20) unsigned NOT NULL,
  `badge_id` smallint(5) unsigned NOT NULL,
  `awarded_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`user_id`,`badge_id`),
  KEY `fk_ub_badge` (`badge_id`),
  CONSTRAINT `fk_ub_badge` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`badge_id`),
  CONSTRAINT `fk_ub_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_position`
--

DROP TABLE IF EXISTS `user_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_position` (
  `user_id` bigint(20) unsigned NOT NULL,
  `position_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`position_id`),
  KEY `fk_up_pos` (`position_id`),
  CONSTRAINT `fk_up_pos` FOREIGN KEY (`position_id`) REFERENCES `position` (`position_id`),
  CONSTRAINT `fk_up_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_tool`
--

DROP TABLE IF EXISTS `user_tool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_tool` (
  `user_id` bigint(20) unsigned NOT NULL,
  `tool_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`tool_id`),
  KEY `fk_ut_tool` (`tool_id`),
  CONSTRAINT `fk_ut_tool` FOREIGN KEY (`tool_id`) REFERENCES `tool` (`tool_id`),
  CONSTRAINT `fk_ut_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `v_project_list`
--

DROP TABLE IF EXISTS `v_project_list`;
/*!50001 DROP VIEW IF EXISTS `v_project_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_project_list` AS SELECT
 1 AS `project_id`,
  1 AS `title`,
  1 AS `status`,
  1 AS `created_at`,
  1 AS `updated_at`,
  1 AS `leader_id`,
  1 AS `leader_nickname`,
  1 AS `total_needed`,
  1 AS `total_accepted` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_user_rating`
--

DROP TABLE IF EXISTS `v_user_rating`;
/*!50001 DROP VIEW IF EXISTS `v_user_rating`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_user_rating` AS SELECT
 1 AS `user_id`,
  1 AS `avg_score`,
  1 AS `cnt` */;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'sideproject'
--

--
-- Final view structure for view `v_project_list`
--

/*!50001 DROP VIEW IF EXISTS `v_project_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_project_list` AS select `p`.`project_id` AS `project_id`,`p`.`title` AS `title`,`p`.`status` AS `status`,`p`.`created_at` AS `created_at`,`p`.`updated_at` AS `updated_at`,`p`.`leader_id` AS `leader_id`,`u`.`nickname` AS `leader_nickname`,ifnull(sum(distinct `ppn`.`needed_count`),0) AS `total_needed`,sum(case when `pm`.`status` = 'ACCEPTED' then 1 else 0 end) AS `total_accepted` from (((`project` `p` join `user` `u` on(`u`.`user_id` = `p`.`leader_id`)) left join `project_position_need` `ppn` on(`ppn`.`project_id` = `p`.`project_id`)) left join `project_member` `pm` on(`pm`.`project_id` = `p`.`project_id`)) group by `p`.`project_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_user_rating`
--

/*!50001 DROP VIEW IF EXISTS `v_user_rating`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_user_rating` AS select `project_evaluation`.`ratee_user_id` AS `user_id`,round(avg(`project_evaluation`.`score`),2) AS `avg_score`,count(0) AS `cnt` from `project_evaluation` group by `project_evaluation`.`ratee_user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-09 10:34:38
