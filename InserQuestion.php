<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>galderak gehitu</title> 
  </head>
  <body>
  </header>
	<nav2 class='main' id='n1' role='navigation'>
	</nav2>
	<p>
  <form id="Galderak" name="Galderak" method="post">
    <fieldset>
        <legend>Galderak gehitu</legend>
			<p>
            <label>Galdera </label>
                <input id="galdera" name="galdera" type="text" />
			</p>
			<p>
	    <label>Erantzuna </label>
                <input id="erantzuna" name="erantzuna" type="text" />
			</p>
	    <label>Zailtasuna </label>
                <input id="zailtasuna" name="zailtasuna" type="text" />
			</p>
            <input id="gehitu" name="gehitu" type="submit" value="gehitu"/>
            <input id="logout" name="logout" type="submit" value="logout"/>
            <input id="ikusi"  name="ikusi"  type="submit" value="galderak ikusi"/>
    </fieldset>
    </body>
</form>
<?php
session_start();
if(isset($_POST['logout'])){
  session_destroy();
  header("Location: login.php");
}
if(isset($_POST['ikusi'])){
  header("Location: seeXMLQuestions.php");
}
if(!empty($_POST['galdera'])){
  if(!empty($_POST['erantzuna'])){
    if(!empty($_SESSION['email'])){
      mysql_connect("localhost", "root","")or die(mysql_error());
      mysql_select_db("Quiz") or die(mysql_error());
      
      $sql="INSERT INTO Galderak(Zenbakia, Galdera, Erantzuna, Zailtasuna, Egilea) VALUES
  (NULL,'$_POST[galdera]','$_POST[erantzuna]','$_POST[zailtasuna]','$_SESSION[email]')";
  
  if (!mysql_query($sql))
{

  die('Errorea:' . mysql_error());
}
      $xml = simplexml_load_file('galderak.xml');
      
      $assessmentItem = $xml->addChild('assessmentItem');
      $complexity = $assessmentItem->addAttribute('complexity',$_POST['zailtasuna']);
      $subject = $assessmentItem->addAttribute('subject','WS');
      
      $itemBody = $assessmentItem ->addChild('itemBody');
      $p = $itemBody->addChild('p',$_POST['galdera']);
      $correctResponse = $assessmentItem->addChild('correctResponse');
      $value = $correctResponse->addChild('value',$_POST['erantzuna']);
      
      //echo $xml->asXML();
      $xml->asXML('galderak.xml');
      
      
      mysql_close();
      echo "galdera ondo gehituta";
      }
      //echo "<meta content= '4;URL='layout.html''/>";
     }
     }
?>