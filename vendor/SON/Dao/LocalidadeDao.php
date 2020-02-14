<?php
namespace SON\Dao;
use PDO;
use App\Models\Localidade;
use App\Models\Endereco;

class LocalidadeDao extends baseDao{
	protected $db;
	protected $table = "LOCALIDADE";

	/**
	 * Fun��o responsavel por persistir a localidade junto com o endere�o
	 * @param Localidade $localidade
     * @param Endereco $endereco
	 * @return array
	 */
	public function save(Localidade $localidade, Endereco $endereco)
	{
	    try {
	        $this->db->beginTransaction();

	        $this->saveEndereco($endereco);

	        $lastInsertId = $this->db->lastInsertId();

	        $sth = $this->db->prepare('INSERT INTO LOCALIDADE (DESCRICAO, ID_ENDERECO, ATIVO, ID_USER_SESSION) VALUES(:descricao, :idendereco, :ativo, :id_user_session);');
	        // bindParam
	        $sth->bindValue(':descricao',          $localidade->getDescricao(),        PDO::PARAM_STR);
	        $sth->bindValue(':idendereco',         $lastInsertId,                      PDO::PARAM_STR);
	        $sth->bindValue(':ativo',              $localidade->getAtivo(),            PDO::PARAM_BOOL);
	        $sth->bindValue(':id_user_session',    $localidade->getId_User_Session(),  PDO::PARAM_INT);

	        $sth->execute();
	        $this->db->commit();
	        return ['success' => true];
	    } catch (\Exception $e) {
	        $this->db->rollBack();
	        return ['success' => false, 'msg' => $e->getMessage()];
	    }
	}

	/**
	 * Fun��o responsavel por persistir a localidade
	 * @param Localidade $localidade
	 * @return array
	 */
	private function saveEndereco(Endereco $endereco) {
	    if(empty($endereco->getId())){
	       $sth = $this->db->prepare('INSERT INTO ENDERECO (localidade, cep, logradouro, bairro, numero, complemento, uf)
                                    VALUES(:localidade, :cep, :logradouro, :bairro, :numero, :complemento, :uf);');
	    } else {
	        $sth = $this->db->prepare('UPDATE ENDERECO SET LOCALIDADE = ":localidade" , CEP = ":cep", LOGRADOURO = ":logradouro",
                                    BAIRRO = ":bairro", NUMERO = ":numero", COMPLEMENTO = ":complemento", UF = :uf where ID = :id');
	        $sth->bindParam(':id',         $endereco->getId(),             PDO::PARAM_INT);
	    }
		// bindParam
	    $sth->bindValue(':localidade',     $endereco->getLocalidade(),     PDO::PARAM_STR);
	    $sth->bindValue(':cep',            $endereco->getCep(),            PDO::PARAM_STR);
	    $sth->bindValue(':logradouro',     $endereco->getLogradouro(),     PDO::PARAM_STR);
	    $sth->bindValue(':bairro',         $endereco->getBairro(),         PDO::PARAM_STR);
	    $sth->bindValue(':numero',         $endereco->getNumero(),         PDO::PARAM_INT);
	    $sth->bindValue(':complemento',    $endereco->getComplemento(),    PDO::PARAM_STR);
	    $sth->bindValue(':uf',             $endereco->getUf(),             PDO::PARAM_STR);
	    $sth->execute();
	}

	/**
	 * Fun��o responsavel por persistir a atualiza��o da localidade
	 * @param Localidade $localidade
	 * @return array
	 */
	public function atualizar(Localidade $localidade, Endereco $endereco)
	{
	    try {
    	    $this->db->beginTransaction();

    	    $sth = $this->db->prepare('UPDATE LOCALIDADE set DESCRICAO = ":descricao" , ID_ENDERECO = ":idendereco", ATIVO = :ativo where ID = :id');

    	    $sth->bindParam(':descricao',  $localidade->getDescricao(),    PDO::PARAM_STR);
    	    $sth->bindParam(':idendereco', $localidade->getId_endereco(),  PDO::PARAM_STR);
    	    $sth->bindParam(':ativo',      $localidade->getAtivo(),        PDO::PARAM_BOOL);
    	    $sth->bindParam(':id',         $localidade->getId(),           PDO::PARAM_BOOL);

    	    $sth->execute();

    	    $this->saveEndereco($endereco);

    	    return $this->db->commit();
	    }  catch (\Exception $e) {
	        $this->db->rollBack();
	        return $e->getMessage();
	    }
	}

	/**
	 * Fun��o responsavel por retornar a listagem das localidades
	 * @return
	 */
	public function getList()
	{
	    $sth = $this->db->prepare("SELECT *  FROM ".$this->table." INNER JOIN ENDERECO E ON E.ID = ID_ENDERECO");
	    $sth->execute();

	    return parent::returnResult($sth);
	}

	/**
	 * Fun��o responsavel por retornar a listagem das localidades para o autocomplete
	 * @return
	 */
	public function getAutoCompleteList($param = false)
	{
	    $sql = "SELECT * FROM ".$this->table." L";

	    if($param) $sql = $sql . " WHERE L.DESCRICAO like '%" . $param['term'] . "%'";

	    $sth = $this->db->prepare($sql);
	    $sth->execute();

	    return parent::returnResult($sth);
	}
}

