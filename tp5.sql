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
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='系统行为表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_action`
--

LOCK TABLES `t_admin_action` WRITE;
/*!40000 ALTER TABLE `t_admin_action` DISABLE KEYS */;
INSERT INTO `t_admin_action` VALUES (1,'admin','module_update','更新模块','更新模块','','[user|get_nickname] 更新了模块：[details]',1,1480307558,1480307558),(2,'admin','group_add','添加用户组','添加用户组','','[user|get_nickname] 添加了用户组：[details]',1,1480307558,1480307558),(44,'admin','group_edit','修改用户组','修改用户组','','[user|get_nickname] 修改了用户组：[details]',1,1480307558,1480307558),(45,'admin','group_enable','启用用户组','启用用户组','','[user|get_nickname] 启用了用户组：[details]',1,1480307558,1480307558),(46,'admin','group_disable','禁用用户组','禁用用户组','','[user|get_nickname] 禁用了用户组：[details]',1,1480307558,1480307558),(47,'admin','group_delete','删除用户组','删除用户组','','[user|get_nickname] 删除了用户组：[details]',1,1480307558,1480307558),(48,'admin','admin_add','添加管理员','添加管理员','','[user|get_nickname] 添加了管理员：[details]',1,1480307558,1488879371),(49,'admin','admin_edit','修改管理员','修改管理员','','[user|get_nickname] 修改了管理员：[details]',1,1480307558,1480307558),(50,'admin','admin_enable','启用管理员','启用管理员','','[user|get_nickname] 启用了管理员：[details]',1,1480307558,1480307558),(51,'admin','admin_disable','禁用管理员','禁用管理员','','[user|get_nickname] 禁用了管理员：[details]',1,1480307558,1480307558),(52,'admin','admin_delete','删除管理员','删除管理员','','[user|get_nickname] 删除了管理员：[details]',1,1480307558,1480307558),(59,'admin','loginlog_delete','删除登录日志','删除登录日志','','[user|get_nickname] 删除了登录日志：[details]',1,1488879520,1488879520);
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
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `phone` char(11) DEFAULT NULL COMMENT '手机号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE COMMENT '用户名'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_admin`
--

LOCK TABLES `t_admin_admin` WRITE;
/*!40000 ALTER TABLE `t_admin_admin` DISABLE KEYS */;
INSERT INTO `t_admin_admin` VALUES (1,'admin','a5064e08c2ccd3fb0257bb4a9af4a29f','145963','超级管理员',1,'18687460581',1485139796),(2,'test1','a5064e08c2ccd3fb0257bb4a9af4a29f','145963','测试管理',1,'18687460582',1485139796),(3,'test2','c05195114a2a93354e974b3b4e84016d','601441','测试用户2',1,'13566887745',1488765264);
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
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COMMENT='后台管理员登录日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_adminloginlog`
--

