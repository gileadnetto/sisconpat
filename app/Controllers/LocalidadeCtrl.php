<?php

namespace App\Controllers;

use App\Models\Localidade;
use SON\Controller\Action;
use SON\Di\Container;

class LocalidadeCtrl extends Action{
   
    /**
     * Função responsavel por retornar a listagem de locais.
     */
    public function getLocalidade() {
        $localidadeDao = Container::getDao("LocalidadeDao"); 
        $result = $localidadeDao->getList();
        echo json_encode(array("recordsTotal" => $result['total'], "data" => $result['results']));
    }
    
    /**
     * Função responsavel por realizar o processo de deletar um local.
     */
    public function deleteLocal() {
        $request = $this->getRequest();
        $constraint = $postData = array();
        
        $postData = [
            'id_local' => $request['id_local']
        ];
        
        //$this->checkPostData($postData, $constraint);
        
        if(count($constraint) > 1) {
            echo array('success' => 0,'constraint' => $constraint);
        } else {
            $localidadeDao = Container::getDao("LocalidadeDao");
            $response = $localidadeDao->deletar($postData['id_local']);
                 
            $result = array_merge(array('success' => 1), $response);
            $response = json_encode($result);
        	unset($localidadeDao);
        	
        	echo $response;
        }
    }
    
    /**
     * Função responsavel por realizar o processo de cadastro de local.
     * @return number[][]|string
     */
    public function cadastrarLocal() {
        $request = $this->getRequest();
        $constraint = $postData = array();
        
        $postData = [
            'localidade' => $request['localidade'],
            'endereco' => $request['endereco']
        ];
        
        $this->checkPostData($postData, $constraint);
           
        if(count($constraint) > 0) {
            echo explode(',', $constraint);
        } else {
            $localidade = Container::getClass("Localidade");
            $localidadeDao = Container::getDao("LocalidadeDao");
            
            $this->postDataToEntity($localidade, $postData);
           
            $local = $localidade->jsonSerialize();    
            
            $response = $localidadeDao->cadastrar($local);
            $response = json_encode($response);
            unset($localidade);
            echo $response;   
        }
    }
    
    /**
     * Função responsavel por fazer o check dos valores do post
     * @param array $postData
     * @param array $constraint
     * @return number
     */
    private function checkPostData(array $postData, array &$constraint)
    {
        //if($postData['id_local']) $constraint['id_local'] = 'ID Local invalido!';
        
        if(!$postData['localidade']) $constraint['localidade'] = 'Localidade invalida!';
        
        if(!$postData['endereco']) $constraint['endereco'] = 'Endereço invalido!';
        
        return $constraint;
    }
    
    /**
     * Função responsavel por preencher a entidde com os dados do post.
     * @param Localidade $entity
     * @param array $postData
     */
    private function postDataToEntity(Localidade $entity, array $postData)
    {
        $entity->setDescricao($postData['localidade']);
        $entity->setEndereco($postData['endereco']);
        $entity->setAtivo(1);
    }
    
    /**
     * Função responsavel por retornar a listagem de locais.
     */
    public function getOptionLocal() {
        $localidadeDao = Container::getDao("LocalidadeDao");
        $response = $localidadeDao->getOption();
        
        $this->view->resultado=$response;
        $this->render('getOption','localidade');
    }
    
    /**
     * Função responsavel por retornar a listagem de locais para a transferencia.
     */
    public function getOptionTransferencia() {
        
        $localidadeDao = Container::getDao("LocalidadeDao");
        $response = $localidadeDao->getOption();
        
        $this->view->resultado=$response;

        $this->render('getOptionTransferencia','localidade');
    }
    
    /**
     * Função responsavel por retornar a listagem de locais para a transferencia.
     */
    public function getOptionDestino() {
        
        $localidadeDao = Container::getDao("LocalidadeDao");
        $response = $localidadeDao->getOption();
        
        $this->view->resultado=$response;
         
        $this->render('getOptionDestino','localidade');
    }

    /**
     * Função responsavel por realizar o processo de atualizar um local
     */
    public function atualizarLocal() {
        
        $id         = $_POST['id_atualizacao'];
        $descricao  = $_POST['local'];
        $endereco   = $_POST['endereco'];
        
        $localidade = Container::getClass("Localidade");
        $localidadeDao = Container::getDao("LocalidadeDao");

        $localidade->setid($id);
        $localidade->setdescricao($descricao);
        $localidade->setEndereco($endereco);

        $localidades = $localidade->jsonSerialize();        
        $response = $localidadeDao->atualizar($localidades);
        $response = json_encode($response);
        unset($localidade);
        print_r($response);   
        
   }
}
