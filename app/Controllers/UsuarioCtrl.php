<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class UsuarioCtrl extends Action {
   
	public function getUsuario() {        
       
		$usuario = Container::getClass("Usuario"); //instacinado a classe e a conexao banco
		$response = $usuario->getUsuario();
		       
        $this->view->resultado=$response;
		$this->render('getUsuario','administrador');
		unset($usuario);
         
    }
    
	public function deletUsuario() {     
        $id =$_POST['id'];
        $usuario = Container::getClass("Usuario"); //instacinado a classe e a conexao banco
		$response = $usuario->deletUsuario($id);
		$response = json_encode($response);
        print_r($response); 
		unet($usuario);
	}
     
	public function cadastrarUsuario() {      
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $perfil = $_POST['perfil'];
                 
        $user = Container::getClass("Usuario");
        
        $user->setEmail($email);
        $user->setLogin($nome);
        $user->setSenha($senha);
        $user->setPerfil($perfil);

		$usuarios = $user->jsonSerialize(); 
        //instacinado a classe e a conexao banco
        $response = $user->cadastrarUsuario($usuarios);
        $usuario_json = json_encode($response);
		print_r($response);   
		unset($user);
        
	}
     
	public function updateUsuario() {  
		$usuario       = $_POST['usuario_modal'];
		$email      	 = $_POST['email_modal'];
		$perfil        = $_POST['perfil'];
		$id            = $_POST['id_modal'];  
	
		$user = Container::getClass("Usuario");

		$user->setEmail($email);
		$user->setLogin($usuario);
		$user->setSenha("0");
		$user->setPerfil($perfil);
		$user->setId($id);
 
        $usuario = $user->jsonSerialize();
         
        //var_dump($produto_json);
		$response = $user->updateUsuario($usuario);
		$response = json_encode($usuario);
		print_r($response); 
		unset($user);
	}
}
