<?php
namespace App\Models;

Class Transferencia{
        protected $table ="Transferencia"; 
        private $idOrigem;//Localidade
        private $idDestino;//Localidade
        private $quant;//int
        private $dtMov;//TIMESTAMP
        private $id_user_session;
        
        public function getIdOrigem()
        {
            return $this->idOrigem;
        }
    
        public function getIdDestino()
        {
            return $this->idDestino;
        }
    
        public function getQuant()
        {
            return $this->quant;
        }
    
        public function getDtMov()
        {
            return $this->dtMov;
        }
    
        public function getId_user_session()
        {
            return $this->id_user_session;
        }
    
        public function setIdOrigem($idOrigem)
        {
            $this->idOrigem = $idOrigem;
        }
    
        public function setIdDestino($idDestino)
        {
            $this->idDestino = $idDestino;
        }
    
        public function setQuant($quant)
        {
            $this->quant = $quant;
        }
    
        public function setDtMov($dtMov)
        {
            $this->dtMov = $dtMov;
        }
    
        public function setId_user_session($id_user_session)
        {
            $this->id_user_session = $id_user_session;
        }
    
        public function jsonSerialize() {
            return get_object_vars($this);
        }
        
        /**
         * Função responsavel por montar a entidade de transferencia.
         * @param array $Transferencia
         */
        public function exchangeArray(array $Transferencia) { 
            $this->idOrigem = $Transferencia['Origem'];
            $this->idDestino = $Transferencia['Destino'];
            $this->quant = count($Transferencia['idsPatrimonios']);
            $this->id_user_session = $Transferencia['id_user_session'];
            $this->dtMov = $Transferencia['data'];
        }
        
        public function checkConstraint() {
            
        }
}


