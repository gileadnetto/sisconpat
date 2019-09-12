<?php
namespace SON\Dao;
include('requisicoes.php');
include_once('processador.php');
require_once 'config.php';

class HomeDao {    
  protected $db;
  protected $table;  
  
 	 public function __construct(\PDO $db){
		$this->db=$db;         
	}
  
	public function listar($id_Usuario){  
		$conn = $this->db;

		$query   =  "SELECT  
		(SELECT COUNT(id)FROM   localidade) AS QTD_LOCAL,
		(SELECT COUNT(id)FROM   patrimonio) AS QTD_PATRIMONIO ,
		(SELECT COUNT(id)FROM   transferencia) AS QTD_TRANSFERENCIA,
		(SELECT COUNT(id)FROM   transferencia where ID_USUARIO = $id_Usuario ) AS MINHAS_TRANSFERENCIAS";
	
		$response = \processador\Processador::action($query, $conn);
		return $response;
		
	}

 	public function relatorio () {
		$conn = $this->db;   
		$query   =  "SELECT  distinct ID_LOCALIDADE ,count(ID_LOCALIDADE) quantidade , localidade.DESCRICAO from patrimonio inner join localidade on localidade.id = patrimonio.id_localidade  and patrimonio.ATIVO=1 GROUP BY ID_LOCALIDADE order by  ID_LOCALIDADE ";
		$retorno = \processador\Processador::action($query, $conn);
		
		return $retorno;

		
	}
    
}