LOCK TABLES `t_admin_adminloginlog` WRITE;
/*!40000 ALTER TABLE `t_admin_adminloginlog` DISABLE KEYS */;
INSERT INTO `t_admin_adminloginlog` VALUES (104,'admin',1489024655,'127.0.0.1',1,'登陆成功'),(105,'admin',1489980376,'127.0.0.1',1,'登陆成功'),(106,'admin',1490164946,'127.0.0.1',1,'登陆成功'),(107,'admin',1490585200,'127.0.0.1',1,'登陆成功'),(108,'admin',1490603485,'127.0.0.1',1,'登陆成功'),(109,'admin',1491362728,'127.0.0.1',1,'登陆成功'),(110,'admin',1491532468,'127.0.0.1',1,'登陆成功'),(111,'admin',1491554289,'127.0.0.1',1,'登陆成功'),(112,'admin',1491559934,'127.0.0.1',1,'登陆成功'),(113,'admin',1491784905,'127.0.0.1',1,'登陆成功'),(114,'test1',1491787458,'127.0.0.1',1,'登陆成功'),(115,'admin',1493173365,'127.0.0.1',1,'登陆成功'),(116,'admin',1494410659,'127.0.0.1',1,'登陆成功'),(117,'admin',1494835324,'127.0.0.1',1,'登陆成功'),(118,'admin',1495510587,'127.0.0.1',1,'登陆成功');
/*!40000 ALTER TABLE `t_admin_adminloginlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin_attachment`
--

DROP TABLE IF EXISTS `t_admin_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_admin_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `module` varchar(32) NOT NULL DEFAULT '' COMMENT '模块名，由哪个模块上传的',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '文件链接',
  `mime` varchar(64) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT 'sha1 散列值',
  `driver` varchar(16) NOT NULL DEFAULT 'local' COMMENT '上传驱动',
  `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='附件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_attachment`
--

LOCK TABLES `t_admin_attachment` WRITE;
/*!40000 ALTER TABLE `t_admin_attachment` DISABLE KEYS */;
INSERT INTO `t_admin_attachment` VALUES (1,1,'timg (1).jpg','admin','uploads/images/20170206/d34ac85e487daab698260b8d4a122458.jpg','','','image/jpeg','jpg',109502,'3073b31edebeaf6ec907049333288157','b0a49009470d0285a2ef218112b3fad60f1b92d5','local',0,1486373058,1486373058,100,1),(2,1,'Everything_1.3.4.686_XiaZaiBa.zip','admin','uploads/files/20170207/f61caccb724b22230a58e7dc416d9a78.zip','','','application/octet-stream','zip',772118,'9cc391c2bcc3959841e10e96bfd6a722','89262876ec28d0e493eb8c6d88012efc43881542','local',0,1486439118,1486439118,100,1),(3,1,'2015小微企业统计详细.rar','admin','uploads/files/20170207/eb52a5c35fab230080f9dc2c735bc0a6.rar','','','application/octet-stream','rar',736621,'686c8ce6cdad6c7bb330239626dfc624','18c411a415917bc3ddb141c820a2162a3ceb88ca','local',0,1486452085,1486452085,100,1),(4,1,'2.三省五州市.rar','admin','uploads/files/20170207/86a607424ddb131030f3c3292c9237c7.rar','','','application/octet-stream','rar',102517,'fbbd8452bc605ba6f94da198ffc668eb','7ebed689b7fdf2ff78a48b5e10d84f85014f010a','local',0,1486454312,1486454312,100,1),(5,1,'“数据文山”发布版块及内容.xls','admin','uploads/files/20170207/b1778dd1154f58dff0f03467ce5311b5.xls','','','application/octet-stream','xls',37376,'d0406b4bc01250807f7c54bab507e527','34c7b35162df39a89e412cd63eb52e2ce4d092d7','local',0,1486454315,1486454315,100,1),(6,1,'二、统计数据.rar','admin','uploads/files/20170207/05040eb63b7a9f87bf6c765c784c8b56.rar','','','application/octet-stream','rar',674636,'b5764d29d7835cdd93ccf4974c20be91','adf099856384b1f59ac8b005bd30b59fbdbef401','local',0,1486454438,1486454438,100,1),(7,1,'timg (2).jpg','admin','uploads/images/20170207/d4104bc6ab73ec58ab17e2662637ee26.jpg','','','image/jpeg','jpg',71635,'5970899b8f9517dea50d10341b0f3c61','ea87742e5998d82ac4266d2aad2a9585fd57ab62','local',0,1486459718,1486459718,100,1),(8,1,'timg (1).jpg','admin','uploads/images/20170207/20cce190faf8767ba56a1c7a2d7889e1.jpg','','','image/jpeg','jpg',246830,'70e66818ed91a85fe9d00087d43db0e5','a90c0879ded974b89e94faf014422a984416900c','local',0,1486459732,1486459732,100,1),(9,1,'timg.jpg','admin','uploads/images/20170207/2495ba078dd38851e6b981719cd6b60f.jpg','','','image/jpeg','jpg',83494,'336def02cfad8feec82ef73e6231169d','513054e21a6cc6b666ce194377a3941d742c0ed9','local',0,1486462230,1486462230,100,1),(10,1,'下载.jpg','admin','uploads/images/20170207/8216462a4c3b00d5a2dc6bee234b0313.jpg','','','image/jpeg','jpg',21477,'cd86a7f06211b44e827ffb51e3416df6','9f95d71ecb65ccf60a4a219037e7f2155592756f','local',0,1486462341,1486462341,100,1),(11,1,'timg (2).jpg','admin','uploads/images/20170208/6bda63866ed781748d22c29170b1f4f0.jpg','','','application/octet-stream','jpg',72486,'008b1ddcc729eb9b9817c721a667a0e2','df68ae4a37a54a5cadebd7d1b5a7dd3dbd7530ac','local',0,1486547928,1486547928,100,1),(12,1,'timg.jpg','admin','uploads/images/20170208/343c24df270ce9aeea515323ed2c7361.jpg','','','application/octet-stream','jpg',83924,'5a157272338e0cb5441c5f1385045167','6ec93fd77fbe9240998f22df0edd3d971b06f498','local',0,1486547936,1486547936,100,1),(13,1,'timg (1).jpg','admin','uploads/images/20170208/801bfee60a10b67286723a35cbb9b27d.jpg','','','application/octet-stream','jpg',247606,'edda6f37da179de431f6cb522619ca65','c002c3ff304c59db60158fab3da39a7340ba0a03','local',0,1486547953,1486547953,100,1),(14,1,'timg (1).jpg','admin','uploads/images/20170208/69dda9dfc0098539eb5d2ba9f1375786.jpg','','','image/jpeg','jpg',199810,'d8ea2c601f0b57ef40b271a53564a2ff','bffa17a58b61e6791623ca742a0f29e979a064b5','local',0,1486548239,1486548239,100,1),(15,1,'c53d407e40acb98e621f97ef55613a29.jpeg','admin','uploads/images/20170208/c53d407e40acb98e621f97ef55613a29.jpeg','','','image/jpeg','jpeg',12171,'76743acf2670eb8b7f91c0bcf9615518','8336be54c51c89911bbab55d9d364fc304970556','local',0,1486548819,1486548819,100,1),(16,1,'55271a895f4a4f8227b5df214825fcdc.jpeg','admin','uploads/images/20170208/55271a895f4a4f8227b5df214825fcdc.jpeg','','','image/jpeg','jpeg',11326,'d5c43b4aab2398f05aa91d9feda22f7f','5a1625b6848ad46357bdba424b262ccea9cf9fd8','local',0,1486548949,1486548949,100,1),(17,1,'7496ddc38c07ded0ef9676f0bf7463e5.jpeg','admin','uploads/images/20170209/7496ddc38c07ded0ef9676f0bf7463e5.jpeg','','','image/jpeg','jpeg',7674,'b1bc0d9a3e3b1f074475d8e6ee72f913','352680cf97162e0fc871f2a9c1909eb8992a0469','local',0,1486602455,1486602455,100,1),(18,1,'5970032538f4588a560b97aa99777d54.jpeg','admin','uploads/images/20170209/5970032538f4588a560b97aa99777d54.jpeg','','','image/jpeg','jpeg',6101,'ab4685d88ed289d29350f36a6924ca46','03293ffe89222ddfd0a0387c8f4dc13c07116b11','local',0,1486602476,1486602476,100,1),(19,1,'c15e97e951e9048f5efb2c5069597e71.jpeg','admin','uploads/images/20170209/c15e97e951e9048f5efb2c5069597e71.jpeg','','','image/jpeg','jpeg',4910,'ceca4fe298212d8546c05c53c0ffc7a3','4db26f76e40fa92cecf002d4bacb690f26b294cd','local',0,1486603156,1486603156,100,1),(20,1,'69b9ebdcf5551e837fbed3600cdb6554.jpeg','admin','uploads/images/20170209/69b9ebdcf5551e837fbed3600cdb6554.jpeg','','','image/jpeg','jpeg',7961,'0616fec9f62661bc558701bf3cc8755d','2b5f5ea303c2cf73c53904df40f86746273979d9','local',0,1486603201,1486603201,100,1),(21,1,'43af6b26e4e2da939ab28f62301eac0f.jpeg','admin','uploads/images/20170209/43af6b26e4e2da939ab28f62301eac0f.jpeg','','','image/jpeg','jpeg',8612,'332a64fc9acf0b02090e773d6e00fbf9','5efeebded01dfa59bfc5b5f99848fe441ec865bf','local',0,1486603209,1486603209,100,1),(22,1,'2e470189d51c77a96051e7300628d20a.jpeg','admin','uploads/images/20170209/2e470189d51c77a96051e7300628d20a.jpeg','','','image/jpeg','jpeg',6105,'b44c9a018b0bc1667b91bc297bb5acac','4c81eea093cdf255ed38218d72a59fd5026f5c43','local',0,1486603221,1486603221,100,1),(23,1,'919cc9ef6e6e75e4084c456a80832d2b.jpeg','admin','uploads/images/20170209/919cc9ef6e6e75e4084c456a80832d2b.jpeg','','','image/jpeg','jpeg',10910,'346e937bd77ba4017b71da59a696cd6b','78f1603d06717ece75ddd6b6a173e489f13f9295','local',0,1486603567,1486603567,100,1),(24,1,'下载.jpg','admin','uploads/images/20170209/17e7dfd56e43df681fa689c01cf51172.jpg','','','image/jpeg','jpg',11290,'5e1b5fd0af618bf0eddf8a8a9ffafd3f','657803433ddc620beb8fdf7dddb0ec03618379d3','local',0,1486626384,1486626384,100,1),(25,1,'timg.jpg','','uploads/images/20170210/3534825861e7250909becf8780a43846.jpg','','','image/jpeg','jpg',42554,'09817121d28690844ff603eece6fcd6e','d6ba1c5b14e3f78582d0c5f90afba35ba54053ec','local',0,1486709031,1486709031,100,1);
/*!40000 ALTER TABLE `t_admin_attachment` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='用户组表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_group`
--

LOCK TABLES `t_admin_auth_group` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_group` DISABLE KEYS */;
INSERT INTO `t_admin_auth_group` VALUES (1,0,'超级管理员',1,'',0,1426881003,1427552428),(2,0,'信息管理员',1,'2,3,10,9,15,16,17,18,19,37,38,4,5,6,7,8,9',2,1483065464,1494410796),(3,2,'信息发布员',1,'',0,1483065492,1488529039),(4,3,'本地新闻发布员',1,'2,3,10,9,12,13,14,15,16,17,18,19,37,38,4,5,6,7,8,9',0,1483067746,1494410859),(36,35,'测试子部门',1,'20,31,32,33,34,35,22,23,24,25,26',1,1491551446,1491792628),(35,34,'测试',1,'4,5,6,7,8,9',50,1488765201,1488765222),(34,0,'模型管理员',1,'2,3,10,11,12,13,14,15,16,17,18,19',20,1488353716,1488353755),(33,3,'技术文章发布员',1,'20,31,32,33,34,35',0,1488352373,1491786993),(32,3,'其他地区新闻发布员',1,'',0,1488352372,1488352372);
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
INSERT INTO `t_admin_auth_group_access` VALUES (1,1),(2,33),(2,36),(3,32),(3,33);
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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='规则表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_auth_rule`
--

