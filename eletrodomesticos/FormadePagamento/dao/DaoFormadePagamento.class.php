<?php
include_once "FormadePagamento/modelo/FormadePagamento.class.php";
 class DaoFormadePagamento 
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
			
			if($this->minhaConexao) //this*********************
			{
				
				$selecionaBanco = mysql_select_db($this->nomeBanco,$this->minhaConexao) or die(mysql_error()); //this*********************
				$this->conectou=true; //this*********************
				
			}
		 }
		
		function desconecta()
		{
			if($this->conectou) //this*********************
			{
				$this->conectou=false; //this*********************
				mysql_close($this->minhaConexao) or die(mysql_error()); //não precisa de return*********************
				
			}
		}
		
		public function inserir($formadePagamento)
		{
			$nome=$formadePagamento->getNome();
			$descricao=$formadePagamento->getDescricao();
			$sql="insert into formadepagamento (id, nome, descricao, status) values (null, '$nome','$descricao' ,1 )";
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
		}
	
		public function buscar($nome)
		{	
			$listaFormasdePagamento = array();
			
			$i=0;
			$sql="select id, nome, descricao from formadepagamento where status=true and nome like '%". $nome ."%' "; // faltou o id
			
			$foi=$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$formadePagamento = new FormadePagamento();
				$formadePagamento->setId($row[0]);
				$formadePagamento->setNome($row[1]);
				$formadePagamento->setDescricao($row[2]);
	
				$listaFormasdePagamento[$i] = $formadePagamento;
				
				$i++;
			}
			$this->desconecta();
			return $listaFormasdePagamento;
        }
		
		public function buscarId($id)
		{	
			$listaFormasdePagamento = array();
			$i=0;
			$sql="select  id,nome, descricao from formadepagamento where status=true and id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$formadePagamento = new FormadePagamento();
				$formadePagamento->setId($row[0]);
				$formadePagamento->setNome($row[1]);
				$formadePagamento->setDescricao($row[2]);
				$listaFormasdePagamento[$i] = $formadePagamento;
				$i++;
			}
			$this->desconecta();
			return $listaFormasdePagamento;
        }

 
        		
		public function excluir($id)
		{
			$sql="update formadepagamento set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($formadePagamento)
		{
			
			$nome=$formadePagamento->getNome();
			$descricao=$formadePagamento->getDescricao();
			$sql="update formadepagamento set"." nome='$nome'".","." descricao='$descricao'"." where id=".$formadePagamento->getId()." and status=true";
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		public function buscarTodos()
		{	
			$listaFormasdePagamento = array();
			
			$i=0;
			$sql="select id, nome from formadepagamento where status=true"; // faltou o id
			
			$foi=$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$formadePagamento = new FormadePagamento();
				$formadePagamento->setId($row[0]);
				$formadePagamento->setNome($row[1]);
	
				$listaFormasdePagamento[$i] = $formadePagamento;
				
				$i++;
			}
			$this->desconecta();
			return $listaFormasdePagamento;
        }
		
		   
}
?>