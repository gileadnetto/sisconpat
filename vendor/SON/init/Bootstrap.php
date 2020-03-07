<?php

namespace SON\Init;
abstract Class Bootstrap{
      private $routes;
        
        public function  __construct() {
            $this->initRoutes();
            $this->run($this->getUrl());           
        }
        
        abstract protected function initRoutes();        
        
        protected function setRoutes(array $routes ) {
            
            $this->routes = $routes;
            
        }
        
        protected function run($url) { 
            // verificar se a url é exite
            array_walk($this->routes, function($route) use ($url){  
                //echo "/sisconpat/public".$route['route']."<br>";
                if($url == "/sisconpat/www".$route['route']){
                   
                    $class = "App\\Controllers\\".ucfirst($route['controller']);

                    $controller = new $class;
                    $action = $route['action'];
                    $retorno = $controller->$action();
                  
                    if(json_encode($retorno)) {
                        $retorno = json_encode($retorno);
                    }

                    echo $retorno;
                }
                
            }) ;
           
        }

        public function getUrl() {
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
        
 }

