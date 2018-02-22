<?php
class ListadeCasamento {
    private $id;
    private $idCliente;
    private $endereco;
    private $local;
    private $cidade;
    private $estado;
    private $conjuge;
    private $data;
    private $status;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setLocal($local){
        $this->local = $local;
    }

    public function getLocal(){
        return $this->local;
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

    public function setConjuge($conjuge){
        $this->conjuge = $conjuge;
    }

    public function getConjuge(){
        return $this->conjuge;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }
}?>