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
     
        
       // if($layout = true  && file_exists("../App/views/layout.php"))
          //  {
         //   include_once '../App/views/layout.php';
          //  }
            
        // else{
			$this->content($pasta);          
        // }
            
         }
         public function content($pasta) {
           
            $atual = get_Class($this);
            //echo $atual;
            $singleClassName = strtolower(str_replace("App\\Controllers\\","",$atual));
            
          // echo "<br><br>".'../App/views/'.$singleClassName."/".$this->action.".php";
           $singleClassName=$pasta;
           
           include_once '../App/views/'.$singleClassName."/".$this->action.".php";  
            //echo '../App/views/'.$singleClassName."/".$this->action.".php"; 
         }
}
