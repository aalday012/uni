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
	$galderak = mysql_query( "select Zenbakia, Galdera, Erantzuna, Zailtasuna from Galderak WHERE Egilea = '$_SESSION[email]'" );
}

echo '<table border=1><tr><th> Zenbakia </th><th> Galdera </th><th> Erantzuna </th><th> Zailtasuna </th></tr>';

while ($row = mysql_fetch_array( $galderak ) ) {
echo '<tr><td>'.$row['Zenbakia'].'</td><td>'.$row['Galdera'].'</td><td>'.$row['Erantzuna'].'</td><td>'.$row['Zailtasuna'].'</td></tr>';
}
echo '</table>';

mysql_close();
?>