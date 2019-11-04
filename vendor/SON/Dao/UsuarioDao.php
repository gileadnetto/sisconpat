<?php
namespace SON\Dao;
use App\Models\Usuario;
use PDO;
use App\Models\UserSession;

include('requisicoes.php');
include_once('processador.php');
require_once 'config.php';

class UsuarioDao extends baseDao{    
    protected $db;
    protected $table = "USUARIO";
  
    /**
     * Função responsavel por recuperar todos os usuarios
     * @return array
     */
	public function getUsuario():array {
	    $sth = $this->db->prepare('SELECT * from usuario;');
	    
	    $sth->execute();
	    
	    return  PARENT::returnResult($sth);
	}

	/**
	 * Função responsavel por autenticar o usuario que esta logando existe.
	 * @param Usuario $usuario
	 * @return array
	 */
	public function autenticar(Usuario $usuario):array {
	    $sth = $this->db->prepare('SELECT * from usuario WHERE login = :login AND senha = :senha;');
	    
	    $sth->bindParam(':login', $usuario->getLogin(),   PDO::PARAM_STR);
	    $sth->bindParam(':senha', $usuario->getSenha(),   PDO::PARAM_STR);
	    
	    $sth->execute();
	    
	    return  PARENT::returnResult($sth);
	}

	/**
	 * Função responsavel por salvar o user session
	 * @param UserSession $userSession
	 * @return array
	 */
	public function saveUserSession(UserSession $userSession)
	{
	    try {
    	    $this->db->beginTransaction();
    	    $sth = $this->db->prepare('INSERT INTO USER_SESSION(ID_USUARIO, LOGIN, IP, NAVEGADOR) VALUES (:ID_USUARIO,:LOGIN,:IP,:NAVEGADOR)');
    	    
    	    $sth->bindParam(':ID_USUARIO', $userSession->getId_usuario(),  PDO::PARAM_INT);
    	    $sth->bindParam(':LOGIN',      $userSession->getLogin(),       PDO::PARAM_STR);
    	    $sth->bindParam(':IP',         $userSession->getIp(),          PDO::PARAM_STR);
    	    $sth->bindParam(':NAVEGADOR',  $userSession->getNavegador(),   PDO::PARAM_STR);
    	    
    	    $sth->execute();
    	    $lastInsertId = $this->db->lastInsertId();
    	    $this->db->commit();
    	  
    	    $userSession->setId($lastInsertId);
    	    
    	    return ['success' => true];
	    } catch (\Exception $e) {
	        $this->db->rollBack();
	        return ['success' => false, 'msg' => $e->getMessage()];
	    }
	    
	}
	
	public function deletUsuario($id){
		$conn = $this->db;	   	   
		$query   =  "DELETE from usuario WHERE ID =$id;";
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Deletar um  usuario');
			 
 		return $retorno;  
	}
       
	public function cadastrarUsuario($usuario_json){
		$conn = $this->db;
		$data = array(
			'PERFIL' => $usuario_json['perfil'] ,
			'EMAIL' => $usuario_json['email'] ,
			'LOGIN' => $usuario_json['login'] ,
			'SENHA' => $usuario_json['senha'] ,

		);
		$tabela = $usuario_json['table'];
		
		$retorno = \processador\Processador::providerAction($data, $conn,$tabela, 'Cadastrar usuario');
		return $retorno;
	}

	public function updateUsuario($usuario_json){
		$conn = $this->db;	   
		$query   =  'UPDATE usuario set perfil="'.$usuario_json['perfil'].'", email="'.$usuario_json['email'].'" , login="'.$usuario_json['login'].'" where id="'.$usuario_json['id'].'";';
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Atualizar um usuario');
			 
 		return $retorno;	
	}
}
