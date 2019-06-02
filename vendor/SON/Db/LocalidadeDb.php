<?php
namespace SON\Db;
include('requisicoes.php');
include_once('processador.php');

require_once 'config.php';

abstract class LocalidadeDb{
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

	public function deletar($id_local){

		$conn = $this->db;  
		
		$query = "SELECT * FROM produtos where ID_LOCALIDADE = $id_local;";
		$produto = \processador\Processador::action($query, $conn);
		
		if( $produto['total'] <= 0 ){
			$conn2 = $this->db; 
			$query = "DELETE from localidade WHERE ID = '$id_local'";
			$retorno = \processador\Processador::actionProvider($query, $conn2, 'Deletar Local');
		}

		else{
			return array(
				'total'     => 0,
				'erro'      => true,
				'mensagem'  => 'Esse Local possui produto(s) cadastrados',
				'results'   =>null	
			);
		}

		return $retorno;
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

