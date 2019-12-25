<?php


namespace application\core;


class View
{
    public $path;//путь к виду
    public $layout='default';//путь к шаблону
    public $footer='footer';//путь к футеру

    public $route;
    public function __construct($route)
      {
        $this->route=$route;
        $this->path=$route['controller'].'/'.$route['action'];

       }

     public function render($title,$vars=[]){
        extract($vars);

        ob_start();
        require 'application/view/'.$this->path.'.php';
       $content= ob_get_clean();
         ob_start();
         require 'application/view/layouts/'.$this->footer.'.php';
         $foot= ob_get_clean();

         require 'application/view/layouts/'.$this->layout.'.php';
      }
      public static function errorCode($code){
        http_response_code($code);
        require 'application/view/errors/'.$code.'.php';
        exit;
      }
    public function message($status,$message){

        exit( json_encode(['status'=>$status,'message'=> $message]));
    }
    public function redirect($url){
       header('location:'.$url);
        exit();
    }
    public function location($url) {

        exit(json_encode(['url' => $url]));
    }

}