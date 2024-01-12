CREATE DATABASE  IF NOT EXISTS `mi_portafolio`;
USE `mi_portafolio`;
DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` longtext NOT NULL,
  `fechaProyecto` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
LOCK TABLES `proyectos` WRITE;
UNLOCK TABLES;