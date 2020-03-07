<?php

namespace App\Controllers;

use App\Models\Localidade;
use SON\Controller\Action;
use SON\Di\Container;
use App\Models\Endereco;

class LocalidadeCtrl extends Action{
   
    /**
     * Fun��o responsavel por retornar a listagem de locais.
     */
    public function getLocalidade() {
        
        $localidadeDao = Container::getDao("LocalidadeDao");
        $result = $localidadeDao->getList();
      
        return [
            "recordsTotal" => $result['total'],
            "data" => $result['results']
        ];
    }
    
    /**
     * Fun��o responsavel por retornar a listagem dos Patrimonios.
     */
    public function getAutoCompleteLocalidadeList()
    {
        $query = $this->getPostData();
        
        $localidadeDao = Container::getDao("LocalidadeDao");
        $result = $localidadeDao->getAutoCompleteList(['term' => $query['q']]);
        return [$result['results']];
    }
    
    /**
     * Fun��o responsavel por realizar o processo de cadastro de local.
     * @return json
     */
    public function cadastrarLocal()
    {
        $request = $this->getPostData();
        $constraint = $postData = array();
        
        $postData = [
            'localidade'    => $request['localidade'],
            'descricao'     => $request['descricao'],
            'cep'           => $request['cep'],
            'uf'            => $request['uf'],
            'bairro'        => $request['bairro'],
            'logradouro'    => $request['logradouro'],
            'numero'        => $request['numero'],
            'complemento'   => $request['complemento']
         ];
        
        $constraint = $this->checkPostData($postData, $constraint);
           
        if(count($constraint) > 0) {
            return array("constraint" => $constraint , "sucesso" => 0);
        } else {
            $localidade = Container::getClass("Localidade");
            $localidadeDao = Container::getDao("LocalidadeDao");
            $endereco = Container::getClass("endereco");
            
            $this->postDataToEntity($localidade, $postData);
            $this->postDataToEntityEndereco($endereco, $postData);
            
            $result = $localidadeDao->save($localidade, $endereco);

            if($result['success'] === true){
                return array("sucesso" => true, "msg" => $localidade->getDescricao()." cadastrada com sucesso.");
            } else {
                return array("sucesso" => false, "msg" => "Erro ao cadastrar localidade!".$result['msg'] );
            }
            unset($localidade);
            unset($endereco);
        }
    }
    
    /**
     * Fun��o responsavel por fazer a verifica��o dos valores do post
     * @param array $postData
     * @param array $constraint
     * @return number
     */
    private function checkPostData(array $postData, array $constraint)
    {
        if(!$postData['localidade']) $constraint['localidade'] =  "Campo (Localidade) invalida!";
        if(!$postData['descricao']) $constraint['descricao'] =  "Campo (Descricao) invalida!";
        if(!$postData['cep']) $constraint['cep'] =  "Campo (Cep) invalida!";
        if(!$postData['logradouro']) $constraint['logradouro'] =  "Campo (Logradouro) invalida!";
        if(!$postData['numero']) $constraint['numero'] =  "Campo (N�mero) invalida!";
        if(!$postData['complemento']) $constraint['complemento'] =  "Campo (Complemento) invalida!";
               
        return $constraint;
    }
    
    /**
     * Fun��o responsavel por preencher a entidde com os dados do post.
     * @param Localidade $entity
     * @param array $postData
     */
    private function postDataToEntity(Localidade $entity, array $postData)
    {
        $id_user_session = parent::getUserSession();
        $entity->setDescricao($postData['descricao']);
        $entity->setAtivo($postData['ativo'] ?? 1);
        $entity->setId_User_Session($id_user_session);
    }
    
    /**
     * Fun��o responsavel por preencher a entidade de endereco com os dados do post.
     * @param Endereco $entity
     * @param array $postData
     */
    private function postDataToEntityEndereco(Endereco $entity, array $postData)
    {
        $entity->setLocalidade($postData['localidade']);
        $entity->setCep($postData['cep']);
        $entity->setLogradouro($postData['logradouro']);
        $entity->setBairro($postData['bairro']);
        $entity->setNumero($postData['numero']);
        $entity->setComplemento($postData['complemento']);        
        $entity->setUf($postData['uf']);        
    }
   
    /**
     * Fun��o responsavel por retornar a listagem de locais.
     */
    public function getOptionLocal() {
        $localidadeDao = Container::getDao("LocalidadeDao");
        $response = $localidadeDao->getOption();
        
        $this->view->resultado=$response;
        $this->render('getOption','localidade');
    }
    
    /**
     * Fun��o responsavel por retornar a listagem de locais para a transferencia.
     */
    public function getOptionTransferencia() {
        
        $localidadeDao = Container::getDao("LocalidadeDao");
        $response = $localidadeDao->getOption();
        
        $this->view->resultado=$response;

        $this->render('getOptionTransferencia','localidade');
    }
    
    /**
     * Fun��o responsavel por retornar a listagem de locais para a transferencia.
     */
    public function getOptionDestino() {
        
        $localidadeDao = Container::getDao("LocalidadeDao");
        $response = $localidadeDao->getOption();
        
        $this->view->resultado=$response;
         
        $this->render('getOptionDestino','localidade');
    }

    /**
     * Fun��o responsavel por realizar o processo de atualizar um local
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
        unset($localidade);
        return $response;   
        
   }
}
