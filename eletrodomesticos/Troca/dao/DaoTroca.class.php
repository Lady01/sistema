<?php
include_once "Troca/modelo/Troca.class.php";
 class DaoTroca 
{
		  private $servidor = 'localhost'; // servidor
	      private  $usuario = 'root'; // usuario do banco
	      private $senha = ''; // senha do usuario do banco
	      private $nomeBanco = 'eletrodomesticos'; // nome do banco
		  private $conectou=false;
		  private $minhaConexao=null;
		  private $selecionaBanco=null;
		  
		 public function conecta ()
		 {
			$this->minhaConexao = mysql_connect($this->servidor,$this->usuario,$this->senha) or die(mysql_error()); //this*********************
			
			if($this->minhaConexao) 
			{
				
				$selecionaBanco = mysql_select_db($this->nomeBanco,$this->minhaConexao) or die(mysql_error()); //this*********************
				$this->conectou=true;
			}
		 }
		
		function desconecta()
		{
			if($this->conectou) 
			{
				$this->conectou=false; 
				mysql_close($this->minhaConexao) or die(mysql_error()); 
				
			}
		}
		
		public function inserir($troca)
		{
			$idItemVenda=$troca->getIdItemVenda();
			$data=$troca->getData();
			$observacao=$troca->getObservacao();
			$comDefeito=$troca->getComDefeito();
			$sql="insert into troca (id, idItemVenda, dataTroca, observacao, comDefeito) values (null, $idItemVenda, '$data' ,'$observacao', $comDefeito )";
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
		}
	
		

 
        		
		   
}
?>