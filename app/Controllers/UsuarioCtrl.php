<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class UsuarioCtrl extends Action {
   
	public function getUsuario() {        
       
		$usuarioDao = Container::getDao("UsuarioDao"); //instacinado a classe e a conexao banco
		$response = $usuarioDao->getUsuario();
		       
        $this->view->resultado=$response;
		$this->render('getUsuario','administrador');
		unset($usuarioDao);
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
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $perfil = $_POST['perfil'];
                 
        $user = Container::getClass("Usuario");
        $usuarioDao = Container::getDao("UsuarioDao");
        
        $user->setEmail($email);
        $user->setLogin($nome);
        $user->setSenha($senha);
        $user->setPerfil($perfil);

		$usuarios = $user->jsonSerialize(); 
        //instacinado a classe e a conexao banco
        $response = $usuarioDao->cadastrarUsuario($usuarios);

		print_r($response);   
		unset($user);
		unset($usuarioDao);
        
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
}
