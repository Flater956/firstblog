<?php


namespace application\core;
use  application\core\View;



abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;
    public $postId;
    public function __construct($route)
    {

        $this->route = $route;

         $this->postId=$this->getId();

       if( $this->chekAcl()==true) {
           $this->view = new View($route);
           $this->model = $this->loadModel($route['controller']);
       }else{
           View::errorCode('403');
       }
    }

      public function getId(){
          $arr=explode('/',trim($_SERVER['REQUEST_URI'], '/'));

          return array_pop($arr);
      }

    public function loadModel($name){
        $path='application\models\\'.ucfirst($name);

        if (class_exists($path)){

            return new $path;
        }



    }
    public function chekAcl(){
        $this->acl= require ('application/acl/'. $this->route['controller'].'.php');
        if ($this->isAcl('all')){
            return true;
        }
        elseif (($this->isAcl('authorise')) and  (isset($_SESSION['authorise']['id']) )){
            return true;
        } elseif (($this->isAcl('admin')) and  (isset($_SESSION['admin']) )){
            return true;

        }
   }
   public function isAcl($key){
        return in_array($this->route['action'],$this->acl[$key]);
   }
}