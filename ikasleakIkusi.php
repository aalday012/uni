<?php
session_start();
if(isset($_POST['logout'])){
  session_destroy();
  header("Location: login.php");
}

if(!empty($_SESSION['email']))
{
	mysql_connect("localhost", "root","")or die(mysql_error());
	mysql_select_db("Quiz") or die(mysql_error());
	$ikasleak = mysql_query( "select Izena, Abizenak from Erabiltzaile" );
}

echo '<table border=1><tr><th> Izena </th><th> Abizenak </th></tr>';

while ($row = mysql_fetch_array( $ikasleak ) ) {
echo '<tr><td>'.$row['Izena'].'</td><td>'.$row['Abizenak'].'</td></tr>';
}
echo '</table>';

mysql_close();
?>