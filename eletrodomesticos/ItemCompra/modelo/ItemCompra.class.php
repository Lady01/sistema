<?php
class ItemCompra {
    private $id;
    private $idCompra;
    private $idProduto;
    private $preco;
    private $quantidade;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setIdCompra($idCompra){
        $this->idCompra = $idCompra;
    }

    public function getIdCompra(){
        return $this->idCompra;
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