<?php
include_once "Cliente/modelo/Cliente.class.php";
include_once "Cliente/controle/ControleCliente.class.php";
 class DaoCliente
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
		
		public function inserir($cliente)
		{
			$nome=$cliente->getNome();
			$cpf=$cliente->getCpf();
			$sexo=$cliente->getSexo();
			$endereco=$cliente->getEndereco();
			$cidade=$cliente->getCidade();
			$estado=$cliente->getEstado();
			$telefone=$cliente->getTelefone();
			$dataNasc=$cliente->getDataNasc();
			$status=$cliente->getStatus();
			$sql="insert into cliente (id, nome, cpf, sexo, endereco, cidade, estado, telefone, dataNasc, status) values (null, '$nome',$cpf, '$sexo', '$endereco', '$cidade', '$estado', '$telefone', '$dataNasc' ,$status )";
			echo $sql;
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
		}
	
		public function buscar($nome)
		{	
			$listaClientes = array();
			$i=0;
			$sql="select id, nome, cpf, sexo, endereco, cidade, estado, telefone, dataNasc from cliente where status=true and nome like '%". $nome ."%' "; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$cliente = new Cliente();
				$cliente->setId($row[0]);
				$cliente->setNome($row[1]);
				$cliente->setCpf($row[2]);
				$cliente->setSexo($row[3]);
				$cliente->setEndereco($row[4]);
				$cliente->setCidade($row[5]);
				$cliente->setEstado($row[6]);
				$cliente->setTelefone($row[7]);
				$cliente->setDataNasc($row[8]);
				
				$listaClientes[$i] = $cliente;
				$i++;
			}
			$this->desconecta();
			return $listaClientes;
        }
		
		public function buscarId($id)
		{	
			$listaClientes = array();
			$i=0;
			$sql="select id, nome, cpf, sexo, endereco, cidade, estado, telefone, dataNasc from cliente where status=true and id=$id"; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_array($query))
			{
				$cliente = new Cliente();
				$cliente->setId($row[0]);
				$cliente->setNome($row[1]);
				$cliente->setCpf($row[2]);
				$cliente->setSexo($row[3]);
				$cliente->setEndereco($row[4]);
				$cliente->setCidade($row[5]);
				$cliente->setEstado($row[6]);
				$cliente->setTelefone($row[7]);
				$cliente->setDataNasc($row[8]);
				
				$listaClientes[$i] = $cliente;
				$i++;
			}
			$this->desconecta();
			return $listaClientes;
        }

 
        		
		public function excluir($id)
		{
			$sql="update cliente set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($cliente)
		{
		$id=$cliente->getId();	
		$nome=$cliente->getNome();
		$cpf=$cliente->getCpf();
		$sexo=$cliente->getSexo();
		$endereco=$cliente->getEndereco();
		$cidade=$cliente->getCidade();
		$estado=$cliente->getEstado();
		$telefone=$cliente->getTelefone();
		$dataNasc=$cliente->getDataNasc();
			$sql="update cliente set"." nome='$nome'".","." cpf=".$cpf.","."sexo='$sexo'".","."endereco='$endereco'".","."cidade='$cidade'".","."estado='$estado'".","."telefone='".$telefone."',"."dataNasc='$dataNasc'". "where id=".$id." and status=true";
			var_dump($sql);
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		   
}
?>