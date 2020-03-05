<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;
use App\Models\Patrimonio;

class PatrimonioCtrl extends Action {

    /**
     * Fun��o responsavel por retornar a listagem dos Patrimonios.     
     */
    public function getPatrimonio() 
    {
        $patrimonioDao = Container::getDao("PatrimonioDao");
        $result = $patrimonioDao->getList();
        echo json_encode(array("recordsTotal" => $result['total'], "data" => $result['results']));
    }
    
    /**
     * Fun��o responsavel por retornar a listagem dos Patrimonios.
     */
    public function getAutoCompletePatrimonioList()
    {
        $query = $this->getPostData();
        
        $patrimonioDao = Container::getDao("PatrimonioDao");
        $result = $patrimonioDao->getAutoCompleteList(['term' => $query['q']]);
        echo json_encode([$result['results']]);
    }
    
    /**
     * Fun��o responsavel por realizar o processo de cadastro do patrimonio.
     */
    public function cadastrarPatrimonio() {
        
		$request = $this->getPostData();
        $constraint = $postData = array();
        
        $postData = [
            'patrimonio'    => $request['patrimonio'],
            'descricao'     => $request['descricao'],
            'id_localidade' => isset($request['id_localidade']) ? $request['id_localidade'] : null,
            'tombamento'    => $request['tombamento'],
            'valor'         => $request['valor'],
            'vidautil'      => $request['vidautil'],
            'foto'          => isset($request['foto']) ? $request['foto'] : "padrao.png"
        ];
        
        $constraint = $this->checkPostData($postData, $constraint);
        
        if(count($constraint) > 0) {
            echo json_encode(array("constraint" => $constraint , "sucesso" => 0));
        } else {
            $patrimonio = Container::getClass("Patrimonio");
            $patrimonioDao = Container::getDao("PatrimonioDao");
            
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
	 * Fun��o responsavel por fazer algumas valida��es antes da persistencia dos dados do patrimonio.
	 * @param array $postData
	 * @param array $constraint
	 * @return array
	 */
	private function checkPostData(array $postData, array $constraint):array
	{
	    if(!$postData['patrimonio'])       $constraint['patrimonio'] =  "Campo (Patrimonio) invalida!";
	    if(!$postData['descricao'])        $constraint['descricao'] =  "Campo (Descricao) invalida!";
	    if(!$postData['id_localidade'])    $constraint['id_localidade'] =  "Campo (Local) invalida!";
	    if(!$postData['tombamento'])       $constraint['tombamento'] =  "Campo (Tombamento) invalida!";
	    if(!$postData['foto'])             $constraint['foto'] =  "Campo (Foto) invalida!";
	    
	    return $constraint;
	    
	    /* if (!empty($postData["foto"])) {
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
	    } */
	}
	
	/**
	 * Fun��o responsavel por montar a entidade de patrimonio
	 * @param Patrimonio $patrimonio
	 * @param array $postData
	 */
	private function postDataToEntity(Patrimonio $patrimonio, array $postData)
	{
	    $id_user_session = parent::getUserSession();
	    $patrimonio->setPatrimonio($postData['patrimonio']);
	    $patrimonio->setDescricao($postData['descricao']);
	    $patrimonio->setTombamento($postData['tombamento']);
	    $patrimonio->setValor($postData['valor']);
	    $patrimonio->setVidautil($postData['vidautil']);
	    $patrimonio->setIdLocalidade($postData['id_localidade']);
	    $patrimonio->setFoto($postData['foto']);
	    $patrimonio->setId_User_Session($id_user_session);
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
