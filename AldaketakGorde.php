<?php
require 'DBKonexioa.php';
require 'Session.php';


$sql = 'UPDATE Galderak SET Testua="'.$_POST['testua'].'", ErantzunZuzena="'.$_POST['erantzuna'].'", ZailtasunMaila="'.$_POST['zailtasuna'].'" where GZenbaki="'.$_POST['kodea'].'";';
	if (mysqli_query($esteka, $sql))
		{
echo("Datuak ondo aldatu dira.");
echo('<br/><br/>');
echo('<div class="go"><a href="reviewingQuizes.php">Atzera</a></div>');
echo('<br/><br/>');
		}
	  else
		{
		echo "Errorea: " . $sql . "<br />" . mysqli_error($konexioa);
		}

 require 'DBKonexioaItxi.php';

?>