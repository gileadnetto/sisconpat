<?php
namespace SON\Dao;
include('requisicoes.php');
include_once('processador.php');

require_once 'config.php';

class LocalidadeDao{
	protected $db;
	protected $table;

	public function __construct(\PDO $db) {
		$this->db=$db;         
	}

	public function Listar() {  
		$conn = $this->db;
		$query = "SELECT * from localidade order BY DT_CAD desc ;";
		$response = \processador\Processador::action($query, $conn);
		return $response;
	} 
	
	public function getList() {
	    $conn = $this->db;
	    $query = "SELECT L.DESCRICAO, L.ENDERECO, L.DT_CAD  FROM LOCALIDADE L ORDER BY L.DT_CAD DESC;";
	    $response = \processador\Processador::action($query, $conn);
	    return $response;
	}  

	public function deletar($id_local){

		$conn = $this->db;  

		$conn2 = $this->db; 
		$query = "DELETE from localidade WHERE ID = '$id_local'";
		$retorno = \processador\Processador::actionProvider($query, $conn2, 'Deletar Local');
		
		return ['result' => $retorno];
		
	}

	public function cadastrar($local) {
		$conn = $this->db;  

		$data = array(
			'DESCRICAO' => $local['descricao'] ,
			'ENDERECO' => $local['endereco'] ,
		);
		
		$tabela = $local['table'];
		
		$retorno = \processador\Processador::providerAction($data, $conn, $tabela, 'Adicionou o local'.$local['descricao']);
		return $retorno;
	
	}

	public function atualizar($local) {
		$conn = $this->db;     
		$query = 'UPDATE localidade set DESCRICAO="'.$local['descricao'].'" ,ENDERECO="'.$local['endereco'].'" where ID='.$local['id'];
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Atualizar Local');
		
		return $retorno;
	}

	public function getOption() {
		return $this->Listar();
	}
	
}

