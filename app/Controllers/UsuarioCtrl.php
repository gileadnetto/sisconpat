<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class UsuarioCtrl extends Action {
   
	public function getUsuario() {        

		$usuarioDao = Container::getDao("UsuarioDao");
        $result = $usuarioDao->getList();
        return array("recordsTotal" => $result['total'], "data" => $result['results']);
      
    }
    
	public function deletUsuario() {     
        $id = $_POST['id'];
        $usuarioDao = Container::getDao("UsuarioDao"); //instacinado a classe e a conexao banco
		$response = $usuarioDao->deletUsuario($id);
		unset($usuarioDao);
        return $response ; 
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
            echo array("constraint" => $constraint , "sucesso" => 0);
        } else {
            $usuario = Container::getClass("Usuario");
			$usuarioDao = Container::getDao("UsuarioDao");
			
            $this->postDataToEntity($usuario, $postData);
            
            $result = $usuarioDao->save($usuario);
            $login = $usuario->getLogin();
            unset($usuario);
            
            if($result['success']){
                return array("sucesso" => true, "msg" => $login." cadastrado com sucesso.");
            }

            return array("sucesso" => false, "msg" => "Erro ao cadastrar o usuario!".$result['msg']);
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
		unset($user);
		unset($usuarioDao);
		return $response; 
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


