<?php
namespace SON\Dao;
use PDO;
use App\Models\Endereco;

class EnderecoDao extends baseDao{
	protected $db;
	protected $table = "ENDERECO";

	/**
	 * Função responsavel por persistir a localidade
	 * @param Localidade $localidade
	 * @return array
	 */
	public function save(Endereco $endereco) {
	    $sth = $this->db->prepare('INSERT INTO ENDERECO (localidade, cep, logradouro, bairro, numero, complemento, uf) 
                                    VALUES(:localidade, :cep, :logradouro, :bairro, :numero, :complemento, :uf);');
	    
	    $sth->bindParam(':localidade',     $endereco->getLocalidade(),     PDO::PARAM_STR);
	    $sth->bindParam(':cep',            $endereco->getCep(),            PDO::PARAM_STR);
	    $sth->bindParam(':logradouro',     $endereco->getLogradouro(),     PDO::PARAM_STR);
	    $sth->bindParam(':bairro',         $endereco->getBairro(),         PDO::PARAM_STR);
	    $sth->bindParam(':numero',         $endereco->getNumero(),         PDO::PARAM_INT);
	    $sth->bindParam(':complemento',    $endereco->getComplemento(),    PDO::PARAM_STR);
	    $sth->bindParam(':uf',             $endereco->getUf(),             PDO::PARAM_STR);
	    $sth->execute();
	    $endereco->setId($this->db->lastInsertId());
	}
	
	/**
	 * Função responsavel por persistir a atualização da localidade
	 * @param Localidade $localidade
	 * @return array
	 */
	public function atualizar(Endereco $endereco) {
	    $sth = $this->db->prepare('UPDATE ENDERECO SET 
                                    LOCALIDADE = ":localidade" , 
                                    CEP = ":cep", 
                                    LOGRADOURO = ":logradouro", 
                                    BAIRRO = ":bairro", 
                                    NUMERO = ":numero", 
                                    COMPLEMENTO = ":complemento",  
                                    UF = :uf where ID = :id');
	    
	    $sth->bindParam(':localidade',     $endereco->getLocalidade(),     PDO::PARAM_STR);
	    $sth->bindParam(':cep',            $endereco->getCep(),            PDO::PARAM_STR);
	    $sth->bindParam(':logradouro',     $endereco->getLogradouro(),     PDO::PARAM_STR);
	    $sth->bindParam(':bairro',         $endereco->getBairro(),         PDO::PARAM_STR);
	    $sth->bindParam(':numero',         $endereco->getNr(),             PDO::PARAM_INT);
	    $sth->bindParam(':complemento',    $endereco->getComplemento(),    PDO::PARAM_STR);
	    $sth->bindParam(':uf',             $endereco->getUf(),             PDO::PARAM_STR);
	    
	    $result = $sth->execute();
	    return  $result->fetchAll();
	}
}

