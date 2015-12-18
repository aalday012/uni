<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Aukeratu nick-a</title> 
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right"><a href="login.php">Login</a></span>
      <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
      <span class="right"><a href="erregistroa.html">signUp</a></span>
      <span class="right"><a href="simpleReg.php">signUpSoap</a></span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Home</a></span>
		<span><a href='log_joko.php'>Quizzes</a></span>
		<span><a href='AitorAratz.html'>Egileak</a></span>
	</nav>
    <section class="main" id="s1">
    
	
	<div align = 'left'>
	 <form id="nick" name="nick" method="post">
		<fieldset>
			<legend>Login formularioa</legend>
				<p>
				<label>Nick </label>
					<input id="nick" name="nick" type="text" />
				</p>
			<p>Nick gabe jolasteko besterik gabe botoia sakatu </p>
				<input id="jolastu" name="jolastu" type="submit" value="Jolastu"/>				
		</fieldset>
		</body>
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
session_start();
if(isset($_POST['jolastu'])){
  if(!empty($_POST['nick'])){
    $_SESSION['nick']=$_POST['nick'];
    header('Location: jokoa.php ');
  }else{
    header('Location: jokoa.php ');
  }
}
?>