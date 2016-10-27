DROP TABLE IF EXISTS `duplicate_ul1`;
DROP TABLE IF EXISTS `duplicate_obj1`;
DROP TABLE IF EXISTS `obce1`;

CREATE TABLE duplicate_ul1 SELECT * FROM (SELECT kod_obce, nazev_obce, nazev_ulice, cislo_orientacni,znak_cisla_orientacniho,COUNT(*) AS pocet FROM ruian WHERE (cislo_orientacni > 0) GROUP BY kod_obce,nazev_ulice,cislo_orientacni,znak_cisla_orientacniho) AS adresy WHERE (pocet > 1);

CREATE TABLE duplicate_obj1 SELECT * FROM (SELECT kod_obce, nazev_obce, kod_casti_obce, nazev_casti_obce, typ_so, cislo_domovni, COUNT(*) AS pocet FROM ruian GROUP BY kod_casti_obce, typ_so, cislo_domovni) AS adresy WHERE (pocet > 1);

ALTER TABLE duplicate_obj1 ADD stav TINYINT NOT NULL, ADD id INT unsigned NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id);
ALTER TABLE duplicate_ul1 ADD stav TINYINT NOT NULL, ADD id INT unsigned NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (id);

CREATE TABLE obce1 SELECT kod_obce, nazev_obce, count(*) FROM duplicate_obj WHERE ((stav='0') OR (stav='1')) GROUP BY kod_obce; 
INSERT INTO obce1 SELECT kod_obce, nazev_obce, count(*) FROM duplicate_ul WHERE ((stav='0') OR (stav = '1')) GROUP BY kod_obce;

