<?php

require 'DBKonexioa.php';
require 'SoapEskaera.php';

//fitxategi tamaina MB-ekin konparatzeko, MB 1 zenbat den adierazi eta gero biderketa egingo dugu
define('MB', 1048576);

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
$soapPass = eskaeraPasahitza($pasahitza);

if(strlen($ticketa)==0){
	
	
	if ($soap=="EZ"){
            echo "<script> alert('Ez zaude irakasgaian matrikulatuta.'); </script><br/>";
            //header('Location: layout.php');
	    echo "<p><a href='layout.php'>Bueltatu hasierara</a></p>";

	} else if ($soapPass=="BALIOGABEA"){

		   echo "<script> alert('Pasahitza ahulegia da. Saiatu berriro.'); </script>";
                    //echo $pasahitza;
	            //echo $soapPass;
	           echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
                   // header('Location: signUp.html');


	}else if(!filter_var($emaila, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>"~[a-z]+[0-9]{3}\@(ikasle\.)?ehu\.(eus|es)~"))) == false) {

			if ($espezialitatea=="Besterik") $espezialitatea = $besterik;

			if (isset($_FILES['argazkia']) && $_FILES['argazkia']['size'] > 0) {                                        // erregistroa gehitu ARGAZKIAREKIN
				  $tmpName = $_FILES['argazkia']['tmp_name']; //igotako fitxategia non dagoen esan.
				  $fp = fopen($tmpName, 'r'); //ireki
				  $irudiDatuak = fread($fp, filesize($tmpName)); //irakurri
				  $irudiDatuak = addslashes($irudiDatuak);
				  fclose($fp);
                                  $pasahitza = sha1($pasahitza);
				
					$sql="INSERT INTO Erabiltzaile (Izena, Abizenak, Emaila, Pasahitza, Telefonoa, Espezialitatea, Argazkia) VALUES('$izena', '$abizena', '$emaila', '$pasahitza', '$telefonoa', '$espezialitatea','$irudiDatuak')";
							$ema = mysqli_query($esteka, $sql);
								if(!$ema){
								die ('Errorea mysqli query-a gauzatzerakoan.');
							} else {
                                               
                                                          echo "<script> alert('Jada erregistratu zara argazki eta guzti! Login egin webgunearen zerbitzu guztietaz disfrutatzeko'); </script>";
				                          //header('Location: SignInKonekxio.php');
				                          //echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
							  //echo "Erregistro bat gehitu da argazkiarekin!";
                                                           echo $pasahitza;
						           echo $ticketa;
							   echo "<p> <a href='ShowUsersWithImage.php'>Erregistroak ikusi</a></p>";
							   echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
                                                           //header('Location: layout.php');
						   }

			}else{                             //ARGAZKIRIK GABE erregistro bat gehitu
			
                                  $pasahitza = sha1($pasahitza);
				  $sql="INSERT INTO Erabiltzaile(Izena, Abizenak, Emaila, Pasahitza, Telefonoa, Espezialitatea) VALUES('$izena', '$abizena', '$emaila', '$pasahitza', '$telefonoa', '$espezialitatea')";

				  $ema = mysqli_query($esteka, $sql);

				  if(!$ema){
					die ('Errorea mysqli query-a gauzatzerakoan.');
				  } else {
                                   echo "<script> alert('JADA ERREGISTRATU ZARA! Login egin webgunearen zerbitzu guztietaz disfrutatzeko'); </script>";
				   // echo "Erregistro bat gehitu da!";
                                   //echo $soapPass;
				   echo "<p> <a href='ShowUsers.php'>Erregistroak ikusi</a></p>";
                                   //header('Location: SignInKonekxio.php');
				   echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
				  }
			}

	} else {
			echo("$emaila ez da baliozko emaila. Saiatu berriz.<br/>");
                        echo "<p> <a href='signUp.html'>Saiatu berriz</a></p>";
			echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
                        //header('Location: signUp.html');
	}

}else{					//TICKETA BADU
	
	$soapTicket=eskaeraTicketa($ticketa);
	
		if ($soap =="EZ"){
			echo "<script> alert('Ez zaude irakasgaian matrikulatua.Ez duzu baimenik erregistratzeko'); </script>";
                        echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";

		} else if ($soapPass=='BALIOGABEA'){
                    //echo $pasahitza;
		    echo "<script> alert('$pasahitza pasahitza ahulegia da.Aldatu eta saiatu berriz.'); </script>";
                    echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
                    echo "<p> <a href='signUp.html'>Saiatu Berriz</a></p>";
                    //header('Location: signUp.php');
			
		} else if ($soapPass=='BALIOZKOA' && $soapTicket=='BAIMENIK GABEKO ERABILTZAILEA'){

				echo("ERROREA.Baimenik gabeko erabiltzailea zara lortu baliozko ticket bat eta saiatu berriz.<br/>");
                                //echo $pasahitza;
                                //echo $soapTicketa;
				//echo $ticketa;
	                        echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
				echo "<p> <a href='signUp.html'>Saiatu berriz</a></p>";
                                //header('Location: signUp.php');

		} else if(!filter_var($emaila, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>"~[a-z]+[0-9]{3}\@(ikasle\.)?ehu\.(eus|es)~"))) == false) {

			if ($espezialitatea=="Besterik") $espezialitatea = $besterik;

				 if (isset($_FILES['argazkia']) && $_FILES['argazkia']['size'] > 0) {                                        // erregistroa gehitu ARGAZKIAREKIN
				  $tmpName = $_FILES['argazkia']['tmp_name']; //igotako fitxategia non dagoen esan.
				  $fp = fopen($tmpName, 'r'); //ireki
				  $irudiDatuak = fread($fp, filesize($tmpName)); //irakurri
				  $irudiDatuak = addslashes($irudiDatuak);
				  fclose($fp);
                                  $pasahitza = sha1($pasahitza);
				
					$sql="INSERT INTO Erabiltzaile (Izena, Abizenak, Emaila, Pasahitza, Telefonoa, Espezialitatea, Argazkia) VALUES('$izena', '$abizena', '$emaila', '$pasahitza', '$telefonoa', '$espezialitatea','$irudiDatuak')";
							$ema = mysqli_query($esteka, $sql);
								if(!$ema){
								die ('Errorea mysqli query-a gauzatzerakoan.');
							} else {
							   echo "<script> alert('Jada erregistratu zara argazki eta guzti! Login egin webgunearen zerbitzu guztietaz disfrutatzeko'); </script>";
				                          //header('Location: SignInKonekxio.php');
				                          //echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
							  //echo "Erregistro bat gehitu da argazkiarekin!";
                                                           echo $pasahitza;
						           echo $ticketa;
							   echo "<p> <a href='ShowUsersWithImage.php'>Erregistroak ikusi</a></p>";
							   echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
                                                           //header('Location: layout.php');
						   }

			}else{                        //ARGAZKIRIK GABE erregistro bat gehitu
			          
                                  $pasahitza = sha1($pasahitza);
				  $sql="INSERT INTO Erabiltzaile(Izena, Abizenak, Emaila, Pasahitza, Telefonoa, Espezialitatea) VALUES('$izena', '$abizena', '$emaila', '$pasahitza', '$telefonoa', '$espezialitatea')";

				  $ema = mysqli_query($esteka, $sql);

				  if(!$ema){
					die ('Errorea mysqli query-a gauzatzerakoan.');
				  } else {
				   echo "<script> alert('Jada erregistratu zara! Login egin webgunearen zerbitzu guztietaz disfrutatzeko'); </script>";
				   // echo "Erregistro bat gehitu da!";
                                   //header('Location: SignInKonekxio.php');
				   echo "<p> <a href='ShowUsers.php'>Erregistroak ikusi</a></p>";
				   echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
				  }
			   }

		} else {
			echo("$emaila ez da baliozko emaila. Saiatu berriz.<br/>");
			echo "<p> <a href='layout.php'>Bueltatu hasierara</a></p>";
                        //header('Location: signUp.html');
			echo "<p> <a href='signUp.html'>Saiatu berriz</a></p>";
		}	
}								

		
require 'DBKonexioaItxi.php';

?>																