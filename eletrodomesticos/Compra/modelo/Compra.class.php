<?php
class Compra {
    private $id;
    private $idFornecedor;
    private $data;
    private $observacao;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdFornecedor($idFornecedor){
        $this->idFornecedor = $idFornecedor;
    }

    public function getIdFornecedor(){
        return $this->idFornecedor;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }

    public function setObservacao($observacao){
        $this->observacao = $observacao;
    }

    public function getObservacao(){
        return $this->observacao;
    }
}
?>