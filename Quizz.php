<?php
mysql_connect("localhost", "root","")or die(mysql_error());
mysql_select_db("Quiz") or die(mysql_error());

$galderak = mysql_query( "select Zenbakia, Galdera, Zailtasuna from Galderak" );
echo '<table border=1><tr><th> Zenbakia </th><th> Galdera </th><th> Zailtasuna </th></tr>';

while ($row = mysql_fetch_array( $galderak ) ) {
echo '<tr><td>'.$row['Zenbakia'].'</td><td>'.$row['Galdera'].'</td><td>'.$row['Zailtasuna'].'</td></tr>';
}

echo '</table>';
echo "<p> <a href='layout.html'> Home </a>";
?>