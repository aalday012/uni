<?php
include("sesioa.php");
$expr='/^[a-z]+\d{3}@ikasle\.ehu\.(eus|es)$/';
if(filter_var($_SESSION['email'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$expr)))){
header('Location: handlingQuizzes.php');
exit();
}
mysql_connect("localhost", "root","")or die(mysql_error());
mysql_select_db("Quiz") or die(mysql_error());

$galderak = mysql_query( "select Zenbakia, Galdera, Zailtasuna from Galderak" );

$combobox="";
while ($row = mysql_fetch_array( $galderak ) ) {
$combobox.= "<option value='".$row['Zenbakia']."'> ".$row['Zenbakia']."</option>";
}

//echo "<p> <a href='layout.html'> Home </a>";
?>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Galderen berrikusketa</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		  $("document").ready(function() {
		  $("p").hide();
		  $("labe").hide();
		  $("input").hide();
		  $("option")click(function(){
			$("p").show();
			$("labe").show();
			$("input").show();
		  });
		  $("#editatu").click(function(){
			$("p").hide();
			$("labe").hide();
			$("input").hide();
		  });
		});
	</script>
	<script type="text/javascript" language = "javascript">
	 XMLHttpRequestObject = new XMLHttpRequest();
	 XMLHttpRequestObject.onreadystatechange = function(){
	 //alert(XMLHttpRequestObject.readyState);
	 if ((XMLHttpRequestObject.readyState==4)&&(XMLHttpRequestObject.status==200 )){ 
		document.getElementById("txtHint").innerHTML=
		XMLHttpRequestObject.responseText;
	 }}
	 function ikasleakIkusi(){
	   XMLHttpRequestObject.open("GET","ikasleakIkusi.php", true);
	   XMLHttpRequestObject.send(); 
	 }
</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right" style="display:none;"><a href="/logout">Logout</a></span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
	</nav>
    <section class="main" id="s1">
    
	<div align ='left'>
	   <form id="editatu" name="editatu" method="post">
	   <label>Galdera bat aukeratu </label>
	   <select name="Zenbakia" id="Zenbakia" onchange="form.submit()" >
		   <option slected> --
		   <?php echo $combobox; ?>
	   </select>
		<?php
		if(isset($_POST['Zenbakia'])){
		mysql_connect("localhost", "root","")or die(mysql_error());
		mysql_select_db("Quiz") or die(mysql_error());
		$galdera = mysql_query( "select Zenbakia, Galdera, Erantzuna, Zailtasuna from Galderak WHERE Zenbakia='$_POST[Zenbakia]'" );
		$row2 = mysql_fetch_array($galdera);
		}
		//echo ($row2['Galdera']);
		?>
		  <p>
		   <label>Galdera</label>
				<input id="galdera" name="galdera" type="text" value="<?php echo ($row2['Galdera']);?>" />
		  </p>
		  <p>
		   <label>Erantzuna</label>
				<input id="erantzuna" name="erantzuna" type="text" value="<?php echo ($row2['Erantzuna']);?>" />
		  </p>
		  <p>
		   <label>Zailtasuna</label>
				<input id="zailtasuna" name="zailtasuna" type="text" value="<?php echo ($row2['Zailtasuna']);?>" />
		  </p>
		  <input type="hidden" id="zenbakia" name="zenbakia" value="<?php echo($row2['Zenbakia']);?>"/>
		  <input id="editatu" name="editatu" type="submit" value="editatu"/>
		  <input id="ikusi"  name="ikusi"  type="button" value="ikasleak ikusi" onclick="ikasleakIkusi()"/>
		  <input id="logout" name="logout" type="submit" value="logout"/>
		  <br>
		 <div id="txtHint" style="background-color:#99FF66;">
			<p>Ikasle zerrenda hemen agertuko da...</p>
		</div>
		<?php
			if(isset($_POST['editatu'])){
			  mysql_connect("localhost", "root","")or die(mysql_error());
			  mysql_select_db("Quiz") or die(mysql_error());
			  $galdera1=$_POST['galdera'];
			  $erantzuna=$_POST['erantzuna'];
			  $zailtasuna=$_POST['zailtasuna'];
			  $zenbakia=$_POST['zenbakia'];
			  $sql="Update Galderak Set Galdera='$galdera1',Erantzuna='$erantzuna',Zailtasuna='$zailtasuna' where Zenbakia='$zenbakia'";
			  mysql_query($sql);
			  echo("galera editatu da.");
			}
			if(isset($_POST['logout'])){
			  session_destroy();
			  header("Location: login.php");
			}
		?>
	</div>
	</section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
