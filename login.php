<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>login</title> 
  </head>
  <body>
  </header>
	<nav2 class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Home</a></span>
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
    </fieldset>
    </body>
</form>
<?php
if(isset($_POST['email'])){
  if(isset($_POST['pass'])){
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
      echo "ondo login";

      mysql_close();
      header('Location: logged.html ');
      echo "ondo login";
      }
      //echo "<meta content= '4;URL='layout.html''/>";
     }
   }  
?>