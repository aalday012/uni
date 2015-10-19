<?php
$izena=$_POST['izena'];
$abizenak=$_POST['abizenak'];
if(empty($izena)){
  echo "Beharrezkoak (*) bete";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }
if(empty($abizenak)){
  echo "Beharrezkoak (*) bete";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }
$pass=$_POST['pass'];
if(strlen($pass)<6){
  echo "Pasahitz desegokia";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }
$expr='/^[a-z]+\d{3}@ikasle\.ehu\.(eus|es)$/';
$email=$_POST['email'];
if(!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
  echo "Email desegokia";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }
$expr='/^\d{9}$/';
$telf=$_POST['telf'];
if(!filter_var($telf, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
  echo "Telefono desegokia";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }
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