<?php
namespace App\Models;

Class Localidade
{
	protected $table = "localidade";
	private $descricao;
	private $id_endereco;
	private $ativo;
	private $id_user_session;

    public function getTable()
    {
        return $this->table;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getId_endereco()
    {
        return $this->id_endereco;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }
    
    public function getId_User_Session()
    {
        return $this->id_user_session;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setId_endereco($id_endereco)
    {
        $this->id_endereco = $id_endereco;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
    
    public function setId_User_Session($id_user_session)
    {
        $this->id_user_session = $id_user_session;
    }

    public function jsonSerialize()
	{
        return get_object_vars($this);
    }
}


