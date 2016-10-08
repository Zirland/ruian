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
?>
<form method="get" action="index.php">
<input name="action" type="hidden" value="obec"> 
<select name="obec">
<?php
$query0 = "SELECT * FROM obce GROUP BY kod_obce;";
if ($result0 = mysqli_query($link, $query0)) {

    while ($row0 = mysqli_fetch_row($result0)) {
                $kod = $row0[0];
                $nazev = $row0[1];
 
                echo "<option value=\"$kod\">$nazev</option>";
}
               
  mysqli_free_result($result0);
} else echo("Error description: " . mysqli_error($link));
?>
</select>
<input type="submit">
</form>

<hr>

<?php
if ($action == "obec") {
?>
<table border="1" cellpadding="4">
<tr><th>Název obce</th><th>Název části obce</th><th>Typ čísla</th><th>Číslo domovní</th><th>Počet</th></tr>

<?php

$query1="SELECT * FROM duplicate_obj WHERE (kod_obce = $obec);";

if ($result1 = mysqli_query($link, $query1)) {

    while ($row1 = mysqli_fetch_row($result1)) {
                $obec_kod = $row1[0];
                $nazev = $row1[1];
                $cast_kod = $row1[2];
                $cast = $row1[3];
                $typ = $row1[4];
                $cislo = $row1[5];
                $pocet = $row1[6];
                $void = $row1[7];
 
                echo "<tr bgcolor=\"";
                switch ($void)
                {
                   case 1: echo "yellow"; break;
                   case 2: echo "green"; break;
                }
                echo "\"><td>$nazev</td><td>$cast</td><td>$typ</td><td>$cislo</td><td>$pocet</td>
<td><a href=\"ruian.php?action=reklamace&obec=$obec_kod&cast=$cast_kod&cislo=$cislo\">Reklamace</a></td>
<td><a href=\"ruian.php?action=nofix&obec=$obec_kod&cast=$cast_kod&cislo=$cislo\">NoFix</a></td></tr>";
}
               
  mysqli_free_result($result1);
} else echo("Error description: " . mysqli_error($link));


$query2="SELECT * FROM duplicate_ul WHERE (kod_obce = $obec);";

if ($result2 = mysqli_query($link, $query2)) {

    while ($row2 = mysqli_fetch_row($result2)) {
                $obec_kod = $row2[0];
                $nazev = $row2[1];
                $ulice = $row2[2];
                $cislo = $row2[3];
                $pismeno = $row2[4];
                $pocet = $row2[5];
                $void = $row2[6];
 
                echo "<tr><td>$nazev</td><td>$ulice</td><td>$cislo</td><td>$znak</td><td>$pocet</td>
<td><a href=\"ruian.php?action=reklamace&obec=$obec_kod&ulice=$ulice&cislo=$cislo&pismeno=$pismeno\">Reklamace</a></td>
<td><a href=\"ruian.php?action=nofix&obec=$obec_kod&ulice=$ulice&cislo=$cislo&pismeno=$pismeno\">NoFix</a></td></tr>";
}
               
  mysqli_free_result($result2);
} else echo("Error description: " . mysqli_error($link));

}
/*


$action = $_POST["action"];
$i = 0;
$now = time();
$frmtime = date('Y-m-d H:i:s');

$query0 = "UPDATE blacklist SET void='1' WHERE (timeend < '$frmtime');";
$result0 = mysqli_query($link, $query0);

?>
<form method="post" action="index.php">
<input name="action" type="hidden" value="add"> 
<input name="cislo" type="text" maxlength="20" value="" autofocus> 
<input name="datum" type="text" maxlength="2" size="3" value=""> 
<input name="hodiny" type="text" maxlength="2" size="3" value=""> 
<input name="minuty" type="text" maxlength="2" size="3" value=""> 
<input name="doba" type="text" maxlength="1" size="2" value=""> 
<input name="kraj" type="text" maxlength="3" size="4" value=""> 

<input type="submit" name="submit" value="Vložit">
</form>

<? if ($action == "add") {

$add_cislo = $_POST["cislo"];
$den = $_POST["datum"];
$mesic = "09";
$rok = "2016";
$hodiny = $_POST["hodiny"];
$minuty = $_POST["minuty"];
$add_doba = $_POST["doba"];
$add_kraj = $_POST["kraj"];

$pom = $rok."-".$mesic."-".$den." ".$hodiny.":".$minuty.":00";
$datum_start = strtotime($pom);

$datum_konec = $datum_start+($add_doba*24*3600);

$add_start = date("Y-m-d H:i:s", $datum_start);
$add_end = date("Y-m-d H:i:s", $datum_konec);

$query1 = "INSERT INTO blacklist (cislo, timestart, trvani, timeend, kraj, void) VALUES ('$add_cislo','$add_start','$add_doba','$add_end','$add_kraj','0');";

$result1 = mysqli_query($link, $query1);
if (!$result1) {echo("Error description: " . mysqli_error($link));};

}
?>

*/
mysqli_close ($link);
?>
</table>
</body>
</html>
