<?php

require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');



function eskaeraEmail($eposta){
	$bezeroa = new nusoap_client('http://wsjiparsar.esy.es/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);
	$emaitza = $bezeroa->call('egiaztatuE', array('x'=>$eposta));
	return $emaitza;
}

function eskaeraPasahitza($pasahitza){
	$bezeroa = new nusoap_client('http://oromeo001.hol.es/wsolis16-2/egiaztatuPasahitza.php?wsdl', true);
	$emaitza= $bezeroa->call('konprobatuPasahitza',array('pasahitz'=>$pasahitza));
	return $emaitza;
}

function eskaeraTicketa($ticket){
	$bezeroa = new nusoap_client('http://oromeo001.hol.es/wsolis16-2/egiaztatuTicketa.php?wsdl', true);
	$emaitza= $bezeroa->call('konprobatuTicketa',array('ticket'=>$ticket));
	return $emaitza;
}

?>