<?php
namespace App\Models;

Class Patrimonio {
	protected $table ="patrimonio";

	private $id;
	private $patrimonio;
	private $descricao;
	private $idLocalidade;
	private $tombamento;
	private $ativo;
	private $foto;
	private $id_user_session;
	private $valor;
	private $vidautil;
	private $valordepreciacao;
	private $dt_cad;
	private $dt_mod;
	
	
    public function getId()
    {
        return $this->id;
    }

    public function getPatrimonio()
    {
        return $this->patrimonio;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getIdLocalidade()
    {
        return $this->idLocalidade;
    }

    public function getTombamento()
    {
        return $this->tombamento;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getId_user_session()
    {
        return $this->id_user_session;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getVidautil()
    {
        return $this->vidautil;
    }

    public function getValordepreciacao()
    {
        return $this->valordepreciacao;
    }

    public function getDt_cad()
    {
        return $this->dt_cad;
    }

    public function getDt_mod()
    {
        return $this->dt_mod;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPatrimonio($patrimonio)
    {
        $this->patrimonio = $patrimonio;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setIdLocalidade($idLocalidade)
    {
        $this->idLocalidade = $idLocalidade;
    }

    public function setTombamento($tombamento)
    {
        $this->tombamento = $tombamento;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function setId_user_session($id_user_session)
    {
        $this->id_user_session = $id_user_session;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function setVidautil($vidautil)
    {
        $this->vidautil = $vidautil;
    }

    public function setValordepreciacao($valordepreciacao)
    {
        $this->valordepreciacao = $valordepreciacao;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}


