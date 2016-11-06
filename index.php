<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta content="text/html; charset=utf-8" http-equiv="content-type">
  <title>RÚIAN</title>
</head>
<body>
<?php
$link = mysqli_connect('localhost', 'ruian', 'ruian', 'ruian');
if (!$link) {
    echo "Error: Unable to connect to MySQL.<br />";
    echo "Debug: " . mysqli_connect_errno() . " " . mysqli_connect_error() . "<br />";
    exit;

mysqli_set_charset($link, "utf8");
}

$action = $_GET["action"];
$obec = $_GET["obec"];
$id = $_GET["id"];
?>
<form method="get" action="index.php">
<input name="action" type="hidden" value="obec"> 
<select name="obec">
<?php
$query0 = "SELECT * FROM obce GROUP BY kod_obce ORDER BY nazev_obce;";
if ($result0 = mysqli_query($link, $query0)) {

	while ($row0 = mysqli_fetch_row($result0)) {
                $kod = $row0[0];
                $nazev = $row0[1];
                $pripadu = $row0[2];

		$query00 = "SELECT * FROM ruian_obce WHERE lau2='$kod';";
		if ($result00 = mysqli_query($link, $query00)) {

		    while ($row00 = mysqli_fetch_row($result00)) {
                	$lau1 = $row00[1];

	                echo "<option value=\"$kod\"";
        	        if ($kod == $obec) {echo " SELECTED";}
	                echo ">$nazev $lau1 ($pripadu)</option>";
    		    }
		    mysqli_free_result($result00);
		} else echo("Error description: " . mysqli_error($link));
	}
	mysqli_free_result($result0);
} else echo("Error description: " . mysqli_error($link));
?>
</select>
<input type="submit">
<a href="index.php?action=rebuild">Vyčistit</a>
</form>

<form method="get" action="index.php">
<input name="action" type="hidden" value="obec"> 
<select name="obec">
<?php
$query1 = "SELECT * FROM obce_rekl GROUP BY kod_obce ORDER BY nazev_obce;";
if ($result1 = mysqli_query($link, $query1)) {

	while ($row1 = mysqli_fetch_row($result1)) {
                $kod = $row1[0];
                $nazev = $row1[1];
                $pripadu = $row1[2];

		$query10 = "SELECT * FROM ruian_obce WHERE lau2='$kod';";
		if ($result10 = mysqli_query($link, $query10)) {

			while ($row10 = mysqli_fetch_row($result10)) {
                		$lau1 = $row10[1];
 
                		echo "<option value=\"$kod\"";
				if ($kod == $obec) {echo " SELECTED";}
				echo ">$nazev $lau1 ($pripadu)</option>";
			}
			mysqli_free_result($result10);
		} else echo("Error description: " . mysqli_error($link));		
	}
              
	mysqli_free_result($result1);
} else echo("Error description: " . mysqli_error($link));
?>
</select>
<input type="submit">
</form>

<hr>

<?php

switch ($action) {
  case "obec" :
    include 'list.php';
    break;

  case "reklobj" :
    mysqli_query($link, "UPDATE duplicate_obj SET stav=1 WHERE (id='$id');");
    include 'list.php';
    break; 

  case "nofixobj" :
    mysqli_query($link, "UPDATE duplicate_obj SET stav=2 WHERE (id='$id');");
    include 'list.php';
    break; 

  case "reklul" :
    mysqli_query($link, "UPDATE duplicate_ul SET stav=1 WHERE (id='$id');");
    require 'list.php';
    break; 

  case "nofixul" :
    mysqli_query($link, "UPDATE duplicate_ul SET stav=1 WHERE (id='$id');");
    require 'list.php';
    break; 

  case "delobj" :
    mysqli_query($link, "DELETE FROM duplicate_obj WHERE (id='$id');");
    require 'list.php';
    break; 

  case "delul" :
    mysqli_query($link, "DELETE FROM duplicate_ul WHERE (id='$id');");
    require 'list.php';
    break; 

  case "rebuild" :
    mysqli_query($link, "DROP TABLE obce;");
    mysqli_query($link, "CREATE TABLE obce SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_obj WHERE (stav='0') GROUP BY kod_obce;");
    mysqli_query($link, "INSERT INTO obce SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_ul WHERE (stav='0') GROUP BY kod_obce;");
    mysqli_query($link, "DROP TABLE obce_rekl;");
    mysqli_query($link, "CREATE TABLE obce_rekl SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_obj WHERE (stav='1') GROUP BY kod_obce;");
    mysqli_query($link, "INSERT INTO obce_rekl SELECT kod_obce, nazev_obce, count(*) AS pocet FROM duplicate_ul WHERE (stav='1') GROUP BY kod_obce;");
    break; 
}


mysqli_close ($link);
?>
</table>
</body>
</html>
