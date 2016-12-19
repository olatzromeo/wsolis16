<?php

require 'DBKonexioa.php';
require('SoapEskaera.php');

//fitxategi tamaina MB-ekin konparatzeko, MB 1 zenbat den adierazi eta gero biderketa egingo dugu
define('MB', 1048576);

/* $esteka =mysqli_connect ("mysql.hostinger.es","u628663284_olis","C0nguit0s","u628663284_quiz") or die ("Konekxioa ez da gauzatu MySQLra");
mysqli_select_db($esteka,"u628663284_quiz") or die ("Errorea datu basearen konekxioarekin"); */

/*$esteka= mysqli_connect("localhost", "root","", "quiz") or die ("Konekxioa ez da gauzatu MySQLra");
mysqli_select_db($esteka,"Quiz") or die ("Errorea datu basearen konekxioarekin");*/



$izena = $_POST["izena"];
$abizena = $_POST["abizenak"];
$emaila= $_POST['emaila'];
$pasahitza= $_POST['pasahitza'];
$telefonoa= $_POST["telefonoa"];
$espezialitatea= $_POST["espezialitatea"];
$besterik= $_POST["besterik"];
/*$interesa=$_POST["interesa"];*/
$ticketa=$_POST["ticketa"];

$soap = eskaeraEmail($emaila);
$soapPass = eskaeraPasahitza($ticketa,$pasahitza);
	

if ($soap == "EZ"){
	echo '<script language="javascript"> alert("Ez zaude irakasgaian matrikulatua."); </script>';
	echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";

} else if ($soapPass == "BALIOGABEA"){
	echo '<script language="javascript"> alert("Pasahitza ahulegia da."); </script>';
	echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
} else if (!filter_var($emaila, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>"~[a-z]+[0-9]{3}\@(ikasle\.)?ehu\.(eus|es)~"))) == false) {
	if ($espezialitatea=="Besterik") $espezialitatea = $besterik;

	$sql="INSERT INTO Erabiltzaile(Izena, Abizenak, Emaila, Pasahitza, Telefonoa, Espezialitatea) VALUES('$izena', '$abizena', '$emaila', '$pasahitza', '$telefonoa', '$espezialitatea')";

	$ema = mysqli_query($esteka, $sql);

	if(!$ema){
		die ('Errorea mysqli query-a gauzatzerakoan.');
	} else {
		echo "Erregistro bat gehitu da!";
		echo "<p> <a href='ShowUsers.php'>Erregistroak ikusi</a></p>";
		echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
	}
} else {
	echo("$emaila is not a valid email address.<br/>");
	echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
}

require 'DBKonexioaItxi.php';

?>