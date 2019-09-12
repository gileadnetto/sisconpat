<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class PatrimonioCtrl extends Action {

    /**
     * Fun��o responsavel por retornar a listagem dos Patrimonios.
     */
    public function getPatrimonio() {
        $this->view->patrimonio = Container::getDao("PatrimonioDao")->listar();
        $this->render('getPatrimonio','patrimonio');
    }
    
    /**
     * Fun��o responsavel por realizar a busca.
     */
    public function buscar() {
        $query = $_POST['query'];
        
        $this->view->itens= Container::getDao("PatrimonioDao")->buscarAll($query);;
        $this->render('getPatrimonio','patrimonio');
    }
    
    /**
     * Fun��o responsavel por realizar o processo de cadastro do patrimonio.
     */
    public function cadastrar() {
        $constraint = array();
        
        $request = $this->getRequest();
        
        if(!$request->post()) return json_encode(['success'=> 0]);
        
        $patrimonio = $_POST['patrimonio'];
        $descricao = $_POST['descricao'];
        $idLocalidade = $_POST['local_inicial'];
        $tombamento = $_POST['tombamento'];
        $foto = $_FILES["foto"] ?: $nome_imagem = "padrao.png";
        
        $constraint = $this->checkPostData($request);
        
        if(count($constraint) >= 1) return json_encode(['success' => 0, 'constraint' => $constraint]);
        
        $this->postDataToEntity($request);
        
        if(count($constraint) > 0) return $response = json_encode(array("sucesso" => 0));
        
		$patrimonioModel = \SON\Di\Container::getClass("Patrimonio"); //instacinado a classe e a conexao banco
		$patrimonioDao = Container::getDao("PatrimonioDao");

		$patrimonioModel->setPatrimonio($patrimonio);
		$patrimonioModel->setDescricao($descricao);
		$patrimonioModel->setTombamento($tombamento);
		$patrimonioModel->setIdLocalidade($idLocalidade);
		$patrimonioModel->setFoto($nome_imagem);

		$patrimonioJson = $patrimonioModel->jsonSerialize();
		$response = $patrimonioDao->cadastrar($patrimonioJson);
		
		$response = json_encode($response);
		unset($patrimonioModel);
		echo $response; 
	}
	
	/**
	 * Fun��o responsavel por fazer algumas valida��es antes da persistencia dos dados do patrimonio.
	 * @param unknown $request
	 * @return array
	 */
	private function checkPostData($request):array
	{
	    if (!empty($foto["name"])) {
	        // Largura máxima em pixels
	        $largura = 86150;
	        // Altura máxima em pixels
	        $altura = 86180;
	        // Tamanho máximo do arquivo em bytes
	        $tamanho = 6100000;
	        
	        $error = array();
	        
	        // Verifica se o arquivo é uma imagem
	        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
	            $error[1] = "Isso não é uma imagem.";
	        }
	        
	        // Pega as dimensões da imagem
	        $dimensoes = getimagesize($foto["tmp_name"]);
	        
	        // Verifica se a largura da imagem é maior que a largura permitida
	        if($dimensoes[0] > $largura) {
	            $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
	        }
	        
	        // Verifica se a altura da imagem é maior que a altura permitida
	        if($dimensoes[1] > $altura) {
	            $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
	        }
	        
	        // Verifica se o tamanho da imagem é maior que o tamanho permitido
	        if($foto["size"] > $tamanho) {
	            $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
	        }
	        
	        // Se não houver nenhum erro
	        if (count($error) == 0) {
	            
	            // Pega extensão da imagem
	            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	            
	            // Gera um nome único para a imagem
	            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	            
	            // Caminho de onde ficará a imagem
	            $caminho_imagem = "imagens/produtos/" . $nome_imagem;
	            
	            // Faz o upload da imagem para seu respectivo caminho
	            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
	            
	        }
	        
	        // Se houver mensagens de erro, exibe-as
	        if (count($error) != 0) {
	            foreach ($error as $erro) {
	                echo $erro . "<br />";
	                die('erro em add foto');
	            }
	        }
	    }//fim do if se a foto foi selecionada
	    else{
	        $nome_imagem = "padrao.png";
	    }
	}
    
    public function deletPatrimonio(){
        $tombamento =$_POST['tombamento'];
        $patrimonioDao = Container::getDao("PatrimonioDao"); //instaciando a classe e a conexao banco
        $response = $patrimonioDao->deletar($tombamento);
	
		$response = json_encode($response);
		unset($patrimonioDao);
        echo $response; 
        
    }
    
    public function atualizarProduto() {
	       
        $patrimonio = $_POST['patrimonio_att_modal'];
        $descricao = $_POST['descricao_att_modal'];
        $idLocalidade = $_POST['local_inicial'];
        $tombamento = $_POST['tombamento_att_modal'];
		$foto = $_FILES["foto_att_modal"];
		$foto_antiga = $_POST["foto"];

			
        if (!empty($foto["name"])) {		
			// Largura máxima em pixels
			$largura = 86150;
			// Altura máxima em pixels
			$altura = 86180;
			// Tamanho máximo do arquivo em bytes
			$tamanho = 6100000;

			$error = array();

			// Verifica se o arquivo é uma imagem
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
			$error[1] = "Arquivo selecionado não é uma imagem.";
			} 
	
			// Pega as dimensões da imagem
			$dimensoes = getimagesize($foto["tmp_name"]);
		
			// Verifica se a largura da imagem é maior que a largura permitida
			if($dimensoes[0] > $largura) {
				$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			}

			// Verifica se a altura da imagem é maior que a altura permitida
			if($dimensoes[1] > $altura) {
				$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
			}
			
			// Verifica se o tamanho da imagem é maior que o tamanho permitido
			if($foto["size"] > $tamanho) {
				$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
			}

			// Se não houver nenhum erro
			if (count($error) == 0) {
			
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

				// Gera um nome único para a imagem
				$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

				// Caminho de onde ficará a imagem
				$caminho_imagem = "imagens/produtos/" . $nome_imagem;

				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($foto["tmp_name"], $caminho_imagem);		
			
			}
	
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
					die('erro em add foto');
				}
			}
		}//fim do if se a foto foi selecionada
		else{ //se não for selecionada nenhuma imagem 
			$nome_imagem = $foto_antiga;
		}

        
		$patrimonioModel = \SON\Di\Container::getClass("Patrimonio"); //instacinado a classe e a conexao banco
		$patrimonioDao = Container::getDao("PatrimonioDao");

		$patrimonioModel->setPatrimonio($patrimonio);
		$patrimonioModel->setDescricao($descricao);
		$patrimonioModel->setTombamento($tombamento);
		$patrimonioModel->setIdLocalidade($idLocalidade);
		if($nome_imagem){
		    $patrimonioModel->setFoto($nome_imagem);
		}

		$itemJson = $patrimonioModel->jsonSerialize();
       // $produto_json = json_encode($produto);
         
		$response = $patrimonioDao->atualizar($itemJson);

		$response = json_encode($response);
		unset($patrimonioModel);
		unset($patrimonioDao);
        echo $response; 
       
    }
    
   
}
