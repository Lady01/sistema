<?php
include_once "Produto/modelo/Produto.class.php";

 class DaoProduto 
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
			$this->minhaConexao = mysql_connect($this->servidor,$this->usuario,$this->senha) or die(mysql_error()); 
			if($this->minhaConexao) 
			{
				
				$selecionaBanco = mysql_select_db($this->nomeBanco,$this->minhaConexao) or die(mysql_error()); 
				$this->conectou=true; 
			}
		 }
		
		function desconecta()
		{
			if($this->conectou) 			{
				$this->conectou=false; 
				mysql_close($this->minhaConexao) or die(mysql_error()); 
				
			}
		}
		
		public function inserir($produto)
		{
			$idMarca=$produto->getIdMarca();
			$nome=$produto->getNome();
			$descricao=$produto->getDescricao();
			$qtdDisponivel=$produto->getQtdDisponivel();
			$preco=$produto->getPreco();
			$status=$produto->getStatus();
			$sql="insert into produto (id, idMarca, nome, descricao,  preco, status) values (null, $idMarca, '$nome', '$descricao', $preco, $status )";
			
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
			}
	
		public function buscar($nome)
		{	
			$listaProdutos = array();
			$i=0;
			$sql="select id, idMarca, nome, descricao, qtdDisponivel, preco from produto where status=true and nome like '%". $nome ."%' "; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$produto = new Produto();
				$produto->setId($row[0]);
				$produto->setIdMarca($row[1]);
				$produto->setNome($row[2]);
				$produto->setDescricao($row[3]);
				$produto->setQtdDisponivel($row[4]);
				$produto->setPreco($row[5]);
				$listaProdutos[$i] = $produto;
				$i++;
			}
			
			$this->desconecta();
			return $listaProdutos;
        }
		
		public function buscarId($id)
		{	
			$listaProdutos = array();
			$i=0;
			$sql="select id, idMarca, nome, descricao, qtdDisponivel, preco from produto where status=true and id=$id"; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$produto = new Produto();
				$produto->setId($row[0]);
				$produto->setIdMarca($row[1]);
				$produto->setNome($row[2]);
				$produto->setDescricao($row[3]);
				$produto->setQtdDisponivel($row[4]);
				$produto->setPreco($row[5]);

				$listaProdutos[$i] = $produto;
				$i++;
			}
			$this->desconecta();
			return $listaProdutos;
        }

 
        		
		public function excluir($id)
		{
			$sql="update produto set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($produto)
		{
		
			$nome=$produto->getNome();
			$descricao=$produto->getDescricao();
			$sql="update produto set"." nome='$nome'".","." descricao='$descricao'".","."preco=".$produto->getPreco()." where id=".$produto->getId()." and status=true";
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		   
}
?>