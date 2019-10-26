<?php
namespace App\Models;

Class Transferencia{
        protected $table ="Transferencia"; 
        private $idOrigem;//Localidade
        private $idDestino;//Localidade
        private $quant;//int
        private $idUsuario;//Usuario
        private $dtMov;//TIMESTAMP
               
        function getTable() {
            return $this->table;
        }

        function getIdOrigem() {
            return $this->idOrigem;
        }

        function getIdDestino() {
            return $this->idDestino;
        }

        function getQuant() {
            return $this->quant;
        }

        function getIdUsuario() {
            return $this->idUsuario;
        }
        
        function getDtMov() {
            return $this->dtMov;
        }

        function setTable($table) {
            $this->table = $table;
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
            $this->idUsuario = $Transferencia['Usuario'];
            $this->quant = $Transferencia['Quantidade'];
        }
        
        public function checkConstraint() {
            
        }
}


