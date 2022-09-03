<?php

class App{
    protected $controller = 'solutionController';
    protected $method = 'index';
    protected $param = [];

    public function __construct()
    {
       $url = $this->parseUrl();

        if(!isset($url[0])){
            require_once 'app/controllers/'.$this->controller.'.php';
            $this->controller = new $this->controller;
            call_user_func_array([$this->controller, $this->method], []);
        }
       /**
        * Check Controller found or Not
       **/
       if(file_exists('app/controllers/'.$url[0].'Controller.php')){
           $this->controller = $url[0].'Controller';
           unset($url[0]);
       }else{
           echo "$url[0] controller not found";
           die;
       }

       require_once 'app/controllers/'.$this->controller.'.php';
       $this->controller = new $this->controller;


        /**
         * Check Method found or Not into controller
         **/
       if(isset($url[1])){
           $methodName = 'solution'.$url[1];
           if(method_exists($this->controller, $methodName)){
              $this->method = $methodName;
              unset($url[1]);
           }else{
               echo "solution$url[1] method not found";
               die;
           }
       }else{
           echo "Wrong parameter, Please try with right parameter ";
           die;
       }

       /**
        * check parameters
       **/
       $this->param = $url? array_values($url):[];

       /**
        * Here method always index selected
       **/
       call_user_func_array([$this->controller, $this->method], $this->param);
    }

    public function parseUrl()
    {
        if(isset($_GET['url'])){
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}