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
    
    /**
     * Função responsavel por montar a entidade de transferencia.
     * @param array $arrTransferenciaItem
     */
    public function exchangeArray(array $arrTransferenciaItem) {
        $this->idOrigem = $arrTransferenciaItem['Origem'];
        $this->idDestino = $arrTransferenciaItem['Destino'];
        $this->idUsuario = $arrTransferenciaItem['Usuario'];
        $this->quant = $arrTransferenciaItem['Quantidade'];
    }

}





