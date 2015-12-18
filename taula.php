<?php
mysql_connect("localhost", "root","")or die(mysql_error());
mysql_select_db("Quiz") or die(mysql_error());

$erabiltzaileak = mysql_query( "select * from Erabiltzaile" );
echo '<table border=1><tr><th> Izena </th><th> Abizenak </th><th> Email </th><th> Telefonoa </th><th> Pasahitza </th><th> Espezialitatea </th><th> Argazkia </th></tr>';

while ($row = mysql_fetch_array( $erabiltzaileak ) ) {
$argazki= mysql_escape_string($row['Argazkia']);
echo '<tr><td>'.$row['Izena'].'</td><td>'.$row['Abizenak'].'</td><td>'.$row['Email'].'</td><td>'.$row['Telefonoa'].'</td><td>'.$row['Pasahitza'].'</td><td>'.$row['Espezialitatea'].'</td><td><img src=" '.$argazki.'"></td></tr>';
}

echo '</table>';
echo "<p> <a href='layout.html'> Home </a>";
?>