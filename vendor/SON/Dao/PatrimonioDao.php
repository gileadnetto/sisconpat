<?php
namespace SON\Dao;
use PDO;
use App\Models\Patrimonio;

class PatrimonioDao extends baseDao{
    protected $db;
    protected $table = "PATRIMONIO";   
          
	/**
	 * Fun��o responsavel por persistir o patrimonio
	 * @param Patrimonio $patrimonio
	 * @return array
	 */
	public function save(Patrimonio $patrimonio) {
	    try {
	        $this->db->beginTransaction();
	        
    		$sth = $this->db->prepare('INSERT INTO PATRIMONIO (PATRIMONIO, DESCRICAO, ID_LOCALIDADE, TOMBAMENTO, FOTO, VALOR, VIDAUTIL, ID_USER_SESSION) VALUES (:patrimonio, :descricao, :idLocalidade, :tombamento, :foto, :valor, :vidautil, :idusersession);');
    		
    		$sth->bindValue(':patrimonio',    $patrimonio->getPatrimonio(),       PDO::PARAM_STR);
    		$sth->bindValue(':descricao',     $patrimonio->getDescricao(),        PDO::PARAM_STR);
    		$sth->bindValue(':idLocalidade',  $patrimonio->getIdLocalidade(),     PDO::PARAM_INT);
    		$sth->bindValue(':tombamento',    $patrimonio->getTombamento(),       PDO::PARAM_INT);
    		$sth->bindValue(':foto',          $patrimonio->getFoto());
    		$sth->bindValue(':valor',         $patrimonio->getValor());
    		$sth->bindValue(':vidautil',      $patrimonio->getVidautil(),         PDO::PARAM_INT);
    		$sth->bindValue(':idusersession', $patrimonio->getId_user_session(),  PDO::PARAM_INT);
    		
    		
    		$sth->execute();
    		$this->db->commit();
    		return ['success' => true];
	    } catch (\Exception $e) {
	        $this->db->rollBack();
	        return ['success' => false, 'msg' => $e->getMessage()];
	    }
	}
      
	/**
	 * Fun��o responsavel por persistir a atualiza��o do patrimonio
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
	 * Fun��o responsavel por retornar a listagem dos patrimonio
	 * @return array
	 */
	public function getList() {
	    
	    $sth = $this->db->prepare("SELECT P.ID , P.PATRIMONIO , P.DESCRICAO , L.DESCRICAO as LOCALIDADE, P.VALOR, P.VIDAUTIL,P.VALORDEPRECIACAO ,P.TOMBAMENTO , P.DT_CAD, P.ATIVO, P.FOTO FROM PATRIMONIO P, LOCALIDADE L WHERE P.ID_LOCALIDADE = L.ID ORDER By P.DT_CAD DESC ");
	    
	    $sth->execute();
	    
	    return  PARENT::returnResult($sth);
	}
	
	/**
	 * Fun��o responsavel por retornar a listagem das patrimonios para o autocomplete
	 * @return
	 */
	public function getAutoCompleteList($param = false)
	{
	    $sql = "SELECT *  FROM ".$this->table." P";
	    
	    if($param) $sql = $sql . " WHERE P.DESCRICAO like '%" . $param['term'] . "%' OR P.TOMBAMENTO = '" . $param['term'] . "'";
	    
	    $sth = $this->db->prepare($sql);
	    $sth->execute();
	    
	    return parent::returnResult($sth);
	}
     
    public function atualizarLocalPatrimonio($pat_json) {
		$conn = $this->db;	   
		$query = 'UPDATE patrimonio set ID_LOCALIDADE='.$pat_json['idLocalidade'].' where ID='.$pat_json['id'].';';
		$retorno = \processador\Processador::actionProvider($query, $conn, 'atualizar Patrimonio');
		return $retorno;
	}
	
	public function ultimosCadastros( $limit = 10 ) {
		$conn = $this->db;   
		$query   =  "SELECT PATRIMONIO, DESCRICAO, FOTO, DT_CAD, VALOR, TOMBAMENTO FROM `patrimonio` ORDER BY DT_CAD DESC LIMIT $limit;";
		$retorno = \processador\Processador::action($query, $conn);
		return $retorno;
	}
}

