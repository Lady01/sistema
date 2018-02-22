<?php
include_once "Fornecedor/modelo/Fornecedor.class.php";
include_once "Fornecedor/controle/ControleFornecedor.class.php";
 class DaoFornecedor 
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
		
		public function inserir($fornecedor)
		{
			$nome=$fornecedor->getNome();
			$cnpj=$fornecedor->getCnpj();
			$telefone=$fornecedor->getTelefone();
			$endereco=$fornecedor->getEndereco();
			$cidade=$fornecedor->getCidade();
			$estado=$fornecedor->getEstado();
			$descricao=$fornecedor->getDescricao();
			$status=$fornecedor->getStatus();
			$sql="insert into fornecedor (id, nome, cnpj, telefone, endereco, cidade, estado, descricao, status) values (null, '$nome',$cnpj, $telefone, '$endereco', '$cidade', '$estado', '$descricao' ,$status )";
			
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
		}
	
		public function buscar($nome)
		{	
			$listaFornecedores = array();
			$i=0;
			$sql="select id, nome, cnpj, telefone, endereco, cidade, estado, descricao from fornecedor where status=true and nome like '%". $nome ."%' "; // faltou o id
			
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$fornecedor = new Fornecedor();
				$fornecedor->setId($row[0]);
				$fornecedor->setNome($row[1]);
				$fornecedor->setCnpj($row[2]);
				$fornecedor->setTelefone($row[3]);
				$fornecedor->setEndereco($row[4]);
				$fornecedor->setCidade($row[5]);
				$fornecedor->setEstado($row[6]);
				$fornecedor->setDescricao($row[7]);
				
				
				$listaFornecedores[$i] = $fornecedor;
				$i++;
			}
			$this->desconecta();
		
			return $listaFornecedores;
        }
		
		public function buscarId($id)
		{	
			$listaFornecedores = array();
			$i=0;
			$sql="select  id,nome,cnpj, telefone, endereco, cidade, estado, descricao from fornecedor where status=true and id=$id"; // faltou o id
			
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_array($query))
			{
				$fornecedor = new Fornecedor();
				$fornecedor->setId($row[0]);
				$fornecedor->setNome($row[1]);
				$fornecedor->setCnpj($row[2]);
				$fornecedor->setTelefone($row[3]);
				$fornecedor->setEndereco($row[4]);
				$fornecedor->setCidade($row[5]);
				$fornecedor->setEstado($row[6]);
				$fornecedor->setDescricao($row[7]);

				
				$listaFornecedores[$i] = $fornecedor;
				
				$i++;
			}
			$this->desconecta();
			return $listaFornecedores;
        }

 
        		
		public function excluir($id)
		{
			$sql="update fornecedor set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($fornecedor)
		{
			$nome=$fornecedor->getNome();
			$endereco=$fornecedor->getEndereco();
			$cidade=$fornecedor->getCidade();
			$estado=$fornecedor->getEstado();
			$descricao=$fornecedor->getDescricao();
			$sql="update fornecedor set"." nome='$nome'".","."cnpj=".$fornecedor->getCnpj().","."telefone=".$fornecedor->getTelefone().","."endereco='$endereco'".","."cidade='$cidade'".","."estado='$estado'".","."descricao='$descricao'". "where id=".$fornecedor->getId()." and status=true";
			
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		   
}
?>