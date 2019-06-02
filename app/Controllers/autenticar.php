<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;

class autenticar {
	public function validar() {    
		session_start();

		$usuario = Container::getClass("Usuario"); //instacinado a classe e a conexao banco
        $login = $_POST['usuario'];
		$senha = md5($_POST['senha']);
		
		$response = $usuario->autenticar($login, $senha);
		//$resultado  =  (array) json_decode($response);

		if( $response['total'] != 1){
			header('Location: autenticar');
		}

        foreach ($response['results'] as $res) {  
			$res = (array) $res;

			if(isset($res['login'] )){
				//super global session
				$_SESSION['usuario'] = $res['login'];
				$_SESSION['email'] = $res['email'];
				$_SESSION['perfil'] = $res['perfil'];		             
				$_SESSION['id_usuario'] =$res['id'];

				header('Location: home');
			}
			else{
				header('Location: autenticar');
			}
        }
     }
}
