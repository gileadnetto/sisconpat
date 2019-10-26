<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;
use App\Models\Transferencia;
use App\Models\TransferenciaItem;
use App\Models\Patrimonio;

class TransferenciaCtrl extends Action {
    private $transferenciaDao;
    private $transferenciaModel;
    private $transferenciaItemModel;
    
    public function getItensTransferencia() {
        $local_inicial = $_POST['local_inicial'];
        $transferenciaDao = Container::getDao("TransferenciaDao");      
        $response = $transferenciaDao->getItensTransferencia($local_inicial);
		//$resultado  = json_encode($response);
		$this->view->resultado=$response;
		$this->render('getItensTransferencia','transferencia');   
    }
    
    /**
     * Função responsavel por realizar o processo de transferencia, transferencia item e a localização dos produtos.
     * @return array
     */
    public function transferir()
    {
        $postData = $this->getPostData();
        
        $constraint = $this->checkPostData($postData);
        
        if(count($constraint) > 0) echo $constraint;

        try{
            $this->realizarTransferencia($postData);
            $this->realizaTransferenciaItens();
            $this->atualizaLocaisPatrimonio();          
        } catch (\Exception $e){
            echo $e->getMessage();   
        }
        
        echo ['sucesso' => 1, 'msg' => 'Transferencia realizada com sucesso!' ];
	}
	
	/**
	 * Função responsavel por verificar os dados do post
	 * @param array $postData
	 * @return array
	 */
	private function checkPostData(array $postData)
	{
	    $constraint = [];
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
	    
	    $daoTransferenca->transferir($entityTransferencia);
	}	
	
	/**
	 * função responsavel por montar a entidade com os dados do post
	 * @param Transferencia $entidadeTransferencia
	 * @param array $arrData
	 */
	private function fillEntityTransferencia(Transferencia $entidadeTransferencia, array $arrData) 
	{
	    $entidadeTransferencia->exchangeArray($arrData);
	}
	
	/**
	 * Função responsavel por atualizar a localização dos patrimonios
	 * @param array $arrData
	 */
	private function atualizaLocalizacaoPatrimonio(array $arrData)
	{
	    $entityPatrimonio = Container::getClass("Patrimonio");
	    $patrimonioDao = Container::getDao("PatrimonioDao");
	    
	    foreach($_checkbox as $_patrimonio_id){
	        $patrimonio = $patrimonioDao->getById($_patrimonio_id);
	        $patrimonio->setIdLocalidade($ID);
	        $patrimonioDao->atualizarLocalPatrimonio($entityPatrimonio);
	    }
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
	
	/**
	 * Função responsavel pore realizar o processo de transferencia dos itens
	 * @param array $arrData
	 */
	private function realizaTransferenciaItem(array $arrData)
	{
	    $entityTransferenciaItem = Container::getClass("TransferenciaItem");
	    $transferenciaDao = Container::getDao("TransferenciaDao");
	    
	    foreach($_checkbox as $_patrimonio_id){
	        $this->fillEntityTransferenciaItem($entityTransferenciaItem, $arrData);
	        $transferenciaDao->transferir_item($entityTransferenciaItem);
	    }
	}
	
	/**
	 * função responsavel por montar a entidade de transferencia item com os dados do post
	 * @param array $arrData
	 * @param TransferenciaItem $entidadeTransferenciaItem
	 */
	private function fillEntityTransferenciaItem(TransferenciaItem &$entidadeTransferenciaItem, array $arrData)
	{
	    $entidadeTransferenciaItem->exchangeArray($arrData);
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
