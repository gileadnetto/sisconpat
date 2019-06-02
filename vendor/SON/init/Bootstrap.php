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
            foreach ($this->routes as $key => $rota ){
                if($url == "/sisconpat/www".$rota['route']){
                    $class = "App\\Controllers\\".ucfirst($rota['controller']);
                    $controller = new $class;
                    $action = $rota['action'];
                    $controller->$action();
                }
            }
        }

        public function getUrl() {
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
        
 }

