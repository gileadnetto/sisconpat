<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

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
     * * função responsavel por montar a entidade com os dados do post
     * @param array $post
     */
    public function postDataToEntity() {
        return $this->transferenciaModel->exchangeArray($_POST);        
    }
    
    public function transferir(){
        $getPost = $_POST; //Recupera o post
        
        //Inicialização dos models e DAO
        $this->transferenciaModel = Container::getClass("Transferencia");
        $this->transferenciaDao = Container::getDao("TransferenciaDao");
        
        $constraint = $this->transferenciaModel->checkConstraint($getPost);
        
        if($constraint.lenght > 1) {
            return $constraint;
        }
        
        $entity = $this->postDataToEntity($getPost);
        
        $entity = $entity->jsonSerialize();
        
        $response = $this->transferenciaDao->transferir($entity); 

        $this->transferenciaItemModel = Container::getClass("TransferenciaItem");

		//adicionar os itens na tabela item transferencia
        

	 	foreach($_checkbox as $_patrimonio_id){

	 	    $idItem = intval($_patrimonio_id);//pegando id dos produtos escolhidos
			$trans_item->setId_transferencia($response['results'][0]['ID']);
			$trans_item->setId_item($idItem);
			$transItem =  $trans_item->jsonSerialize();
			
			$transferenciaDAO->transferir_item($transItem); 
		
		}
		
		//Atualizar os locais dos produtos
		$patrimonio = Container::getClass("Patrimonio"); //instacinado a classe e a conexao banco
		$patrimonioDao = Container::getDao("PatrimonioDao");
		foreach($_checkbox as $_patrimonio_id){
		    $idPatrimonio = intval($_patrimonio_id);
		    $patrimonio->setId($idPatrimonio);
		    $patrimonio->setIdLocalidade($loc_destino);
		    $patrimonioJson =  $patrimonio->jsonSerialize();					        
		    $patrimonioDao->atualizarLocalPatrimonio($patrimonioJson); 
			
		}
		echo $response['results'][0]['ID'];
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
