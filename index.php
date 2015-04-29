<?php
require_once __DIR__ . '/vendor/autoload.php';

    $answer = new Response();
	
	if (!$_POST) {
	    $answer->renderBasic();
	}else{
		if ($_POST['num_ref']) {
			$ref = new Referencia(Tools::prepareString(Tools::friendlyPost($_POST['num_ref'])));
			$json = $ref->getBasicInfo();
		    $answer->renderSearchResults(json_decode($json));
		}else{

			$answer->redirectWithMessage('w', 'Completa correctamente todos los campos','/manifiesto_ferroviario/ ');
		}
		 
	}
