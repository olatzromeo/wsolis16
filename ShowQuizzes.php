<?php

require 'DBKonexioa.php';
session_start();

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan. " . PHP_EOL;
	echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
} else {
	$ordua = date("Y-m-d H:i:s");
	$ekintza = 'Galderak ikusi';
	$IPHelb = $_SERVER['REMOTE_ADDR'];

	if(isset($_SESSION['login'])){
		$konexioId = $_SESSION['konexio'];
		$erabPosta = $_SESSION['login'];
		$sql="INSERT INTO Ekintzak(KonexioId, ErabPosta, EkintzaMota, EkintzaOrdua, IPHelbidea) VALUES('$konexioId', '$erabPosta', '$ekintza', '$ordua', '$IPHelb')";
	} else {
		$sql="INSERT INTO Ekintzak(EkintzaMota, EkintzaOrdua, IPHelbidea) VALUES('$ekintza', '$ordua', '$IPHelb')";
	}
	$ema = mysqli_query($esteka, $sql);

	$ema = mysqli_query($esteka, "select * from Galderak");

	echo '<table border=1> <tr><th>Galdera:</th>
		  <th>Zailtasun-maila:</th>
		  </tr>';

	while ($row = mysqli_fetch_assoc($ema)){
		if ($row['ZailtasunMaila']==0) echo '<tr><td>'.$row['Testua'].'</td> <td></td></tr>';
		else echo '<tr><td>'.$row['Testua'].'</td> <td>'.$row['ZailtasunMaila'].'</td></tr>';
	}

	echo '</table><br/>';
	echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
	mysqli_free_result($ema);
}

require 'DBKonexioaItxi.php';

?>
		