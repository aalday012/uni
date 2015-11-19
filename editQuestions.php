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
<title>Galderen berrikusketa</title>
</head>
<body>
   <form id="editatu" name="editatu" method="post">
   <label>Galdera bat aukeratu </label>
   <select name="Zenbakia" id="Zenbakia" onchange="form.submit()" >
       <option slected> --
       <?php echo $combobox; ?>
   </select>
<?php
mysql_connect("localhost", "root","")or die(mysql_error());
mysql_select_db("Quiz") or die(mysql_error());
$galdera = mysql_query( "select Zenbakia, Galdera, Erantzuna, Zailtasuna from Galderak WHERE Zenbakia='$_POST[Zenbakia]'" );
$row2 = mysql_fetch_array($galdera);
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
  <input id="logout" name="logout" type="submit" value="logout"/>
  <br>
</body>
</html>

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