<?php
namespace App\Models;

use SON\Db\TransferenciaDb;

Class TransferenciaItem extends TransferenciaDb{
        protected $table ="Transferencia_item"; 
	private $idTransferencia;
	private $idProduto;

	public function setId_transferencia($idTransferencia){
		$this->idTransferencia=$idTransferencia;
	}

	public function setId_produto($idProduto){
		$this->idProduto=$idProduto;
	}


	public function getId_transferencia(){
	
	return $this->idTransferencia;

	}

	public function getId_produto(){
	
	return $this->idProduto;

	}

	

	
	public function jsonSerialize() {
        return get_object_vars($this);
    }

}





