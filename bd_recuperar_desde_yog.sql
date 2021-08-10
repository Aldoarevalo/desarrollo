/*
SQLyog Community v8.71 
MySQL - 5.0.13-rc-nt : Database - dfactory_utic
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`dfactory_utic` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dfactory_utic`;

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `cli_codigo` int(11) NOT NULL auto_increment,
  `cli_ci` int(11) default NULL,
  `cli_nombre` varchar(30) default NULL,
  `cli_apellido` varchar(30) default NULL,
  `cli_ruc` varchar(30) default NULL,
  `cli_telefono` varchar(30) default NULL,
  PRIMARY KEY  (`cli_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cliente` */

LOCK TABLES `cliente` WRITE;

insert  into `cliente`(`cli_codigo`,`cli_ci`,`cli_nombre`,`cli_apellido`,`cli_ruc`,`cli_telefono`) values (1,111,'Carlos','Gimenez','111-6','0984521789'),(2,5221409,'Abner','CÃƒÂ¡ceres','1234556','098645754');

UNLOCK TABLES;

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `emp_codigo` int(11) NOT NULL auto_increment,
  `emp_ci` int(11) default NULL,
  `emp_nombre` varchar(30) default NULL,
  `emp_apellido` varchar(30) default NULL,
  `emp_salario` int(11) default NULL,
  `emp_telefono` varchar(30) default NULL,
  `emp_usuario` varchar(30) default NULL,
  `emp_clave` varchar(30) default NULL,
  PRIMARY KEY  (`emp_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `empleado` */

LOCK TABLES `empleado` WRITE;

insert  into `empleado`(`emp_codigo`,`emp_ci`,`emp_nombre`,`emp_apellido`,`emp_salario`,`emp_telefono`,`emp_usuario`,`emp_clave`) values (1,12345,'Juan','Perez',1000000,'0984123456','admin','123'),(2,4981582,'Lucas','Riquelme',8000000,'984123456','lucas','123');

UNLOCK TABLES;

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `mar_codigo` int(11) NOT NULL auto_increment,
  `mar_descripcion` varchar(30) NOT NULL,
  PRIMARY KEY  (`mar_codigo`),
  UNIQUE KEY `mar_descripcion` (`mar_descripcion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `marca` */

LOCK TABLES `marca` WRITE;

insert  into `marca`(`mar_codigo`,`mar_descripcion`) values (1,'Intel'),(2,'AMD'),(3,'nVidia'),(4,'AOC'),(5,'Acer');

UNLOCK TABLES;

/*Table structure for table `presupuesto` */

DROP TABLE IF EXISTS `presupuesto`;

CREATE TABLE `presupuesto` (
  `pre_codigo` int(11) NOT NULL auto_increment,
  `pre_fecha` date default NULL,
  `emp_usuario` varchar(30) default NULL,
  `cli_codigo` int(11) default NULL,
  `pre_activo` int(1) NOT NULL,
  PRIMARY KEY  (`pre_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto` */

LOCK TABLES `presupuesto` WRITE;

insert  into `presupuesto`(`pre_codigo`,`pre_fecha`,`emp_usuario`,`cli_codigo`,`pre_activo`) values (1,'2019-08-11','1',1,1),(2,'2019-08-11','1',1,0),(3,'2019-08-16','2',2,0);

UNLOCK TABLES;

/*Table structure for table `presupuesto_detalle` */

DROP TABLE IF EXISTS `presupuesto_detalle`;

CREATE TABLE `presupuesto_detalle` (
  `pdet_codigo` int(11) NOT NULL auto_increment,
  `pre_codigo` int(11) default NULL,
  `pro_codigo` int(11) default NULL,
  `pdet_cantidad` int(11) default NULL,
  `pdet_precio` int(11) default NULL,
  `pdet_subtotal` int(11) default NULL,
  PRIMARY KEY  (`pdet_codigo`),
  UNIQUE KEY `pre_codigo` (`pre_codigo`,`pro_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto_detalle` */

LOCK TABLES `presupuesto_detalle` WRITE;

insert  into `presupuesto_detalle`(`pdet_codigo`,`pre_codigo`,`pro_codigo`,`pdet_cantidad`,`pdet_precio`,`pdet_subtotal`) values (1,1,1,2,5000,10000),(2,1,2,5,7000,35000),(3,1,3,3,6000,18000),(4,2,1,2,5000,10000),(5,2,2,3,7000,21000),(7,3,1,2,5000,10000),(8,3,2,5,7000,35000);

UNLOCK TABLES;

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `pro_codigo` int(11) NOT NULL auto_increment,
  `pro_descripcion` varchar(30) default NULL,
  `mar_codigo` int(11) default NULL,
  `pro_costo` int(11) default NULL,
  `pro_precio` int(11) default NULL,
  PRIMARY KEY  (`pro_codigo`),
  KEY `marca` (`mar_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

LOCK TABLES `producto` WRITE;

insert  into `producto`(`pro_codigo`,`pro_descripcion`,`mar_codigo`,`pro_costo`,`pro_precio`) values (1,'Disco Duro 1TB Sata2',1,3000,5000),(2,'Memoria 32Gb',2,5000,7000),(3,'SSD 480GB',3,4000,6000),(4,'CoolerMaster',4,3000,4000),(5,'CajaKit',5,2000,2500),(6,'notebook',1,130000,1500000);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
