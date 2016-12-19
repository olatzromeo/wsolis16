<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Galderak Sartu</title> 
	<link rel='stylesheet' type='text/css' href='stylesPWS/insertquestion.css' />
	<link rel='stylesheet' type='text/css' href='stylesPWS/signUp.css' /> 
	<link rel='stylesheet' type='text/css' media='only screen and (min-width: 530px) and (min-device-width: 481px)' href='stylesPWS/wide.css' />

	<div id='page-wrap'>
	<header class='main' id='h1'>
		  <span class="right"><a href="signUp.html">SignUp</a>&nbsp;&nbsp;</span>
		  <span class="right"><a href="SignIn.php">LogIn</a> </span>
		  <span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
		<h2>Quiz: SARTU GALDERAK</h2>
		</header>
		
    <script type="text/javascript" src="js/signUp.js"></script>
	<script type="text/javascript">
            function galderakIkusi() {
                alert("Segituan bistaratuko zaizkizu galderak....itxaron pixka bat");
  		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if (xhttp.readyState==4) {  //fitxategia kargatzean
				//alert(xhttp.responseText);		// deiaren erantzuna string moduan bistaratu
				var erantzuna = xhttp.responseText;	// zerbitzariaren erantzuna testu huts (html) formatuan
				var obj = document.getElementById('emaitza');
				obj.innerHTML = erantzuna;
			}
		}
		setInterval(function datuakEskatu(){
			var egilea = document.getElementById('egilePosta').value;
			var eskaera= "erabGalderakIkusi.php?login=".concat(egilea);
			xhttp.open("GET", eskaera, true);
			xhttp.send(null);
		}, 5000);
           }
	</script>
  </head>
  <body> 
		<nav class='main' id='n1' role='navigation'>
			<span><a href='layout.php'>Home</a></span>
			<span><a href='ShowQuizzes.php'>Show Quizzes</a></span>
			<span><a href='credits.html'>Credits</a></span>
		</nav>
		<section class="main" id="s1">
        <?php session_start();
            if(!isset($_SESSION['login'])){
                  echo '
						<span class="right"><a href="signUp.html">SignUp</a>&nbsp;&nbsp;</span>
                        <span class="right"><a href="SignIn.php">LogIn</a> </span>';
            } else {
                  echo '<div align="right"><i>' . $_SESSION['login'] . '</i> barruan da.<br/></div>';
                  echo '<span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
                        <div align="right">
                        <form method="post" action="LogOut.php" id="logout" name="logout" enctype="multipart/form-data">
                        <input type="submit" class="button" name="logout" value="Log out" /></form>
                        </div>';
            }
        ?>
	<div> 
        <div id="formularioa">
		<?php echo '<form id="form-galderak" action="handlingQuizzes.php" method="post">' ?>
                      <?php
                         require 'DBKonexioa.php';
                         require 'Session.php';
                      ?>
                    	<br/><p><label>Egilearen ePosta:</label></p>
                        <?php echo '<input name="egilePosta" type="text" id="egilePosta" value="'.$_SESSION['login'].'" readonly="readonly"><br/><br/>'
                        ?>

                     	<p><label>Galdera:</label></p>
                        <textarea id="galderatestua" name="galdTestua"class="textarea"rows="8" cols="60" placeholder="Idatzi hemen zure 
galdera..."></textarea><br/><br/>	
                        
                        <p><label>Erantzun zuzena:</label></p>
                        <textarea id="eranZuzena" name="eranZuzena"class="textarea"rows="8" cols="60" placeholder="Idatzi hemen galderaren 
