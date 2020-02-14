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
     * Fun��o responsavel por recuperar todos os usuarios
     * @return array
     */
	public function getUsuario():array {
	    $sth = $this->db->prepare('SELECT * from usuario;');
	    
	    $sth->execute();
	    
	    return  PARENT::returnResult($sth);
	}

	/**
	 * Fun��o responsavel por autenticar o usuario que esta logando existe.
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
	 * Fun��o responsavel por salvar o user session
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
	   
	
		/**
	 * Fun��o responsavel por persistir a localidade junto com o endere�o
	 * @param Localidade $localidade
     * @param Endereco $endereco
	 * @return array
	 */
	public function save(Usuario $usuario)
	{
	    try {
	        $this->db->beginTransaction();
	        
	        $sth = $this->db->prepare('INSERT INTO usuario (login, email, senha, perfil) VALUES(:login, :email, :senha, :perfil);');
	        
	        $sth->bindValue(':login',          	$usuario->getLogin(),       PDO::PARAM_STR);
	        $sth->bindValue(':email',         	$usuario->getEmail(),       PDO::PARAM_STR);
	        $sth->bindValue(':senha',           $usuario->getSenha(),       PDO::PARAM_STR);
	        $sth->bindValue(':perfil',    		$usuario->getPerfil(),  	PDO::PARAM_STR);
	        
	        $sth->execute();
	        $this->db->commit();
	        return ['success' => true];
	    } catch (\Exception $e) {
	        $this->db->rollBack();
	        return ['success' => false, 'msg' => $e->getMessage()];
	    }
	}

	public function updateUsuario($usuario_json){
		$conn = $this->db;	   
		$query   =  'UPDATE usuario set perfil="'.$usuario_json['perfil'].'", email="'.$usuario_json['email'].'" , login="'.$usuario_json['login'].'" where id="'.$usuario_json['id'].'";';
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Atualizar um usuario');
			 
 		return $retorno;	
	}

	public function getList()
	{
	    $sth = $this->db->prepare("SELECT *  FROM ".$this->table);
	    $sth->execute();
	    return parent::returnResult($sth);
	}

}
