<?php
require_once __DIR__ . '/vendor/autoload.php';


$options = array("location" => "http://edespacho.dev/soap-server.php", "uri" => "http://edespacho.dev/");
$query = Tools::prepareString(Tools::friendlyPost($_POST['query']));



// if($_SERVER['REQUEST_METHOD'] != 'POST' || !$query){http_response_code(405); die('NOT ALLOWED');}

try {

    $client = new SoapClient(null, $options);

            $response = $client->consultarListaGuia();    


    Response::WebServiceResponse($response);


} catch (SoapFault $e) {

    Response::renderJSON(array('ERROR'=>'SOAP ERROR', 'MSG' => $e));
}