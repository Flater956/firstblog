<?php

namespace application\core;
use application\core\View;
class Router

{

    protected $rout = [];
    protected $param = [];


    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $value) {
            $this->add($key, $value);
        }
        $this->run();

    }


    public function add($route, $params)
    {
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);

        $route = '#^' . $route . '$#';
        $this->rout[$route] = $params;

    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');




        foreach ($this->rout as $rout => $param) {


            if (preg_match($rout, $url,$matches)) {


                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }

                $this->param = $param;

                return true;

            }
        }
        return false;

    }

    public function run()
    {
        if ($this->match()) {

            $path = 'application\controllers\\' . ucfirst($this->param['controller']) . 'Controller';

            if (class_exists($path)) {

                $action = $this->param['action'] . 'Action';


                if (method_exists($path, $action)) {

                    $controller = new $path($this->param);
                    $controller->$action();

                }else{
            View::errorCode(404);
             }
         }else{
              View::errorCode(404);
         }
      }else{
           View::errorCode(404);

          }

        }
    }
