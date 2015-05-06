<?php

/**
   * Clase Response contiene varios métodos para genererar 'Respuestas' a una petición.
   */
   class Response
   {
    private $csrf_field;
    private $products;
   	private $img;

   	function __construct($csrf_field = 1,$products = 2) {
      $this->products = $products;
      $this->csrf_field = $csrf_field;
      
    }

  /**
  * Example of documenting multiple possible datatypes for a given parameter
  * @param bool|string $foo sometimes a boolean, sometimes a string (or, could have just used "mixed")
  * @param bool|int $bar sometimes a boolean, sometimes an int (again, could have just used "mixed")
  */

    public static function startTwig($template){
      genera_menu(0,1,true,true,"UTF-8");

      /* I use Twig as template http
      engine://twig.sensiolabs.org/documentation */

      /// Initialize Twig
      $loader = new Twig_Loader_Filesystem('views/templates');
      
      //For Developement
      $twig = new Twig_Environment($loader, array(
        'cache' => false,  'debug' => true,
      ));
      $twig->addExtension(new Twig_Extension_Debug());
      //For Developement

      /* Production (cached)
      $twig = new Twig_Environment($loader, array(
        'cache' => 'views/compilation_cache'
        ));
      */

      // Load Template
      $template = $twig->loadTemplate($template);
      return $template;
    }

    public static function redirectWithMessage($code,$text,$url) {
      $msg = new Messages();
      $msg->add($code,$text,$url);
    }

    public static function renderJSON($x){
      header('Content-Type: application/json');
      echo json_encode($x);exit;

    }

    public static function WebServiceResponse($xml){
      if (!$xml) {
        self::renderJSON(array('ERROR'=>'NO SERVER RESPONSE'));
      }

      if(!is_object($xml)){
            $xml = Tools::prepareXML($xml);        
      }

      if ($xml) {
        if (!Tools::TieneError($xml)) {
          self::renderJSON($xml);
        }else{
          self::renderJSON(array('ERROR'=>$xml->error));
        }
      }else{
        self::renderJSON(array('ERROR'=>'INVALID XML'));
      }

      
    }
     

    public function renderBasic($message = false){
      $msg = new Messages();
      $message = $msg->display('all',false);
      // Generate the graph
      // Start twig using the following template      
      $template = self::startTwig('inicio.html.twig');

      // We send the products array, the graph and the anti-CRSF input field to render it and echo the result
      echo $template->render(array('message' => $message, 'focus_head' => true));
      exit;
    }

    public function renderSearchResults($json){
      $jsonObj = json_decode($json);
      if (!$jsonObj->ok) {
        $this->redirectWithMessage('i', ''.$jsonObj->msg.'','/manifiesto_ferroviario/ ');
      }
      $template = self::startTwig('resultados_referencia.html.twig');
      echo $template->render(array('Referencia' => $jsonObj->data));
      exit;

    }
 


  }   