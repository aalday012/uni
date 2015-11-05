<?php
session_start();
$galdera = $_GET['galdera'];
$erantzuna = $_GET['erantzuna'];
if(!empty($galdera)){
  if(!empty($erantzuna)){
    if(!empty($_SESSION['email'])){
      mysql_connect("localhost", "root","")or die(mysql_error());
      mysql_select_db("Quiz") or die(mysql_error());
      
      $sql="INSERT INTO Galderak(Zenbakia, Galdera, Erantzuna, Zailtasuna, Egilea) VALUES
  (NULL,'$galdera','$erantzuna','$_GET[zailtasuna]','$_SESSION[email]')";
  
  if (!mysql_query($sql))
{

  echo "errorea gertatu da" ;
  die('Errorea:' . mysql_error());
}
      $xml = simplexml_load_file('galderak.xml');
      
      $assessmentItem = $xml->addChild('assessmentItem');
      $complexity = $assessmentItem->addAttribute('complexity',$_GET['zailtasuna']);
      $subject = $assessmentItem->addAttribute('subject','WS');
      
      $itemBody = $assessmentItem ->addChild('itemBody');
      $p = $itemBody->addChild('p',$galdera);
      $correctResponse = $assessmentItem->addChild('correctResponse');
      $value = $correctResponse->addChild('value',$erantzuna);
      
      //echo $xml->asXML();
      $xml->asXML('galderak.xml');
      
      
      mysql_close();
      echo "galdera ondo gehituta";
      }else{
	echo "emailik ez";
      }
      //echo "<meta content= '4;URL='layout.html''/>";
     }else{
	echo "erantzunik ez";
     }
     }else{
	echo "galderarik ez";
     }
?>