<?php

require 'DBKonexioa.php';

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan. " . PHP_EOL;
	echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
} else {
	$ema = mysqli_query($esteka, "select * from Konexioak");

	echo '<table border=1> 
		  <tr><th>Konexio Id </th>
		  <th>Erabiltzaile Posta </th>
		  <th>Konexio Ordua</th>
		  </tr>';

	while ($row = mysqli_fetch_assoc($ema)){
		echo '<tr><td>'.$row['KonexioId'].'</td> <td>'.$row['ErabPosta'].'</td><td>'.$row['KonexioOrdua'].'</td></tr>';
	}
	echo '</table><br/>';

	echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
	mysqli_free_result($ema);
}

require 'DBKonexioaItxi.php';

?>
