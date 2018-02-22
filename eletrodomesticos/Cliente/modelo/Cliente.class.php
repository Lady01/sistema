<?php
class Cliente {
    private $id;
    private $nome;
    private $cpf;
	private $sexo;
	private $endereco;
    private $cidade;
    private $estado;
    private $telefone;
    private $dataNasc;
    private $status;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getCpf(){
        return $this->cpf;
    }
	
	public function setSexo($sexo){
        $this->sexo = $sexo;
    }

    public function getSexo(){
        return $this->sexo;
    }
	
	    public function setEndereco($endereco){
        $this->endereco =$endereco;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setDataNasc($dataNasc){
        $this->dataNasc = $dataNasc;
    }

    public function getDataNasc(){
        return $this->dataNasc;
    }


    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }
}
?>