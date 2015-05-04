<?php
require_once __DIR__ . '/vendor/autoload.php';
header('Content-Type: application/json');
// echo "<xmp>";
$namespaces = array("ns1:","ns2:","ns3:","ns4:","ns5:","ns6:","ns7:","ns8:","ns9:","ns10:","ns11:","S:","wsu:");
$options = array("location" => "http://edespacho.dev/soap-server.php",
    "uri" => "http://edespacho.dev/");
try {
    $client = new SoapClient(null, $options);

// LISTA

    $response = $client->consultarListaGuia();
    $xml_string = str_replace($namespaces, "", $response);
    $xml = simplexml_load_string($xml_string);
    if ($xml !== false && $xml->tieneError == false) {
    	echo json_encode($xml->Body->listaGuiaRespuesta);
    }

// DETALLE

/*
    $response = $client->consultarDetalleGuia();
    $xml_string = str_replace($namespaces, "", $response);
    $xml = simplexml_load_string($xml_string);

    if ($xml !== false && $xml->Body->detalleGuiaRespuesta->tieneError == 'false') {

	$obj = $xml->Body->detalleGuiaRespuesta->manifiesto;
    	echo json_encode($obj);
    }
*/
} catch (SoapFault $e) {

    echo json_encode(array('SOAP ERROR'=>$e));
}