<?php
class Usuario {
    private $id;
	private $idFuncionario;
	private $nivel;
    private $login;
    private $senha;
	private $status;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
	
	public function setIdFuncionario($idFuncionario){
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario(){
        return $this->idFuncionario;
    }
	
	public function setNivel($nivel){
        $this->nivel = $nivel;
    }

    public function getNivel(){
        return $this->nivel;
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getSenha(){
        return $this->senha;
    }
	public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }
}
?>