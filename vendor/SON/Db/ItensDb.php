<?php
namespace SON\Db;
include_once('requisicoes.php');
include_once('processador.php');
require_once 'config.php';

abstract class ItensDb{
  protected $db;
  protected $table;
  
	public function __construct(\PDO $db) {
        $this->db=$db;         
	}
      
	public function Listar()    {  
		$conn = $this->db;
		$query = "SELECT p.ID , p.PATRIMONIO , p.DESCRICAO , p.ID_LOCALIDADE , p.TOMBAMENTO ,DATE_FORMAT(p.DT_CAD, '%d-%m-%Y')as DT_CAD ,p.ATIVO ,p.FOTO, l.DESCRICAO as LOCAL FROM patrimonio p , localidade l where p.ID_LOCALIDADE = l.ID and p.ativo = 1;";
		$response = \processador\Processador::action($query, $conn);
		return $response;
	}  
          
	public function cadastrar($item) {
		$conn = $this->db;
		$tabela = $item['table'];
		
		$data = array(
			'PATRIMONIO' 		=> 	$item['PATRIMONIO'],
			'DESCRICAO' 	=>	$item['descricao'],
			'ID_LOCALIDADE'	=> 	$item['idLocalidade'],
			'TOMBAMENTO'	=> 	$item['tombamento'],
			'FOTO'			=> 	$item['foto']
		);

		$response = \processador\Processador::providerAction($data, $conn, $tabela, 'Adicionar produto');
		return $response;
	}
      
	public function buscarAll($query) {

		$response = null;
		
		if($query != null){

			$conn = $this->db;
			$query = "SELECT p.ID , p.PATRIMONIO, p.DESCRICAO, p.ID_LOCALIDADE, p.TOMBAMENTO, DATE_FORMAT(p.DT_CAD, '%d-%m-%Y')as DT_CAD, p.ATIVO, l.DESCRICAO as LOCAL , p.FOTO FROM PATRIMONIO p INNER JOIN localidade l on l.id = p.id_localidade where (p.TOMBAMENTO like '%".$query."%' or p.PATRIMONIO like '%".$query."%' or p.DESCRICAO like '%".$query."%' or l.DESCRICAO like '%".$query."%') and p.ativo = 1";
			//fazer busca sql no banco
			$response = \processador\Processador::action($query, $conn);
		}
		else{
			$response  = $this->Listar();
		}

		return $response;
	}
        
	public function deletar($tombamento) {
		$conn = $this->db;   
		$query = "UPDATE patrimonio SET ATIVO= 0 WHERE tombamento = $tombamento";
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Deixou inativo ');
		return $retorno;
	}
      
	public function atualizar($item) {
		$conn = $this->db;
		$query = 'UPDATE `patrimonio` SET PATRIMONIO="'.$item['produto'].'", DESCRICAO="'.$item['descricao'].'"';
		
		if($item['foto']){
			$query .=', FOTO = "'.$item['foto'].'" ';
		}
		if($item['idLocalidade']){
			$query .=' ,ID_LOCALIDADE= '.$item['idLocalidade'];
		}
		$query .=' WHERE TOMBAMENTO='.$item['tombamento'].' ;';
		
		$retorno = \processador\Processador::actionProvider($query, $conn, 'Atualizar Item');
		return $retorno;

	}
     
    public function atualizarLocalProduto($prod_json) {
		$conn = $this->db;	   
		$query = 'UPDATE patrimonio set ID_LOCALIDADE='.$prod_json['idLocalidade'].' where ID='.$prod_json['id'].';';
		$retorno = \processador\Processador::actionProvider($query, $conn, 'atualizar Produto');
		return $retorno;
    }
}

