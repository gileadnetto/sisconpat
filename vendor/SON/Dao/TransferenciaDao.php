<?php
namespace SON\Dao;
use App\Models\Transferencia;
use PDO;
use App\Models\TransferenciaItem;

class TransferenciaDao extends baseDao{
	protected $db;
	protected $table = "TRANSFERENCIA";  
	
	/**
	 * Fun��o responsavel por realizar a persistencia da transferencia
	 * @param Transferencia $transferencia
	 * @param array[Patrimonio] $patrimonio
	 * @return array
	 */
	public function transferir(Transferencia $transferencia, array $patrimonios) 
	{
	    try {
    	    $this->db->beginTransaction();
    	    
    	    $sth = $this->db->prepare('INSERT INTO transferencia (ID_ORIGEM,ID_DESTINO,DT_MOV,QUANT,ID_USER_SESSION) VALUES(:idOrigem,:idDestino,:data, :quant,:idUserSession);');
    	    
    	    $sth->bindValue(':idOrigem', $transferencia->getIdOrigem(), PDO::PARAM_INT);
    	    $sth->bindValue(':idDestino', $transferencia->getIdDestino(), PDO::PARAM_INT);
    	    $sth->bindValue(':data', $transferencia->getDtMov());
    	    $sth->bindValue(':quant', $transferencia->getQuant(), PDO::PARAM_INT);
    	    $sth->bindValue(':idUserSession', $transferencia->getId_user_session(), PDO::PARAM_INT);
    	    
    	    $sth->execute();
    	    
    	    $lastInsertId = $this->db->lastInsertId();
    	    
    	    foreach ($patrimonios as $key){
    	        $sth = $this->db->prepare('INSERT INTO transferencia_item (ID_TRANSFERENCIA,ID_ITEM) VALUES(:idTransferencia,:idItem);');
    	        $sth->bindValue(':idTransferencia', $lastInsertId, PDO::PARAM_INT);
    	        $sth->bindValue(':idItem', $key, PDO::PARAM_INT);
    	        $sth->execute();
    	        
    	        $sth = $this->db->prepare('UPDATE PATRIMONIO SET ID_LOCALIDADE = :idLocalidade WHERE ID = :idPatrimonio');
    	        $sth->bindValue(':idLocalidade', $transferencia->getIdDestino(), PDO::PARAM_INT);
    	        $sth->bindValue(':idPatrimonio', $key, PDO::PARAM_INT);
    	        $sth->execute();
    	    }
    	    
    	    $this->db->commit();
    	    return ['success' => true];
	    } catch (\Exception $e) {
	        $this->db->rollBack();
	        return ['success' => false, 'msg' => $e->getMessage()];
	    }
	}
	
	/**
	 * Fun��o responsavel por retornar a listagem das localidades
	 * @return
	 */
	public function getList()
	{
	    $sth = $this->db->prepare("
            SELECT 
                (SELECT L.DESCRICAO FROM LOCALIDADE L WHERE L.ID = T.ID_ORIGEM) AS ORIGEM,
                (SELECT L.DESCRICAO FROM LOCALIDADE L WHERE L.ID = T.ID_DESTINO) AS DESTINO,
                T.QUANT,                 
                T.DT_MOV AS DATA,
                U.LOGIN AS USUARIO  
            FROM ".$this->table." T 
            INNER JOIN USER_SESSION U ON U.ID = T.ID_USER_SESSION
        ");
	    $sth->execute();
	    
	    return parent::returnResult($sth);
	}
	
	public function getItensTransferencia($local_inicial) {

		$conn = $this->db;
		$query = "SELECT p.ID , p.PATRIMONIO , p.DESCRICAO , p.ID_LOCALIDADE , p.TOMBAMENTO ,DATE_FORMAT(p.DT_CAD, '%d-%m-%Y')as DT_CAD ,p.ATIVO ,p.FOTO, l.DESCRICAO as LOCAL FROM patrimonio p , localidade l where p.ID_LOCALIDADE = l.ID and p.ID_LOCALIDADE=$local_inicial and p.ativo = 1;";
		$response = \processador\Processador::action($query, $conn);
		return $response;
	}
       
	public function getMinhasTransferencias($idUsuario) {
		$conn = $this->db;

		$query = 'SELECT t.ID,t.ID_ORIGEM,t.ID_DESTINO,t.ID_USER_SESSION, t.QUANT,t.DT_MOV,l.DESCRICAO as destino, l2.DESCRICAO as origem FROM transferencia t join localidade l on l.id = t.ID_DESTINO join localidade l2 on l2.id = t.ID_ORIGEM where t.ID_USER_SESSION = '.$idUsuario.' order by(t.DT_MOV)desc';
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
		$sth = $this->db->prepare("SELECT  t.id as idT , t.ID_USER_SESSION ,p.patrimonio, p.TOMBAMENTO ,p.descricao,p.ativo ,t.dt_mov, t.quant, l.descricao as destino, l2.descricao as origem from transferencia t join localidade l on l.id = t.id_destino join localidade l2 on l2.id = t.id_origem join transferencia_item ti on t.id = ti.id_transferencia join patrimonio p on p.id = ti.id_item and t.ID=$idTransferencia");
		$sth->execute();
	
		return parent::returnResult($sth);

		// $conn = $this->db;
		// $query = "SELECT  t.id as idT , t.ID_USUARIO ,p.patrimonio, p.TOMBAMENTO ,p.descricao,p.ativo ,t.dt_mov, t.quant, l.descricao as destino, l2.descricao as origem from transferencia t join localidade l on l.id = t.id_destino join localidade l2 on l2.id = t.id_origem join transferencia_item ti on t.id = ti.id_transferencia join patrimonio p on p.id = ti.id_item and t.ID=$idTransferencia";
		// $retorno = \processador\Processador::action($query, $conn);
		// return $retorno;
	}
       
}
