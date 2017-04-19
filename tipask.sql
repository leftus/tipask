-- MySQL dump 10.13  Distrib 5.7.11, for Win32 (AMD64)
--
-- Host: localhost    Database: tipask
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `ask_answers`
--

DROP TABLE IF EXISTS `ask_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `supports` int(10) unsigned NOT NULL DEFAULT '0',
  `oppositions` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` int(10) unsigned NOT NULL DEFAULT '0',
  `device` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `adopted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `answers_created_at_index` (`created_at`),
  KEY `answers_updated_at_index` (`updated_at`),
  KEY `answers_question_id_index` (`question_id`),
  KEY `answers_user_id_index` (`user_id`),
  KEY `answers_adopted_at_index` (`adopted_at`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_answers`
--

LOCK TABLES `ask_answers` WRITE;
/*!40000 ALTER TABLE `ask_answers` DISABLE KEYS */;
INSERT INTO `ask_answers` VALUES (1,'tipask是全世界最好的问答系统吗？',1,1,'<p>必须是啊必须是啊必须是啊必须是啊必须是啊必须是啊</p>',1,0,2,1,1,'2017-03-29 08:16:13','2017-03-29 08:12:02','2017-03-29 08:16:13');
/*!40000 ALTER TABLE `ask_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_areas`
--

DROP TABLE IF EXISTS `ask_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` smallint(6) NOT NULL DEFAULT '0',
  `grade` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=386 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_areas`
--

LOCK TABLES `ask_areas` WRITE;
/*!40000 ALTER TABLE `ask_areas` DISABLE KEYS */;
INSERT INTO `ask_areas` VALUES (1,'北京',0,1),(2,'上海',0,1),(3,'天津',0,1),(4,'重庆',0,1),(5,'辽宁',0,1),(6,'吉林',0,1),(7,'黑龙江',0,1),(8,'河北',0,1),(9,'山西',0,1),(10,'山东',0,1),(11,'河南',0,1),(12,'内蒙古',0,1),(13,'陕西',0,1),(14,'甘肃',0,1),(15,'宁夏',0,1),(16,'青海',0,1),(17,'新疆',0,1),(18,'福建',0,1),(19,'湖南',0,1),(20,'广东',0,1),(21,'广西',0,1),(22,'海南',0,1),(23,'江苏',0,1),(24,'浙江',0,1),(25,'安徽',0,1),(26,'江西',0,1),(27,'湖北',0,1),(28,'四川',0,1),(29,'贵州',0,1),(30,'云南',0,1),(31,'西藏',0,1),(32,'北京市',1,2),(33,'上海市',2,2),(34,'天津市',3,2),(35,'重庆市',4,2),(36,'抚顺',5,2),(37,'本溪',5,2),(38,'丹东',5,2),(39,'锦州',5,2),(40,'营口',5,2),(41,'阜新',5,2),(42,'辽阳',5,2),(43,'铁岭',5,2),(44,'朝阳',5,2),(45,'盘锦',5,2),(46,'葫芦岛',5,2),(47,'大连',5,2),(48,'沈阳',5,2),(49,'鞍山',5,2),(50,'长春',6,2),(51,'吉林',6,2),(52,'四平',6,2),(53,'辽源',6,2),(54,'通化',6,2),(55,'白城',6,2),(56,'延边',6,2),(57,'白山',6,2),(58,'松原',6,2),(59,'哈尔滨',7,2),(60,'齐齐哈尔',7,2),(61,'鹤岗',7,2),(62,'双鸭山',7,2),(63,'鸡西',7,2),(64,'大庆',7,2),(65,'伊春',7,2),(66,'牡丹江',7,2),(67,'佳木斯',7,2),(68,'七台河',7,2),(69,'绥化',7,2),(70,'黑河',7,2),(71,'大兴安岭',7,2),(72,'石家庄',8,2),(73,'唐山',8,2),(74,'秦皇岛',8,2),(75,'邯郸',8,2),(76,'邢台',8,2),(77,'张家口',8,2),(78,'承德',8,2),(79,'廊坊',8,2),(80,'沧州',8,2),(81,'保定',8,2),(82,'衡水',8,2),(83,'太原',9,2),(84,'大同',9,2),(85,'阳泉',9,2),(86,'长治',9,2),(87,'晋城',9,2),(88,'朔州',9,2),(89,'晋中',9,2),(90,'忻州',9,2),(91,'吕梁',9,2),(92,'临汾',9,2),(93,'运城',9,2),(94,'济南',10,2),(95,'青岛',10,2),(96,'淄博',10,2),(97,'枣庄',10,2),(98,'东营',10,2),(99,'潍坊',10,2),(100,'烟台',10,2),(101,'威海',10,2),(102,'济宁',10,2),(103,'泰安',10,2),(104,'日照',10,2),(105,'莱芜',10,2),(106,'德州',10,2),(107,'滨州',10,2),(108,'临沂',10,2),(109,'荷泽',10,2),(110,'聊城',10,2),(111,'郑州',11,2),(112,'开封',11,2),(113,'洛阳',11,2),(114,'平顶山',11,2),(115,'焦作',11,2),(116,'鹤壁',11,2),(117,'新乡',11,2),(118,'安阳',11,2),(119,'濮阳',11,2),(120,'许昌',11,2),(121,'漯河',11,2),(122,'三门峡',11,2),(123,'商丘',11,2),(124,'周口',11,2),(125,'驻马店',11,2),(126,'信阳',11,2),(127,'南阳',11,2),(128,'济源',11,2),(129,'呼和浩特',12,2),(130,'包头',12,2),(131,'乌海',12,2),(132,'赤峰',12,2),(133,'呼伦贝尔',12,2),(134,'巴彦淖尔',12,2),(135,'通辽',12,2),(136,'鄂尔多斯',12,2),(137,'乌兰察布',12,2),(138,'锡林郭勒盟',12,2),(139,'阿拉善盟',12,2),(140,'兴安盟',12,2),(141,'西安',13,2),(142,'铜川',13,2),(143,'宝鸡',13,2),(144,'咸阳',13,2),(145,'榆林',13,2),(146,'延安',13,2),(147,'渭南',13,2),(148,'汉中',13,2),(149,'商洛',13,2),(150,'安康',13,2),(151,'杨凌示范区',13,2),(152,'兰州',14,2),(153,'金昌',14,2),(154,'白银',14,2),(155,'天水',14,2),(156,'临夏回族自治州',14,2),(157,'定西',14,2),(158,'平凉',14,2),(159,'庆阳',14,2),(160,'陇南',14,2),(161,'武威',14,2),(162,'张掖',14,2),(163,'酒泉',14,2),(164,'甘南藏族自治州',14,2),(165,'嘉峪关',14,2),(166,'银川',15,2),(167,'石嘴山',15,2),(168,'吴忠',15,2),(169,'固原',15,2),(170,'中卫',15,2),(171,'西宁',16,2),(172,'海东地区',16,2),(173,'海北藏族自治州',16,2),(174,'黄南藏族自治州',16,2),(175,'海南藏族自治州',16,2),(176,'果洛藏族自治州',16,2),(177,'玉树藏族自治州',16,2),(178,'海西蒙古族藏族自治州',16,2),(179,'乌鲁木齐',17,2),(180,'克拉玛依',17,2),(181,'石河子',17,2),(182,'吐鲁番地区',17,2),(183,'哈密地区',17,2),(184,'昌吉回族自治州',17,2),(185,'和田地区',17,2),(186,'阿克苏地区',17,2),(187,'喀什地区',17,2),(188,'克孜勒苏柯尔克孜自治州',17,2),(189,'巴音郭楞蒙古自治州',17,2),(190,'塔城地区',17,2),(191,'阿勒泰地区',17,2),(192,'博尔塔拉蒙古自治州',17,2),(193,'伊犁哈萨克自治州',17,2),(194,'阿拉尔',17,2),(195,'图木舒克',17,2),(196,'五家渠',17,2),(197,'福州',18,2),(198,'厦门',18,2),(199,'三明',18,2),(200,'莆田',18,2),(201,'泉州',18,2),(202,'漳州',18,2),(203,'南平',18,2),(204,'宁德',18,2),(205,'龙岩',18,2),(206,'长沙',19,2),(207,'株洲',19,2),(208,'湘潭',19,2),(209,'衡阳',19,2),(210,'邵阳',19,2),(211,'岳阳',19,2),(212,'常德',19,2),(213,'张家界',19,2),(214,'娄底',19,2),(215,'郴州',19,2),(216,'永州',19,2),(217,'怀化',19,2),(218,'益阳',19,2),(219,'湘西自治州',19,2),(220,'广州',20,2),(221,'深圳',20,2),(222,'珠海',20,2),(223,'佛山',20,2),(224,'东莞',20,2),(225,'惠州',20,2),(226,'江门',20,2),(227,'湛江',20,2),(228,'茂名',20,2),(229,'中山',20,2),(230,'汕头',20,2),(231,'揭阳',20,2),(232,'潮州',20,2),(233,'汕尾',20,2),(234,'韶关',20,2),(235,'肇庆',20,2),(236,'清远',20,2),(237,'梅州',20,2),(238,'河源',20,2),(239,'云浮',20,2),(240,'阳江',20,2),(241,'南宁',21,2),(242,'柳州',21,2),(243,'桂林',21,2),(244,'梧州',21,2),(245,'北海',21,2),(246,'玉林',21,2),(247,'百色',21,2),(248,'防城港',21,2),(249,'钦州',21,2),(250,'贵港',21,2),(251,'贺州',21,2),(252,'河池',21,2),(253,'来宾',21,2),(254,'崇左',21,2),(255,'海口',22,2),(256,'三亚',22,2),(257,'琼海',22,2),(258,'五指山',22,2),(259,'儋州',22,2),(260,'文昌',22,2),(261,'万宁',22,2),(262,'东方',22,2),(263,'其他',22,2),(264,'南京',23,2),(265,'徐州',23,2),(266,'连云港',23,2),(267,'淮安',23,2),(268,'盐城',23,2),(269,'扬州',23,2),(270,'南通',23,2),(271,'镇江',23,2),(272,'常州',23,2),(273,'泰州',23,2),(274,'无锡',23,2),(275,'苏州',23,2),(276,'宿迁',23,2),(277,'杭州',24,2),(278,'湖州',24,2),(279,'宁波',24,2),(280,'温州',24,2),(281,'嘉兴',24,2),(282,'绍兴',24,2),(283,'金华',24,2),(284,'衢州',24,2),(285,'舟山',24,2),(286,'台州',24,2),(287,'丽水',24,2),(288,'合肥',25,2),(289,'淮南',25,2),(290,'淮北',25,2),(291,'芜湖',25,2),(292,'铜陵',25,2),(293,'蚌埠',25,2),(294,'马鞍山',25,2),(295,'安庆',25,2),(296,'黄山',25,2),(297,'宿州',25,2),(298,'滁州',25,2),(299,'巢湖',25,2),(300,'宣城',25,2),(301,'池州',25,2),(302,'六安',25,2),(303,'阜阳',25,2),(304,'毫州',25,2),(305,'南昌',26,2),(306,'景德镇',26,2),(307,'萍乡',26,2),(308,'新余',26,2),(309,'九江',26,2),(310,'鹰潭',26,2),(311,'上饶',26,2),(312,'宜春',26,2),(313,'抚州',26,2),(314,'吉安',26,2),(315,'赣州',26,2),(316,'武汉',27,2),(317,'黄石',27,2),(318,'襄阳',27,2),(319,'十堰',27,2),(320,'宜昌',27,2),(321,'荆州',27,2),(322,'鄂州',27,2),(323,'孝感',27,2),(324,'黄冈',27,2),(325,'咸宁',27,2),(326,'荆门',27,2),(327,'随州',27,2),(328,'天门',27,2),(329,'仙桃',27,2),(330,'潜江',27,2),(331,'神农架林区',27,2),(332,'恩施自治州',27,2),(333,'成都',28,2),(334,'自贡',28,2),(335,'广安',28,2),(336,'攀枝花',28,2),(337,'泸州',28,2),(338,'德阳',28,2),(339,'绵阳',28,2),(340,'广元',28,2),(341,'遂宁',28,2),(342,'内江',28,2),(343,'乐山',28,2),(344,'宜宾',28,2),(345,'南充',28,2),(346,'资阳',28,2),(347,'雅安',28,2),(348,'巴中',28,2),(349,'达州',28,2),(350,'眉山',28,2),(351,'甘孜',28,2),(352,'凉山',28,2),(353,'阿坝',28,2),(354,'贵阳',29,2),(355,'六盘水',29,2),(356,'遵义',29,2),(357,'铜仁',29,2),(358,'毕节',29,2),(359,'安顺',29,2),(360,'黔东南苗族侗族自治州',29,2),(361,'黔南布依族苗族自治州',29,2),(362,'黔西南布依族苗族自治州',29,2),(363,'昆明',30,2),(364,'昭通',30,2),(365,'曲靖',30,2),(366,'玉溪',30,2),(367,'普洱',30,2),(368,'临沧',30,2),(369,'保山',30,2),(370,'丽江',30,2),(371,'文山',30,2),(372,'红河',30,2),(373,'西双版纳',30,2),(374,'楚雄',30,2),(375,'大理',30,2),(376,'德宏',30,2),(377,'怒江',30,2),(378,'迪庆',30,2),(379,'拉萨',31,2),(380,'那曲',31,2),(381,'昌都',31,2),(382,'山南',31,2),(383,'日喀则',31,2),(384,'阿里',31,2),(385,'林芝',31,2);
/*!40000 ALTER TABLE `ask_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_articles`
--

DROP TABLE IF EXISTS `ask_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `collections` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` int(10) unsigned NOT NULL DEFAULT '0',
  `supports` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `device` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `articles_user_id_index` (`user_id`),
  KEY `articles_category_id_index` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_articles`
--

LOCK TABLES `ask_articles` WRITE;
/*!40000 ALTER TABLE `ask_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_attentions`
--

DROP TABLE IF EXISTS `ask_attentions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_attentions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `source_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `attentions_source_id_source_type_index` (`source_id`,`source_type`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_attentions`
--

LOCK TABLES `ask_attentions` WRITE;
/*!40000 ALTER TABLE `ask_attentions` DISABLE KEYS */;
INSERT INTO `ask_attentions` VALUES (1,2,1,'App\\Models\\Tag','2017-03-29 07:59:07','2017-03-29 07:59:07'),(2,2,1,'App\\Models\\Question','2017-03-29 08:07:22','2017-03-29 08:07:22'),(3,1,1,'App\\Models\\Question','2017-03-29 08:12:02','2017-03-29 08:12:02'),(4,2,2,'App\\Models\\Tag','2017-03-29 08:12:23','2017-03-29 08:12:23');
/*!40000 ALTER TABLE `ask_attentions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_authentications`
--

DROP TABLE IF EXISTS `ask_authentications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_authentications` (
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `real_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `id_card` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `id_card_image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `skill` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `skill_image` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `failed_reason` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  KEY `authentications_category_id_index` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_authentications`
--

LOCK TABLES `ask_authentications` WRITE;
/*!40000 ALTER TABLE `ask_authentications` DISABLE KEYS */;
INSERT INTO `ask_authentications` VALUES (2,0,'苏俊安','620423198706183338','authentications-CvVb8qTV58db694b4acf9.jpg','互联网','authentications-Y4ZZehRU58db694b4f34a.jpg',NULL,0,'2017-03-29 07:59:07','2017-03-29 08:01:50');
/*!40000 ALTER TABLE `ask_authentications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_categories`
--

DROP TABLE IF EXISTS `ask_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `grade` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `role_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_categories`
--

LOCK TABLES `ask_categories` WRITE;
/*!40000 ALTER TABLE `ask_categories` DISABLE KEYS */;
INSERT INTO `ask_categories` VALUES (1,0,1,'默认分类',NULL,'default','questions,articles,tags,experts',0,NULL,1,'2016-09-29 10:25:54','2016-09-29 10:28:05');
/*!40000 ALTER TABLE `ask_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_collections`
--

DROP TABLE IF EXISTS `ask_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `source_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `collections_source_id_source_type_index` (`source_id`,`source_type`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_collections`
--

LOCK TABLES `ask_collections` WRITE;
/*!40000 ALTER TABLE `ask_collections` DISABLE KEYS */;
INSERT INTO `ask_collections` VALUES (1,2,1,'App\\Models\\Question','tipask是全世界最好的问答系统吗？','2017-03-29 08:07:25','2017-03-29 08:07:25');
/*!40000 ALTER TABLE `ask_collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_comments`
--

DROP TABLE IF EXISTS `ask_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `source_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_user_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `supports` int(11) NOT NULL DEFAULT '0',
  `device` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comments_source_id_source_type_index` (`source_id`,`source_type`),
  KEY `comments_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_comments`
--

LOCK TABLES `ask_comments` WRITE;
/*!40000 ALTER TABLE `ask_comments` DISABLE KEYS */;
INSERT INTO `ask_comments` VALUES (1,2,'评论的按钮没有',1,'App\\Models\\Answer',NULL,1,1,1,'2017-03-29 08:13:58','2017-03-29 08:14:23'),(2,2,'能提交几次评论',1,'App\\Models\\Answer',NULL,1,1,1,'2017-03-29 08:14:21','2017-03-29 08:14:24');
/*!40000 ALTER TABLE `ask_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_credits`
--

DROP TABLE IF EXISTS `ask_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `source_subject` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coins` int(11) NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `credits_user_id_index` (`user_id`),
  KEY `credits_source_id_index` (`source_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_credits`
--

LOCK TABLES `ask_credits` WRITE;
/*!40000 ALTER TABLE `ask_credits` DISABLE KEYS */;
INSERT INTO `ask_credits` VALUES (1,1,'login',0,NULL,0,10,'2017-03-29 04:40:23'),(2,2,'register',0,NULL,20,20,'2017-03-29 07:50:23'),(3,2,'ask',1,'tipask是全世界最好的问答系统吗？',-3,0,'2017-03-29 08:07:05'),(4,2,'ask',1,'tipask是全世界最好的问答系统吗？',0,0,'2017-03-29 08:07:05'),(5,1,'answer',1,'tipask是全世界最好的问答系统吗？',0,10,'2017-03-29 08:12:02'),(6,1,'answer_adopted',1,'tipask是全世界最好的问答系统吗？',3,20,'2017-03-29 08:16:13');
/*!40000 ALTER TABLE `ask_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_doings`
--

DROP TABLE IF EXISTS `ask_doings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_doings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `action` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `source_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refer_id` int(10) unsigned NOT NULL,
  `refer_user_id` int(10) unsigned NOT NULL,
  `refer_content` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `doings_source_id_source_type_index` (`source_id`,`source_type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_doings`
--

LOCK TABLES `ask_doings` WRITE;
/*!40000 ALTER TABLE `ask_doings` DISABLE KEYS */;
INSERT INTO `ask_doings` VALUES (1,2,'ask',1,'App\\Models\\Question','tipask是全世界最好的问答系统吗？','tipask是全世界最好的问答系统吗？',0,0,'','2017-03-29 08:07:05'),(2,2,'follow_question',1,'App\\Models\\Question','tipask是全世界最好的问答系统吗？','',0,0,'','2017-03-29 08:07:22'),(3,1,'answer',1,'App\\Models\\Question','tipask是全世界最好的问答系统吗？','必须是啊必须是啊必须是啊必须是啊必须是啊必须是啊',0,0,'','2017-03-29 08:12:02');
/*!40000 ALTER TABLE `ask_doings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_email_tokens`
--

DROP TABLE IF EXISTS `ask_email_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_email_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `email_tokens_email_index` (`email`),
  KEY `email_tokens_token_index` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_email_tokens`
--

LOCK TABLES `ask_email_tokens` WRITE;
/*!40000 ALTER TABLE `ask_email_tokens` DISABLE KEYS */;
INSERT INTO `ask_email_tokens` VALUES (1,'1494836022@qq.com','register','41a032c30ce21f703d87f139a08d45485405cb6d47b980ecf7b574599f4e1bec','2017-03-29 07:50:23','2017-03-29 07:50:23');
/*!40000 ALTER TABLE `ask_email_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_exchanges`
--

DROP TABLE IF EXISTS `ask_exchanges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_exchanges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `coins` int(10) unsigned NOT NULL DEFAULT '0',
  `real_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `exchanges_user_id_index` (`user_id`),
  KEY `exchanges_goods_id_index` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_exchanges`
--

LOCK TABLES `ask_exchanges` WRITE;
/*!40000 ALTER TABLE `ask_exchanges` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_exchanges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_failed_jobs`
--

DROP TABLE IF EXISTS `ask_failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_failed_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_failed_jobs`
--

LOCK TABLES `ask_failed_jobs` WRITE;
/*!40000 ALTER TABLE `ask_failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_friendship_links`
--

DROP TABLE IF EXISTS `ask_friendship_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_friendship_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `slogan` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_friendship_links`
--

LOCK TABLES `ask_friendship_links` WRITE;
/*!40000 ALTER TABLE `ask_friendship_links` DISABLE KEYS */;
INSERT INTO `ask_friendship_links` VALUES (1,'tipask问答网','国内最好PHP开源的问答系统','http://wenda.tipask.com',1,1,'2016-05-10 10:25:54','2016-05-10 10:28:05');
/*!40000 ALTER TABLE `ask_friendship_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_goods`
--

DROP TABLE IF EXISTS `ask_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `coins` int(11) NOT NULL,
  `remnants` int(11) NOT NULL,
  `post_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_goods`
--

LOCK TABLES `ask_goods` WRITE;
/*!40000 ALTER TABLE `ask_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_jobs`
--

DROP TABLE IF EXISTS `ask_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_jobs`
--

LOCK TABLES `ask_jobs` WRITE;
/*!40000 ALTER TABLE `ask_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_messages`
--

DROP TABLE IF EXISTS `ask_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `is_read` tinyint(3) unsigned NOT NULL,
  `from_deleted` tinyint(3) unsigned NOT NULL,
  `to_deleted` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_messages`
--

LOCK TABLES `ask_messages` WRITE;
/*!40000 ALTER TABLE `ask_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_migrations`
--

DROP TABLE IF EXISTS `ask_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_migrations`
--

LOCK TABLES `ask_migrations` WRITE;
/*!40000 ALTER TABLE `ask_migrations` DISABLE KEYS */;
INSERT INTO `ask_migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_email_tokens_table',1),('2015_01_15_105324_create_roles_table',1),('2015_01_15_114412_create_role_user_table',1),('2015_01_26_115212_create_permissions_table',1),('2015_01_26_115523_create_permission_role_table',1),('2015_02_09_132439_create_permission_user_table',1),('2015_09_09_033353_create_questions_table',1),('2015_10_09_154125_create_answers_table',1),('2015_10_14_202058_create_user_data_table',1),('2015_10_16_173405_create_areas_table',1),('2015_11_13_163708_create_tags_table',1),('2015_11_25_124050_create_credits_table',1),('2015_11_27_155528_create_settings_table',1),('2015_12_04_120431_create_doings_table',1),('2015_12_14_144438_create_comments_table',1),('2015_12_21_120443_create_notifications_table',1),('2015_12_22_192137_create_collections_table',1),('2015_12_23_173149_create_attentions_table',1),('2016_01_07_174607_create_taggables_table',1),('2016_01_08_193754_create_supports_table',1),('2016_01_14_154209_create_articles_table',1),('2016_02_15_184106_create_messages_table',1),('2016_02_18_170935_create_notices_table',1),('2016_02_19_173117_create_recommendations_table',1),('2016_03_09_160615_create_question_invitations_table',1),('2016_05_05_173205_create_goods_table',1),('2016_05_05_174022_create_exchanges_table',1),('2016_05_10_164740_create_friendship_links_table',1),('2016_05_11_163810_create_authentications_table',1),('2016_06_13_112300_create_jobs_table',1),('2016_06_13_112327_create_failed_jobs_table',1),('2016_06_27_163138_create_user_oauth_table',1),('2016_09_19_231131_create_category_table',1),('2016_11_25_160245_add_logo_for_articles',1),('2016_12_02_183440_comment_add_support_field',1),('2016_12_10_161032_create_user_tag_table_table',1),('2016_12_15_100932_alter_question_invitation_add_sendto',1);
/*!40000 ALTER TABLE `ask_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_notices`
--

DROP TABLE IF EXISTS `ask_notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_notices`
--

LOCK TABLES `ask_notices` WRITE;
/*!40000 ALTER TABLE `ask_notices` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_notifications`
--

