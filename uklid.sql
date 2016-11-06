DROP TABLE IF EXISTS `duplicate_ul`;
DROP TABLE IF EXISTS `duplicate_obj`;
DROP TABLE IF EXISTS `obce`;
DROP TABLE IF EXISTS `obce_rekl`;

RENAME TABLE duplicate_ul1 TO duplicate_ul;
RENAME TABLE duplicate_obj1 TO duplicate_obj;

CREATE TABLE obce SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_obj WHERE (stav='0') GROUP BY kod_obce;
INSERT INTO obce SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_ul WHERE (stav='0') GROUP BY kod_obce;

CREATE TABLE obce_rekl SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_obj WHERE (stav='1') GROUP BY kod_obce;
INSERT INTO obce_rekl SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_ul WHERE (stav='1') GROUP BY kod_obce;
