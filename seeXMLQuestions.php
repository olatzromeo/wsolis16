<?php

require 'DBKonexioa.php';

$xml = simplexml_load_file("xml/galderak.xml") or die("Error: Ezin izan da .xml fitxategia aurkitu.");

echo '<table border=1> <tr><th>Galdera:</th>
	<th>Zailtasun-maila:</th>
	</tr>';

foreach($xml->assessmentItem as $galdera){
	if ($galdera['complexity']==0) echo '<tr><td>'.$galdera->itemBody->p.'</td> <td></td></tr>';
	else echo '<tr><td>'.$galdera->itemBody->p.'</td> <td>'.$galdera['complexity'].'</td></tr>';
}

echo '</table><br/>';
echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";

?>