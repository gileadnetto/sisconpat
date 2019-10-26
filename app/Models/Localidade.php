<?php
namespace App\Models;

Class Localidade
{
	protected $table = "localidade";
	private $descricao;
	private $id_endereco;
	private $ativo;	

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

    public function jsonSerialize()
	{
        return get_object_vars($this);
    }
}


