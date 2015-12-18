<?php
session_start();
if(!isset($_SESSION['asmatuak'])){
$_SESSION['asmatuak']=0;
$_SESSION['okerrak']=0;
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
<title>Quizz</title>
</head>
<body>
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
echo '<table border=1><tr><th> Zenbakia </th><th> Galdera </th><th> Zailtasuna </th></tr>';
$row2 = mysql_fetch_array($galdera);
echo '<tr><td>'.$row2['Zenbakia'].'</td><td>'.$row2['Galdera'].'</td><td>'.$row2['Zailtasuna'].'</td></tr>';
}
//echo ($row2['Galdera']);
?>
  <p>
   <label>Erantzuna</label>
        <input id="erantzuna1" name="erantzuna1" type="text" />
  </p>
  <input type="hidden" id="erantzuna2" name="erantzuna2" value="<?php echo($row2['Erantzuna']);?>"/>
  <input id="saiatu" name="saiatu" type="submit" value="saiatu"/>
  <input id="home" name="home" type="submit" value="Home"/>
  <br>
</body>
</html>

<?php
if(isset($_POST['home'])){
  session_destroy();
  header("Location: layout.html");
}
if(isset($_POST['saiatu'])){
  if($_POST['erantzuna1']==$_POST['erantzuna2']){
    $_SESSION['asmatuak']=$_SESSION['asmatuak'] + 1;
    echo("galdera asmatua \n");
    if(isset($_SESSION['nick'])){
      echo("asmatuak:$_SESSION[asmatuak], okerrak:$_SESSION[okerrak]");
    }
  }else{
    $_SESSION['okerrak']=$_SESSION['okerrak'] + 1;
    echo("erantzun okerra \n");
    if(isset($_SESSION['nick'])){
      echo("asmatuak:$_SESSION[asmatuak], okerrak:$_SESSION[okerrak]");
    }
  }
}
?>