<?php
namespace App\Models;

Class Usuario{
    
	protected $table ="usuario";
       
	private $id;
	private $email;
	private $perfil;
	private $login;
	private $senha;
    
	public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setPerfil($perfil){
		$this->perfil=$perfil;
	}
	public function setSenha($senha){
		$this->senha=$senha;
	}
	public function setLogin($login){
		$this->login=$login;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function getLogin(){
		return $this->login;
	}

	public function jsonSerialize() {
        return get_object_vars($this);
    }
}


