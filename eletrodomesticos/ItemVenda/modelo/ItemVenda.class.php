<?php
class ItemVenda {
    private $id;
    private $idVenda;
    private $idProduto;
    private $preco;
    private $quantidade;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdVenda($idVenda){
        $this->idVenda = $idVenda;
    }

    public function getIdVenda(){
        return $this->idVenda;
    }

    public function setIdProduto($idProduto){
        $this->idProduto = $idProduto;
    }

    public function getIdProduto(){
        return $this->idProduto;
    }

    public function setPreco($preco){
        $this->preco = $preco;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }
}

?>