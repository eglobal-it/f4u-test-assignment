/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `client` (
  `client_uuid` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`client_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`client_uuid`, `firstname`, `lastname`) VALUES
	('a517b2d7-0b7e-4964-b94e-83e05700543f', 'test', 'testov');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `shipping_address` (
  `shipping_address_uuid` varchar(50) NOT NULL,
  `client_uuid` varchar(50) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `address_zipcode` varchar(255) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(255) NOT NULL,
  `address_country` varchar(255) NOT NULL,
  PRIMARY KEY (`shipping_address_uuid`),
  KEY `FK_shipping_address_client` (`client_uuid`),
  CONSTRAINT `FK_shipping_address_client` FOREIGN KEY (`client_uuid`) REFERENCES `client` (`client_uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `shipping_address` DISABLE KEYS */;
INSERT INTO `shipping_address` (`shipping_address_uuid`, `client_uuid`, `is_default`, `address_zipcode`, `address_street`, `address_city`, `address_country`) VALUES
	('05b68ba3-cc19-4ed5-9fee-05260f91b19a', 'a517b2d7-0b7e-4964-b94e-83e05700543f', 0, 'LV-1029', 'Visvalzha2', 'Riga', 'LV'),
	('88419f47-206e-4441-8766-01a4f5bdc1dd', 'a517b2d7-0b7e-4964-b94e-83e05700543f', 1, 'LV-1029', 'Visvalzha', 'Riga', 'LV');
/*!40000 ALTER TABLE `shipping_address` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
