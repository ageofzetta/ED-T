<?php
require_once __DIR__ . '/vendor/autoload.php';

    $answer = new Response();
	
	if (!$_POST) {

	    $answer->renderBasic();

	}else{

		$num_ref = Tools::prepareString(Tools::friendlyPost($_POST['num_ref']));

		if ($num_ref && strlen($num_ref) == 15) {
			
			$ED = 	new EDespacho(array('referencia' => $num_ref), false);
			$basicInfo = $ED->getBasicInfo($num_ref);
			// $ED->
			var_dump($ED);
		    // $answer->renderSearchResults($basicInfo);


		}else{

			$answer->redirectWithMessage('w', 'Complete correctamente todos los campos','/manifiesto_ferroviario/ ');
		}
		 
	}


