<?php
namespace App\Models;

use SON\Db\TransferenciaDb;

Class Transferencia extends TransferenciaDb{
        protected $table ="Transferencia"; 
        private $idOrigem;
        private $idDestino;
        private $quant;
        private $idUsuario;
        
               
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

        function setTable($table) {
            $this->table = $table;
        }

        function setIdOrigem($idOrigem) {
            $this->idOrigem = $idOrigem;
        }

        function setIdDestino($idDestino) {
            $this->idDestino = $idDestino;
        }

        function setQuant($quant) {
            $this->quant = $quant;
        }

        function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }
        
        public function jsonSerialize() {
        return get_object_vars($this);
    }



}