DROP TABLE IF EXISTS `ask_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` int(10) unsigned NOT NULL,
  `subject` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `refer_id` int(10) unsigned NOT NULL DEFAULT '0',
  `refer_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notifications_to_user_id_index` (`to_user_id`),
  KEY `notifications_source_id_index` (`source_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_notifications`
--

LOCK TABLES `ask_notifications` WRITE;
/*!40000 ALTER TABLE `ask_notifications` DISABLE KEYS */;
INSERT INTO `ask_notifications` VALUES (1,2,1,'comment_answer',1,'必须是啊必须是啊必须是啊必须是啊必须是啊必须是啊','评论的按钮没有',1,'answer',1,'2017-03-29 08:13:58','2017-03-30 02:37:11'),(2,2,1,'comment_answer',1,'必须是啊必须是啊必须是啊必须是啊必须是啊必须是啊','能提交几次评论',1,'answer',1,'2017-03-29 08:14:21','2017-03-30 02:37:11'),(3,2,1,'adopt_answer',1,'tipask是全世界最好的问答系统吗？','',0,'',1,'2017-03-29 08:16:13','2017-03-30 02:37:15');
/*!40000 ALTER TABLE `ask_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_permission_role`
--

DROP TABLE IF EXISTS `ask_permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_permission_role`
--

LOCK TABLES `ask_permission_role` WRITE;
/*!40000 ALTER TABLE `ask_permission_role` DISABLE KEYS */;
INSERT INTO `ask_permission_role` VALUES (1,1,1,'2016-02-16 09:37:51','2016-04-16 09:57:51');
/*!40000 ALTER TABLE `ask_permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_permission_user`
--

DROP TABLE IF EXISTS `ask_permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_permission_user`
--

LOCK TABLES `ask_permission_user` WRITE;
/*!40000 ALTER TABLE `ask_permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_permissions`
--

DROP TABLE IF EXISTS `ask_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_permissions`
--

LOCK TABLES `ask_permissions` WRITE;
/*!40000 ALTER TABLE `ask_permissions` DISABLE KEYS */;
INSERT INTO `ask_permissions` VALUES (1,'后台管理首页','admin.index.index','后台管理首页',NULL,'2016-02-16 09:57:51','2016-02-16 09:57:51');
/*!40000 ALTER TABLE `ask_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_question_invitations`
--

DROP TABLE IF EXISTS `ask_question_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_question_invitations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `send_to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `question_invitations_user_id_index` (`user_id`),
  KEY `question_invitations_question_id_index` (`question_id`),
  KEY `question_invitations_send_to_index` (`send_to`),
  KEY `question_invitations_from_user_id_index` (`from_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_question_invitations`
--

LOCK TABLES `ask_question_invitations` WRITE;
/*!40000 ALTER TABLE `ask_question_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_question_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_questions`
--

DROP TABLE IF EXISTS `ask_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` smallint(6) NOT NULL DEFAULT '0',
  `hide` tinyint(4) NOT NULL DEFAULT '0',
  `answers` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `followers` int(10) unsigned NOT NULL DEFAULT '0',
  `collections` int(10) unsigned NOT NULL DEFAULT '0',
  `comments` int(10) unsigned NOT NULL DEFAULT '0',
  `device` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `questions_created_at_index` (`created_at`),
  KEY `questions_updated_at_index` (`updated_at`),
  KEY `questions_user_id_index` (`user_id`),
  KEY `questions_title_index` (`title`),
  KEY `questions_category_id_index` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_questions`
--

LOCK TABLES `ask_questions` WRITE;
/*!40000 ALTER TABLE `ask_questions` DISABLE KEYS */;
INSERT INTO `ask_questions` VALUES (1,2,1,'tipask是全世界最好的问答系统吗？','<p>tipask是全世界最好的问答系统吗？<img src=\"http://www.tipask.cn/image/show/attachments-2017-03-X1pIcVqo58db6b10cd2ad.jpg\" class=\"img-responsive\" style=\"width:375px;\" alt=\"attachments-2017-03-X1pIcVqo58db6b10cd2a\" /><br /></p>',3,0,1,13,2,1,0,1,2,'2017-03-29 08:07:05','2017-03-30 02:37:15');
/*!40000 ALTER TABLE `ask_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_recommendations`
--

DROP TABLE IF EXISTS `ask_recommendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_recommendations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_recommendations`
--

LOCK TABLES `ask_recommendations` WRITE;
/*!40000 ALTER TABLE `ask_recommendations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_recommendations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_role_user`
--

DROP TABLE IF EXISTS `ask_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_role_user`
--

LOCK TABLES `ask_role_user` WRITE;
/*!40000 ALTER TABLE `ask_role_user` DISABLE KEYS */;
INSERT INTO `ask_role_user` VALUES (1,1,1,'2017-03-29 04:37:47','2017-03-29 04:37:47'),(3,2,2,'2017-03-29 07:58:20','2017-03-29 07:58:20');
/*!40000 ALTER TABLE `ask_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_roles`
--

DROP TABLE IF EXISTS `ask_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_roles`
--

LOCK TABLES `ask_roles` WRITE;
/*!40000 ALTER TABLE `ask_roles` DISABLE KEYS */;
INSERT INTO `ask_roles` VALUES (1,'后台管理员','admin','后台管理员，具有最高权限',1,'2016-02-16 01:52:13','2016-02-16 01:52:13'),(2,'普通会员','member','普通会员，不可管理后台',1,'2016-02-16 01:52:13','2016-02-16 01:52:13');
/*!40000 ALTER TABLE `ask_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_settings`
--

DROP TABLE IF EXISTS `ask_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_settings` (
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_settings`
--

LOCK TABLES `ask_settings` WRITE;
/*!40000 ALTER TABLE `ask_settings` DISABLE KEYS */;
INSERT INTO `ask_settings` VALUES ('coins_write_article','0'),('coins_adopted','0'),('coins_answer','0'),('coins_ask','0'),('coins_login','0'),('coins_register','20'),('credits_write_article','0'),('credits_adopted','20'),('credits_answer','10'),('credits_ask','0'),('credits_login','10'),('credits_register','20'),('date_format','Y-m-d'),('time_diff','0'),('time_format','H:i'),('time_friendly','1'),('time_offset','8'),('website_admin_email','1399301831@qq.com'),('website_footer',''),('website_header',''),('website_icp',''),('website_cache_time','1'),('website_name','糖友网问答平台'),('website_url','www.tipask.cn');
/*!40000 ALTER TABLE `ask_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_supports`
--

DROP TABLE IF EXISTS `ask_supports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_supports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `supportable_id` int(10) unsigned NOT NULL,
  `supportable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `supports_supportable_id_supportable_type_index` (`supportable_id`,`supportable_type`),
  KEY `supports_session_id_index` (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_supports`
--

LOCK TABLES `ask_supports` WRITE;
/*!40000 ALTER TABLE `ask_supports` DISABLE KEYS */;
INSERT INTO `ask_supports` VALUES (1,'0aa65c684b4bbde9228eb782b49da0e94e5e2136',2,1,'App\\Models\\Answer','2017-03-29 08:13:25','2017-03-29 08:13:25'),(2,'0aa65c684b4bbde9228eb782b49da0e94e5e2136',2,1,'App\\Models\\Comment','2017-03-29 08:14:23','2017-03-29 08:14:23'),(3,'0aa65c684b4bbde9228eb782b49da0e94e5e2136',2,2,'App\\Models\\Comment','2017-03-29 08:14:24','2017-03-29 08:14:24');
/*!40000 ALTER TABLE `ask_supports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_taggables`
--

DROP TABLE IF EXISTS `ask_taggables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_taggables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) unsigned NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `taggables_taggable_id_taggable_type_index` (`taggable_id`,`taggable_type`),
  KEY `taggables_tag_id_index` (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_taggables`
--

LOCK TABLES `ask_taggables` WRITE;
/*!40000 ALTER TABLE `ask_taggables` DISABLE KEYS */;
INSERT INTO `ask_taggables` VALUES (1,2,1,'App\\Models\\Question','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ask_taggables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_tags`
--

DROP TABLE IF EXISTS `ask_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `logo` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `followers` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`),
  KEY `tags_parent_id_index` (`parent_id`),
  KEY `tags_followers_index` (`followers`),
  KEY `tags_category_id_index` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_tags`
--

LOCK TABLES `ask_tags` WRITE;
/*!40000 ALTER TABLE `ask_tags` DISABLE KEYS */;
INSERT INTO `ask_tags` VALUES (1,'互联网',0,'','',NULL,0,1,'2017-03-29 07:59:07','2017-03-29 07:59:07'),(2,'tipask',0,'','',NULL,0,1,'2017-03-29 08:07:05','2017-03-29 08:12:23');
/*!40000 ALTER TABLE `ask_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_user_data`
--

DROP TABLE IF EXISTS `ask_user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_user_data` (
  `user_id` int(10) unsigned NOT NULL,
  `coins` int(10) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) unsigned NOT NULL DEFAULT '0',
  `registered_at` timestamp NULL DEFAULT NULL,
  `last_visit` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `questions` int(10) unsigned NOT NULL DEFAULT '0',
  `articles` int(10) unsigned NOT NULL DEFAULT '0',
  `answers` int(10) unsigned NOT NULL DEFAULT '0',
  `adoptions` int(10) unsigned NOT NULL DEFAULT '0',
  `supports` int(10) unsigned NOT NULL DEFAULT '0',
  `followers` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `email_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `authentication_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_user_data`
--

LOCK TABLES `ask_user_data` WRITE;
/*!40000 ALTER TABLE `ask_user_data` DISABLE KEYS */;
INSERT INTO `ask_user_data` VALUES (1,3,60,'2017-03-29 04:37:47','2017-03-29 04:37:47','127.0.0.1',0,0,1,1,1,0,5,0,0,0),(2,17,40,'2017-03-29 07:50:23','2017-03-29 07:50:23','127.0.0.1',1,0,0,0,2,0,8,0,0,0);
/*!40000 ALTER TABLE `ask_user_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_user_oauth`
--

DROP TABLE IF EXISTS `ask_user_oauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_user_oauth` (
  `id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `auth_type` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `access_token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `refresh_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expires_in` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_oauth_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_user_oauth`
--

LOCK TABLES `ask_user_oauth` WRITE;
/*!40000 ALTER TABLE `ask_user_oauth` DISABLE KEYS */;
/*!40000 ALTER TABLE `ask_user_oauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_user_tags`
--

DROP TABLE IF EXISTS `ask_user_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_user_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `questions` int(10) unsigned NOT NULL DEFAULT '0',
  `articles` int(10) unsigned NOT NULL DEFAULT '0',
  `answers` int(10) unsigned NOT NULL DEFAULT '0',
  `supports` int(10) unsigned NOT NULL DEFAULT '0',
  `adoptions` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_tags_user_id_index` (`user_id`),
  KEY `user_tags_tag_id_index` (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_user_tags`
--

LOCK TABLES `ask_user_tags` WRITE;
/*!40000 ALTER TABLE `ask_user_tags` DISABLE KEYS */;
INSERT INTO `ask_user_tags` VALUES (1,2,2,1,0,0,0,1,'2017-03-29 08:07:05','2017-03-29 08:16:13'),(2,1,2,0,0,1,1,0,'2017-03-29 08:12:02','2017-03-29 08:13:25');
/*!40000 ALTER TABLE `ask_user_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask_users`
--

DROP TABLE IF EXISTS `ask_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `province` smallint(6) DEFAULT NULL,
  `city` smallint(6) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `site_notifications` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_notifications` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_name_index` (`name`),
  KEY `users_mobile_index` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_users`
--

LOCK TABLES `ask_users` WRITE;
/*!40000 ALTER TABLE `ask_users` DISABLE KEYS */;
INSERT INTO `ask_users` VALUES (1,'admin','1399301831@qq.com',NULL,'$2y$10$l2WJY.g0rOY8AePJbskyEO1jrAI0.ckl5Xtyy28jL4dz89Nd7oAQu',NULL,NULL,NULL,NULL,NULL,NULL,1,'follow_user,invite_answer,comment_question,comment_article,adopt_answer,comment_answer,reply_comment','adopt_answer,invite_answer','fH5nZ1vxenNWOmkvwkVA3BN2PQoJNNONRbMNhwcHtAvt842kGh0LUUiINo7L','2017-03-29 04:37:47','2017-03-29 07:49:30'),(2,'leftus','1494836022@qq.com',NULL,'$2y$10$oDyQ1ue9hGNAsqhvq/vPtubeMBFOv8NJvvbRG0sf4SI09Lh376v9K',0,NULL,0,0,'','',1,'follow_user,invite_answer,comment_question,comment_article,adopt_answer,comment_answer,reply_comment','adopt_answer,invite_answer',NULL,'2017-03-29 07:50:23','2017-03-29 07:58:20');
/*!40000 ALTER TABLE `ask_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-30 13:17:36
