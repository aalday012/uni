<!DOCTYPE html>
<html>
	<head>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>login</title>
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
			<section class="main" id="s1" align = 'left'>
				 <form id="login" name="login" method="post" align = 'left'>
					<fieldset>
						<legend>Login formularioa</legend>
						<p>
						<label>Email </label>
							<input id="email" name="email" type="text" />
						</p>
						<p>
						<label>Pasahitza </label>
							<input id="pass" name="pass" type="password" />
						</p>
						<input id="login" name="login" type="submit" value="Login"/>
						<p> <a href='changePass.php'> Pasahitza ahaztu duzu? </a>
					</fieldset>
					<?php 
						$gehitu = false;
						session_start();
						if(isset($_POST['home'])){
							session_destroy();
							header("Location: layout.html");
						}
						if (!isset($_SESSION['accessError']))
						{
							$_SESSION ['accessError'] = 0;
						}
						if(!empty($_POST['email']))
						{
							if(!empty($_POST['pass']))
							{
								mysql_connect("localhost", "root","")or die(mysql_error());
								mysql_select_db("Quiz") or die(mysql_error());
								$selecta = "SELECT Pasahitza FROM Erabiltzaile WHERE Email = '$_POST[email]'";
								$emaitza = mysql_query($selecta);
								$info = mysql_fetch_array($emaitza);
								if (!$info) {
									//die('Errorea: Emaila ez dago.');
									echo "Errorea: email-a ez da existitzen";
									$gehitu = true;
								}else if ($info['Pasahitza'] != sha1($_POST['pass'])){
									//die('Errorea: Pasahitz okerra!');
									echo "Errorea: Pasahitz okerra";
									$gehitu = true;
								}else{
									$_SESSION['email']=$_POST['email'];
									echo "ondo login";
									mysql_close();
									$expr='/^[a-z]+\d{3}@ikasle\.ehu\.(eus|es)$/';
									$email=$_POST['email'];
									if(filter_var($email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
										header('Location: handlingQuizzes.php ');
									}else{
										header('Location: editQuestions.php ');
									}
									//echo "<a href="InserQuestion.php?email=<?$_POST['email']>">emaila bidali<a/> ";
								}
								if($gehitu)
									$_SESSION ['accessError'] = $_SESSION ['accessError'] +1;
								if (isset($_SESSION ['accessError']) && $_SESSION ['accessError'] >= 3)
									{
										$_SESSION ['accessError'] = 0;
										header("Location: layout.html"); 
									}
								//echo "<meta content= '4;URL='layout.html''/>";
							}
						}
					?>
				</form>
			</section>
			<footer class='main' id='f1'>
				<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>
	</body>
</html>

