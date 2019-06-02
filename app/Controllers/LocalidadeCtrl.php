<?php

namespace App\Controllers;

use SON\Controller\Action;
//use App\Models\Artigo;
use SON\Di\Container;

class LocalidadeCtrl extends Action{
   
    public function getLocalidade() {
               
        $localidade = Container::getClass("Localidade"); //instacinado a classe e a conexao banco
        $response = $localidade->listar();
        
        //$localidades  = json_decode($response);
        $localidades  = $response;
        $this->view->localidades=$localidades;
        unset($localidade);
                    
        $this->render('getlocalidade','localidade');
      
    }
    
    
    public function deletLocal() {
        $id_local =$_POST['id_local'];
        $localidade = Container::getClass("Localidade"); //instacinado a classe e a conexao banco
        $response = $localidade->deletar($id_local);
             
		$response = json_encode($response);
		unset( $localidade);
        echo $response; 
    }
    
    public function cadastrarLocal() {
                
        $descricao = $_POST['loc'];
        $endereco = $_POST['endereco'];
        
        $localidade = Container::getClass("Localidade");
        
        $localidade->setdescricao($descricao);
        $localidade->setEndereco($endereco);

        $local = $localidade->jsonSerialize();    

        $response = $localidade->cadastrar($local);
        $response = json_encode($response);
        unset($localidade);
        echo $response;   
                      
        
    }
    
    public function getOptionLocal() {
        
        $localidade = Container::getClass("Localidade");
        $response = $localidade->getOption();
        
        $this->view->resultado=$response;
        $this->render('getOption','localidade');
    }
    
    public function getOptionTransferencia() {
        
        $localidade = Container::getClass("Localidade");
        $response = $localidade->getOption();
        
        $this->view->resultado=$response;

        $this->render('getOptionTransferencia','localidade');
    }
    
    public function getOptionDestino() {
        
        $localidade = Container::getClass("Localidade");
        $response = $localidade->getOption();
        
        $this->view->resultado=$response;
         
        $this->render('getOptionDestino','localidade');
    }

    public function atualizarLocal() {
        
        $id         = $_POST['id_atualizacao'];
        $descricao  = $_POST['local'];
        $endereco   = $_POST['endereco'];
        
        $localidade = Container::getClass("Localidade");

        $localidade->setid($id);
        $localidade->setdescricao($descricao);
        $localidade->setEndereco($endereco);

        $localidades = $localidade->jsonSerialize();        
        $response = $localidade->atualizar($localidades);
        $response = json_encode($response);
        unset($localidade);
        print_r($response);   
        
   }
}
