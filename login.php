<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>login</title> 
  </head>
  <body>
  </header>
	<nav2 class='main' id='n1' role='navigation'>
	</nav2>
	<p>
  <form id="login" name="login" method="post">
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
            <input id="home" name="home" type="submit" value="Home"/>
            
    </fieldset>
    </body>
</form>
<?php 
session_start();
if(isset($_POST['home'])){
  session_destroy();
  header("Location: layout.html");
}
if(!empty($_POST['email'])){
  if(!empty($_POST['pass'])){
      mysql_connect("localhost", "root","")or die(mysql_error());
      mysql_select_db("Quiz") or die(mysql_error());

      $selecta = "SELECT Pasahitza FROM Erabiltzaile WHERE Email = '$_POST[email]'";
      $emaitza = mysql_query($selecta);
      $info = mysql_fetch_array($emaitza);
      if (!$info) {
	      //die('Errorea: Emaila ez dago.');
	      echo "Errorea: email-a ez da existitzen";
      }else if ($info['Pasahitza'] != $_POST['pass']){
	      //die('Errorea: Pasahitz okerra!');
	      echo "Errorea: Pasahitz okerra";
      }else{
      $_SESSION['email']=$_POST['email'];
      echo "ondo login";

      mysql_close();
      header('Location: handlingQuizzes.php ');
      //echo "<a href="InserQuestion.php?email=<?$_POST['email']>">emaila bidali<a/> ";
      }
      //echo "<meta content= '4;URL='layout.html''/>";
     }
   }  
?>