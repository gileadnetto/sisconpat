<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class UsuarioCtrl extends Action {
   
	public function getUsuario() {        

		$usuarioDao = Container::getDao("UsuarioDao");
        $result = $usuarioDao->getList();
        echo json_encode(array("recordsTotal" => $result['total'], "data" => $result['results']));
      
    }
    
	public function deletUsuario() {     
        $id = $_POST['id'];
        $usuarioDao = Container::getDao("UsuarioDao"); //instacinado a classe e a conexao banco
		$response = $usuarioDao->deletUsuario($id);
		$response = json_encode($response);
        print_r($response); 
		unet($usuarioDao);
	}
     
	public function cadastrarUsuario() {  
		
		$request = $this->getPostData();
        $constraint = $postData = array();
		
        $postData = [
            'login'    => $request['login'],
            'senha'    => md5($request['senha']),
            'email'    => $request['email'],
            'perfil'   => $request['perfil'],
         ];
        
        $constraint = $this->checkPostData($postData, $constraint);
           
        if(count($constraint) > 0) {
            echo json_encode(array("constraint" => $constraint , "sucesso" => 0));
        } else {
            $usuario = Container::getClass("Usuario");
			$usuarioDao = Container::getDao("UsuarioDao");
			
            $this->postDataToEntity($usuario, $postData);
            
            $result = $usuarioDao->save($usuario);
            
            if($result['success']){
                echo json_encode(array("sucesso" => true, "msg" => $usuario->getLogin()." cadastrado com sucesso."));
            } else {
                echo json_encode(array("sucesso" => false, "msg" => "Erro ao cadastrar o usuario!".$result['msg'] ));
            }
            unset($usuario);
		}
        
	}
     
	public function updateUsuario() {  
		$usuario       = $_POST['usuario_modal'];
		$email      	 = $_POST['email_modal'];
		$perfil        = $_POST['perfil'];
		$id            = $_POST['id_modal'];  
	
		$user = Container::getClass("Usuario");
		$usuarioDao = Container::getDao("UsuarioDao");

		$user->setEmail($email);
		$user->setLogin($usuario);
		$user->setSenha("0");
		$user->setPerfil($perfil);
		$user->setId($id);
 
        $usuario = $user->jsonSerialize();
         
        //var_dump($produto_json);
		$response = $usuarioDao->updateUsuario($usuario);
		$response = json_encode($usuario);
		print_r($response); 
		unset($user);
		unset($usuarioDao);
	}

	/**
     * Fun��o responsavel por fazer a verifica��o dos valores do post
     * @param array $postData
     * @param array $constraint
     * @return number
     */
    private function checkPostData(array $postData, array $constraint)
    {
		!$postData['login'] && $constraint['login'] = "Campo (login) invalido!";
		!$postData['senha'] && $constraint['senha'] = "Campo (senha) invalido!";
		!$postData['perfil'] && $constraint['perfil'] = "Campo (perfil) invalido!";
		!$postData['email'] && $constraint['email'] = "Campo (email) invalido!";

		return $constraint;
    }
    
    /**
     * Fun��o responsavel por preencher a entidde com os dados do post.
     * @param Localidade $entity
     * @param array $postData
     */
    private function postDataToEntity( $entity, array $postData)
    {
        $entity->setLogin($postData['login']);
        $entity->setSenha($postData['senha']);
		$entity->setEmail($postData['email']);
		$entity->setPerfil($postData['perfil']);

    }
}


