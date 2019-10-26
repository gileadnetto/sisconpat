<?php
namespace SON\Dao;
use PDO;
use App\Models\Patrimonio;

class PatrimonioDao extends baseDao{
    protected $db;
    protected $table = "PATRIMONIO";   
          
	/**
	 * Função responsavel por persistir o patrimonio
	 * @param Patrimonio $patrimonio
	 * @return array
	 */
	public function save(Patrimonio $patrimonio) {
	    try {
    		$sth = $this->db->prepare('INSERT INTO PATRIMONIO (PATRIMONIO, DESCRICAO, ID_LOCALIDADE, TOMBAMENTO, FOTO, VALOR, VIDAUTIL) VALUES (:patrimonio, :descricao, :idLocalidade, :tombamento, :foto, :valor, :vidautil);');
    		
    		$sth->bindParam(':patrimonio',    $patrimonio->getPatrimonio(),   PDO::PARAM_INT);
    		$sth->bindParam(':descricao',     $patrimonio->getDescricao(),    PDO::PARAM_STR);
    		$sth->bindParam(':id_localidade', $patrimonio->getIdLocalidade(), PDO::PARAM_INT);
    		$sth->bindParam(':tombamento',    $patrimonio->getTombamento(),   PDO::PARAM_INT);
    		$sth->bindParam(':valor',         $patrimonio->getTombamento());
    		$sth->bindParam(':vidautil',      $patrimonio->getTombamento(),   PDO::PARAM_INT);
    		$sth->bindParam(':foto',          $patrimonio->getFoto());
    		
    		$sth->execute();
    		$this->db->commit();
    		return ['success' => true];
	    } catch (\Exception $e) {
	        $this->db->rollBack();
	        return ['success' => false, 'msg' => $e->getMessage()];
	    }
	}
      
	/**
	 * Função responsavel por persistir a atualização do patrimonio
	 * @param Patrimonio $patrimonio
	 * @return array
	 */
	public function update(Patrimonio $patrimonio) {

		$query = 'UPDATE PATRIMONIO SET PATRIMONIO = ":patrimonio", DESCRICAO = ":descricao"';
		
		if($patrimonio->idLocalidade) $query .=' ,ID_LOCALIDADE = :idlocalidade';
		if($patrimonio->foto) $query .=', FOTO = ":foto" ';
		
		$query .=' WHERE TOMBAMENTO = :tombamento;';
		
		$sth = $this->db->prepare($query);
		
		$sth->bindParam(':patrimonio',    $patrimonio->getPatrimonio(),   PDO::PARAM_INT);
		$sth->bindParam(':descricao',     $patrimonio->getDescricao(),    PDO::PARAM_STR);
		$sth->bindParam(':id_localidade', $patrimonio->getIdLocalidade(), PDO::PARAM_INT);
		$sth->bindParam(':tombamento',    $patrimonio->getTombamento(),   PDO::PARAM_INT);
		$sth->bindParam(':foto',          $patrimonio->getFoto());

		return $sth->execute();
	}
	
	/**
	 * Função responsavel por retornar a listagem dos patrimonio
	 * @return array
	 */
	public function getList() {
	    
	    $sth = $this->db->prepare("SELECT P.ID , P.PATRIMONIO , P.DESCRICAO , L.DESCRICAO as LOCALIDADE, P.VALOR, P.VIDAUTIL,P.VALORDEPRECIACAO ,P.TOMBAMENTO , P.DT_CAD, P.ATIVO, P.FOTO FROM PATRIMONIO P, LOCALIDADE L where P.ID_LOCALIDADE = L.ID;");
	    
	    $sth->execute();
	    
	    return  PARENT::returnResult($sth);
	} 	
     
    public function atualizarLocalPatrimonio($pat_json) {
		$conn = $this->db;	   
		$query = 'UPDATE patrimonio set ID_LOCALIDADE='.$pat_json['idLocalidade'].' where ID='.$pat_json['id'].';';
		$retorno = \processador\Processador::actionProvider($query, $conn, 'atualizar Patrimonio');
		return $retorno;
    }
}

