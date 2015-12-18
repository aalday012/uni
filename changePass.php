<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Pasahitza aldatu</title>
  </head>
  <body>
  </header>
	<nav2 class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Home</a></span>
	</nav2>
	<p>
  <form id="erregistro" name="erregistro" method="post">
    <fieldset>
        <legend>Erregistro formularioa</legend>
            <label>Email (*)</label>
                <input id="email" name="email" type="text" />
			</p>
			<p>
	    <label>Pasahitza (*)</label>
                <input id="pass" name="pass" type="password" />
			</p>
	    <label>Pasahitza errepikatu (*)</label>
                <input id="pass2" name="pass2" type="password" />
			</p>
			<br/>
            <input id="bidali" name="bidali" type="submit" value="Bidali"/>
    </fieldset>
    </body>
</form>
<?php 
ini_set('memory_limit','-1');
$bai="SI";
if(!empty($_POST['email'])){
  if(!empty($_POST['pass'])){
    require_once('lib/nusoap.php');
    require_once('lib/class.wsdlcache.php');
    $bezeroa = new nusoap_client("http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl", false);
    $emaitza = $bezeroa-> call('comprobar', array('x'=>$_POST['email']));
    //echo '<h2>Request</h2><pre>'.htmlspecialchars($bezeroa->request, ENT_QUOTES).'</pre>';
    //echo '<h2>Response</h2><pre>'.htmlspecialchars($bezeroa->response, ENT_QUOTES).'</pre>';
    if(strcmp($emaitza, $bai) != 0) {
      echo ("ez zaude irakasgaian matrikulatua");
    }else{
      $bezeroa2 = new nusoap_client("http://localhost/wsp/wsp/ikasleak/passSoap.php?wsdl", false);
      $erantzuna = $bezeroa2-> call('egiaztatuPass', array('x'=>$_POST['pass'],'y'=>$_POST['pass2']));
      if($erantzuna=="baliogabea"){
	echo("pasahitz errazegia edo ezberdinak");
      }else{
	mysql_connect("localhost", "root","")or die(mysql_error());
	mysql_select_db("Quiz") or die(mysql_error());
	$email=$_POST['email'];
	$pass=sha1($_POST['pass']);
	mysql_query("Update Erabiltzaile Set Pasahitza='$pass' WHERE Email='$email'") or die(mysql_error());
	echo("pasahitza aldatu da");
	}
    }
    //echo '<h2>Request</h2><pre>'.htmlspecialchars($bezeroa2->request, ENT_QUOTES).'</pre>';
    //echo '<h2>Response</h2><pre>'.htmlspecialchars($bezeroa2->response, ENT_QUOTES).'</pre>';
    //echo '<pre>'.htmlspecialchars($bezeroa2->debug_str, ENT_QUOTES).'</pre>';
      //echo "<a href="InserQuestion.php?email=<?$_POST['email']>">emaila bidali<a/> ";
      }
     }  
?>