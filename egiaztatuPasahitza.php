<?php

require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');

$server    = new soap_server(); //soap_server objektua
$namespace = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$server->configureWSDL('konprobatuPasahitza',$namespace );
$server->wsdl->schemaTargetNamespace = $namespace;

$server->register('konprobatuPasahitza', array('pasahitz'=>'xsd:string'),
array('erantz'=>'xsd:string'), $namespace, $namespace."#konprobatuPasahitza",'rpc','encoded',
    'baliozko pasahitza itzultzen du');


function konprobatuPasahitza($pasahitz) {

$fitxategi = 'toppasswords.txt';
$searchfor = $pasahitz;

// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($fitxategi );

// escape special characters in the query
$pattern = preg_quote($searchfor, '/');

// finalise the regular expression, matching the whole line
$pattern = "/^.*$pattern.*\$/m";

// search, and store all matching occurences in $matches
if(preg_match_all($pattern, $contents, $matches)){
   return 'BALIOGABEA';
}
else{
   return 'BALIOZKOA';
}
}

//parametroak pasa ez badira, string hutsa balioa ematen zaio.
$HTTP_RAW_POST_DATA = isset( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA); //xml-a analizatu, funtzioa deitu eta erantzuna sortu egiten du.
?>