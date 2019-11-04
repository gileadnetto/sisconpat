<?php
namespace App\Models;

Class UserSession{
    
	protected $table ="user_session";
       
	private $id;
	private $id_usuario;
	private $login;
	private $ip;
	private $navegador;
	
    public function getId()
    {
        return $this->id;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getNavegador()
    {
        return $this->navegador;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function setNavegador($navegador)
    {
        $this->navegador = $navegador;
    }

}


