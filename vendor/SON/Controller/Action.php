<?php
namespace SON\Controller;
require_once("../lib/Template/Template.php");
use lib\Template\Template;

Class Action
{
    protected $view;
    protected $action;


    public function __construct() {
        $this->view = new \stdClass();  
    }
    
    /**
     * string acao
     * string pasta , pasta dendro da view q esta  o  seu estilo
     * string template por padrao e falso caso enviar positivo ira renderizar o template padrao
     * string titulo, titulo da tab no navegador
     * string script,   script da pagina
     * @desc
     *
     */
    public  function render($action, $pasta = 'index', $layout = false, $titulo = '', $script = ''  ) {
        $this->action = $action;
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        //para cada interacao irei verificar se  o usuario esta autenticado
        if( $this->action != 'autenticar' && $this->action != 'sair' && $this->action != 'index' ){
            if(!isset($_SESSION['usuario'])){
                header('Location: autenticar');
            }
        }
        
        if( $layout == true  && file_exists("../App/views/template/padrao.php") ){
            
            if (!$script){
                $script = $action;
            }
            
            $template = new Template("../app/views/template/padrao.php");
            $template->set("TITULO", $titulo);
            
            $menu = $this->requireToVar('../App/views/menu.php');
            $template->set("MENU", $menu);
            $template->set("SCRIPT", $script);
            //$conteudo = file_get_contents('../App/views/'.$pasta.'/'.$this->action.'.php');
            $conteudo = $this->requireToVar('../App/views/'.$pasta.'/'.$this->action.'.php');
            //$conteudo = include_once '../App/views/'.$pasta.'/'.$this->action.'.php';
            $template->set("CONTEUDO", $conteudo);
            echo $template->processar();
            
        }
        
        else{
            $this->content($pasta);
        }
        
    }
    
    /* public  function render($action,$pasta = "index")  //$layout=true
    {
        $this->action = $action;
        $this->content($pasta);          
            
    } */
    public function content($pasta) {
        $atual = get_Class($this);
        $singleClassName = strtolower(str_replace("App\\Controllers\\","",$atual));
        $singleClassName = $pasta;
       
        include_once '../App/views/'.$singleClassName."/".$this->action.".php";  
    }
     
    /**
     * FunÁ„o responsavel por retornar a requisiÁ„o em array
     */
    public function getPostData()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;
    }
    
    function requireToVar($file)
    {
        
        // Inicializa o buffer e bloqueia qualquer sa√≠da para o navegador
        ob_start();
        // Executamos o include () normalmente
        include $file;
        
        // Neste momento nenhuma sa√≠da foi enviada ao navegador
        // Recebemos o valor do buffer na vari√°vel $resultado
        $resultado = ob_get_contents();
        // J√° podemos encerrar o buffer e limpar tudo que h√° nele
        ob_end_clean();
        
        return $resultado;
        
    }
}
