<?php
require_once __DIR__ . '/vendor/autoload.php';

if (!$_POST) {
    
    $answer = new Response();
    $answer->renderBasic();
}else{

}
// 