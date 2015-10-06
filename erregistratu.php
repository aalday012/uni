<?php
mysql_connect("localhost", "root","")or die(mysql_error());
mysql_select_db("Quiz") or die(mysql_error());

$sql="INSERT INTO Erabiltzaile(Izena, Abizenak, Email, Telefonoa, Pasahitza, Espezialitatea) VALUES
  ('$_POST[izena]','$_POST[abizenak]','$_POST[email]','$_POST[telf]','$_POST[pass]','$_POST[Espezialitatea]')";

if (!mysql_query($sql))
{

  die('Errorea:' . mysql_error());
}

echo "1 record added";
mysql_close();
echo "<p> <a href='taula.php'> Erregistroak ikusi </a>";
?>