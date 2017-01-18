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
-- Table structure for table `t_admin_action`
--

DROP TABLE IF EXISTS `t_admin_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(16) NOT NULL DEFAULT '' COMMENT '所属模块名',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` varchar(80) NOT NULL DEFAULT '' COMMENT '行为标题',
  `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='系统行为表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_action`
--

LOCK TABLES `t_admin_action` WRITE;
/*!40000 ALTER TABLE `t_admin_action` DISABLE KEYS */;
INSERT INTO `t_admin_action` VALUES (1,'admin','module_update','更新模块','更新模块','','[user|get_nickname] 更新了模块：[details]',1,1480307558,1480307558);
/*!40000 ALTER TABLE `t_admin_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_addon`
--

DROP TABLE IF EXISTS `t_admin_addon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_addon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text NOT NULL COMMENT '插件描述',
  `config` text COMMENT '配置',
  `author` varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(8) NOT NULL DEFAULT '' COMMENT '版本号',
  `adminlist` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '插件类型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='插件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_addon`
--

LOCK TABLES `t_admin_addon` WRITE;
/*!40000 ALTER TABLE `t_admin_addon` DISABLE KEYS */;
INSERT INTO `t_admin_addon` VALUES (1,'RocketToTop','小火箭返回顶部','小火箭返回顶部','{\"status\":\"1\"}','OpenCMF','1.2.0',0,0,1471175585,1471175585,0,1);
/*!40000 ALTER TABLE `t_admin_addon` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='后台管理员登录日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_adminloginlog`
--

LOCK TABLES `t_admin_adminloginlog` WRITE;
/*!40000 ALTER TABLE `t_admin_adminloginlog` DISABLE KEYS */;
INSERT INTO `t_admin_adminloginlog` VALUES (1,'admin',1482804705,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(2,'admin',1482804727,'127.0.0.1',0,'用户名或密码错误'),(3,'admin',1482804782,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(4,'admin',1482805385,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(5,'admin',1482805842,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(6,'admin',1482806400,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(7,'admin',1482808308,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(8,'admin',1482826288,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(9,'admin',1482826412,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(10,'admin',1482826455,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(11,'admin',1482826599,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(12,'admin',1482826626,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(13,'admin',1482826658,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(14,'admin',1482826756,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(15,'admin',1482826932,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(16,'admin',1482830245,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(17,'admin',1482830462,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(18,'admin',1482830481,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(19,'admin',1482830502,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(20,'admin',1482830740,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(21,'admin',1482830772,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(22,'admin',1482830883,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(23,'admin',1482830911,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(24,'admin',1482830949,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(25,'admin',1482831032,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(26,'admin',1482831261,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(27,'admin',1482831384,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(28,'admin',1482887905,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(29,'admin',1482998517,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(30,'admins',1482999049,'127.0.0.1',0,'用户名不存在或被禁用'),(31,'admins',1482999063,'127.0.0.1',0,'用户名不存在或被禁用'),(32,'admin',1482999073,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(33,'admin',1483061126,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(34,'admin',1483069665,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(35,'asdasd',1483069876,'127.0.0.1',0,'用户名不存在或被禁用'),(36,'asdasd',1483070663,'127.0.0.1',0,'用户名不存在或被禁用'),(37,'admin',1483070724,'127.0.0.1',1,'登录成功,正在跳转后台首页...'),(38,'admin',1483318908,'127.0.0.1',1,'登陆成功'),(39,'admin',1483405142,'127.0.0.1',1,'登陆成功'),(40,'admin',1483410751,'127.0.0.1',1,'登陆成功'),(41,'admin',1483410802,'127.0.0.1',1,'登陆成功'),(42,'admin',1483410847,'127.0.0.1',1,'登陆成功'),(43,'admin',1483410878,'127.0.0.1',1,'登陆成功'),(44,'admin',1483492009,'127.0.0.1',1,'登陆成功'),(45,'admin',1483514547,'127.0.0.1',1,'登陆成功'),(46,'admin',1483515426,'127.0.0.1',1,'登陆成功'),(47,'admin',1483582876,'127.0.0.1',1,'登陆成功'),(48,'admin',1483664328,'127.0.0.1',1,'登陆成功'),(49,'admin',1483675571,'127.0.0.1',1,'登陆成功'),(50,'admin',1483755065,'127.0.0.1',0,'登陆失败'),(51,'admin',1483755078,'127.0.0.1',1,'登陆成功'),(52,'admin',1483772407,'127.0.0.1',1,'登陆成功'),(53,'admin',1483772899,'127.0.0.1',1,'登陆成功'),(54,'admin',1483777838,'0.0.0.0',1,'登陆成功'),(55,'admin',1483923413,'127.0.0.1',1,'登陆成功'),(56,'admin',1484011407,'127.0.0.1',1,'登陆成功'),(57,'admin',1484182373,'127.0.0.1',1,'登陆成功'),(58,'admin',1484209607,'127.0.0.1',1,'登陆成功'),(59,'asdas',1484210389,'127.0.0.1',0,'登陆失败'),(60,'admin',1484210444,'127.0.0.1',1,'登陆成功'),(61,'admin',1484210976,'127.0.0.1',1,'登陆成功'),(62,'admin',1484212567,'127.0.0.1',1,'登陆成功'),(63,'admin',1484268810,'127.0.0.1',1,'登陆成功'),(64,'admin',1484528342,'127.0.0.1',1,'登陆成功'),(65,'admin',1484641277,'127.0.0.1',1,'登陆成功'),(66,'admin',1484643935,'127.0.0.1',1,'登陆成功'),(67,'admin',1484701273,'127.0.0.1',1,'登陆成功');
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
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级分组id',
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建日期',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_group`
--

LOCK TABLES `t_admin_auth_group` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_group` DISABLE KEYS */;
INSERT INTO `t_admin_auth_group` VALUES (1,0,'超级管理员',1,'',0,1426881003,1427552428),(2,0,'信息管理员',1,'',2,1483065464,1483411390),(3,2,'信息发布员',1,'',0,1483065492,1483065492),(4,3,'一组发布员',1,'',0,1483067746,1483067746),(5,3,'二组发布员',1,'',1,1483067769,1483067769),(6,5,'二组一号发布员',1,'',0,1483067769,1483067769);
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
  `module` varchar(30) NOT NULL COMMENT '所属模块',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='规则表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_rule`
--

LOCK TABLES `t_admin_auth_rule` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_rule` DISABLE KEYS */;
INSERT INTO `t_admin_auth_rule` VALUES (1,'admin','system','系统',1,1,''),(2,'admin','systemconfig','系统管理',1,1,''),(3,'admin','admin/config/configset','系统设置',1,1,''),(4,'admin','extendcenter','扩展中心',1,1,''),(5,'admin','admin/module/index','功能模块',1,1,''),(6,'admin','admin/module/install','安装',1,1,''),(7,'admin','admin/module/uninstall','卸载',1,1,''),(8,'admin','admin/module/updateinfo','更新信息',1,1,''),(9,'admin','admin/module/setstatus','设置状态',1,1,''),(10,'admin','admin/config/index','配置管理',1,1,''),(11,'admin','admin/config/setstatus','设置状态',1,1,''),(12,'admin','admin/log/index','日志管理',1,1,''),(13,'admin','admin/log/details','日志详情',1,1,''),(14,'admin','admin/log/delete','删除日志',1,1,''),(15,'admin','admin/action/index','行为管理',1,1,''),(16,'admin','admin/action/add','新增行为',1,1,''),(17,'admin','admin/action/setstatus','行为状态',1,1,''),(18,'admin','admin/action/delete','删除行为',1,1,''),(19,'admin','admin/action/edit','修改行为',1,1,''),(20,'admin','roleaccess','系统权限',1,1,''),(21,'admin','admin/access/index','管理员管理',1,1,''),(22,'admin','admin/group/index','用户组管理',1,1,'');
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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='系统配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_config`
--

LOCK TABLES `t_admin_config` WRITE;
/*!40000 ALTER TABLE `t_admin_config` DISABLE KEYS */;
INSERT INTO `t_admin_config` VALUES (1,'站点开关','TOGGLE_WEB_SITE','1',1,'select','0:关闭\r\n1:开启','站点关闭后将不能访问',1378898976,1406992386,1,1),(2,'网站标题','WEB_SITE_TITLE','CoreThink',1,'text','','网站标题前台显示标题',1378898976,1379235274,2,1),(3,'网站口号','WEB_SITE_SLOGAN','互联网WEB产品最佳选择',1,'text','','网站口号、宣传标语、一句话介绍',1434081649,1434081649,3,1),(4,'网站LOGO','WEB_SITE_LOGO','',1,'picture','','网站LOGO',1407003397,1407004692,4,1),(5,'网站描述','WEB_SITE_DESCRIPTION','CoreThink是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等开放化低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。',1,'textarea','','网站搜索引擎描述',1378898976,1379235841,5,1),(6,'网站关键字','WEB_SITE_KEYWORD','OpenCMF、CoreThink、南京科斯克网络科技',1,'textarea','','网站搜索引擎关键字',1378898976,1381390100,6,1),(7,'版权信息','WEB_SITE_COPYRIGHT','Copyright © 南京科斯克网络科技有限公司 All rights reserved.',1,'text','','设置在网站底部显示的版权信息，如“版权所有 © 2014-2015 科斯克网络科技”',1406991855,1406992583,7,1),(8,'网站备案号','WEB_SITE_ICP','苏ICP备1502009-2号',1,'text','','设置在网站底部显示的备案号，如“苏ICP备1502009-2号\"',1378900335,1415983236,8,1),(9,'站点统计','WEB_SITE_STATISTICS','',1,'textarea','','支持百度、Google、cnzz等所有Javascript的统计代码',1378900335,1415983236,9,1),(10,'文件上传大小','UPLOAD_FILE_SIZE','10',2,'num','','文件上传大小单位：MB',1428681031,1428681031,1,1),(11,'图片上传大小','UPLOAD_IMAGE_SIZE','2',2,'num','','图片上传大小单位：MB',1428681071,1428681071,2,1),(12,'后台多标签','ADMIN_TABS','1',2,'radio','0:关闭\r\n1:开启','',1453445526,1453445526,3,1),(13,'分页数量','ADMIN_PAGE_ROWS','10',2,'num','','分页时每页的记录数',1434019462,1434019481,4,1),(14,'后台主题','ADMIN_THEME','default',2,'select','default:默认主题\r\nblue:蓝色理想\r\ngreen:绿色生活','后台界面主题',1436678171,1436690570,5,1),(15,'导航分组','NAV_GROUP_LIST','main:主导航\r\ntop:顶部导航\r\nbottom:底部导航\r\nwap_bottom:Wap底部导航',2,'array','','导航分组',1458382037,1458382061,6,1),(16,'配置分组','CONFIG_GROUP_LIST','1:基本\r\n2:系统\r\n3:开发\r\n4:部署\r\n5:授权\r\n6:其它配置',2,'array','','配置分组',1379228036,1426930700,7,1),(17,'开发模式','DEVELOP_MODE','1',3,'select','1:开启\r\n0:关闭','开发模式下会显示菜单管理、配置管理、数据字典等开发者工具',1432393583,1432393583,1,1),(18,'是否显示页面Trace','SHOW_PAGE_TRACE','0',3,'select','0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1387165685,2,1),(19,'系统加密KEY','AUTH_KEY','qc:`Z!xPq?;[=y\"KB/VXxBgj\"-`}<[IpJ/zk/?K)fb(v(*ea,we?`*ES&c;F,QiW',3,'textarea','','轻易不要修改此项，否则容易造成用户无法登录；如要修改，务必备份原key',1438647773,1438647815,3,1),(20,'URL模式','URL_MODEL','3',4,'select','0:普通模式\r\n1:PATHINFO模式\r\n2:REWRITE模式\r\n3:兼容模式','',1438423248,1438423248,1,1),(21,'静态文件独立域名','STATIC_DOMAIN','',4,'text','','静态文件独立域名一般用于在用户无感知的情况下平和的将网站图片自动存储到腾讯万象优图、又拍云等第三方服务。',1438564784,1438564784,2,1),(22,'开启子域名配置','APP_SUB_DOMAIN_DEPLOY','0',4,'radio','1:是\r\n0:否','是否开启子域名配置',1467549933,1467549933,3,1),(23,'子域名规则','APP_SUB_DOMAIN_RULES','',4,'array','','子域名规则',1467549993,1467549993,4,1),(24,'域名后缀','APP_DOMAIN_SUFFIX','',4,'text','','com.cn 、net.cn之类的需要配置此项',1467550066,1467550066,5,1),(25,'强制Wap主题','WAP_MODE','0',4,'radio','1:是\r\n0:否','是否在电脑端强制显示Wap主题',1467121607,1467121607,6,1),(26,'官网账号','AUTH_USERNAME','trial',5,'text','','官网登陆账号（用户名）',1438647815,1438647815,1,1),(27,'官网密码','AUTH_PASSWORD','trial',5,'text','','官网密码',1438647815,1438647815,2,1),(28,'密钥','AUTH_SN','',5,'textarea','','密钥请通过登陆官网至个人中心获取',1438647815,1438647815,3,1),(29,'系统其它','other_sys','',6,'text','','系统其它配置说明',1483771700,1483771700,0,1);
/*!40000 ALTER TABLE `t_admin_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_hook`
--

DROP TABLE IF EXISTS `t_admin_hook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '钩子ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='钩子表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_hook`
--

LOCK TABLES `t_admin_hook` WRITE;
/*!40000 ALTER TABLE `t_admin_hook` DISABLE KEYS */;
INSERT INTO `t_admin_hook` VALUES (1,'AdminIndex','后台首页小工具','后台首页小工具',1,1446522155,1446522155,1),(2,'FormBuilderExtend','FormBuilder类型扩展Builder','aaa,ddd',1,1447831268,1447831268,1),(3,'UploadFile','上传文件钩子','',1,1407681961,1407681961,1),(4,'PageHeader','页面header钩子，一般用于加载插件CSS文件和代码','',1,1407681961,1407681961,1),(5,'PageFooter','页面footer钩子，一般用于加载插件CSS文件和代码','RocketToTop',1,1407681961,1407681961,1),(6,'CommonHook','通用钩子，自定义用途，一般用来定制特殊功能','',1,1456147822,1456147822,1);
/*!40000 ALTER TABLE `t_admin_hook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_log`
--

DROP TABLE IF EXISTS `t_admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` longtext NOT NULL COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_log`
--

LOCK TABLES `t_admin_log` WRITE;
/*!40000 ALTER TABLE `t_admin_log` DISABLE KEYS */;
INSERT INTO `t_admin_log` VALUES (12,1,1,2130706433,'admin_module',1,' 更新了模块：',1,1484642336),(13,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：',1,1484644321),(14,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：',1,1484644782),(15,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：admin',1,1484645652),(16,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统',1,1484645685),(17,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484645758),(18,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484702855),(22,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484705242),(23,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484705289),(21,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484705141),(24,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710023),(25,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710055),(26,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710089),(27,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710133),(28,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710310),(29,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484721641),(30,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484721707);
/*!40000 ALTER TABLE `t_admin_log` ENABLE KEYS */;
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
INSERT INTO `t_admin_module` VALUES (1,'admin','系统核心','','&#xe62e;','#3CA6F1','核心系统','曲靖开发区奇讯科技有限公司','1.0.1','','','{\"1\":{\"pid\":\"0\",\"title\":\"\\u7cfb\\u7edf\",\"icon\":\"&#xe62e;\",\"level\":\"system\",\"url\":\"system\",\"id\":\"1\"},\"2\":{\"pid\":\"1\",\"title\":\"\\u7cfb\\u7edf\\u7ba1\\u7406\",\"icon\":\"&#xe63c;\",\"url\":\"systemConfig\",\"id\":\"2\"},\"3\":{\"pid\":\"2\",\"title\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"icon\":\"\",\"url\":\"admin\\/Config\\/configSet\",\"id\":\"3\"},\"4\":{\"pid\":\"1\",\"title\":\"\\u6269\\u5c55\\u4e2d\\u5fc3\",\"icon\":\"&#xe61f;\",\"url\":\"extendCenter\",\"id\":\"4\"},\"5\":{\"pid\":\"4\",\"title\":\"\\u529f\\u80fd\\u6a21\\u5757\",\"icon\":\"\",\"url\":\"admin\\/Module\\/index\",\"id\":\"5\"},\"6\":{\"pid\":\"5\",\"title\":\"\\u5b89\\u88c5\",\"icon\":\"\",\"url\":\"admin\\/Module\\/install\",\"id\":\"6\"},\"7\":{\"pid\":\"5\",\"title\":\"\\u5378\\u8f7d\",\"icon\":\"\",\"url\":\"admin\\/Module\\/uninstall\",\"id\":\"7\"},\"8\":{\"pid\":\"5\",\"title\":\"\\u66f4\\u65b0\\u4fe1\\u606f\",\"icon\":\"\",\"url\":\"admin\\/Module\\/updateInfo\",\"id\":\"8\"},\"9\":{\"pid\":\"5\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Module\\/setStatus\",\"id\":\"9\"},\"10\":{\"pid\":\"2\",\"title\":\"\\u914d\\u7f6e\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Config\\/index\",\"id\":\"10\"},\"11\":{\"pid\":\"10\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Config\\/setStatus\",\"id\":\"11\"},\"12\":{\"pid\":\"2\",\"title\":\"\\u65e5\\u5fd7\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Log\\/index\",\"id\":\"12\"},\"13\":{\"pid\":\"12\",\"title\":\"\\u65e5\\u5fd7\\u8be6\\u60c5\",\"icon\":\"\",\"url\":\"admin\\/Log\\/details\",\"id\":\"13\"},\"14\":{\"pid\":\"12\",\"title\":\"\\u5220\\u9664\\u65e5\\u5fd7\",\"icon\":\"\",\"url\":\"admin\\/Log\\/delete\",\"id\":\"14\"},\"15\":{\"pid\":\"2\",\"title\":\"\\u884c\\u4e3a\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Action\\/index\",\"id\":\"15\"},\"16\":{\"pid\":\"15\",\"title\":\"\\u65b0\\u589e\\u884c\\u4e3a\",\"icon\":\"\",\"url\":\"admin\\/Action\\/add\",\"id\":\"16\"},\"17\":{\"pid\":\"15\",\"title\":\"\\u884c\\u4e3a\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Action\\/setStatus\",\"id\":\"17\"},\"18\":{\"pid\":\"15\",\"title\":\"\\u5220\\u9664\\u884c\\u4e3a\",\"icon\":\"\",\"url\":\"admin\\/Action\\/delete\",\"id\":\"18\"},\"19\":{\"pid\":\"15\",\"title\":\"\\u4fee\\u6539\\u884c\\u4e3a\",\"icon\":\"\",\"url\":\"admin\\/Action\\/edit\",\"id\":\"19\"},\"20\":{\"pid\":\"1\",\"title\":\"\\u7cfb\\u7edf\\u6743\\u9650\",\"icon\":\"&#xe62b;\",\"url\":\"roleAccess\",\"id\":\"20\"},\"21\":{\"pid\":\"20\",\"title\":\"\\u7ba1\\u7406\\u5458\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Access\\/index\",\"id\":\"21\"},\"22\":{\"pid\":\"20\",\"title\":\"\\u7528\\u6237\\u7ec4\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Group\\/index\",\"id\":\"22\"}}',1,1438651748,1482137289,0,1);
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

-- Dump completed on 2017-01-18 18:21:09
