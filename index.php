<?php
// Respuesta
// WebService Falso
$response = json_decode(file_get_contents('guias.json'));

if($response->listaGuiaRespuesta->tieneError === 'true'){
	 var_dump($response->listaGuiaRespuesta->tieneError);
} 
$guias = $response->listaGuiaRespuesta->guia;
var_dump($guias[0]); 