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
		<link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='stylesPWS/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='stylesPWS/smartphone.css' />
		<script type="text/javascript" language = "javascript">
			 XMLHttpRequestObject = new XMLHttpRequest();
			 XMLHttpRequestObject.onreadystatechange = function(){
			 //alert(XMLHttpRequestObject.readyState);
			if ((XMLHttpRequestObject.readyState==4)&&(XMLHttpRequestObject.status==200 )){ 
				document.getElementById("txtHint").innerHTML=
				XMLHttpRequestObject.responseText;
			}}
			 XMLHttpRequestObject2 = new XMLHttpRequest();
			 XMLHttpRequestObject2.onreadystatechange = function(){
			 //alert(XMLHttpRequestObject2.readyState);
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
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right" style="display:none;"><a href="login.php">Login</a></span>
				<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
				<span class="right" style="display:none;"><a href="erregistroa.html">signUp</a></span>
				<span class="right" style="display:none;"><a href="simpleReg.php">signUpSoap</a></span>
				<h2>Quiz: crazy questions</h2>
			</header>
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.html'>Home</a></span>
				<span><a href='log_joko.php'>Quizzes</a></span>
				<span><a href='AitorAratz.html'>Egileak</a></span>
			</nav>
			<section class="main" id="s1">
			<div>
				<form id="Galderak" name="Galderak" method="post" align='left'>
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
					<?php 
						if(!empty($_SESSION['email']))
						{
							mysql_connect("localhost", "root","")or die(mysql_error());
							mysql_select_db("Quiz") or die(mysql_error());
							$galderaKop = mysql_query( "select COUNT(*) AS danak from Galderak" );
							$nireGaldraKop = mysql_query( "select COUNT(*) AS nireak from Galderak WHERE Egilea = '$_SESSION[email]'" );
						}
						$row = mysql_fetch_array( $nireGaldraKop );
						$row2 = mysql_fetch_array( $galderaKop );
						echo ' 	<div id="galderakop"style="background-color:orange;">
									<p> Galdera kopurua/Nire galderak: '.$row['nireak'].'/'.$row2['danak'].'</p>
								</div>';
						mysql_close();
					?>
					<div id="txtHint" style="background-color:#99FF66;">
						<p>Zure galderak hemen agertuko dira...</p>
					</div>
					<div id="txtHint2" style="background-color:#0000FF;">
						<p></p>
					</div>
				</form>
			</div>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>
	</body>
</html>
<?php
if(isset($_POST['logout'])){
  session_destroy();
  header("Location: layout.html");
}
?>