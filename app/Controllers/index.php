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
        $this->render('home');
    }
    
     public function LocalidadeIndex() {           
        $this->render('localidade');
    }
    
    public function itemIndex() {           
        $this->render('itens');
    }
    
     public function transferenciaIndex() {           
        $this->render('transferencia');
    }
    
    public function minhastransferenciasIndex() {           
        $this->render('minhas_transferencias');
    }
    
     public function relatorioIndex() {           
        $this->render('relatorio');
    }
    
    public function administradorIndex() {           
        $this->render('administrador');
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

