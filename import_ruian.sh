#!/bin/bash

NAME="20161031_OB_ADR_csv.zip"
CESTA_K_CSV="./CSV"  ## cesta, kde jsi rozbalil archiv (cesta až k souborům)

######################
USER="ruian"                  ## uživatel do DB
PASSWORD="ruian"        ## heslo do DB
DB="ruian"                  ## databáze
TABLE="ruian"  ## tabulka v DB, kam se budou importovat data
######################

echo "Stahuji seznam adres..."
wget "http://vdp.cuzk.cz/vymenny_format/csv/$NAME"
unzip ${NAME}
rm ${NAME}

echo "Inicializace databáze..."
mysql -u ${USER} -p${PASSWORD} ${DB} < schema.sql

echo "Příprava importu..."
cd ${CESTA_K_CSV}
cat * > cp1250.csv
iconv -f cp1250 -t utf-8 < cp1250.csv > utf-8.csv
grep -v '^Kód ADM' utf-8.csv > ruian

# import
echo "Importuji soubory do databáze"

mysqlimport --fields-terminated-by=\; --columns='kod_adm,kod_obce,nazev_obce,nazev_momc,nazev_mop,kod_casti_obce,nazev_casti_obce,nazev_ulice,typ_so,cislo_domovni,cislo_orientacni,znak_cisla_orientacniho,psc,souradnice_y,souradnice_x,plati_od' --local -u ${USER} -p${PASSWORD} ${DB} ruian

echo "... hotovo."

cd ..

echo "Zjišťuji chyby..."
mysql -u ${USER} -p${PASSWORD} ${DB} < chyby.sql

curl http://andreas.zirland.org/ruian/migrace.php

mysql -u ${USER} -p${PASSWORD} ${DB} < uklid.sql

echo "... hotovo."

exit;
