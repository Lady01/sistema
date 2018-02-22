<?php
class Produto {
    private $id;
    private $idMarca;
    private $nome;
    private $descricao;
    private $qtdDisponivel;
    private $preco;
    private $status;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdMarca($idMarca){
        $this->idMarca = $idMarca;
    }

    public function getIdMarca(){
        return $this->idMarca;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setQtdDisponivel($qtdDisponivel){
        $this->qtdDisponivel = $qtdDisponivel;
    }

    public function getQtdDisponivel(){
        return $this->qtdDisponivel;
    }

    public function setPreco($preco){
        $this->preco = $preco;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }
}
?>