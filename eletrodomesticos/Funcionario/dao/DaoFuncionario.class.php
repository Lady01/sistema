<?php
include_once "Funcionario/modelo/Funcionario.class.php";
include_once "Funcionario/controle/ControleFuncionario.class.php";
 class DaoFuncionario
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
		
		public function inserir($funcionario)
		{
			$nome=$funcionario->getNome();
			$cpf=$funcionario->getCpf();
			$sexo=$funcionario->getSexo();
			$endereco=$funcionario->getEndereco();
			$cidade=$funcionario->getCidade();
			$estado=$funcionario->getEstado();
			$telefone=$funcionario->getTelefone();
			$matricula=$funcionario->getMatricula();
			$dataNasc=$funcionario->getDataNasc();
			$status=$funcionario->getStatus();
			$cargo=$funcionario->getCargo();
			$sql="insert into funcionario (id, nome, cpf, sexo, endereco, cidade, estado, telefone, matricula, dataNasc, status, cargo) values (null, '$nome',$cpf, '$sexo', '$endereco', '$cidade', '$estado', $telefone, $matricula, '$dataNasc' ,$status, '$cargo' )";
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
		}
	
		public function buscar($nome)
		{	
			$listaFuncionarios = array();
			$i=0;
			$sql="select id, nome, cpf, sexo, endereco, cidade, estado, telefone, matricula, dataNasc, cargo from funcionario where status=true and nome like '%". $nome ."%' "; // faltou o id
			
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$funcionario = new Funcionario();
				$funcionario->setId($row[0]);
				$funcionario->setNome($row[1]);
				$funcionario->setCpf($row[2]);
				$funcionario->setSexo($row[3]);
				$funcionario->setEndereco($row[4]);
				$funcionario->setCidade($row[5]);
				$funcionario->setEstado($row[6]);
				$funcionario->setTelefone($row[7]);
				$funcionario->setMatricula($row[8]);
				$funcionario->setDataNasc($row[9]);
				$funcionario->setCargo($row[10]);
				
				$listaFuncionarios[$i] = $funcionario;
				$i++;
			}
			$this->desconecta();
			return $listaFuncionarios;
        }
		
		public function buscarId($id)
		{	
			$listaFuncionarios = array();
			$i=0;
			$sql="select id, nome, cpf, sexo, endereco, cidade, estado, telefone, matricula, dataNasc, cargo from funcionario where status=true and id=$id"; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_array($query))
			{
				$funcionario = new Funcionario();
				$funcionario->setId($row[0]);
				$funcionario->setNome($row[1]);
				$funcionario->setCpf($row[2]);
				$funcionario->setSexo($row[3]);
				$funcionario->setEndereco($row[4]);
				$funcionario->setCidade($row[5]);
				$funcionario->setEstado($row[6]);
				$funcionario->setTelefone($row[7]);
				$funcionario->setMatricula($row[8]);
				$funcionario->setDataNasc($row[9]);
				$funcionario->setCargo($row[10]);

				$listaFuncionarios[$i] = $funcionario;
				$i++;
			}
			$this->desconecta();
			return $listaFuncionarios;
        }

 
        		
		public function excluir($id)
		{
			$sql="update funcionario set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($funcionario)
		{
			$id= $funcionario->getId();
			$nome=$funcionario->getNome();
			$sexo=$funcionario->getSexo();
			$endereco=$funcionario->getEndereco();
			$cidade=$funcionario->getCidade();
			$estado=$funcionario->getEstado();
			$cargo=$funcionario->getCargo();
			$dataNasc=$funcionario->getDataNasc();
			$sql="update funcionario set"." nome='$nome'".","." cpf=".$funcionario->getCpf().","." sexo='$sexo'".","." endereco='$endereco'".","." cidade='$cidade'".","." estado='$estado'".","." telefone=".$funcionario->getTelefone().","."matricula=".$funcionario->getMatricula().","."dataNasc='$dataNasc'".","."cargo='$cargo'"." where id=".$id." and status=true";
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		   
}
?>