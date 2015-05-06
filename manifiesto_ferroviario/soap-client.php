<?php
require_once '../vendor/autoload.php';

// PREPARE POST
$query = Tools::prepareString(Tools::friendlyPost($_POST['query']));

if (!$query) {
	$query = 'consultarDetalleGuia';
}

// IF THERE'S NO POST RETURN 405 ERROR
// if($_SERVER['REQUEST_METHOD'] != 'POST' || !$query){http_response_code(405); die('NOT ALLOWED');}

// PREPARE SOAP
ini_set("soap.wsdl_cache_enabled", "0");
$options = array("location" => "http://edespacho.dev/soap-server.php", "uri" => "http://edespacho.dev/");

// WSDL's
$wsdl_lista_guia = 'https://www.ventanillaunica.gob.mx/ventanilla-ws-ferros/ConsultarListaGuiaFerrosService?wsdl'; 
$wsdl_detalle_guia = 'https://www2.ventanillaunica.gob.mx/ferros/ConsultarDetalleGuiaFerrosService?wsdl'; 

// ADRESSES
$address_lista_guia = 'https://www2.ventanillaunica.gob.mx:443/ferros/ConsultarListaGuiaFerrosService'; 
$address_detalle_guia = 'https://www2.ventanillaunica.gob.mx/ferros/ConsultarDetalleGuiaFerrosService?wsdl'; 

// PARAMETERS
$parameters_lista_guia = array('aduana' => '170', 'fechaInicial' => '2015-03-26', 'fechaFinal' => '2015-03-26',  'claveTransportista' => 'KCSM', 'numeroEquipo' => false, 'estatusBL' => false );
$parameters_detalle_guia = array('numeroBL' => '000001631155', 'claveTransportista' => 'KCSM', 'numeroEquipo' => false, 'estatusBL' => false );

switch ($query) {

        case 'consultarListaGuia':
            $wsdl = $wsdl_lista_guia;
            $address = $address_lista_guia;
            $parameters = $parameters_lista_guia;
            break;

        case 'consultarDetalleGuia':
            $wsdl = $wsdl_detalle_guia;
            $address = $address_detalle_guia;
            $parameters = $parameters_detalle_guia;
            break;
        
        default:
            $wsdl = $wsdl_lista_guia;
            $address = $address_lista_guia;
            $parameters = $parameters_lista_guia;

            break;
    }

try {

	$client = new WSSoapClient($wsdl, array('trace' => 1));
	// $client->__setUsernameToken('BAHJ610209LP4', 'AjqsT+BhThRKIftSjwVggS/V5reMO2wI/ISdZbqOe7ZdGQDHc1IsnNb+uguhpfhk', 'PasswordText');
	$client->__setUsernameToken('AIN051006884', 'Ecl5+TA2mvglVSfiruClGdyqo4eGng9A44YyXpJdNfWuuoF87Tp8jioswqTQF7ZZ', 'PasswordText');
	$client->__setLocation($address);
	$result = $client->__call($query, array('parameters' => $parameters));
	Response::WebServiceResponse($result);

} catch (SoapFault $e) {

    Response::renderJSON(array('ERROR'=>'SOAP ERROR', 'MSG' => $e));
}

