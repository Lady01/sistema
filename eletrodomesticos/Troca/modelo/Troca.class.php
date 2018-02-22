<?php
class Troca {
    private $id;
    private $idItemVenda;
    private $data;
    private $observacao;
    private $comDefeito;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdItemVenda($idItemVenda){
        $this->idItemVenda = $idItemVenda;
    }

    public function getIdItemVenda(){
        return $this->idItemVenda;
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

    public function setComDefeito($comDefeito){
        $this->comDefeito = $comDefeito;
    }

    public function getComDefeito(){
        return $this->comDefeito;
    }
}
?>