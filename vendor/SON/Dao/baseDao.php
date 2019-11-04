<?php
namespace SON\Dao;
use PDO;

class baseDao {
    protected $db;
    protected $table;
    private $beginTransaction;
    
    
    /**
     * Contrutor padr�o para instanciar o PDO
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
   
    /**
     * Fun��o responsavel por retornar toda a entidade
     * @return entidade
     */
    public function get()
    {       
        $sth = $this->db->prepare("SELECT *  FROM ".$this->table."");
        $sth->execute();
        
        return $this->returnResult($sth);
    }
    
    /**
     * Fun��o resposanvel por retornar a entidade pela ID
     * @param int $id
     * @return entidade
     */
    public function getById(int $id)
    {            
        $sth = $this->db->prepare("SELECT * FROM ".$this->table." WHERE :ID");
        
        $sth->bindParam(':ID', $id, PDO::PARAM_INT);
        
        $sth->execute();
        
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Fun��o responsavel por montar um retorno padr�o
     * @param \PDOStatement $sth
     * @return array
     */
    protected function returnResult(\PDOStatement $sth):array
    {
        return [
            'total' => $sth->rowCount(),
            'results' => $sth->fetchAll(PDO::FETCH_ASSOC)
        ];
    }
}
