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
$pass2=$_POST['pass2'];
if(strlen($pass)<6){
  echo "Pasahitz desegokia";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }

$expr='/^[a-z]+\d{3}@ikasle\.ehu\.(eus|es)$/';
$expr2='/^[a-z]+\d{3}@ehu\.(eus|es)$/';
$email=$_POST['email'];
if(!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
  if(!filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr2)))){
    echo "Email desegokia";
    echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
    die("");
   }
}
$expr='/^\d{9}$/';
$telf=$_POST['telf'];
if(!filter_var($telf, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
  echo "Telefono desegokia";
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
  }
$bai='SI';
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
/*$bezeroa = new nusoap_client("http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl", false);
$emaitza = $bezeroa-> call('comprobar', array('x'=>$_POST['email']));
if(strcmp($emaitza, $bai) != 0) {
  echo ("ez zaude irakasgaian matrikulatua");
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die("");
}*/
$bezeroa2 = new nusoap_client("http://localhost/wsp/wsp/ikasleak/passSoap.php?wsdl", false);
$erantzuna = $bezeroa2-> call('egiaztatuPass', array('x'=>$_POST['pass'],'y'=>$_POST['pass2']));
if($erantzuna=="baliogabea"){
  echo("pasahitz errazegia");
  echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
  die(""); 
}

$zifratua=sha1($pass);
    define('LIMITEA', 5000);
    define('EXTENSIOAK', serialize(array('image/jpg', 'image/jpeg', 'image/gif', 'image/png')));
    
    $BAIMENDUAK = unserialize(EXTENSIOAK);
        
     if ($_FILES["argazki"]["error"] <= 0) {
        if (in_array($_FILES['argazki']['type'], $BAIMENDUAK) && $_FILES['argazki']['size'] <= LIMITEA * 1024) {
            $rutaServidor = "irudiak/" . $_FILES['argazki']['name'];
            if (!file_exists($rutaServidor)) {
                $resultado = move_uploaded_file($_FILES["argazki"]["tmp_name"], $rutaServidor);
                if ($resultado) {
                } else {
                    echo '<script type="text/javascript">
                        alert("Ocurrió un error al mover archivo");
                        header("location:registro.php");
                        </script>';
                        echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
			die("");
                }
            } else {
                echo '<script type="text/javascript">
                    alert("Este archivo ya existe en la BD");
                    header("location:registro.php");
                    </script>';
                    echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
		    die("");
            }
        } else {
            echo "<script type='text/javascript'>
                alert('Tipo de archivo no permitido o excede tamaño');
                header('location:registro.php');
                </script>";
                echo "<p> <a href='erregistroa.html'> Erregistratzera bueltatu </a>";
		die("");
        }
    }else{
      $rutaServidor="irudiak/anonimo.png";
    }

mysql_connect("localhost", "root","")or die(mysql_error());
mysql_select_db("Quiz") or die(mysql_error());

$sql="INSERT INTO Erabiltzaile(Izena, Abizenak, Email, Telefonoa, Pasahitza, Espezialitatea, Argazkia) VALUES
  ('$_POST[izena]','$_POST[abizenak]','$_POST[email]','$_POST[telf]','$zifratua','$_POST[Espezialitatea]', '$rutaServidor')";

if (!mysql_query($sql))
{

  die('Errorea:' . mysql_error());
}

echo "1 record added";
mysql_close();
echo "<p> <a href='taula.php'> Erregistroak ikusi </a>";
?>