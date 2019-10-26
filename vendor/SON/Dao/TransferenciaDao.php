<?php
namespace SON\Dao;
use App\Models\Transferencia;
use PDO;
use App\Models\TransferenciaItem;

class TransferenciaDao{    
	protected $db;
	protected $table = "TRANSFERENCIA";  
	
	/**
	 * Contrutor padrão para instanciar o PDO
	 * @param PDO $db
	 */
	protected function __construct(PDO $db)
	{
	    $this->db = $db;
	}
	
	/**
	 * Função responsavel por retornar toda a entidade
	 * @return entidade
	 */
	protected function get()
	{
	    $sth = $this->db->prepare('SELECT * FROM :TABLE');
	    
	    $sth->bindParam(':TABLE', $this->table, PDO::PARAM_STR);
	    
	    $result = $sth->execute();
	    
	    return  $result->fetchAll();
	}
	
	/**
	 * Função resposanvel por retornar a entidade pela ID
	 * @param int $id
	 * @return entidade
	 */
	protected function getById(int $id)
	{
	    $sth = $this->db->prepare('SELECT * FROM :TABLE WHERE :ID');
	    
	    $sth->bindParam(':TABLE', $this->table, PDO::PARAM_STR);
	    $sth->bindParam(':ID', $id, PDO::PARAM_INT);
	    
	    $result = $sth->execute();
	    
	    return  $result->fetchAll();
	}
	
	/**
	 * Função responsavel por realizar a persistencia da transferencia
	 * @param Transferencia $transferencia
	 * @return array
	 */
	public function transferir(Transferencia $transferencia) {
	    
	    $sth = $this->db->prepare('INSERT INTO transferencia (ID_ORIGEM,ID_DESTINO,QUANT,ID_USUARIO) VALUES(:idOrigem,:idDestino,:quant,:idUsuario);');
	    
	    $sth->bindParam(':idOrigem', $this->table, PDO::PARAM_INT);
	    $sth->bindParam(':idDestino', $this->table, PDO::PARAM_INT);
	    $sth->bindParam(':quant', $this->table, PDO::PARAM_INT);
	    $sth->bindParam(':idUsuario', $this->table, PDO::PARAM_INT);
	    
	    $result = $sth->execute();
	    return  $result->fetchAll();
	}

	/**
	 * Função responsavel por realizar a persistencia dos itens da transferencia.
	 * @param TransferenciaItem $transferenciaItem
	 * @return array
	 */
	public function transferir_item(TransferenciaItem $transferenciaItem) {
	    
	    $sth = $this->db->prepare('INSERT INTO transferencia_item (id_transferencia,id_item) values(:idItem, :idTransferencia);');
	    
	    $sth->bindParam(':idItem', $this->table, PDO::PARAM_INT);
	    $sth->bindParam(':idTransferencia', $this->table, PDO::PARAM_INT);
	    
	    $result = $sth->execute();
	    return  $result->fetchAll();
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
       
	public function UltimaTransferencia(){
		$conn = $this->db;	
		$query = "SELECT * FROM transferencia ORDER BY transferencia.id DESC LIMIT 1";
		$retorno = \processador\Processador::action($query, $conn);
		return $retorno;	
    } 
       
	public function gerarPDF($idTransferencia) {
		$conn = $this->db;
		$query = "SELECT  t.id as idT , t.ID_USUARIO ,p.patrimonio, p.TOMBAMENTO ,p.descricao,p.ativo ,t.dt_mov, t.quant, l.descricao as destino, l2.descricao as origem from transferencia t join localidade l on l.id = t.id_destino join localidade l2 on l2.id = t.id_origem join transferencia_item ti on t.id = ti.id_transferencia join patrimonio p on p.id = ti.id_item and t.ID=$idTransferencia";
		$retorno = \processador\Processador::action($query, $conn);
		return $retorno;
	}
       
}
