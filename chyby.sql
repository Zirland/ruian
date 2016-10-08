DROP TABLE IF EXISTS `duplicate_ul1`;
DROP TABLE IF EXISTS `duplicate_obj1`;
DROP TABLE IF EXISTS `obce1`;

CREATE TABLE duplicate_ul1 SELECT * FROM (SELECT kod_obce, nazev_obce, nazev_ulice, cislo_orientacni,znak_cisla_orientacniho,COUNT(*) AS pocet FROM ruian WHERE (cislo_orientacni > 0) GROUP BY kod_obce,nazev_ulice,cislo_orientacni,znak_cisla_orientacniho) AS adresy WHERE (pocet > 1);

CREATE TABLE duplicate_obj1 SELECT * FROM (SELECT kod_obce, nazev_obce, kod_casti_obce, nazev_casti_obce, typ_so, cislo_domovni, COUNT(*) AS pocet FROM ruian GROUP BY kod_casti_obce, typ_so, cislo_domovni) AS adresy WHERE (pocet > 1);

ALTER TABLE duplicate_obj1 ADD void BOOLEAN;
ALTER TABLE duplicate_ul1 ADD void BOOLEAN;

CREATE TABLE obce1 SELECT kod_obce, nazev_obce FROM duplicate_obj WHERE ((void IS NULL) OR (void=0)) GROUP BY kod_obce;

INSERT INTO obce1 SELECT kod_obce, nazev_obce FROM duplicate_ul WHERE ((void IS NULL) OR (void=0)) GROUP BY kod_obce;                                   


