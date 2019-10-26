<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;
use App\Models\Patrimonio;

class PatrimonioCtrl extends Action {

    /**
     * FunÁ„o responsavel por retornar a listagem dos Patrimonios.     
     */
    public function getPatrimonio() 
    {
        $patrimonioDao = Container::getDao("PatrimonioDao");
        $result = $patrimonioDao->getList();
        echo json_encode(array("recordsTotal" => $result['total'], "data" => $result['results']));
    }
    
    /**
     * FunÁ„o responsavel por retornar a listagem dos Patrimonios.
     */
    public function getAutoCompletePatrimonioList()
    {
        $patrimonioDao = Container::getDao("PatrimonioDao");
        $result = $patrimonioDao->get();
        echo json_encode([$result['results']]);
    }
    
    /**
     * FunÁ„o responsavel por realizar o processo de cadastro do patrimonio.
     */
    public function cadastrar() {
        
        $request = $this->getPostData();
        $constraint = $postData = array();
        
        $postData = [
            'patrimonio'    => $request['patrimonio'],
            'descricao'     => $request['descricao'],
            'local_inicial' => $request['local_inicial'],
            'tombamento'    => $request['tombamento'],
            'foto'          => $request['foto'] ?: "padrao.png"
        ];
        
        $constraint = $this->checkPostData($postData, $constraint);
        
        if(count($constraint) > 0) {
            echo json_encode(array("constraint" => $constraint , "sucesso" => 0));
        } else {
            $patrimonio = Container::getClass("Localidade");
            $patrimonioDao = Container::getDao("LocalidadeDao");
            
            $this->postDataToEntity($patrimonio, $postData);
            
            $result = $patrimonioDao->save($patrimonio);
            
            if($result['success']){
                echo json_encode(array("sucesso" => true, "msg" => $patrimonio->getDescricao()." cadastrada com sucesso."));
            } else {
                echo json_encode(array("sucesso" => false, "msg" => "Erro ao cadastrar localidade!".$result['msg'] ));
            }
            unset($patrimonio);
        }
	}
	
	/**
	 * FunÁ„o responsavel por fazer algumas validaÁıes antes da persistencia dos dados do patrimonio.
	 * @param array $postData
	 * @param array $constraint
	 * @return array
	 */
	private function checkPostData(array $postData, array $constraint):array
	{
	    if(!$postData['patrimonio'])       $constraint['patrimonio'] =  "Campo (Patrimonio) invalida!";
	    if(!$postData['descricao'])        $constraint['descricao'] =  "Campo (Descricao) invalida!";
	    if(!$postData['local_inicial'])    $constraint['local_inicial'] =  "Campo (Local) invalida!";
	    if(!$postData['tombamento'])       $constraint['tombamento'] =  "Campo (Tombamento) invalida!";
	    if(!$postData['foto'])             $constraint['foto'] =  "Campo (Foto) invalida!";
	    
	    return $constraint;
	    
	    /* if (!empty($postData["foto"])) {
	        // Largura m√°xima em pixels
	        $largura = 86150;
	        // Altura m√°xima em pixels
	        $altura = 86180;
	        // Tamanho m√°ximo do arquivo em bytes
	        $tamanho = 6100000;
	        
	        $error = array();
	        
	        // Verifica se o arquivo √© uma imagem
	        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
	            $error[1] = "Isso n√£o √© uma imagem.";
	        }
	        
	        // Pega as dimens√µes da imagem
	        $dimensoes = getimagesize($foto["tmp_name"]);
	        
	        // Verifica se a largura da imagem √© maior que a largura permitida
	        if($dimensoes[0] > $largura) {
	            $error[2] = "A largura da imagem n√£o deve ultrapassar ".$largura." pixels";
	        }
	        
	        // Verifica se a altura da imagem √© maior que a altura permitida
	        if($dimensoes[1] > $altura) {
	            $error[3] = "Altura da imagem n√£o deve ultrapassar ".$altura." pixels";
	        }
	        
	        // Verifica se o tamanho da imagem √© maior que o tamanho permitido
	        if($foto["size"] > $tamanho) {
	            $error[4] = "A imagem deve ter no m√°ximo ".$tamanho." bytes";
	        }
	        
	        // Se n√£o houver nenhum erro
	        if (count($error) == 0) {
	            
	            // Pega extens√£o da imagem
	            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	            
	            // Gera um nome √∫nico para a imagem
	            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	            
	            // Caminho de onde ficar√° a imagem
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
	    } */
	}
	
	/**
	 * FunÁ„o responsavel por montar a entidade de patrimonio
	 * @param Patrimonio $patrimonio
	 * @param array $postData
	 */
	private function postDataToEntity(Patrimonio $patrimonio, array $postData)
	{
	    $patrimonio->setPatrimonio($postData['patrimonio']);
	    $patrimonio->setDescricao($postData['descricao']);
	    $patrimonio->setTombamento($postData['local_inicial']);
	    $patrimonio->setIdLocalidade($postData['tombamento']);
	    $patrimonio->setFoto($postData['foto']);
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
	       
        $request = $this->getPostData();
        $constraint = $postData = array();
        
        $postData = [
            'patrimonio' => $request['patrimonio_att_modal'],
            'descricao' => $request['descricao_att_modal'],
            'local_inicial' => $request['local_inicial'],
            'tombamento' => $request['tombamento_att_modal'],
            'foto' => $request['foto'] ?: "padrao.png"
        ];
        
        $constraint = $this->checkPostData($postData, $constraint);
        
        if(count($constraint) > 0) {
            echo json_encode(array("constraint" => $constraint , "sucesso" => 0));
        } else {
            $patrimonio = Container::getClass("Localidade");
            $patrimonioDao = Container::getDao("LocalidadeDao");
            
            $this->postDataToEntity($patrimonio, $postData);
            
            $response = $patrimonioDao->update($patrimonio);
            unset($patrimonio);
            echo json_encode(array("sucesso" => $response ));
        }
       
    }
    
   
}
