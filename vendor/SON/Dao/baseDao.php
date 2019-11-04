<?php
namespace SON\Dao;
use PDO;

class baseDao {
    protected $db;
    protected $table;
    private $beginTransaction;
    
    
    /**
     * Contrutor padrão para instanciar o PDO
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
   
    /**
     * Função responsavel por retornar toda a entidade
     * @return entidade
     */
    public function get()
    {       
        $sth = $this->db->prepare("SELECT *  FROM ".$this->table."");
        $sth->execute();
        
        return $this->returnResult($sth);
    }
    
    /**
     * Função resposanvel por retornar a entidade pela ID
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
     * Função responsavel por montar um retorno padrão
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
