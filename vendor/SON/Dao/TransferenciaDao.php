<?php
namespace SON\Dao;
include_once('requisicoes.php');
include_once('processador.php');
require_once 'config.php';

class TransferenciaDao {    
	protected $db;
	protected $table;  
  
	public function __construct(\PDO $db) {
		$this->db=$db;         
	}

	public function getItensTransferencia($local_inicial) {

		$conn = $this->db;
		$query = "SELECT p.ID , p.PATRIMONIO , p.DESCRICAO , p.ID_LOCALIDADE , p.TOMBAMENTO ,DATE_FORMAT(p.DT_CAD, '%d-%m-%Y')as DT_CAD ,p.ATIVO ,p.FOTO, l.DESCRICAO as LOCAL FROM patrimonio p , localidade l where p.ID_LOCALIDADE = l.ID and p.ID_LOCALIDADE=$local_inicial and p.ativo = 1;";
		$response = \processador\Processador::action($query, $conn);
		return $response;
	}
       
	public function getMinhasTransferencias($idUsuario) {
		$conn = $this->db;

		$query = 'SELECT t.ID,t.ID_ORIGEM,t.ID_DESTINO,t.ID_USUARIO, t.QUANT,t.DT_MOV,l.DESCRICAO as destino, l2.DESCRICAO as origem FROM transferencia t join localidade l on l.id = t.ID_DESTINO join localidade l2 on l2.id = t.ID_ORIGEM where t.ID_USUARIO = '.$idUsuario.' order by(t.DT_MOV)desc';
		$retorno = \processador\Processador::action($query, $conn);
		return $retorno;
	}
       
	public function transferir($trans_json) {
		$conn = $this->db;
		$query = 'INSERT INTO transferencia (ID_ORIGEM,ID_DESTINO,QUANT,ID_USUARIO) VALUES('.$trans_json['idOrigem'].','.$trans_json['idDestino'].','.$trans_json['quant'].','.$trans_json['idUsuario'].');';
		$retorno = \processador\Processador::actionProvider($query, $conn,'Tramitou');
		
		//ao tramitar devo atualizar o patrimonio
		if(!$retorno['erro']){
			$retornoUltimo = $this->UltimaTransferencia();
		}
		return $retornoUltimo;
	}
	public function UltimaTransferencia(){
		$conn = $this->db;	
		$query = "SELECT * FROM transferencia ORDER BY transferencia.id DESC LIMIT 1";
		$retorno = \processador\Processador::action($query, $conn);
		return $retorno;	
    } 
       
	public function transferir_item($trans_json) {
		$idItem = $trans_json['idItem'];
		$idTransferencia = $trans_json['idTransferencia'];
		$conn = $this->db;

		$query = 'INSERT INTO transferencia_item (id_transferencia,id_item) values('.$idTransferencia.', '.$idItem.');';
		$retorno = \processador\Processador::actionProvider($query, $conn);
	
		return $retorno;
	}       
       
	public function gerarPDF($idTransferencia) {
		$conn = $this->db;
		$query = "SELECT  t.id as idT , t.ID_USUARIO ,p.patrimonio, p.TOMBAMENTO ,p.descricao,p.ativo ,t.dt_mov, t.quant, l.descricao as destino, l2.descricao as origem from transferencia t join localidade l on l.id = t.id_destino join localidade l2 on l2.id = t.id_origem join transferencia_item ti on t.id = ti.id_transferencia join patrimonio p on p.id = ti.id_item and t.ID=$idTransferencia";
		$retorno = \processador\Processador::action($query, $conn);
		return $retorno;
	}
       
}
