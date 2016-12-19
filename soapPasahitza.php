<?php
require_once("nusoap/lib/nusoap.php");

$client = new nusoap_client('http://oromeo001.hol.es/wsolis16-2/egiaztatuPasahitza.php?wsdl');
$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;

$result = $client->call("konprobatuPasahitza",array('pasahitz'=>'1234567'));

echo $client->getError() . "\n";

print_r($result);

?>