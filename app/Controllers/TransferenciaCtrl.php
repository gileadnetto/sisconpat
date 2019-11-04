<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;
use App\Controllers\Helpers\Validadores;
use App\Models\Transferencia;
use App\Models\TransferenciaItem;
use App\Models\Patrimonio;
use App\Controllers\Helpers\dateHelper;

class TransferenciaCtrl extends Action {
    private $transferenciaDao;
    private $transferenciaModel;
    private $transferenciaItemModel;
    
    /**
     * Função responsavel por retornar a listagem de transferencias.
     */
    public function getTransferencia() {
        $transferenciaDao = Container::getDao("TransferenciaDao");
        $result = $transferenciaDao->getList();
        echo json_encode(array("recordsTotal" => $result['total'], "data" => $result['results']));
    }
    
    /**
     * Função responsavel por realizar o processo de transferencia, transferencia item e a localização dos produtos.
     * @return array
     */
    public function transferir()
    {
        $postData = $this->getPostData();

        $data = $this->buildArrayPostData($postData);
        
        $constraint = $this->checkPostData($data);
        
        if(count($constraint) > 0) {
            echo ['sucesso' => false, 'msg' => $constraint ];;
            return;
        }

        try{
            $this->realizarTransferencia($data);
        } catch (\Exception $e){
            echo $e->getMessage();   
        }
        
        echo ['sucesso' => 1, 'msg' => 'Transferencia realizada com sucesso!' ];
	}
	
	private function buildArrayPostData($idsPatrimonio)
	{
	    $dados = [];
	    foreach($idsPatrimonio['data'] as $key){
	        if($key['name'] == 'Patrimonios') {
	            $dados['idsPatrimonios'][] = $key['value'];
	        }
	        else if($key['name'] == 'data'){
	            $dados[$key['name']] = dateHelper::dateFormatBD($key['value']);
	        } else
	            $dados[$key['name']] = $key['value'];
	    }
	    
	    return $dados;
	}
	
	/**
	 * Função responsavel por verificar os dados do post
	 * @param array $postData
	 * @return array
	 */
	private function checkPostData(array $postData)
	{
	    $constraint = [];
	    
	    Validadores::validar($postData, 'Origem', validadores::TYPE_ID, $constraint);
	    Validadores::validar($postData, 'Destino', validadores::TYPE_ID, $constraint);
	    Validadores::validar($postData, 'data', validadores::TYPE_DATE, $constraint,'','Y-m-d');
	    Validadores::validar($postData, 'idsPatrimonios', validadores::TYPE_ARRAY_ID, $constraint);	    
	    
	    return $constraint;
	}
	
	/**
	 * Função responsavel por realizar o processo de transferencia
	 * @param array $arrData
	 */
	private function realizarTransferencia(array $arrData)
	{
	    $entityTransferencia = Container::getClass("Transferencia");
	    $daoTransferenca = Container::getDao("TransferenciaDao");
	    
	    $this->fillEntityTransferencia($entityTransferencia, $arrData);
	    
	    $daoTransferenca->transferir($entityTransferencia, $arrData['idsPatrimonios']);     
	}	
	
	/**
	 * função responsavel por montar a entidade com os dados do post
	 * @param Transferencia $entidadeTransferencia
	 * @param array $arrData
	 */
	private function fillEntityTransferencia(Transferencia $entidadeTransferencia, array $arrData) 
	{
	    $id_user_session = parent::getUserSession();
	    $data = array_merge(['id_user_session' => $id_user_session], $arrData);
	    $entidadeTransferencia->exchangeArray($data);
	}
	
	/**
	 * Função responsavel por preencher a entidade de patrimonio
	 * @param Patrimonio $entityPatrimonio
	 * @param array $arrData
	 */
	private function fillEntityPatrimonio(Patrimonio $entityPatrimonio, array $arrData)
	{
	    $entityPatrimonio->exchangeArray($arrData);
	}
    
    public function getMinhasTransferencias() {
		session_start(); 
		$id_usuario = $_SESSION['id_usuario'];
        $transferenciaDao = Container::getDao("TransferenciaDao");      
        $response = $transferenciaDao->getMinhasTransferencias($id_usuario);

		$this->view->resultado=$response;
		$this->render('getMinhasTransferencias','transferencia');
    }
    
	public function gerarPDF() {
		$idTransferencia = intval($_GET['idTransferencia']); 
		$transferenciaDao = Container::getDao("TransferenciaDao");
		$response = $transferenciaDao->gerarPDF($idTransferencia);
		
		$response  = json_encode($response);
		$this->view->resultado=$response;
		$this->render('gerarPDF','transferencia');
    }
     
    public function gerarPDFTransferencia() {
        
		$idTransferencia = (int) ($_GET['idTransferencia']);
		$transferenciaDao = Container::getDao("TransferenciaDao");
		$response = $transferenciaDao->gerarPDF($idTransferencia);
	
		//$resultado  = json_encode($response);
	
		$this->view->resultado=$response;
		$this->render('gerarPDFTransferencia','transferencia');
         
    }
    
        public function gerarPDFEmprestimo() {
                            
           
         $this->render('gerarPDFTermoEmprestimo','transferencia');
       
         
    }
    
}
