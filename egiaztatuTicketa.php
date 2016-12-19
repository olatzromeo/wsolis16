<?php
require_once('nusoap/lib/nusoap.php');
require_once('nusoap/lib/class.wsdlcache.php');

//$ns="http://probakws.hol.es/wsolis16-2";

$server    = new soap_server(); //soap_server objektua
$namespace = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$server->configureWSDL('konprobatuTicketa',$namespace );
$server->wsdl->schemaTargetNamespace = $namespace;

$server->register('konprobatuTicketa', array('ticket'=>'xsd:string'),array('erantz'=>'xsd:string'), $namespace, $namespace."#konprobatuTicketa",'rpc',
    'encoded','baliozko ticketa itzultzen du');


function konprobatuTicketa($ticket) {

$fitxategi = 'ticketak.txt';
$searchfor = $ticket;

// get the file contents, assuming the file to be readable (and exist)
$contents = file_get_contents($fitxategi);

// escape special characters in the query
$pattern = preg_quote($searchfor, '/');

// finalise the regular expression, matching the whole line
$pattern = "/^.*$pattern.*\$/m";

// search, and store all matching occurences in $matches
       if(preg_match_all($pattern, $contents, $matches)){
           return 'BALIOZKOA';
       }else{
           return 'BAIMENIK GABEKO ERABILTZAILEA';
       }

}


//parametroak pasa ez badira, string hutsa balioa ematen zaio.
$HTTP_RAW_POST_DATA = isset( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA); //xml-a analizatu, funtzioa deitu eta erantzuna sortu egiten du.

?>