LOCK TABLES `t_admin_auth_rule` WRITE;
/*!40000 ALTER TABLE `t_admin_auth_rule` DISABLE KEYS */;
INSERT INTO `t_admin_auth_rule` VALUES (1,'admin','system','系统',1,1,''),(2,'admin','systemconfig','系统管理',1,1,''),(3,'admin','admin/config/configset','系统设置',1,1,''),(4,'admin','extendcenter','扩展中心',1,1,''),(5,'admin','admin/module/index','功能模块',1,1,''),(6,'admin','admin/module/install','安装',1,1,''),(7,'admin','admin/module/uninstall','卸载',1,1,''),(8,'admin','admin/module/updateinfo','更新信息',1,1,''),(9,'admin','admin/module/setstatus','设置状态',1,1,''),(10,'admin','admin/config/index','配置管理',1,1,''),(11,'admin','admin/config/setstatus','设置状态',1,1,''),(12,'admin','admin/log/index','日志管理',1,1,''),(13,'admin','admin/log/details','日志详情',1,1,''),(14,'admin','admin/log/delete','删除日志',1,1,''),(15,'admin','admin/action/index','行为管理',1,1,''),(16,'admin','admin/action/add','新增行为',1,1,''),(17,'admin','admin/action/setstatus','设置状态',1,1,''),(18,'admin','admin/action/delete','删除行为',1,1,''),(19,'admin','admin/action/edit','修改行为',1,1,''),(20,'admin','roleaccess','系统权限',1,1,''),(21,'admin','admin/access/index','管理员管理',1,1,''),(22,'admin','admin/group/index','用户组管理',1,1,''),(23,'admin','admin/group/add','添加用户组',1,1,''),(24,'admin','admin/group/edit','修改用户组',1,1,''),(25,'admin','admin/group/setstatus','用户组状态设置',1,1,''),(26,'admin','admin/group/delete','删除用户组',1,1,''),(27,'admin','admin/access/delete','删除员管理',1,1,''),(28,'admin','admin/access/add','添加员管理',1,1,''),(29,'admin','admin/access/edit','修改员管理',1,1,''),(30,'admin','admin/access/setstatus','设置员管理状态',1,1,''),(31,'admin','admin/manager/index','管理员管理',1,1,''),(32,'admin','admin/manager/add','添加员管理',1,1,''),(33,'admin','admin/manager/edit','修改员管理',1,1,''),(34,'admin','admin/manager/setstatus','设置员管理状态',1,1,''),(35,'admin','admin/manager/delete','删除管理员',1,1,''),(36,'admin','admin/admin/loginlog','用户登录日志',1,1,''),(37,'admin','admin/loginlog/index','登录日志',1,1,''),(38,'admin','admin/loginlog/delete','删除日志',1,1,'');
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
INSERT INTO `t_admin_config` VALUES (1,'站点开关','TOGGLE_WEB_SITE','1',1,'select','0:关闭\r\n1:开启','站点关闭后将不能访问',1378898976,1406992386,1,1),(2,'网站标题','WEB_SITE_TITLE','CoreThink',1,'text','','网站标题前台显示标题',1378898976,1379235274,2,1),(3,'网站口号','WEB_SITE_SLOGAN','互联网WEB产品最佳选择',1,'text','','网站口号、宣传标语、一句话介绍',1434081649,1434081649,3,1),(4,'网站LOGO','WEB_SITE_LOGO','',1,'picture','','网站LOGO',1407003397,1407004692,4,1),(5,'网站描述','WEB_SITE_DESCRIPTION','CoreThink是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等开放化低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。',1,'textarea','','网站搜索引擎描述',1378898976,1379235841,5,1),(6,'网站关键字','WEB_SITE_KEYWORD','OpenCMF、CoreThink、南京科斯克网络科技',1,'textarea','','网站搜索引擎关键字',1378898976,1381390100,6,1),(7,'版权信息','WEB_SITE_COPYRIGHT','Copyright © 南京科斯克网络科技有限公司 All rights reserved.',1,'text','','设置在网站底部显示的版权信息，如“版权所有 © 2014-2015 科斯克网络科技”',1406991855,1406992583,7,1),(8,'网站备案号','WEB_SITE_ICP','苏ICP备1502009-2号',1,'text','','设置在网站底部显示的备案号，如“苏ICP备1502009-2号\"',1378900335,1415983236,8,1),(9,'站点统计','WEB_SITE_STATISTICS','',1,'textarea','','支持百度、Google、cnzz等所有Javascript的统计代码',1378900335,1415983236,9,1),(10,'文件上传大小','UPLOAD_FILE_SIZE','2',2,'num','','文件上传大小单位：MB',1428681031,1428681031,1,1),(11,'图片上传大小','UPLOAD_IMAGE_SIZE','2',2,'num','','图片上传大小单位：MB',1428681071,1428681071,2,1),(12,'后台多标签','ADMIN_TABS','1',2,'radio','0:关闭\r\n1:开启','',1453445526,1453445526,3,1),(13,'分页数量','ADMIN_PAGE_ROWS','10',2,'num','','分页时每页的记录数',1434019462,1434019481,4,1),(14,'后台主题','ADMIN_THEME','default',2,'select','default:默认主题\r\nblue:蓝色理想\r\ngreen:绿色生活','后台界面主题',1436678171,1436690570,5,1),(15,'导航分组','NAV_GROUP_LIST','main:主导航\r\ntop:顶部导航\r\nbottom:底部导航\r\nwap_bottom:Wap底部导航',2,'array','','导航分组',1458382037,1458382061,6,1),(16,'配置分组','CONFIG_GROUP_LIST','1:基本\r\n2:系统\r\n3:开发\r\n4:部署\r\n5:授权\r\n6:其它配置',2,'array','','配置分组',1379228036,1426930700,7,1),(17,'开发模式','DEVELOP_MODE','1',3,'select','1:开启\r\n0:关闭','开发模式下会显示菜单管理、配置管理、数据字典等开发者工具',1432393583,1432393583,1,1),(18,'是否显示页面Trace','SHOW_PAGE_TRACE','0',3,'select','0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1387165685,2,1),(19,'系统加密KEY','AUTH_KEY','qc:`Z!xPq?;[=y\"KB/VXxBgj\"-`}<[IpJ/zk/?K)fb(v(*ea,we?`*ES&c;F,QiW',3,'textarea','','轻易不要修改此项，否则容易造成用户无法登录；如要修改，务必备份原key',1438647773,1438647815,3,1),(20,'URL模式','URL_MODEL','3',4,'select','0:普通模式\r\n1:PATHINFO模式\r\n2:REWRITE模式\r\n3:兼容模式','',1438423248,1438423248,1,1),(21,'静态文件独立域名','STATIC_DOMAIN','',4,'text','','静态文件独立域名一般用于在用户无感知的情况下平和的将网站图片自动存储到腾讯万象优图、又拍云等第三方服务。',1438564784,1438564784,2,1),(22,'开启子域名配置','APP_SUB_DOMAIN_DEPLOY','0',4,'radio','1:是\r\n0:否','是否开启子域名配置',1467549933,1467549933,3,1),(23,'子域名规则','APP_SUB_DOMAIN_RULES','',4,'array','','子域名规则',1467549993,1467549993,4,1),(24,'域名后缀','APP_DOMAIN_SUFFIX','',4,'text','','com.cn 、net.cn之类的需要配置此项',1467550066,1467550066,5,1),(25,'强制Wap主题','WAP_MODE','0',4,'radio','1:是\r\n0:否','是否在电脑端强制显示Wap主题',1467121607,1467121607,6,1),(26,'官网账号','AUTH_USERNAME','trial',5,'text','','官网登陆账号（用户名）',1438647815,1438647815,1,1),(27,'官网密码','AUTH_PASSWORD','trial',5,'text','','官网密码',1438647815,1438647815,2,1),(28,'密钥','AUTH_SN','',5,'textarea','','密钥请通过登陆官网至个人中心获取',1438647815,1438647815,3,1),(29,'系统其它','other_sys','',6,'text','','系统其它配置说明',1483771700,1483771700,0,1);
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
) ENGINE=MyISAM AUTO_INCREMENT=285 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin_log`
--

LOCK TABLES `t_admin_log` WRITE;
/*!40000 ALTER TABLE `t_admin_log` DISABLE KEYS */;
INSERT INTO `t_admin_log` VALUES (12,1,1,2130706433,'admin_module',1,' 更新了模块：',1,1484642336),(13,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：',1,1484644321),(14,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：',1,1484644782),(15,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：admin',1,1484645652),(16,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统',1,1484645685),(17,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484645758),(18,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484702855),(22,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484705242),(23,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484705289),(21,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484705141),(24,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710023),(25,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710055),(26,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710089),(27,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710133),(28,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484710310),(29,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484721641),(30,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484721707),(31,2,1,2130706433,'admin_auth_group',14,'超级管理员 添加了用户组：信息组三',1,1484894743),(32,2,1,2130706433,'admin_auth_group',15,'超级管理员 添加了用户组：sdddd',1,1484894961),(33,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1484895124),(34,2,1,2130706433,'admin_auth_group',16,'超级管理员 添加了用户组：测试',1,1484897212),(35,2,1,2130706433,'admin_auth_group',17,'超级管理员 添加了用户组：asd',1,1484897459),(36,2,1,2130706433,'admin_auth_group',18,'超级管理员 添加了用户组：asd',1,1484897513),(37,2,1,2130706433,'admin_auth_group',19,'超级管理员 添加了用户组：ddd',1,1484897552),(38,2,1,2130706433,'admin_auth_group',20,'超级管理员 添加了用户组：测试三',1,1484898225),(39,2,1,2130706433,'admin_auth_group',21,'超级管理员 添加了用户组：asd',1,1484898262),(40,2,1,2130706433,'admin_auth_group',22,'超级管理员 添加了用户组：aasd',1,1484903418),(41,2,1,2130706433,'admin_auth_group',23,'超级管理员 添加了用户组：测试三xx',1,1484903445),(42,44,1,2130706433,'admin_auth_group',23,'超级管理员 修改了用户组：测试三xx',1,1484904305),(43,44,1,2130706433,'admin_auth_group',9,'超级管理员 修改了用户组：aasd',1,1484904385),(44,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1485056420),(45,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1485056517),(46,45,1,2130706433,'admin_auth_group',9,'超级管理员 启用了用户组：测试',1,1485056620),(47,46,1,2130706433,'admin_auth_group',9,'超级管理员 禁用了用户组：测试',1,1485056633),(48,45,1,2130706433,'admin_auth_group',9,'超级管理员 启用了用户组：测试',1,1485067012),(49,46,1,2130706433,'admin_auth_group',9,'超级管理员 禁用了用户组：测试',1,1485070253),(50,45,1,2130706433,'admin_auth_group',9,'超级管理员 启用了用户组：测试',1,1485070258),(51,45,1,2130706433,'admin_auth_group',0,'超级管理员 启用了用户组：测试、aasd',1,1485071377),(52,46,1,2130706433,'admin_auth_group',0,'超级管理员 禁用了用户组：测试、aasd',1,1485071476),(53,46,1,2130706433,'admin_auth_group',0,'超级管理员 禁用了用户组：测试、aasd',1,1485071498),(54,45,1,2130706433,'admin_auth_group',0,'超级管理员 启用了用户组：测试、aasd',1,1485071513),(55,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：测试、aasd',1,1485072857),(56,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：信息组三',1,1485072885),(57,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：二组一号发布员、sdddd、测试、xxxx、ddd',1,1485077482),(58,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：asd',1,1485077497),(59,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：信息组、信息组一、信息组二、信息组一、信息组二',1,1485077512),(60,2,1,2130706433,'admin_auth_group',24,'超级管理员 添加了用户组：测试一',1,1485077576),(61,2,1,2130706433,'admin_auth_group',25,'超级管理员 添加了用户组：测试二',1,1485077595),(62,2,1,2130706433,'admin_auth_group',26,'超级管理员 添加了用户组：测试一子级甲',1,1485077637),(63,2,1,2130706433,'admin_auth_group',27,'超级管理员 添加了用户组：测试一子级乙',1,1485077657),(64,44,1,2130706433,'admin_auth_group',27,'超级管理员 修改了用户组：测试一子级乙',1,1485077667),(65,2,1,2130706433,'admin_auth_group',28,'超级管理员 添加了用户组：测试二子级甲',1,1485077689),(66,2,1,2130706433,'admin_auth_group',29,'超级管理员 添加了用户组：测试二子级乙',1,1485077709),(67,2,1,2130706433,'admin_auth_group',30,'超级管理员 添加了用户组：xxxxxxx',1,1485077725),(68,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：测试一子级乙、xxxxxxx',1,1485077741),(69,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：二组发布员、测试一、测试一子级甲、测试二、测试二子级乙、测试二子级甲',1,1485077836),(70,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1485078058),(71,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1485078312),(72,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1485078928),(73,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1485078970),(74,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1485133424),(75,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1485133430),(76,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1485133620),(77,2,1,2130706433,'admin_auth_group',31,'超级管理员 添加了用户组：测试',1,1485157618),(78,44,1,2130706433,'admin_auth_group',31,'超级管理员 修改了用户组：测试',1,1485157626),(79,46,1,2130706433,'admin_auth_group',31,'超级管理员 禁用了用户组：测试',1,1485157637),(80,45,1,2130706433,'admin_auth_group',31,'超级管理员 启用了用户组：测试',1,1485157640),(81,47,1,2130706433,'admin_auth_group',0,'超级管理员 删除了用户组：测试',1,1485157646),(82,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1485158036),(83,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1485158316),(84,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1485158534),(85,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1485158659),(86,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1485158833),(87,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1485158878),(88,44,1,2130706433,'admin_auth_group',2,'超级管理员 修改了用户组：信息管理员',1,1486192972),(89,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1486353697),(90,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1486353707),(91,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1486353711),(92,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1486353745),(93,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487816426),(94,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487816440),(95,44,1,2130706433,'admin_auth_group',3,'超级管理员 修改了用户组：信息发布员',1,1487816479),(96,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1487816495),(97,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487817508),(98,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487817526),(99,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487817824),(100,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487817869),(101,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487818067),(102,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487818240),(103,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487820003),(104,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487820835),(105,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487820840),(106,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487820920),(107,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487820924),(108,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487820925),(109,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487822045),(110,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487822050),(111,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487822803),(112,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487822807),(113,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：一组发布员',1,1487898878),(114,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：一组发布员',1,1487898881),(115,48,1,2130706433,'admin_admin',17,'超级管理员 添加了管理员：lisi',1,1488350203),(116,48,1,2130706433,'admin_admin',21,'超级管理员 添加了管理员：wangwu4',1,1488350912),(117,44,1,2130706433,'admin_auth_group',4,'超级管理员 修改了用户组：一组发布员',1,1488352344),(118,2,1,2130706433,'admin_auth_group',32,'超级管理员 添加了用户组：其他地区新闻发布员',1,1488352372),(119,2,1,2130706433,'admin_auth_group',33,'超级管理员 添加了用户组：其他地区新闻发布员',1,1488352373),(120,44,1,2130706433,'admin_auth_group',33,'超级管理员 修改了用户组：其他地区新闻发布员',1,1488352405),(121,48,1,2130706433,'admin_admin',22,'超级管理员 添加了管理员：asda',1,1488353528),(122,48,1,2130706433,'admin_admin',23,'超级管理员 添加了管理员：asdddd',1,1488353573),(123,2,1,2130706433,'admin_auth_group',34,'超级管理员 添加了用户组：模型管理员',1,1488353716),(124,44,1,2130706433,'admin_auth_group',34,'超级管理员 修改了用户组：模型管理员',1,1488353755),(125,48,1,2130706433,'admin_admin',24,'超级管理员 添加了管理员：ffsda',1,1488354451),(126,48,1,2130706433,'admin_admin',25,'超级管理员 添加了管理员：xiaoad',1,1488354494),(127,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488360428),(128,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488360484),(129,49,1,2130706433,'admin_admin',16,'超级管理员 修改了管理员：asdas',1,1488361154),(130,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488361166),(131,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488361250),(132,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488361484),(133,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488361515),(134,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488361948),(135,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488361989),(136,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488362002),(137,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488362081),(138,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488362410),(139,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488362780),(140,49,1,2130706433,'admin_admin',25,'超级管理员 修改了管理员：xiaoad',1,1488362787),(141,49,1,2130706433,'admin_admin',2,'超级管理员 修改了管理员：test1',1,1488362948),(142,48,1,2130706433,'admin_admin',26,'超级管理员 添加了管理员：ddd',1,1488426947),(143,49,1,2130706433,'admin_admin',26,'超级管理员 修改了管理员：ddd',1,1488426958),(144,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1488503139),(145,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1488503188),(146,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1488504689),(147,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1488504692),(148,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1488504766),(149,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1488504767),(150,45,1,2130706433,'admin_auth_group',0,'超级管理员 启用了用户组：信息管理员、信息发布员',1,1488527266),(151,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1488527371),(152,45,1,2130706433,'admin_auth_group',2,'超级管理员 启用了用户组：信息管理员',1,1488527715),(153,46,1,2130706433,'admin_auth_group',3,'超级管理员 禁用了用户组：信息发布员',1,1488527737),(154,46,1,2130706433,'admin_auth_group',33,'超级管理员 禁用了用户组：技术文章发布员',1,1488527880),(155,45,1,2130706433,'admin_auth_group',33,'超级管理员 启用了用户组：技术文章发布员',1,1488527903),(156,46,1,2130706433,'admin_auth_group',2,'超级管理员 禁用了用户组：信息管理员',1,1488527970),(157,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：本地新闻发布员',1,1488527975),(158,45,1,2130706433,'admin_auth_group',0,'超级管理员 启用了用户组：信息管理员、信息发布员、本地新闻发布员',1,1488527984),(159,44,1,2130706433,'admin_auth_group',4,'超级管理员 修改了用户组：本地新闻发布员',1,1488528117),(160,48,1,2130706433,'admin_admin',27,'超级管理员 添加了管理员：a',1,1488528323),(161,49,1,2130706433,'admin_admin',6,'超级管理员 修改了管理员：zs',1,1488528498),(162,46,1,2130706433,'admin_auth_group',3,'超级管理员 禁用了用户组：信息发布员',1,1488528581),(163,45,1,2130706433,'admin_auth_group',3,'超级管理员 启用了用户组：信息发布员',1,1488528590),(164,46,1,2130706433,'admin_auth_group',3,'超级管理员 禁用了用户组：信息发布员',1,1488528593),(165,45,1,2130706433,'admin_auth_group',3,'超级管理员 启用了用户组：信息发布员',1,1488528597),(166,46,1,2130706433,'admin_auth_group',0,'超级管理员 禁用了用户组：信息管理员、信息发布员、本地新闻发布员、模型管理员、技术文章发布员、其他地区新闻发布员',1,1488528604),(167,45,1,2130706433,'admin_auth_group',0,'超级管理员 启用了用户组：信息管理员、信息发布员、本地新闻发布员、模型管理员、技术文章发布员、其他地区新闻发布员',1,1488528615),(168,44,1,2130706433,'admin_auth_group',2,'超级管理员 修改了用户组：信息管理员',1,1488528943),(169,44,1,2130706433,'admin_auth_group',2,'超级管理员 修改了用户组：信息管理员',1,1488528951),(170,44,1,2130706433,'admin_auth_group',3,'超级管理员 修改了用户组：信息发布员',1,1488529039),(171,50,1,2130706433,'admin_admin',2,'超级管理员 启用了管理员：test1',1,1488529915),(172,51,1,2130706433,'admin_admin',0,'超级管理员 禁用了管理员：test1、username、yxh',1,1488529942),(173,50,1,2130706433,'admin_admin',0,'超级管理员 启用了管理员：test1、username、yxh、admin2',1,1488529969),(174,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488530097),(175,52,1,2130706433,'admin_admin',0,'超级管理员 删除了管理员：username',1,1488530976),(176,49,1,2130706433,'admin_admin',4,'超级管理员 修改了管理员：yxh',1,1488531008),(177,52,1,2130706433,'admin_admin',0,'超级管理员 删除了管理员：yxh',1,1488531093),(178,52,1,2130706433,'admin_admin',0,'超级管理员 删除了管理员：admin2、asdas、asdasdasd、dddddd、lisi、wangwu、xxxx、zs',1,1488531113),(179,52,1,2130706433,'admin_admin',0,'超级管理员 删除了管理员：asda、asdddd、ddd、ffsda、wangwu2、wangwu3、wangwu4、xiaoad',1,1488531123),(180,52,1,2130706433,'admin_admin',0,'超级管理员 删除了管理员：a',1,1488531132),(181,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488696908),(182,50,1,2130706433,'admin_admin',2,'超级管理员 启用了管理员：test1',1,1488696910),(183,2,1,2130706433,'admin_auth_group',35,'超级管理员 添加了用户组：测试',1,1488765201),(184,44,1,2130706433,'admin_auth_group',35,'超级管理员 修改了用户组：测试',1,1488765214),(185,44,1,2130706433,'admin_auth_group',35,'超级管理员 修改了用户组：测试',1,1488765222),(186,45,1,2130706433,'admin_auth_group',35,'超级管理员 启用了用户组：测试',1,1488765225),(187,48,1,2130706433,'admin_admin',3,'超级管理员 添加了管理员：test2',1,1488765264),(188,50,1,2130706433,'admin_admin',3,'超级管理员 启用了管理员：test2',1,1488765273),(189,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488765915),(190,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488765966),(191,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488766780),(192,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488848056),(193,53,1,2130706433,'admin_action',54,'超级管理员 添加了行为：test_test',1,1488852333),(194,53,1,2130706433,'admin_action',55,'超级管理员 添加了行为：asdasd',1,1488852585),(195,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488852709),(196,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488859907),(197,50,1,2130706433,'admin_admin',2,'超级管理员 启用了管理员：test1',1,1488859917),(198,50,1,2130706433,'admin_admin',2,'超级管理员 启用了管理员：test1',1,1488859929),(199,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488859959),(200,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488868589),(201,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488868618),(202,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488868701),(203,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488868723),(204,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488868740),(205,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488868821),(206,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488868834),(207,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488868922),(208,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488868947),(209,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488869025),(210,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488869284),(211,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488869333),(212,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488869527),(213,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488869561),(214,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488869619),(215,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488869648),(216,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488869685),(217,50,1,2130706433,'admin_admin',2,'超级管理员 启用了管理员：test1',1,1488869703),(218,50,1,2130706433,'admin_admin',3,'超级管理员 启用了管理员：test2',1,1488869704),(219,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488869710),(220,51,1,2130706433,'admin_admin',3,'超级管理员 禁用了管理员：test2',1,1488869727),(221,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488869753),(235,59,1,2130706433,'admin_adminloginlog',0,'超级管理员 删除了登录日志：删除了：[用户名：admin登录日期：2017-02-13 16:04登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-14 09:42登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-15 11:07登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-15 14:44登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-16 11:59登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-21 16:41登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-21 17:58登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-21 18:14登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-02-22 09:38登录ip：127.0.0.1登录状态：登陆成功]；[用户名：admin登录日期：2017-03-07 17:37登录ip：127.0.0.1登录状态：登陆成功]；',1,1488880597),(233,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488874730),(234,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1488874911),(236,59,1,2130706433,'admin_adminloginlog',0,'超级管理员 删除了登录日志：删除了：[用户名：admin登录日期：2017-01-24 10:58登录ip：0.0.0.0登录状态：登陆成功]；\n[用户名：admin登录日期：2017-01-24 12:06登录ip：0.0.0.0登录状态：登陆成功]；\n[用户名：admin登录日期：2017-01-24 14:39登录ip：127.0.0.1登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-04 09:42登录ip：127.0.0.1登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-04 10:50登录ip：127.0.0.1登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-04 16:28登录ip：127.0.0.1登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-06 09:17登录ip：0.0.0.0登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-08 17:57登录ip：127.0.0.1登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-08 18:00登录ip：127.0.0.1登录状态：登陆成功]；\n[用户名：admin登录日期：2017-02-13 08:52登录ip：127.0.0.1登录状态：登陆成功]；\n',1,1488880640),(237,59,1,2130706433,'admin_adminloginlog',0,'超级管理员 删除了登录日志：[用户名：admin登录日期：2017-01-23 09:03登录ip：127.0.0.1登录状态：登陆成功]；\n',1,1488880784),(239,46,1,2130706433,'admin_auth_group',35,'超级管理员 禁用了用户组：测试',1,1488881387),(240,46,1,2130706433,'admin_auth_group',34,'超级管理员 禁用了用户组：模型管理员',1,1488881389),(241,46,1,2130706433,'admin_auth_group',33,'超级管理员 禁用了用户组：技术文章发布员',1,1488881390),(242,45,1,2130706433,'admin_auth_group',33,'超级管理员 启用了用户组：技术文章发布员',1,1488881391),(243,45,1,2130706433,'admin_auth_group',34,'超级管理员 启用了用户组：模型管理员',1,1488881392),(244,45,1,2130706433,'admin_auth_group',35,'超级管理员 启用了用户组：测试',1,1488881393),(259,49,1,2130706433,'admin_admin',2,'超级管理员 修改了管理员：test1',1,1490603531),(260,49,1,2130706433,'admin_admin',2,'超级管理员 修改了管理员：test1',1,1490603539),(261,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491538200),(262,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491546370),(263,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491546510),(264,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491546653),(265,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491546703),(266,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491546766),(267,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491546971),(268,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491547185),(269,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1491547261),(270,2,1,2130706433,'admin_auth_group',36,'超级管理员 添加了用户组：测试子部门',1,1491551446),(271,44,1,2130706433,'admin_auth_group',33,'超级管理员 修改了用户组：技术文章发布员',1,1491786993),(272,49,1,2130706433,'admin_admin',2,'超级管理员 修改了管理员：test1',1,1491787018),(273,44,1,2130706433,'admin_auth_group',36,'超级管理员 修改了用户组：测试子部门',1,1491787760),(274,44,1,2130706433,'admin_auth_group',36,'超级管理员 修改了用户组：测试子部门',1,1491792567),(275,44,1,2130706433,'admin_auth_group',36,'超级管理员 修改了用户组：测试子部门',1,1491792597),(276,44,1,2130706433,'admin_auth_group',36,'超级管理员 修改了用户组：测试子部门',1,1491792605),(277,44,1,2130706433,'admin_auth_group',36,'超级管理员 修改了用户组：测试子部门',1,1491792618),(278,44,1,2130706433,'admin_auth_group',36,'超级管理员 修改了用户组：测试子部门',1,1491792628),(279,1,1,2130706433,'admin_module',1,'超级管理员 更新了模块：系统核心',1,1493173568),(280,44,1,2130706433,'admin_auth_group',4,'超级管理员 修改了用户组：本地新闻发布员',1,1494410674),(281,44,1,2130706433,'admin_auth_group',2,'超级管理员 修改了用户组：信息管理员',1,1494410796),(282,46,1,2130706433,'admin_auth_group',4,'超级管理员 禁用了用户组：本地新闻发布员',1,1494410822),(283,45,1,2130706433,'admin_auth_group',4,'超级管理员 启用了用户组：本地新闻发布员',1,1494410824),(284,44,1,2130706433,'admin_auth_group',4,'超级管理员 修改了用户组：本地新闻发布员',1,1494410859),(258,50,1,2130706433,'admin_admin',2,'超级管理员 启用了管理员：test1',1,1488962689),(256,49,1,2130706433,'admin_admin',2,'超级管理员 修改了管理员：test1',1,1488960162),(257,51,1,2130706433,'admin_admin',2,'超级管理员 禁用了管理员：test1',1,1488960171);
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
INSERT INTO `t_admin_module` VALUES (1,'admin','系统核心','','&#xe62e;','#3CA6F1','核心系统','曲靖开发区奇讯科技有限公司','1.0.1','','','[{\"title\":\"\\u7cfb\\u7edf\",\"icon\":\"&#xe62e;\",\"level\":\"system\",\"url\":\"system\",\"_child\":[{\"title\":\"\\u7cfb\\u7edf\\u7ba1\\u7406\",\"icon\":\"&#xe63c;\",\"url\":\"systemConfig\",\"_child\":[{\"title\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"icon\":\"\",\"url\":\"admin\\/Config\\/configSet\"},{\"title\":\"\\u914d\\u7f6e\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Config\\/index\",\"_child\":[{\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Module\\/setStatus\"}]},{\"title\":\"\\u65e5\\u5fd7\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Log\\/index\",\"_child\":[{\"title\":\"\\u65e5\\u5fd7\\u8be6\\u60c5\",\"icon\":\"\",\"url\":\"admin\\/Log\\/details\"},{\"title\":\"\\u5220\\u9664\\u65e5\\u5fd7\",\"icon\":\"\",\"url\":\"admin\\/Log\\/delete\"}]},{\"title\":\"\\u884c\\u4e3a\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Action\\/index\",\"_child\":[{\"title\":\"\\u65b0\\u589e\\u884c\\u4e3a\",\"icon\":\"\",\"url\":\"admin\\/Action\\/add\"},{\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Action\\/setStatus\"},{\"title\":\"\\u5220\\u9664\\u884c\\u4e3a\",\"icon\":\"\",\"url\":\"admin\\/Action\\/delete\"},{\"title\":\"\\u4fee\\u6539\\u884c\\u4e3a\",\"icon\":\"\",\"url\":\"admin\\/Action\\/edit\"}]},{\"title\":\"\\u767b\\u5f55\\u65e5\\u5fd7\",\"icon\":\"\",\"url\":\"admin\\/LoginLog\\/index\",\"_child\":[{\"title\":\"\\u5220\\u9664\\u65e5\\u5fd7\",\"icon\":\"\",\"url\":\"admin\\/LoginLog\\/delete\"}]}]},{\"title\":\"\\u6269\\u5c55\\u4e2d\\u5fc3\",\"icon\":\"&#xe61f;\",\"url\":\"extendCenter\",\"_child\":[{\"title\":\"\\u529f\\u80fd\\u6a21\\u5757\",\"icon\":\"\",\"url\":\"admin\\/Module\\/index\",\"_child\":[{\"title\":\"\\u5b89\\u88c5\",\"icon\":\"\",\"url\":\"admin\\/Module\\/install\"},{\"title\":\"\\u5378\\u8f7d\",\"icon\":\"\",\"url\":\"admin\\/Module\\/uninstall\"},{\"title\":\"\\u66f4\\u65b0\\u4fe1\\u606f\",\"icon\":\"\",\"url\":\"admin\\/Module\\/updateInfo\"},{\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Module\\/setStatus\"}]}]},{\"title\":\"\\u7cfb\\u7edf\\u6743\\u9650\",\"icon\":\"&#xe62b;\",\"url\":\"roleAccess\",\"_child\":[{\"title\":\"\\u7ba1\\u7406\\u5458\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Manager\\/index\",\"_child\":[{\"title\":\"\\u6dfb\\u52a0\\u5458\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Manager\\/add\"},{\"title\":\"\\u4fee\\u6539\\u5458\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Manager\\/edit\"},{\"title\":\"\\u8bbe\\u7f6e\\u5458\\u7ba1\\u7406\\u72b6\\u6001\",\"icon\":\"\",\"url\":\"admin\\/Manager\\/setStatus\"},{\"title\":\"\\u5220\\u9664\\u7ba1\\u7406\\u5458\",\"icon\":\"\",\"url\":\"admin\\/Manager\\/delete\"}]},{\"title\":\"\\u7528\\u6237\\u7ec4\\u7ba1\\u7406\",\"icon\":\"\",\"url\":\"admin\\/Group\\/index\",\"_child\":[{\"title\":\"\\u6dfb\\u52a0\\u7528\\u6237\\u7ec4\",\"icon\":\"\",\"url\":\"admin\\/Group\\/add\"},{\"title\":\"\\u4fee\\u6539\\u7528\\u6237\\u7ec4\",\"icon\":\"\",\"url\":\"admin\\/Group\\/edit\"},{\"title\":\"\\u7528\\u6237\\u7ec4\\u72b6\\u6001\\u8bbe\\u7f6e\",\"icon\":\"\",\"url\":\"admin\\/Group\\/setStatus\"},{\"title\":\"\\u5220\\u9664\\u7528\\u6237\\u7ec4\",\"icon\":\"\",\"url\":\"admin\\/Group\\/delete\"}]}]}]}]',1,1438651748,1482137289,0,1);
/*!40000 ALTER TABLE `t_admin_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_test`
--

DROP TABLE IF EXISTS `t_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_test` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_test`
--

LOCK TABLES `t_test` WRITE;
/*!40000 ALTER TABLE `t_test` DISABLE KEYS */;
INSERT INTO `t_test` VALUES (1,'广东',0),(2,'江西',0),(3,'广州',1),(4,'深圳',1),(5,'河源',1),(6,'赣州',2),(7,'白云区',3),(8,'越秀区',3),(9,'南山区',4),(10,'江夏村',7);
/*!40000 ALTER TABLE `t_test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-24 17:46:56
