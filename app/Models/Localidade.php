<?php
namespace App\Models;

use SON\Db\LocalidadeDb;

Class Localidade extends LocalidadeDb{
	protected $table ="localidade";
	private $descricao;
	private $endereco;
	
	//function __construct(){
	//}

	public function setId($id){
		$this->id=$id;
	}

	public function setDescricao($descricao){
		$this->descricao=$descricao;
	}

	public function setEndereco($endereco){
		$this->endereco=$endereco;
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
	
	public function jsonSerialize() {
        return get_object_vars($this);
    }
}


