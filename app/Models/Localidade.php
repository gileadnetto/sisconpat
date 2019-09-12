<?php
namespace App\Models;

Class Localidade{
	protected $table ="localidade";
	private $descricao;
	private $endereco;
	private $ativo;

	public function setId($id){
		$this->id=$id;
	}

	public function setDescricao($descricao){
		$this->descricao=$descricao;
	}

	public function setEndereco($endereco){
		$this->endereco=$endereco;
	}

	public function setAtivo($ativo){
	    $this->ativo=$ativo;
	}
	
	public function getEndereco(){
		return $this->endereco;
	}

	public function getId(){
		return $this->id;
	}

	public function getDescricao(){
		return $this->descricao;
	}
	
	public function getAtivo(){
	    return $this->ativo;
	}
	
	public function jsonSerialize() {
        return get_object_vars($this);
    }
}


