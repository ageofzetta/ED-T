<?php
require_once __DIR__ . '/vendor/autoload.php';

if (!$_POST) {
    $answer = new Response();
    $answer->renderBasic();
}else{
	// $id = 'LAR08-02734-I01';
	$ref = new Referencia(Tools::friendlyPost($_POST['num_ref']));
	echo $ref->getBasicInfo();
}
// 