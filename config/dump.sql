-- MySQL dump 10.13  Distrib 5.1.58, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: bloomweb_excelenter
-- ------------------------------------------------------
-- Server version	5.1.53-log

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
-- Table structure for table `architectures`
--

DROP TABLE IF EXISTS `architectures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `architectures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architectures`
--

LOCK TABLES `architectures` WRITE;
/*!40000 ALTER TABLE `architectures` DISABLE KEYS */;
INSERT INTO `architectures` VALUES (1,'AMD'),(2,'Intel');
/*!40000 ALTER TABLE `architectures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `sort` varchar(45) DEFAULT NULL,
  `slug` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'AMD',NULL,NULL,'amd',NULL,NULL),(2,'Intel',NULL,NULL,'intel',NULL,NULL),(3,'LG',NULL,NULL,'lg',NULL,NULL),(4,'Sony',NULL,NULL,'sony',NULL,NULL),(5,'ASUS',NULL,NULL,'asus',NULL,NULL),(6,'XFX',NULL,NULL,'xfx',NULL,NULL),(7,'DELL',NULL,NULL,'dell',NULL,NULL),(8,'Logitech',NULL,NULL,'logitech',NULL,NULL),(9,'Microsoft',NULL,NULL,'microsoft',NULL,NULL),(10,'Genius',NULL,NULL,'genius',NULL,NULL),(11,'Creative',NULL,NULL,'creative',NULL,NULL),(12,'Thermaltake',NULL,NULL,'thermaltake',NULL,NULL),(13,'SuperPower',NULL,NULL,'superpower',NULL,NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `comment` text,
  `model` varchar(45) DEFAULT NULL,
  `foreign_key` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users_INDEX` (`users_id`),
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventories_products_INDEX` (`product_id`),
  CONSTRAINT `fk_inventories_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (13,13,0,'2011-11-21 17:19:02','2011-11-21 17:19:02'),(14,14,0,'2011-11-21 17:20:09','2011-11-21 17:20:09'),(15,15,0,'2011-11-21 17:24:26','2011-11-21 17:24:26'),(16,16,0,'2011-11-21 17:26:07','2011-11-21 17:26:07'),(18,18,0,'2011-11-21 17:43:56','2011-11-21 17:43:56'),(19,19,0,'2011-11-21 18:00:43','2011-11-21 18:00:43'),(20,20,0,'2011-11-21 18:06:09','2011-11-21 18:06:09'),(21,21,0,'2011-11-21 18:14:46','2011-11-21 18:14:46'),(22,22,0,'2011-11-21 18:41:11','2011-11-21 18:41:11'),(23,23,0,'2011-11-21 18:45:50','2011-11-21 18:45:50'),(24,24,0,'2011-11-21 18:47:37','2011-11-21 18:47:37'),(25,25,0,'2011-11-21 18:48:37','2011-11-21 18:48:37'),(26,26,0,'2011-11-21 18:49:36','2011-11-21 18:49:36'),(27,27,0,'2011-11-21 18:52:38','2011-11-21 18:52:38'),(28,28,0,'2011-11-21 18:54:14','2011-11-21 18:54:14'),(29,29,0,'2011-11-21 18:58:06','2011-11-21 18:58:06'),(30,30,0,'2011-11-21 19:06:17','2011-11-21 19:06:17'),(31,31,0,'2011-11-21 19:08:57','2011-11-21 19:08:57'),(32,32,0,'2011-11-21 19:09:58','2011-11-21 19:09:58'),(33,33,0,'2011-11-21 19:15:02','2011-11-21 19:15:02'),(34,34,0,'2011-11-21 19:16:48','2011-11-21 19:16:48'),(35,35,0,'2011-11-21 19:18:35','2011-11-21 19:18:35'),(36,36,0,'2011-11-21 19:19:51','2011-11-21 19:19:51'),(37,37,0,'2011-11-21 19:22:47','2011-11-21 19:22:47'),(38,38,0,'2011-11-21 19:23:48','2011-11-21 19:23:48'),(39,39,0,'2011-11-21 19:25:08','2011-11-21 19:25:08'),(40,40,0,'2011-11-21 19:29:48','2011-11-21 19:29:48'),(41,41,0,'2011-11-21 19:30:45','2011-11-21 19:30:45');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_movements`
--

DROP TABLE IF EXISTS `inventory_movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_movements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(11) NOT NULL,
  `old_quantity` int(11) NOT NULL,
  `new_quantity` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inventory_movements_users_INDEX` (`inventory_id`),
  KEY `fk_inventory_movements_inventories_INDEX` (`user_id`),
  CONSTRAINT `fk_inventory_movements_inventories` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventory_movements_users` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_movements`
--

LOCK TABLES `inventory_movements` WRITE;
/*!40000 ALTER TABLE `inventory_movements` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_item` double NOT NULL,
  `price_total` double NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `transportadora` varchar(100) DEFAULT NULL,
  `guia` varchar(100) DEFAULT NULL,
  `web_transportadora` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`price_item`),
  KEY `fk_order_items_orders_INDEX` (`order_id`),
  CONSTRAINT `fk_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_states`
--

DROP TABLE IF EXISTS `order_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_states`
--

LOCK TABLES `order_states` WRITE;
/*!40000 ALTER TABLE `order_states` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(9) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `identifier` varchar(32) NOT NULL,
  `order_state_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `subtotal` double NOT NULL,
  `total` double NOT NULL,
  `transportadora` varchar(100) DEFAULT NULL,
  `guia` varchar(100) DEFAULT NULL,
  `web_transportadora` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_agent_UNIQUE` (`identifier`),
  KEY `fk_orders_users_INDEX` (`user_id`),
  KEY `fk_orders_order_states_INDEX` (`order_state_id`),
  CONSTRAINT `fk_orders_order_states` FOREIGN KEY (`order_state_id`) REFERENCES `order_states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sliders`
--

DROP TABLE IF EXISTS `page_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `wysiwyg_content` text,
  `sort` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_page_sliders_pages_INDEX` (`page_id`),
  CONSTRAINT `fk_page_sliders_pages` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sliders`
--

LOCK TABLES `page_sliders` WRITE;
/*!40000 ALTER TABLE `page_sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `layout` varchar(45) DEFAULT NULL,
  `keywords` text,
  `is_active` tinyint(1) DEFAULT NULL,
  `wysiwyg_content` longtext,
  `slug` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Inicio','','default','',1,'<p>\r\n	ricardo</p>\r\n','inicio',NULL,'2011-12-02 17:21:06'),(2,'Servicios',NULL,'default',NULL,1,NULL,'servicios',NULL,NULL),(3,'Proceso de Pago',NULL,'default',NULL,1,NULL,'proceso-de-pago',NULL,NULL),(4,'Políticas de Garantia',NULL,'default',NULL,1,NULL,'politicas-de-garantia',NULL,NULL),(5,'Empresa',NULL,'default',NULL,1,NULL,'empresa',NULL,NULL),(6,'Contacto',NULL,'default',NULL,1,NULL,'contacto',NULL,NULL),(7,'Quienes Somos',NULL,'default',NULL,NULL,NULL,'quienes-somos',NULL,NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_lists`
--

DROP TABLE IF EXISTS `price_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_lists`
--

LOCK TABLES `price_lists` WRITE;
/*!40000 ALTER TABLE `price_lists` DISABLE KEYS */;
INSERT INTO `price_lists` VALUES (4,'/app/webroot/files/uploads/grupon (3).pdf','2011-11-06 23:13:50','2011-11-06 23:13:50'),(5,'/app/webroot/files/uploads/phpant2-sample.pdf','2011-11-06 23:15:34','2011-11-06 23:15:34'),(6,'/app/webroot/files/uploads/grupon (4).pdf','2011-11-06 23:17:12','2011-11-06 23:17:12'),(7,'/app/webroot/files/uploads/grupon (5).pdf','2011-11-06 23:19:36','2011-11-06 23:19:36'),(8,'/app/webroot/files/uploads/grupon (6).pdf','2011-11-06 23:20:09','2011-11-06 23:20:09');
/*!40000 ALTER TABLE `price_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_pictures`
--

DROP TABLE IF EXISTS `product_pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt` varchar(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_pictures_products_INDEX` (`product_id`),
  CONSTRAINT `fk_product_pictures_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_pictures`
--

LOCK TABLES `product_pictures` WRITE;
/*!40000 ALTER TABLE `product_pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_types`
--

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;
INSERT INTO `product_types` VALUES (1,'Procesador',NULL),(2,'Tarjeta Madre',NULL),(3,'Memoria',NULL),(4,'Disco Duro',NULL),(5,'Tarjeta De Video',NULL),(6,'Tarjeta De Sonido',NULL),(7,'Torre',NULL),(8,'Impresora',NULL),(9,'Monitor',NULL),(10,'Otras Tarjetas',NULL),(11,'Accesorios',NULL),(12,'Memoria USB',NULL),(13,'Fuente',NULL),(14,'Unidades Opticas',''),(15,'Otro',NULL);
/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_id` int(11) NOT NULL,
  `architecture_id` int(11) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  `is_video_included` tinyint(1) DEFAULT '0',
  `required_power` int(11) DEFAULT NULL,
  `power_output` int(11) DEFAULT '0',
  `is_big_casing_required` tinyint(1) DEFAULT '0',
  `is_power_supply_included` tinyint(1) DEFAULT '0',
  `is_big_casing` tinyint(1) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `ref` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `keywords` text,
  `recommendations` varchar(45) DEFAULT NULL,
  `is_gamers` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `times_visited` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_product_types_INDEX` (`product_type_id`),
  KEY `fk_products_architectures_INDEX` (`architecture_id`),
  KEY `fk_products_brands_INDEX` (`brand_id`),
  CONSTRAINT `fk_products_architectures` FOREIGN KEY (`architecture_id`) REFERENCES `architectures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_brands` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_product_types` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (13,1,1,1,0,NULL,0,0,0,NULL,'AM3+ 1','','001',200000,'blooooom (8).jpg','am3+-1','','',1,1,1,NULL,'2011-11-21 17:19:02','2011-11-21 17:19:02'),(14,1,1,1,0,NULL,0,0,0,NULL,'AM3+ 2','','002',50000,'blooooom (9).jpg','am3+-2','','',1,1,1,NULL,'2011-11-21 17:20:09','2011-11-21 17:20:09'),(15,1,1,1,0,NULL,0,0,0,NULL,'AM3 1','','003',9000,'blooooom (11).jpg','am3-1','','',1,1,1,NULL,'2011-11-21 17:24:26','2011-11-21 17:24:26'),(16,1,1,1,0,NULL,0,0,0,NULL,'AM3 2','','004',50000,'blooooom (10).jpg','am3-2','','',1,1,1,NULL,'2011-11-21 17:26:06','2011-11-21 17:26:06'),(18,2,1,1,1,NULL,0,0,0,NULL,'PCI,DDR3,PCIExpress3.0,sta2, sata3,usb2.0,usb3.0,firewire,IDE','','005',300000,'blooooom (13).jpg','pci,ddr3,pciexpress3.0,sta2,-sata3,usb2.0,usb3.0,firewire,ide','','',1,1,1,NULL,'2011-11-21 17:43:55','2011-11-25 14:49:43'),(19,2,1,6,1,NULL,0,0,0,NULL,'PCI,DDR3,PCIExpress2.0,sta2, sata3,usb2.0,usb3.0,firewire,IDE','','006',200000,'blooooom (14).jpg','pci,ddr3,pciexpress2.0,sta2,-sata3,usb2.0,usb3.0,firewire,ide','','',1,1,0,NULL,'2011-11-21 18:00:43','2011-11-21 18:00:43'),(20,2,1,1,0,NULL,0,0,0,NULL,'PCI,DDR2,PCIExpress2.0,sta2,usb2.0,usb3.0,IDE','','007',200000,'blooooom (15).jpg','pci,ddr3,pciexpress2.0,sta2,-sata3,usb2.0,usb3.0,firewire,ide','','',1,1,0,NULL,'2011-11-21 18:06:09','2011-11-21 18:06:09'),(21,2,1,1,0,NULL,0,0,0,NULL,'PCI,DDR3,PCIExpress2.0,sta2, sata3,usb2.0,usb3.0IDE','','008',300000,'blooooom (17).jpg','pci,ddr3,pciexpress2.0,sta2,-sata3,usb2.0,usb3.0ide','','',1,1,1,NULL,'2011-11-21 18:14:46','2011-11-21 18:14:46'),(22,2,1,6,1,NULL,0,0,0,NULL,'PCI,DDR1,sata2, IDE','','009',200000,'blooooom (18).jpg','pci,ddr1,sata2,-ide','','',1,1,0,NULL,'2011-11-21 18:41:10','2011-11-21 18:41:10'),(23,3,NULL,1,0,NULL,0,0,0,NULL,'DDR3 1','','010',200000,'blooooom (16).jpg','ddr3-1','','',1,1,0,NULL,'2011-11-21 18:45:50','2011-11-21 18:45:50'),(24,3,NULL,6,0,NULL,0,0,0,NULL,'DDR3 2','','011',200000,'blooooom (19).jpg','ddr3-2','','',1,1,0,NULL,'2011-11-21 18:47:36','2011-11-21 18:47:36'),(25,3,NULL,11,0,NULL,0,0,0,NULL,'DDR2 1','','012',200000,'blooooom (20).jpg','ddr2-1','','',1,1,0,NULL,'2011-11-21 18:48:36','2011-11-21 18:48:36'),(26,3,NULL,5,0,NULL,0,0,0,NULL,'DDR2 2','','013',200000,'blooooom (21).jpg','ddr2-2','','',1,1,0,NULL,'2011-11-21 18:49:36','2011-11-21 18:49:36'),(27,3,NULL,11,0,NULL,0,0,0,NULL,'DDR1 1','','014',200000,'blooooom (22).jpg','ddr1-1','','',1,1,0,NULL,'2011-11-21 18:52:37','2011-11-21 18:52:37'),(28,4,NULL,4,0,NULL,0,0,0,NULL,'IDE 1','','015',200000,'blooooom (23).jpg','ide-1','','',1,1,0,NULL,'2011-11-21 18:54:13','2011-11-21 18:54:13'),(29,4,NULL,11,0,NULL,0,0,0,NULL,'SATA2 1','','016',100,'blooooom (25).jpg','sata2-1','','',1,1,0,NULL,'2011-11-21 18:58:06','2011-11-21 18:58:06'),(30,4,NULL,1,0,NULL,0,0,0,NULL,'SATA 3 1','','017',200000,'blooooom (24).jpg','sata-3-1','','',1,1,0,NULL,'2011-11-21 19:06:16','2011-11-21 19:06:16'),(31,4,NULL,1,0,NULL,0,0,0,NULL,'SATA 3 2','','018',200000,'blooooom (26).jpg','sata-3-2','','',1,1,0,NULL,'2011-11-21 19:08:57','2011-11-21 19:08:57'),(32,4,NULL,11,0,NULL,0,0,0,NULL,'SATA2 2','','019',200000,'blooooom (27).jpg','sata2-2','','',1,1,0,NULL,'2011-11-21 19:09:57','2011-11-21 19:09:57'),(33,5,NULL,1,0,2000,0,1,0,NULL,'2000 torre grande1','','020',50000,'blooooom (28).jpg','2000-torre-grande1','','',1,1,0,NULL,'2011-11-21 19:15:02','2011-11-21 19:15:02'),(34,5,NULL,1,0,3000,0,1,0,NULL,'3000 torre grande 2','','021',300000,'blooooom-3_02 (2).jpg','3000-torre-grande-2','','',1,1,0,NULL,'2011-11-21 19:16:48','2011-11-21 19:16:48'),(35,5,NULL,1,0,400,0,0,0,NULL,'400 torre pequeÃ±a','','022',200000,'blooooom-3_02 (4).jpg','400-torre-pequeÃ±a','','',1,1,0,NULL,'2011-11-21 19:18:35','2011-11-21 19:18:35'),(36,5,NULL,1,0,700,0,0,0,NULL,'700 torre pequeÃ±a','','023',200000,'blooooom-3_02 (5).jpg','700-torre-pequeÃ±a','','',1,1,0,NULL,'2011-11-21 19:19:51','2011-11-21 19:19:51'),(37,7,NULL,1,0,NULL,0,0,0,1,'Torre grande sin fuente','','024',200000,'blooooom-3_02 (6).jpg','torre-grande-sin-fuente','','',1,1,0,NULL,'2011-11-21 19:22:47','2011-11-21 19:22:47'),(38,7,NULL,1,0,NULL,0,0,1,1,'Torre grande con fuente','','025',300000,'blooooom (29).jpg','torre-grande-con-fuente','','',1,1,0,NULL,'2011-11-21 19:23:48','2011-11-21 19:23:48'),(39,7,NULL,1,0,NULL,0,0,1,0,'torre pequeÃ±a con fuente','','026',100,'blooooom (30).jpg','torre-pequeÃ±a-con-fuente','','',1,1,0,NULL,'2011-11-21 19:25:08','2011-11-21 19:25:08'),(40,13,NULL,11,0,NULL,750,0,0,NULL,'Fuente 750','','027',30005,'blooooom (31).jpg','fuente-750','','',1,1,0,NULL,'2011-11-21 19:29:48','2011-11-21 19:29:48'),(41,13,NULL,1,0,NULL,3000,0,0,NULL,'Fuente 3000','','028',45600,'blooooom (32).jpg','fuente-3000','','',1,1,0,NULL,'2011-11-21 19:30:44','2011-11-21 19:30:44');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_polls`
--

DROP TABLE IF EXISTS `products_polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_product_id_UNIQUE` (`user_id`,`product_id`),
  KEY `fk_products_poll_users_INDEX` (`user_id`),
  KEY `fk_products_poll_products_INDEX` (`product_id`),
  CONSTRAINT `fk_products_poll_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_poll_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_polls`
--

LOCK TABLES `products_polls` WRITE;
/*!40000 ALTER TABLE `products_polls` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_slots`
--

DROP TABLE IF EXISTS `products_slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_motherboards_slots_slots_INDEX` (`slot_id`),
  KEY `fk_products_slots_products_INDEX` (`product_id`),
  CONSTRAINT `fk_products_slots_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_slots_slots` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_slots`
--

LOCK TABLES `products_slots` WRITE;
/*!40000 ALTER TABLE `products_slots` DISABLE KEYS */;
INSERT INTO `products_slots` VALUES (38,19,1,1),(39,19,12,1),(40,19,11,1),(41,19,10,1),(42,19,9,1),(43,19,7,1),(44,19,6,1),(45,19,3,1),(46,20,1,1),(47,20,14,1),(48,20,11,1),(49,20,10,1),(50,20,9,1),(51,20,6,1),(52,20,3,1),(53,21,1,1),(54,21,15,1),(55,21,11,1),(56,21,10,1),(57,21,9,1),(58,21,7,1),(59,21,6,1),(60,21,4,1),(61,22,1,1),(62,22,13,1),(63,22,11,1),(64,22,6,1),(65,23,15,1),(66,24,15,1),(67,25,14,1),(68,26,14,1),(69,27,13,1),(70,28,11,1),(71,29,5,1),(72,30,7,1),(73,31,7,1),(74,32,6,1),(75,33,4,1),(76,34,4,1),(77,35,3,1),(78,36,3,1),(79,18,1,2),(80,18,15,2),(81,18,11,2),(82,18,10,2),(83,18,9,2),(84,18,7,2),(85,18,6,2),(86,18,4,2);
/*!40000 ALTER TABLE `products_slots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_sockets`
--

DROP TABLE IF EXISTS `products_sockets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_sockets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `socket_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_products_sockets_products_INDEX` (`product_id`),
  KEY `fk_products_sockets_sockets_INDEX` (`socket_id`),
  CONSTRAINT `fk_products_sockets_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_sockets_sockets` FOREIGN KEY (`socket_id`) REFERENCES `sockets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_sockets`
--

LOCK TABLES `products_sockets` WRITE;
/*!40000 ALTER TABLE `products_sockets` DISABLE KEYS */;
INSERT INTO `products_sockets` VALUES (6,13,3,1),(7,14,3,1),(8,15,2,1),(9,16,2,1),(12,19,3,1),(13,20,3,1),(14,22,2,1),(15,18,3,1);
/*!40000 ALTER TABLE `products_sockets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_tags`
--

DROP TABLE IF EXISTS `products_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id_tag_id_UNIQUE` (`product_id`,`tag_id`),
  KEY `fk_products_tags_products_INDEX` (`product_id`),
  KEY `fk_products_tags_tags_INDEX` (`tag_id`),
  CONSTRAINT `fk_products_tags_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_tags_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_tags`
--

LOCK TABLES `products_tags` WRITE;
/*!40000 ALTER TABLE `products_tags` DISABLE KEYS */;
INSERT INTO `products_tags` VALUES (14,13,1,NULL),(15,14,1,NULL),(16,15,1,NULL),(17,16,1,NULL),(20,19,2,NULL),(21,20,2,NULL),(22,21,2,NULL),(23,22,2,NULL),(24,23,3,NULL),(25,24,3,NULL),(26,25,3,NULL),(27,26,3,NULL),(28,27,3,NULL),(29,28,4,NULL),(30,29,4,NULL),(31,30,4,NULL),(32,31,4,NULL),(33,32,4,NULL),(34,33,5,NULL),(35,34,5,NULL),(36,35,5,NULL),(37,36,5,NULL),(38,37,7,NULL),(39,38,7,NULL),(40,39,7,NULL),(41,40,13,NULL),(42,41,13,NULL);
/*!40000 ALTER TABLE `products_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendations`
--

DROP TABLE IF EXISTS `recommendations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `recommended_product_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recommendations_products_1` (`product_id`),
  KEY `fk_recommendations_products_2` (`product_id`),
  CONSTRAINT `fk_recommendations_products_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recommendations_products_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendations`
--

LOCK TABLES `recommendations` WRITE;
/*!40000 ALTER TABLE `recommendations` DISABLE KEYS */;
/*!40000 ALTER TABLE `recommendations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(3,'provider'),(2,'user');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_cart_items`
--

DROP TABLE IF EXISTS `shop_cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_cart_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_cart_id` int(11) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `is_gift` tinyint(1) NOT NULL DEFAULT '0',
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shop_cart_items_shop_carts_INDEX` (`shop_cart_id`),
  CONSTRAINT `fk_shop_cart_items_shop_carts` FOREIGN KEY (`shop_cart_id`) REFERENCES `shop_carts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_cart_items`
--

LOCK TABLES `shop_cart_items` WRITE;
/*!40000 ALTER TABLE `shop_cart_items` DISABLE KEYS */;
INSERT INTO `shop_cart_items` VALUES (4,18,'Product',13,2,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 15:58:21','2011-12-15 15:58:21'),(5,18,'Product',16,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 15:59:09','2011-12-15 15:59:09'),(6,18,'Product',15,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 16:00:17','2011-12-15 16:00:17'),(7,17,'Product',13,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 16:03:17','2011-12-15 16:03:17'),(8,17,'Product',15,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 16:03:26','2011-12-15 16:03:26');
/*!40000 ALTER TABLE `shop_cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_carts`
--

DROP TABLE IF EXISTS `shop_carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `identifier` varchar(32) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subtotal` varchar(100) DEFAULT NULL,
  `descuento` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier_UNIQUE` (`identifier`),
  KEY `fk_shop_carts_users_INDEX` (`user_id`),
  CONSTRAINT `fk_shop_carts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_carts`
--

LOCK TABLES `shop_carts` WRITE;
/*!40000 ALTER TABLE `shop_carts` DISABLE KEYS */;
INSERT INTO `shop_carts` VALUES (16,NULL,'1323974035.889',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 13:33:55','2011-12-15 13:33:55'),(17,NULL,'1323982365.5054',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 15:52:45','2011-12-15 15:52:45'),(18,NULL,'1323982681.8293',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-12-15 15:58:01','2011-12-15 15:58:01');
/*!40000 ALTER TABLE `shop_carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slots`
--

DROP TABLE IF EXISTS `slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slots`
--

LOCK TABLES `slots` WRITE;
/*!40000 ALTER TABLE `slots` DISABLE KEYS */;
INSERT INTO `slots` VALUES (1,'PCI',NULL),(2,'PCIe 1.0',NULL),(3,'PCIe 2.0',NULL),(4,'PCIe 3.0',NULL),(5,'SATA 1.0',NULL),(6,'SATA 2.0',NULL),(7,'SATA 3.0',NULL),(8,'USB 1/1.1',NULL),(9,'USB 2.0',NULL),(10,'USB 3.0',NULL),(11,'IDE',NULL),(12,'Firewire',NULL),(13,'DDR1',NULL),(14,'DDR2',NULL),(15,'DDR3',NULL),(16,'DDR5',NULL);
/*!40000 ALTER TABLE `slots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sockets`
--

DROP TABLE IF EXISTS `sockets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sockets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `architecture_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sockets_architectures_INDEX` (`architecture_id`),
  CONSTRAINT `fk_sockets_architectures` FOREIGN KEY (`architecture_id`) REFERENCES `architectures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sockets`
--

LOCK TABLES `sockets` WRITE;
/*!40000 ALTER TABLE `sockets` DISABLE KEYS */;
INSERT INTO `sockets` VALUES (1,1,'AM2',NULL),(2,1,'AM3',NULL),(3,1,'AM3+',NULL),(4,2,'LGA 2011 / Socket R',NULL),(5,2,'LGA 1155 / Socket H2',NULL),(6,2,'LGA 1567',NULL);
/*!40000 ALTER TABLE `sockets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_sliders`
--

DROP TABLE IF EXISTS `tag_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `wysiwyg_content` text,
  `sort` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tag_sliders_tags_INDEX` (`tag_id`),
  CONSTRAINT `fk_tag_sliders_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_sliders`
--

LOCK TABLES `tag_sliders` WRITE;
/*!40000 ALTER TABLE `tag_sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `in_gamers` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  `sort_in_gamers` int(11) DEFAULT NULL,
  `description` text,
  `slug` varchar(100) NOT NULL,
  `keywords` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Procesadores',0,NULL,NULL,NULL,'procesadores',NULL,NULL,NULL),(2,'Tarjetas Madre',0,NULL,NULL,NULL,'tarjetas-madre',NULL,NULL,NULL),(3,'Memorias',0,NULL,NULL,NULL,'memorias',NULL,NULL,NULL),(4,'Discos Duros',0,NULL,NULL,NULL,'discos-duros',NULL,NULL,NULL),(5,'Tarjetas De Video',0,NULL,NULL,NULL,'tarjetas-de-video',NULL,NULL,NULL),(6,'Tarjetas De Sonido',0,NULL,NULL,NULL,'tarjetas-de-sonido',NULL,NULL,NULL),(7,'Torres',0,NULL,NULL,NULL,'torres',NULL,NULL,NULL),(8,'Impresoras',0,NULL,NULL,NULL,'impresoras',NULL,NULL,NULL),(9,'Monitores',0,NULL,NULL,NULL,'monitores',NULL,NULL,NULL),(10,'Otras Tarjetas',0,NULL,NULL,NULL,'otras-tarjetas',NULL,NULL,NULL),(11,'Accesorios',0,NULL,NULL,NULL,'accesorios',NULL,NULL,NULL),(12,'Dispositivos USB',0,NULL,NULL,NULL,'dispositivos-usb',NULL,NULL,NULL),(13,'Fuente',0,NULL,NULL,NULL,'fuente',NULL,NULL,NULL),(14,'Unidades Opticas',0,NULL,NULL,NULL,'unidades-opticas',NULL,NULL,NULL),(15,'Otro',0,NULL,NULL,NULL,'otro',NULL,NULL,NULL),(16,'Computadores de Escritorio',0,NULL,NULL,NULL,'computadores-de-escritorio',NULL,NULL,NULL),(17,'Computadores Portatiles',0,NULL,NULL,NULL,'computadores-portatiles',NULL,NULL,NULL),(18,'Cables',0,NULL,NULL,NULL,'cables',NULL,NULL,NULL),(19,'Camaras Web y Digitales',0,NULL,NULL,NULL,'camaras-web-y-digitales',NULL,NULL,NULL),(20,'Software',0,NULL,NULL,NULL,'software',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `email` varchar(100) NOT NULL,
  `password` char(40) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_roles_INDEX` (`role_id`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'admin@bloomweb.co','3d66fec9c10dbc7be728b94116fdbad76c134090',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(2,3,'ricardopandales@gmail.com','b92e5e088048b068100a08ba77403ef54cb340cc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'900164990',1,'2011-11-06 12:43:48','2011-11-06 12:43:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visited_products`
--

DROP TABLE IF EXISTS `visited_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visited_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visited_products_users_INDEX` (`user_id`),
  KEY `fk_visited_products_products_INDEX` (`product_id`),
  CONSTRAINT `fk_visited_products_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_visited_products_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visited_products`
--

LOCK TABLES `visited_products` WRITE;
/*!40000 ALTER TABLE `visited_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `visited_products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-12-19 10:29:20
