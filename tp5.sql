-- MySQL dump 10.13  Distrib 5.6.26, for Win64 (x86_64)
--
-- Host: localhost    Database: tp5
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `t_admin_admin`
--

DROP TABLE IF EXISTS `t_admin_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` char(6) NOT NULL COMMENT '加密串',
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户昵称',
  `groupid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属组别id',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `phone` char(11) DEFAULT NULL COMMENT '手机号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE COMMENT '用户名'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_admin`
--

LOCK TABLES `t_admin_admin` WRITE;
/*!40000 ALTER TABLE `t_admin_admin` DISABLE KEYS */;
INSERT INTO `t_admin_admin` VALUES (1,'admin','a5064e08c2ccd3fb0257bb4a9af4a29f','145963','超级管理员',0,1,'18687460581');
/*!40000 ALTER TABLE `t_admin_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_adminloginlog`
--

DROP TABLE IF EXISTS `t_admin_adminloginlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_adminloginlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员登录日志',
  `username` varchar(64) DEFAULT NULL COMMENT '登录用户名',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录日期',
  `loginip` char(15) NOT NULL DEFAULT '' COMMENT '登录ip',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '灯笼状态',
  `mess` varchar(30) DEFAULT NULL COMMENT '登录状态信息',
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE COMMENT '用户名索引'
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='后台管理员登录日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_adminloginlog`
--

LOCK TABLES `t_admin_adminloginlog` WRITE;
/*!40000 ALTER TABLE `t_admin_adminloginlog` DISABLE KEYS */;
INSERT INTO `t_admin_adminloginlog` VALUES (1,'admin',1482804705,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(2,'admin',1482804727,'127.0.0.1',0,'用户名或密码错误'),(3,'admin',1482804782,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(4,'admin',1482805385,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(5,'admin',1482805842,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(6,'admin',1482806400,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(7,'admin',1482808308,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(8,'admin',1482826288,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(9,'admin',1482826412,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(10,'admin',1482826455,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(11,'admin',1482826599,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(12,'admin',1482826626,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(13,'admin',1482826658,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(14,'admin',1482826756,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(15,'admin',1482826932,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(16,'admin',1482830245,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(17,'admin',1482830462,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(18,'admin',1482830481,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(19,'admin',1482830502,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(20,'admin',1482830740,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(21,'admin',1482830772,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(22,'admin',1482830883,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(23,'admin',1482830911,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(24,'admin',1482830949,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(25,'admin',1482831032,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(26,'admin',1482831261,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(27,'admin',1482831384,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(28,'admin',1482887905,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(29,'admin',1482998517,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(30,'admins',1482999049,'127.0.0.1',0,'用户名不存在或被禁用'),(31,'admins',1482999063,'127.0.0.1',0,'用户名不存在或被禁用'),(32,'admin',1482999073,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(33,'admin',1483061126,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(34,'admin',1483069665,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(35,'asdasd',1483069876,'127.0.0.1',0,'用户名不存在或被禁用'),(36,'asdasd',1483070663,'127.0.0.1',0,'用户名不存在或被禁用'),(37,'admin',1483070724,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(38,'admin',1483318908,'127.0.0.1',1,'登陆成功'),(39,'admin',1483405142,'127.0.0.1',1,'登陆成功'),(40,'admin',1483410751,'127.0.0.1',1,'登陆成功'),(41,'admin',1483410802,'127.0.0.1',1,'登陆成功'),(42,'admin',1483410847,'127.0.0.1',1,'登陆成功'),(43,'admin',1483410878,'127.0.0.1',1,'登陆成功'),(44,'admin',1483492009,'127.0.0.1',1,'登陆成功'),(45,'admin',1483514547,'127.0.0.1',1,'登陆成功'),(46,'admin',1483515426,'127.0.0.1',1,'登陆成功'),(47,'admin',1483582876,'127.0.0.1',1,'登陆成功'),(48,'admin',1483664328,'127.0.0.1',1,'登陆成功'),(49,'admin',1483675571,'127.0.0.1',1,'登陆成功'),(50,'admin',1483755065,'127.0.0.1',0,'登陆失败'),(51,'admin',1483755078,'127.0.0.1',1,'登陆成功'),(52,'admin',1483772407,'127.0.0.1',1,'登陆成功'),(53,'admin',1483772899,'127.0.0.1',1,'登陆成功');
/*!40000 ALTER TABLE `t_admin_adminloginlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_auth_group`
--

DROP TABLE IF EXISTS `t_admin_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_group`
--

LOCK TABLES `t_admin_auth_group` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_auth_group_access`
--

DROP TABLE IF EXISTS `t_admin_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_group_access`
--

LOCK TABLES `t_admin_auth_group_access` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_group_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_auth_rule`
--

DROP TABLE IF EXISTS `t_admin_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='规则表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_rule`
--

LOCK TABLES `t_admin_auth_rule` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_config`
--

DROP TABLE IF EXISTS `t_admin_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值',
  `group` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '配置类型',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '配置额外值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='系统配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_config`
--

LOCK TABLES `t_admin_config` WRITE;
/*!40000 ALTER TABLE `t_admin_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_admin_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_module`
--

DROP TABLE IF EXISTS `t_admin_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(31) NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(63) NOT NULL DEFAULT '' COMMENT '标题',
  `logo` varchar(63) NOT NULL DEFAULT '' COMMENT '图片图标',
  `icon` varchar(31) NOT NULL DEFAULT '' COMMENT '字体图标',
  `icon_color` varchar(7) NOT NULL DEFAULT '' COMMENT '字体图标颜色',
  `description` varchar(127) NOT NULL DEFAULT '' COMMENT '描述',
  `developer` varchar(31) NOT NULL DEFAULT '' COMMENT '开发者',
  `version` varchar(7) NOT NULL DEFAULT '' COMMENT '版本',
  `user_nav` text NOT NULL COMMENT '个人中心导航',
  `config` text NOT NULL COMMENT '配置',
  `admin_menu` text NOT NULL COMMENT '菜单节点',
  `is_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许卸载',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='模块功能表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_module`
--

LOCK TABLES `t_admin_module` WRITE;
/*!40000 ALTER TABLE `t_admin_module` DISABLE KEYS */;
INSERT INTO `t_admin_module` VALUES (1,'admin','系统','','&#xe62e;','#3CA6F1','核心系统','曲靖开发区奇讯科技有限公司','1.0.1','','','{\"1\":{\"pid\":\"0\",\"title\":\"\\u7cfb\\u7edf\",\"icon\":\"&#xe62e;\",\"level\":\"system\",\"id\":\"1\"},\"2\":{\"pid\":\"1\",\"title\":\"\\u7cfb\\u7edf\\u7ba1\\u7406\",\"icon\":\"&#xe62e;\",\"id\":\"2\"},\"3\":{\"pid\":\"2\",\"title\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"icon\":\"\",\"url\":\"admin\\/Config\\/configSet\",\"id\":\"3\"},\"4\":{\"pid\":\"1\",\"title\":\"\\u6269\\u5c55\\u4e2d\\u5fc3\",\"icon\":\"&#xe61f;\",\"id\":\"4\"},\"5\":{\"pid\":\"4\",\"title\":\"\\u529f\\u80fd\\u6a21\\u5757\",\"icon\":\"\",\"url\":\"admin\\/Module\\/index\",\"id\":\"5\"},\"6\":{\"pid\":\"5\",\"title\":\"\\u5b89\\u88c5\",\"url\":\"admin\\/Module\\/install\",\"id\":\"6\"},\"7\":{\"pid\":\"5\",\"title\":\"\\u5378\\u8f7d\",\"url\":\"admin\\/Module\\/uninstall\",\"id\":\"7\"},\"8\":{\"pid\":\"5\",\"title\":\"\\u66f4\\u65b0\\u4fe1\\u606f\",\"url\":\"admin\\/Module\\/updateInfo\",\"id\":\"8\"},\"9\":{\"pid\":\"5\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"admin\\/Module\\/setStatus\",\"id\":\"9\"}}',1,1438651748,1482137289,0,1);
/*!40000 ALTER TABLE `t_admin_module` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-07 15:59:27
