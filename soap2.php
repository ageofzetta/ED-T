<?php
ini_set("soap.wsdl_cache_enabled", "0");
$wsdl = 'https://www.ventanillaunica.gob.mx/ventanilla-ws-ferros/ConsultarListaGuiaFerrosService?wsdl'; 


$client = new SoapClient($wsdl, array('trace' => 1));

$params = array('aduana' => '190', 'fechaInicial' => '2012-03-15', 'fechaFinal' => '2012-05-25',  'claveTransportista' => '', 'numeroEquipo' => '', 'estatusBL' => '' );
$result = $client->consultarListaGuia($params);

echo "REQUEST:\n" . htmlentities($client->__getLastRequest()) . "\n";

$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    echo "Process Time: {$time}";