<?php
class Venda {
    private $id;
	private $idListadeCasamento;
	private $idCliente;
    private $idFuncionario;
	private $idFormadePag;
    private $data;
    private $observacao;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
	
	public function setIdListadeCasamento($idListadeCasamento){
        $this->idListadeCasamento = $idListadeCasamento;
    }

    public function getIdListadeCasamento(){
        return $this->idListadeCasamento;
    }
	
	 public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function setIdFuncionario($idFuncionario){
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario(){
        return $this->idFuncionario;
    }
	
	public function setIdFormadePag($idFormadePag){
        $this->idFormadePag = $idFormadePag;
    }

    public function getIdFormadePag(){
        return $this->idFormadePag;
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