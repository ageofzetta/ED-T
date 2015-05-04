<?php
header("Content-type: text/xml; charset=utf-8");

require('library.php');
$options = array("uri" => "http://localhost/manifiesto_ferroviario/");
$server = new SoapServer(null, $options);
$server->setClass('Guias');
$server->handle();