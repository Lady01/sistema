<?php
include_once "Marca/modelo/Marca.class.php";
//include_once "../controller/cliente.class.php";
 class DaoMarca 
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
				//var_dump($this->conectou);
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
		
		public function inserir($marca)
		{
			$nome=$marca->getNome();
			$descricao=$marca->getDescricao();
			$sql="insert into marca (id, nome, descricao, status) values (null, '$nome','$descricao' ,1 )";
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			
			return $query; 
		}
	
		public function buscar($nome)
		{	
			$listaMarcas = array();
			
			$i=0;
			$sql="select id, nome, descricao from marca where status=true and nome like '%". $nome ."%' "; // faltou o id
			
			$foi=$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$marca = new Marca();
				$marca->setId($row[0]);
				$marca->setNome($row[1]);
				$marca->setDescricao($row[2]);
				$listaMarcas[$i] = $marca;
				
				$i++;
			}
			$this->desconecta();
			return $listaMarcas;
        }
		
		public function buscarId($id)
		{	
			$listaMarcas = array();
			$i=0;
			$sql="select  id,nome, descricao from marca where status=true and id=$id"; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$marca = new Marca();
				$marca->setId($row[0]);
				$marca->setNome($row[1]);
				$marca->setDescricao($row[2]);
				$listaMarcas[$i] = $marca;
				$i++;
			}
			$this->desconecta();
			return $listaMarcas;
        }

 
        		
		public function excluir($id)
		{
			$sql="update marca set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($marca)
		{
			
			$nome=$marca->getNome();
			$descricao=$marca->getDescricao();
			$sql="update marca set"." nome='$nome'".","." descricao='$descricao'"." where id=".$marca->getId()." and status=true";
			//var_dump($sql);
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		   
}
?>