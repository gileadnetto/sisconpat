<?php
namespace App\Models;

Class Endereco
{
	protected $table = "endereco";
	private $id;
	private $localidade;
	private $cep;
	private $logradouro;
	private $bairro;
	private $numero;	
	private $complemento;
	private $uf;

    public function getId()
    {
        return $this->id;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getLocalidade()
    {
        return $this->localidade;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setTable($table)
    {
        $this->table = $table;
    }

    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    public function jsonSerialize()
	{
        return get_object_vars($this);
    }
}


