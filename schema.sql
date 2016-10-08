SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ruian`;

CREATE TABLE `ruian` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`kod_adm` INT(11),
`kod_obce` INT(11),
`nazev_obce` VARCHAR(255),
`nazev_momc` VARCHAR(255),
`nazev_mop` VARCHAR(255),
`kod_casti_obce` INT(11),
`nazev_casti_obce` VARCHAR(255),
`nazev_ulice` VARCHAR(255),
`typ_so` VARCHAR(255),
`cislo_domovni` INT(11),
`cislo_orientacni` INT(11),
`znak_cisla_orientacniho` VARCHAR(255),
`psc` INT(11),
`souradnice_y` VARCHAR(255),
`souradnice_x` VARCHAR(255),
`plati_od` VARCHAR(255),
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
