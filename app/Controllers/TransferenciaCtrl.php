<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class TransferenciaCtrl extends Action {
   
    public function getItensTransferencia() {
        $local_inicial = $_POST['local_inicial'];
        $transferencia = Container::getClass("Transferencia");      
        $response = $transferencia->getItensTransferencia($local_inicial);
		//$resultado  = json_encode($response);
		$this->view->resultado=$response;
		$this->render('getItensTransferencia','transferencia');
        
    }
    
    public function transferir(){        
      	session_start();
		$idTransferencia = false;
		$loc_inicial = $_POST['local_inicial'];
		$loc_destino = $_POST['local_destino'];
		$idUsuario = intval($_SESSION['id_usuario']);
         
		if($loc_inicial === $loc_destino || $loc_inicial == 0 || $loc_destino == 0 ){

			if($loc_inicial === $loc_destino){
				echo "erro locais" ; //cod de erro para a msg
			}
			else if($loc_inicial == 0){
				echo "inicial incorreto";
			}
			else if($loc_destino == 0){
				echo "destino incorreto";
			}
		}
        else{
			if(!isset($_POST['check_transferir_produto'])){
				echo "erro vazio";//cod de erro para a msg
				die();          
			}
			else{ 
				//produtos escolhidos
				$_checkbox = $_POST['check_transferir_produto'];
				$qtdProdutos = count($_checkbox);
					
				$transferencia = \SON\Di\Container::getClass("Transferencia"); 
			
				$transferencia->setIdOrigem($loc_inicial);
				$transferencia->setidDestino($loc_destino);
				$transferencia->setQuant($qtdProdutos);
				$transferencia->setIdUsuario($idUsuario);

				$trans = $transferencia->jsonSerialize();
				//enviado o cadastro para a transferencia db
				$response = $transferencia->transferir($trans); 
					
						 
				if($response['erro']){    
					die();
				}
     
				//adicionar os itens na tabela item transferencia
				$trans_item = \SON\Di\Container::getClass("TransferenciaItem");

        	 	foreach($_checkbox as $_produto_id){

					$idProduto = intval($_produto_id);//pegando id dos produtos escolhidos
					$trans_item->setId_transferencia($response['results'][0]['ID']);
					$trans_item->setId_produto($idProduto);
					$trans =  $trans_item->jsonSerialize();
					//$trans_json = json_encode($trans); 
					
					$response_item = $trans_item->transferir_item($trans); 
				
				}
				
				//Atualizar os locais dos produtos
				$prod = \SON\Di\Container::getClass("Itens"); //instacinado a classe e a conexao banco       
				foreach($_checkbox as $_produto_id){
        	 		$idProduto = intval($_produto_id);
        	 	 	$prod->setId($idProduto);
        	 	 	$prod->setIdLocalidade($loc_destino);
                   	$produt =  $prod->jsonSerialize();
					         
					//echo $prod_json;
					$response_prod = $prod->atualizarLocalProduto($produt); 
					
				}                                    
			}     
		}
		echo $response['results'][0]['ID'];
    }
    
    public function getMinhasTransferencias() {
		session_start(); 
		$id_usuario = $_SESSION['id_usuario'];
        $transferencia = Container::getClass("Transferencia");      
        $response = $transferencia->getMinhasTransferencias($id_usuario);

		$this->view->resultado=$response;
		$this->render('getMinhasTransferencias','transferencia');
    }
    
	public function gerarPDF() {
		$idTransferencia = intval($_GET['idTransferencia']); 
		$transferencia = Container::getClass("Transferencia");      
		$response = $transferencia->gerarPDF($idTransferencia);
		
		$response  = json_encode($response);
		$this->view->resultado=$resultado;
		$this->render('gerarPDF','transferencia');
    }
     
    public function gerarPDFTransferencia() {
        
		$idTransferencia = (int) ($_GET['idTransferencia']);
		$transferencia = Container::getClass("Transferencia");      
		$response = $transferencia->gerarPDF($idTransferencia);
	
		//$resultado  = json_encode($response);
	
		$this->view->resultado=$response;
		$this->render('gerarPDFTransferencia','transferencia');
         
    }
    
        public function gerarPDFEmprestimo() {
                            
           
         $this->render('gerarPDFTermoEmprestimo','transferencia');
       
         
    }
    
}
