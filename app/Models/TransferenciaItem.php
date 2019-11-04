<?php
namespace App\Models;

Class TransferenciaItem{
    protected $table ="Transferencia_item"; 
	private $idTransferencia;
	private $idItem;

	public function setId_transferencia($idTransferencia){
		$this->idTransferencia=$idTransferencia;
	}

	public function setId_item($idItem){
		$this->idItem=$idItem;
	}

	public function getId_transferencia(){
	   return $this->idTransferencia;
	}

	public function getId_item(){
	   return $this->idItem;
	}
	
	public function jsonSerialize() {
        return get_object_vars($this);
    }
}





