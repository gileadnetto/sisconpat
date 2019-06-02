<?php
namespace App\Models;

use SON\Db\ItensDb;

Class Itens extends ItensDb{
		protected $table ="produtos";
 
		//private $id;
		private $produto;
		private $descricao;
		private $idLocalidade;
		private $tombamento;
		private $foto = 'tet';
		///private $DTCAD;

	public function setId($id){
		$this->id=$id;
	}

	public function setProduto($produto){
		$this->produto=$produto;
	}
	public function setDescricao($descricao){
		$this->descricao=$descricao;
	}
	public function setIdLocalidade($idLocalidade){
		$this->idLocalidade=$idLocalidade;
	}
	public function setTombamento($tombamento){
		$this->tombamento=$tombamento;
	}
	public function setDTCAD($DTCAD){
		$this->DTCAD=$DTCAD;
	}

	public function setFoto($foto){
		$this->foto = $foto;
	}

	public function getId(){
		return $this->id;
	}

	public function getProduto(){
		return $this->produto;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getIdLocalidade(){
		return $this->idLocalidade;
	}

	public function getTombamento(){
		return $this->tombamento;
	}

	public function getDTCAD(){
		return $this->DTCAD;
	}

	public function getFoto(){
		return $this->Foto;
	}

	public function jsonSerialize() {
        return get_object_vars($this);
    }

}


