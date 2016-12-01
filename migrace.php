<?php
$link = mysqli_connect('localhost', 'ruian', 'ruian', 'ruian');
if (!$link) {
    echo "Error: Unable to connect to MySQL.<br />";
    echo "Debug: " . mysqli_connect_errno() . " " . mysqli_connect_error() . "<br />";
    exit;

mysqli_set_charset($link, "utf8");
}

$query0 = "SELECT * FROM duplicate_obj WHERE (stav='1');";
if ($result0 = mysqli_query($link, $query0)) {

    while ($row0 = mysqli_fetch_row($result0)) {
                $kod_casti = $row0[2];
                $typ = $row0[4];
                $cislo = $row0[5];
 
		mysqli_query($link, "UPDATE duplicate_obj1 SET stav='1' WHERE ((kod_casti_obce='$kod_casti') AND (typ_so='$typ') AND (cislo_domovni='$cislo'));");

}
               
  mysqli_free_result($result0);
} else echo("Error description: " . mysqli_error($link));

$query1 = "SELECT * FROM duplicate_obj WHERE (stav='2');";
if ($result1 = mysqli_query($link, $query1)) {

    while ($row1 = mysqli_fetch_row($result1)) {
                $kod_casti = $row1[2];
                $typ = $row1[4];
                $cislo = $row1[5];
 
		mysqli_query($link, "UPDATE duplicate_obj1 SET stav='2' WHERE ((kod_casti_obce='$kod_casti') AND (typ_so='$typ') AND (cislo_domovni='$cislo'));");

}
               
  mysqli_free_result($result1);
} else echo("Error description: " . mysqli_error($link));

$query2 = "SELECT * FROM duplicate_ul WHERE (stav='1');";
if ($result2 = mysqli_query($link, $query2)) {

    while ($row2 = mysqli_fetch_row($result2)) {
                $kod_obce = $row2[0];
		$nazev_ulice = $row2[2];
                $cislo = $row2[3];
                $znak = $row2[4];
 
		mysqli_query($link, "UPDATE duplicate_ul1 SET stav='1' WHERE ((kod_obce='$kod_obce') AND (nazev_ulice='$nazev_ulice') AND (cislo_orientacni='$cislo') AND (znak_cisla_orientacniho='$znak'));");
}
               
  mysqli_free_result($result2);
} else echo("Error description: " . mysqli_error($link));

$query3 = "SELECT * FROM duplicate_ul WHERE (stav='2');";
if ($result3 = mysqli_query($link, $query3)) {

    while ($row3 = mysqli_fetch_row($result3)) {
		$kod_obce = $row3[0];                
		$nazev_ulice = $row3[2];
                $cislo = $row3[3];
                $znak = $row3[4];
 
		mysqli_query($link, "UPDATE duplicate_ul1 SET stav='2' WHERE ((kod_obce='$kod_obce') AND (nazev_ulice='$nazev_ulice') AND (cislo_orientacni='$cislo') AND (znak_cisla_orientacniho='$znak'));");
}
               
  mysqli_free_result($result3);
} else echo("Error description: " . mysqli_error($link));

mysqli_close ($link);
?>
