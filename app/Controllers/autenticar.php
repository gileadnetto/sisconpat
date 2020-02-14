<?php

namespace App\Controllers;

use SON\Controller\Action;
use SON\Di\Container;
use Exception;
use App\Controllers\Helpers\Validadores;
use App\Models\Usuario;
use App\Models\UserSession;

class Autenticar extends Action{
    
    /**
     * Fun��o reponsavel por realizar o processo de valida��o de usuario
     */
    public function validar() {    
        session_start();

        
        $constraint = [];
        $postData = $this->getPostData();
		
        $constraint = $this->checkPostData($postData);
		
        if(count($constraint) > 0){
    	    header('Location: autenticar');
    	    echo $constraint;
    	}
    	
    	$usuarioDao = Container::getDao("UsuarioDao");
    	$usuario = Container::getClass("Usuario");
    	
    	$this->postDataToEntity($usuario, $postData);
    
    	$response = $usuarioDao->autenticar($usuario);
    
    	if( $response['total'] != 1){
    		header('Location: autenticar');
    		return;
    	}
    
        if($this->saveLoginSession($response)){
    	    header('Location: home');
        } else {
    	    header('Location: autenticar');
        }
    }
    
    /**
     * Fun��o responsavel por verificar os dados vindos do post
     * @param array $postData
     * @return array
     */
    private function checkPostData(array $postData):array
    {
        $constraint = [];
         
        Validadores::validar($postData, 'usuario', validadores::TYPE_STRING, $constraint, 25);
         
        return $constraint;
    }
     
    /**
     * Fun��o repsonsavel por preencher a entidade de usuario com os dados do post.
     * @param Usuario $usuario
     * @param array $postData
     */
    private function postDataToEntity(Usuario $usuario, array $postData)
    {
        $usuario->setLogin($postData['usuario']);
        $usuario->setSenha(md5($postData['senha']));
    }   
     
    /**
    * Fun��o responsavel por salvar algumas informa��es do login na sess�o
    * @param array $response
    * @return bool
    */
    private function saveLoginSession(array $response):bool
    {
        $dadosUsuario = [];
        foreach ($response['results'] as $res) {
            $res = (array) $res;
                $dadosUsuario = [
                    'usuario' => $res['login'],
                    'email' => $res['email'],
                    'perfil' => $res['perfil'],
                    'id_usuario' => $res['id']
                ];
        }
        
        $userSession = Container::getClass("UserSession");
        $usuarioDao = Container::getDao("UsuarioDao");
        
        $this->fillEntityUserSession($userSession, $dadosUsuario);
        
        try {
            $result = $usuarioDao->saveUserSession($userSession);
        } catch (Exception $e) {
            return false;
        }
        
        if($result['success']){
            $_SESSION['usuario'] = $dadosUsuario['usuario'];
            $_SESSION['email'] = $dadosUsuario['email'];
            $_SESSION['perfil'] = $dadosUsuario['perfil'];
            $_SESSION['id_usuario'] = $dadosUsuario['id_usuario'];
            $_SESSION['id_user_session'] = $userSession->getId();
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Fun��o responsavel por preencher a entidade de user session
     * @param UserSession $userSession
     * @param array $response
     */
    private function fillEntityUserSession(UserSession $userSession, array $response)
    {
        $userSession->setId_usuario($response['id_usuario']);
        $userSession->setLogin($response['usuario']);
        $userSession->setIp($_SERVER['REMOTE_ADDR']);
        $userSession->setNavegador($_SERVER['HTTP_USER_AGENT']);
    }
}
