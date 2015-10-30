<?php
    $galderak = simplexml_load_file('galderak.xml');
	echo '<table border=1><tr><th> Galdera </th><th> Erantzuna </th><th> Konplexutasuna </th></tr>';
    foreach ($galderak->assessmentItem as $galdera):
        $Gtextua=$galdera->itemBody->p;
		$complexity= $galdera->attributes()->complexity;
        $Etextua=$galdera->correctResponse->value;
        //echo "</br><strong> Galdera:</strong>".$Gtextua."</br><strong> Erantzuna:</strong>".$Etextua."</br><strong>konplexutasuna:</strong>".$konplexutasuna."</br>"; 
		echo '<tr><td>'.$Gtextua.'</td><td>'.$Etextua.'</td><td>'.$complexity.'</td></tr>';
   endforeach;
   echo "<p> <a href='InserQuestion.php'> Atzera </a>";
?>