<?php 
include("sesioa.php");
$expr='/^[a-z]+\d{3}@ehu\.(eus|es)$/';
if(filter_var($_SESSION['email'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
header('Location: editQuestions.php');
exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>galderak gehitu</title> 
	<script type="text/javascript" language = "javascript">
	 XMLHttpRequestObject = new XMLHttpRequest();
	 XMLHttpRequestObject.onreadystatechange = function(){
	 alert(XMLHttpRequestObject.readyState);
	 if ((XMLHttpRequestObject.readyState==4)&&(XMLHttpRequestObject.status==200 )){ 
		document.getElementById("txtHint").innerHTML=
		XMLHttpRequestObject.responseText;
	 }}
	 XMLHttpRequestObject2 = new XMLHttpRequest();
	 XMLHttpRequestObject2.onreadystatechange = function(){
	 alert(XMLHttpRequestObject2.readyState);
	 if ((XMLHttpRequestObject2.readyState==4)&&(XMLHttpRequestObject2.status==200 )){ 
		document.getElementById("txtHint2").innerHTML=
		XMLHttpRequestObject2.responseText;
	 }}
	 function galderakikusi(){
	    XMLHttpRequestObject.open("GET","galderakIkusi.php", true);
	    XMLHttpRequestObject.send();
	 }
	 function galderakgehitu(){
	   XMLHttpRequestObject2.open("GET","galderakgehitu.php?galdera="+document.Galderak.galdera.value+"&erantzuna="+document.Galderak.erantzuna.value+"&zailtasuna="+document.Galderak.zailtasuna.value, true);
	   XMLHttpRequestObject2.send(); 
	 }
</script>
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
            <input id="gehitu" name="gehitu" type="button" value="gehitu" onclick="galderakgehitu()"/>
            <input id="ikusi"  name="ikusi"  type="button" value="galderak ikusi" onclick="galderakikusi()"/>
            <input id="logout" name="logout" type="submit" value="logout"/>
    </fieldset>
    <div id="txtHint" style="background-color:#99FF66;">
    <p>Zure galderak hemen agertuko dira...</p>
    </div>
    <div id="txtHint2" style="background-color:#0000FF;">
    <p></p>
    </div>
    </body>
</form>
<?php
if(isset($_POST['logout'])){
  session_destroy();
  header("Location: login.php");
}
/*if(isset($_POST['ikusi'])){
  if(!empty($_SESSION['email'])){
    header("Location: seeXMLQuestions.php");
  }  
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
     }*/
?>