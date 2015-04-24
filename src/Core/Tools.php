<?php
/* 
	Misc functions to escape and clean strings
*/

 class Tools
 {
 	public static function friendlyPost ($str = '') {
 		$new = htmlspecialchars_decode(htmlentities($str, ENT_NOQUOTES, 'UTF-8'), ENT_NOQUOTES);
 		return $new;
 	}
 	public static function prepareString($string){
 		if(substr($string, -1) == '/') {
 			$string = substr($string, 0, -1);
 		}
 		return html_entity_decode(trim($string));
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