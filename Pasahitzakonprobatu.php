<?php

require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');
	
$client = new nusoap_client('http://oromeo001.hol.es/wsolis16-2/egiaztatuPasahitza3.php?wsdl',true);
$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;

if(isset($_POST['pasahitza'])){
		
	$result=$soapclient->call('konprobatuPasahitza',array('key'=>1111,'pass'=>$_POST['pasahitza']));
	echo $result;
}

?>