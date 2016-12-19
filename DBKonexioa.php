<?php

$dbhost = "mysql.hostinger.es";
$dbuser = "u809326886_olis";
$dbpass = "olarome13";
$dbizen = "u809326886_quiz";

$esteka = mysqli_connect ($dbhost, $dbuser, $dbpass, $dbizen) or die ("Konekxioa ez da gauzatu MySQLra");
mysqli_select_db($esteka, $dbizen) or die ("Errorea datu basearen konekxioarekin");

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan. " . PHP_EOL;
        echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
}

?>