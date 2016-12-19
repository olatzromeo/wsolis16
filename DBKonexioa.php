<?php

$dbhost = "mysql.hostinger.es";
$dbuser = "u301318292_roux";
$dbpass = "incautosTX13";
$dbizen = "u301318292_proba";

$esteka = mysqli_connect ($dbhost, $dbuser, $dbpass, $dbizen) or die ("Konekxioa ez da gauzatu MySQLra");
mysqli_select_db($esteka, $dbizen) or die ("Errorea datu basearen konekxioarekin");

if(!$esteka){
	echo "Hutsegitea MySQLra konektatzerakoan. " . PHP_EOL;
        echo "errno depurazio akatsa: " . mysqli_connect_errno().PHP_EOL;
}

?>