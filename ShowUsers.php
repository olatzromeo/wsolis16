<?php

require 'DBKonexioa.php';

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan. " . PHP_EOL;
	echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
} else {
	$ema = mysqli_query($esteka, "select * from Erabiltzaile");

	echo '<table border=1> <tr><th>Izena</th>
		  <th>Abizenak</th>
		  <th>Emaila</th>
		  <th>Pasahitza</th>
		  <th>Telefonoa</th>
		  <th>Espezialitatea</th> 				  
		  </tr>';

	while ($row = mysqli_fetch_assoc($ema)){
		echo '<tr><td>'.$row['Izena'].'</td> <td>'.$row['Abizenak'].'</td> <td>'.$row['Emaila']. '</td> <td>'.
		$row['Pasahitza'].'</td> <td>'.$row['Telefonoa'].'</td> <td>'.$row['Espezialitatea'].'</td></tr>';
	}

	echo '</table><br/>';
	echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
	mysqli_free_result($ema);
}

require 'DBKonexioaItxi.php';

?>
