<?php
class Pagamento {
    private $id;
    private $idVenda;
    private $dinheiroRecebido;
    private $troco;
    private $numParcelas;
    private $valorVenda;

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

    public function setDinheiroRecebido($dinheiroRecebido){
        $this->dinheiroRecebido = $dinheiroRecebido;
    }

    public function getDinheiroRecebido(){
        return $this->dinheiroRecebido;
    }

    public function setTroco($troco){
        $this->troco = $troco;
    }

    public function getTroco(){
        return $this->troco;
    }

    public function setNumParcelas($numParcelas){
        $this->numParcelas = $numParcelas;
    }

    public function getNumParcelas(){
        return $this->numParcelas;
    }

    public function setValorVenda($valorVenda){
        $this->valorVenda = $valorVenda;
    }

    public function getValorVenda(){
        return $this->valorVenda;
    }
}
?>