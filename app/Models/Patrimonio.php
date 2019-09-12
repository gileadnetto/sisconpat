<?php
namespace App\Models;

use EntityRelation;

Class Patrimonio {
	protected $table ="patrimonio";

	//private $id;
	private $patrimonio;
	private $descricao;
	private $idLocalidade;
	private $tombamento;
	private $ativo;
	private $foto = 'tet';
	///private $DTCAD;

	public function setId($id){
		$this->id=$id;
	}

	public function setPatrimonio($patrimonio){
	    $this->patrimonio=$patrimonio;
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
	
	public function setAtivo($ativo){
	    $this->foto = $ativo;
	}

	public function getId(){
		return $this->id;
	}

	public function getPatrimonio(){
		return $this->patrimonio;
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
	
	public function getAtivo(){
	    return $this->ativo;
	}

	public function jsonSerialize() {
        return get_object_vars($this);
    }
}


