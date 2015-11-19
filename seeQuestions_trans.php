<?php
session_start();
$xslDoc = new DOMDocument();
$xslDoc->load("seeQuestions.xsl");
$xmlDoc = new DOMDocument();
$xmlDoc->load("galderak.xml");
$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXML($xmlDoc);
if(!empty($_SESSION['email'])){
   echo "<p> <a href='InserQuestion.php'> Atzera </a>";
}else{
   echo "<p> <a href='layout.html'> Home </a>";
   session_destroy();
}
?>
