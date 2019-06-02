<?php


use SON\Controller\Action;
use \SON\Di\Container;

namespace App\Controllers;

class ItensCtrl extends \SON\Controller\Action {

    public function getItens() {
        
        $itens = \SON\Di\Container::getClass("Itens"); //instacinado a classe e a conexao banco
        $response = $itens->listar();
        //$item  = json_decode($response);
        $item = $response;
        $this->view->itens=$item;
		unset($itens);
        $this->render('getItens','itens');
      
    }
    
    public function buscar() {
        $query = $_POST['query'];
        
        $itens = \SON\Di\Container::getClass("Itens"); //instacinado a classe e a conexao banco
        $item = $itens->buscarAll($query);
        unset($itens);
        //$item  = json_decode($response);
        
        $this->view->itens=$item;
        $this->render('getItens','itens');
        
    }
    
    public function cadastrar() {
       
        $produto = $_POST['produto'];
        $descricao = $_POST['descricao'];
        $idLocalidade = $_POST['local_inicial'];
        $tombamento = $_POST['tombamento'];
        $foto = $_FILES["foto"];
         
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

		$item = \SON\Di\Container::getClass("Itens"); //instacinado a classe e a conexao banco

		$item->setProduto($produto);
		$item->setDescricao($descricao);
		$item->setTombamento($tombamento);
		$item->setIdLocalidade($idLocalidade);
		$item->setFoto($nome_imagem);

		$itemJson = $item->jsonSerialize();
		$response = $item->cadastrar($itemJson);
		
		$response = json_encode($response);
		unset($item);
		echo $response; 
	}
    
    public function deletProduto(){
        $tombamento =$_POST['tombamento'];
        $itens = \SON\Di\Container::getClass("Itens"); //instaciando a classe e a conexao banco
        $response = $itens->deletar($tombamento);
	
		$response = json_encode($response);
		unset($itens);
        echo $response; 
        
    }
    
    public function atualizarProduto() {
	       
        $produto = $_POST['produto_att_modal'];
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

        
        $item = \SON\Di\Container::getClass("Itens"); //instacinado a classe e a conexao banco

        $item->setProduto($produto);
        $item->setDescricao($descricao);
        $item->setTombamento($tombamento);
		$item->setIdLocalidade($idLocalidade);
		if($nome_imagem){
			$item->setFoto($nome_imagem);
		}

        $itemJson = $item->jsonSerialize();
       // $produto_json = json_encode($produto);
         
		$response = $item->atualizar($itemJson);

		$response = json_encode($response);
		unset($item);
        echo $response; 
       
    }
    
   
}
