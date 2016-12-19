<?php

$egilea=$_GET["login"];
$xml=simplexml_load_file('xml/galderak.xml');
$glbCounter = 0;
$ownCounter = 0;

echo '<table border=1> <tr><th>Galdera:</th>
	<th>Zailtasun-maila:</th>
	</tr>';

foreach($xml->assessmentItem as $galdera){
	$glbCounter = $glbCounter + 1;
	if($galdera->senderEmail->value == $egilea){
		$ownCounter = $ownCounter + 1;
		if ($galdera['complexity']==0) echo '<tr><td>'.$galdera->itemBody->p.'</td> <td></td></tr>';
		else echo '<tr><td>'.$galdera->itemBody->p.'</td> <td>'.$galdera['complexity'].'</td></tr>';
	}
}
echo '</table><br/><br/>';
echo 'Nire galderak/Galderak guztira DB: ' . $ownCounter . '/' . $glbCounter;

?>
				