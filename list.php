<?php
echo "<table border=\"1\" cellpadding=\"4\">";
echo "<tr><th>Název obce</th><th>Název části obce</th><th>Typ čísla</th><th>Číslo domovní</th><th>Počet</th></tr>";

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
                $stav = $row1[7];
                $id = $row1[8];
 
                echo "<tr bgcolor=\"";
                switch ($stav)
                {
                   case 1: echo "yellow"; break;
                   case 2: echo "green"; break;
                }
                echo "\"><td>$nazev</td><td>$cast</td><td>$typ</td><td>$cislo</td><td>$pocet</td>";
switch ($stav)
{
  case 0: echo "<td><a href=\"index.php?action=reklobj&obec=$obec_kod&id=$id\">Reklamace</a></td><td><a href=\"index.php?action=nofixobj&obec=$obec_kod&id=$id\">NoFix</a></td></tr>"; break;
  case 1: echo "<td><a href=\"index.php?action=delobj&obec=$obec_kod&id=$id\">Opraveno</a></td><td><a href=\"index.php?action=nofixobj&obec=$obec_kod&id=$id\">NoFix</a></td></tr>"; break;
}
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
                $stav = $row2[6];
                $id = $row2[7];
 
                echo "<tr bgcolor=\"";
                switch ($stav)
                {
                   case 1: echo "yellow"; break;
                   case 2: echo "green"; break;
                }
                echo "\"><td>$nazev</td><td>$ulice</td><td>$cislo</td><td>$pismeno</td><td>$pocet</td>";
switch ($stav)
{
  case 0: echo "<td><a href=\"index.php?action=reklul&obec=$obec_kod&id=$id\">Reklamace</a></td><td><a href=\"index.php?action=nofixul&obec=$obec_kod&id=$id\">NoFix</a></td></tr>"; break;
  case 1: echo "<td><a href=\"index.php?action=delul&obec=$obec_kod&id=$id\">Opraveno</a></td><td><a href=\"index.php?action=nofixul&obec=$obec_kod&id=$id\">NoFix</a></td></tr>"; break;
}
}
               
  mysqli_free_result($result2);
} else echo("Error description: " . mysqli_error($link));
?>