erantzuna..."></textarea><br/><br/>	

                        <p><label>Zailtasun-maila:</label></p>
                        <br/>	 
 		<div id="radioAukera">
			<input type="radio" name="kalifiAukera" value="1">1&nbsp;&nbsp;
			<input type="radio" name="kalifiAukera" value="2">2&nbsp;&nbsp;
			<input type="radio" name="kalifiAukera" value="3">3&nbsp;&nbsp; 
			<input type="radio" name="kalifiAukera" value="4">4&nbsp;&nbsp;
			<input type="radio" name="kalifiAukera" value="5">5&nbsp;&nbsp; 
            <input type="radio" name="kalifiAukera" value=""checked>(Kalifikatu gabe)&nbsp;&nbsp;
		</div>
        <br/>
		<input type="submit" name="galderaBidali" value="Bidali Galdera" class="botoia" onclick="return GalderaBalidatu()">
        <input type="button" value="Galderak Ikusi" onclick="galderakIkusi()">
		<br/>
		<br/>
		<br/>	
        </form>  
    	          
    </div><!--amaiera formularioa-->

	<div id="emaitza" style="background-color:#ceff99"></div>
	<br/>
    <br/>
    <br/>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
	</div>
   </body>
</html>	

<?php

       if (isset($_POST['galdTestua'])){
		
                /*Datu Basean begiratu*/
		$gZenbakia= $_POST["galderaZenbakia"];
		$egilePosta = $_POST["egilePosta"];
		$testua= $_POST["galdTestua"];
		$galdera_zuzena= $_POST["eranZuzena"];
		$zailtasun_maila=$_POST["kalifiAukera"];

		$check_erabiltzaileak="select * from Erabiltzaile WHERE Emaila='$egilePosta'";
		$run=mysqli_query($esteka,$check_erabiltzaileak);
		$cont= mysqli_num_rows($run);		


		if($cont==1){  /*erabiltzailea erregistratuta badago*/

		$ekintza = 'Galdera gehitu';
		$ordua = date("Y-m-d H:i:s");
		$IPHelb = $_SERVER['REMOTE_ADDR'];

		if(isset($_SESSION['login'])){
			$konexioId = $_SESSION['konexio'];
			$erabPosta = $_SESSION['login'];
			$sql="INSERT INTO Ekintzak(KonexioId, ErabPosta, EkintzaMota, EkintzaOrdua, IPHelbidea) VALUES('$konexioId', '$erabPosta', '$ekintza', '$ordua', '$IPHelb')";
			mysqli_query($esteka, $sql);
		}

			$sql1="INSERT INTO Galderak(GZenbaki, EgilePosta, Testua, ErantzunZuzena, ZailtasunMaila) VALUES('$gZenbakia', '$egilePosta', '$testua', 
'$galdera_zuzena', '$zailtasun_maila')";
            //echo "<p>DB-arekin konexioa egiten...</p>";
			$ema = mysqli_query($esteka, $sql1);

			if(!$ema){
				die ('Errorea query-a gauzatzerakoan:' . msqli_error());
			}else{
			     echo "Galdera bat gehitu da!";
			     //echo "<p> <a href='ShowQuizzes.php'>Galderak ikusi</a></p>";
			}

                        /*XML-an sartzen*/
		    $xmlGalderak = simplexml_load_file('xml/galderak.xml');
			//echo "<p>XML-an datuan sartzen...</p>";
			$galdera=$xmlGalderak->addChild('assessmentItem');
			$galdera->addAttribute('complexity',$zailtasun_maila);
			$galderaenun=$galdera->addChild('itemBody');
            $galderaenun->addChild('p',$testua);
			$zuzena=$galdera->addChild('correctResponse');
            $zuzena->addChild('value',$galdera_zuzena);
			$gemaila=$galdera->addChild('senderEmail');
            $gemaila->addchild('value',$egilePosta);
            $xmlGalderak->asxml('xml/galderak.xml');
//			echo "<p>... sartu dira datuak.</p>";  
                        echo '<script>alert("Bikain!Galdera berri bat gehitu duzu!!")</script>;';

		}else {       /*erabiltzailea EZ dago erregistratuta*/
		
                     echo "<script>alert('Erabiltzaile posta hori ez dago datu basean erregistratua!')</script>"; 		    
		}  
	}
	
require 'DBKonexioaItxi.php';

?>		