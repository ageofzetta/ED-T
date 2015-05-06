<?php
/**
 * Ésta Clase comprende una Serie de funciones para manipular strings.
 * @author Jahzeel Tapia - https://github.com/ageofzetta/
 */

 class Tools
 {

	/**
	 * Escapa un string
	 * 
	 * @param string $str
	 * @return string 
	 */

 	public static function friendlyPost ($str) {
 		$new = htmlspecialchars_decode(htmlentities($str, ENT_NOQUOTES, 'UTF-8'), ENT_NOQUOTES);
 		return $new;
 	}

	/**
	 * Decodifica un string previamente escapado.
	 * 
	 * @param string $str
	 * @return string
	 */

 	public static function prepareString($str){
 		// if(substr($str, -1) == '/') {
 		// 	$str = substr($str, 0, -1);
 		// }
 		return html_entity_decode(trim($str));
 	}

	/**
	 * Valida un objeto|string como XML válido
	 * 
	 * @param string|object $xml_string
	 * @return object $xml
	 */
 	
 	public static function prepareXML($xml_string){

 		libxml_use_internal_errors(true);

		$namespaces = array("ns1:","ns2:","ns3:","ns4:","ns5:","ns6:","ns7:","ns8:","ns9:","ns10:","ns11:","S:","wsu:");
	    $xml_string = str_replace($namespaces, "", $xml_string);
	    $xml = @simplexml_load_string($xml_string);
	    if (!$xml) {
	    	foreach(libxml_get_errors() as $error) {
		    	Response::renderJSON(array('ERROR'=>'INVALID XML: '.$error->message));

		    }
	    }
	    return $xml;
 		
 	}


	public static function TieneError($obj){
	    foreach(get_object_vars($obj) as $property => $value) {
	        if ($property == 'tieneError') {
	         return filter_var($value, FILTER_VALIDATE_BOOLEAN); 
	         break;
	        }else{
	            if (is_object($obj->$property)) {
	                $newObj = $obj->$property;
	                foreach(get_object_vars($newObj) as $newproperty => $newvalue) {
	                    if ($newproperty == 'tieneError') {
	                        return filter_var($newvalue, FILTER_VALIDATE_BOOLEAN); 
	                        break;
	                    }else{
	                        $newObj2 = $newObj->$newproperty;
	                        if(is_object($newObj2)){
	                            foreach (get_object_vars($newObj2) as $property2 => $value2) {
	                                if ($property2 == 'tieneError') {
	                                 return filter_var($value2, FILTER_VALIDATE_BOOLEAN); 
	                                 break;
	                                }
	                            }

	                        }
	                    }
	                }
	            }
	        }
	    }
	}

 	public static function clearCookies(){
 		if (isset($_SERVER['HTTP_COOKIE'])) {
 			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		    foreach($cookies as $cookie) {
		        $parts = explode('=', $cookie);
		        $name = trim($parts[0]);
		        setcookie($name, '', time()-1000);
		        setcookie($name, '', time()-1000, '/');
		    }
		}
 	}
 } 