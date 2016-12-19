<?php

require 'DBKonexioa.php';
require 'Session.php';
if($_SESSION['erabmota']!="irakasle"){
	 header("location:handlingQuizzes.php"); 
}


echo '<head>', "\n";
echo '</head><body>', "\n";

$sql="SELECT * FROM  Galderak JOIN Erabiltzaile ON Galderak.EgilePosta = Erabiltzaile.Emaila";
$emaitza = mysqli_query($esteka, $sql);
echo('<center>');
echo('<div><p> GALDERAK </p> </div>');
echo '<div align="right"> 
      <form method="post" action="LogOut.php" id="logout" name="logout" enctype="multipart/form-data">
      <input type="submit" class="button" name="logout" value="Log out" /></form>
      </div>';

echo('<table id="taula">');
echo('<tr><th id="erregistroa">EGILEA</th><th id="erregistroa">POSTA</th><th id="erregistroa">GALDERA</th><th id="erregistroa">ERANTZUNA</th><th id="erregistroa1">ZAILTASUNA</th><th></th></tr>');

if($emaitza) {
	while($row = mysqli_fetch_assoc($emaitza)) {
		echo('<form method="post" action="AldaketakGorde.php" id="eguneratu" name="eguneratu" enctype="multipart/form-data">');
		echo('<input type="hidden" name="kodea" value="'.$row['GZenbaki'].'">');
		echo('<tr name ="galdera" id="galdera">');
		echo('<td>'.$row['Izena']." ".$row['Abizenak'] .'</td>'.
			'<td>'.$row['Emaila'] .'</td>'.
			'<td><input type="text" name="testua" value="'.$row['Testua'].'"/></td>'.
			'<td><input type="text" name="erantzuna" value="'.$row['ErantzunZuzena'].'"/></td>'.
			'<td><input type="text" name="zailtasuna" value="'.$row['ZailtasunMaila'].'"/></td>
			<td id="zuzendu"><input type="submit" value="Aldaketak Gorde" id="aldatu" />');
		echo('</tr>');
		echo('</form>');

	}
} 

echo('</table>');
echo('<br/><br/>');
echo('<div><a href="layout.php">Bueltatu hasierara</a></div>');
echo('<br/><br/>');
echo('</center></body>');

require 'DBKonexioaItxi.php';

?>