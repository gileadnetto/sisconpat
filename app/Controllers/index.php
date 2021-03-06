<?php
namespace App\Controllers;

use SON\Controller\Action;
//use App\Models\Artigo;
use SON\Di\Container;

Class Index extends Action{
   
    public function index() {            
        $this->render('index');
    }
    
    public function erro() {
        $this->render('error');
    }
    
    public function homeIndex() {
        $this->render('home','index', true, '','home');
    }
    
     public function LocalidadeIndex() {           
        $this->render('localidade','index', true, 'Local', 'local');
    }
    
    public function itemIndex() {           
        $this->render('itens','index', true, 'Produtos', 'itens');
    }
    
     public function transferenciaIndex() {           
        $this->render('transferencia','index', true, 'Transferencia', 'transferencias');
    }
    
    public function minhastransferenciasIndex() {           
        $this->render('minhas_transferencias','index', true, 'Minhas Transferencia', 'minha_transferencias');
    }
    
     public function relatorioIndex() { 
        $this->render('relatorio','index', true, 'Relatorio', 'relatorio');          
    }
    
    public function administradorIndex() {           
        $this->render('administrador','index', true, 'Administrador', 'administrador');   
    }
    
    
    public function sair() {
        session_start();
        unset($_SESSION['usuario']);
        unset($_SESSION['email']) ;
        unset($_SESSION['pg']) ;
        unset($_SESSION['perfil']);

        $this->render('index');
     //   header('Location:  ');;
    }
    
    public function autenticar() {
        $this->render('autenticar','erro');
    }
}

