<?php
namespace SON\Controller;

Class Action
{
    protected $view;
    protected $action;


    public function __construct() {
        $this->view = new \stdClass();  
    }
    
    public  function render($action,$pasta = "index")  //$layout=true
    {
        $this->action = $action;
        $this->content($pasta);          
            
    }
    public function content($pasta) {
        $atual = get_Class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\","",$atual));
        $singleClassName = $pasta;
       
        include_once '../App/views/'.$singleClassName."/".$this->action.".php";  
    }
     
    /**
     * Fun��o responsavel por retornar a requisi��o em array
     */
    public function getRequest()
    {
        return $_REQUEST;
    }
}
