<?php
namespace SON\Dao;
include('requisicoes.php');
include_once('processador.php');
require_once 'config.php';

class UsuarioDao {    
  protected $db;
  protected $table;  
  
	public function __construct(\PDO $db) {
		$this->db=$db;         
	}
  
	public function getUsuario() {
		$conn = $this->db;	   
		$query   =  "SELECT * from usuario;";
		$retorno = \processador\Processador::action($query, $conn);
			 
 		return $retorno;	
	}

	public function autenticar($login , $senha) {
		$conn = $this->db;	   	   
		$query   =  "SELECT * from usuario WHERE login='$login' AND senha='$senha' ;";
		$retorno = \processador\Processador::action($query, $conn);

		return $retorno;
	}

	public function deletUsuario($id){
		$conn = $this->db;	   	   
		$query   =  "DELETE from usuario WHERE ID =$id;";
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Deletar um  usuario');
			 
 		return $retorno;  
	}
       
	public function cadastrarUsuario($usuario_json){
		$conn = $this->db;	   	
	//	print('<pre>'.$usuario_json.'</pre>');
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
