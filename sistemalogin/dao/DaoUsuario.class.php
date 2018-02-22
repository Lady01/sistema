<?php
include_once "../modelo/Usuario.class.php";
//include_once "../controller/cliente.class.php";
 class DaoUsuario 
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
			
			if($this->minhaConexao) 			{
				
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
		
		public function inserir($usuario)
		{	
			$idFuncionario=$usuario->getIdFuncionario();
			$nivel=$usuario->getNivel();
			$login=$usuario->getLogin();
			$senha=$usuario->getSenha();
			$sql="insert into usuario (id, nivel, login, senha, status, idFuncionario) values (null, $nivel,'$login','$senha' ,1, $idFuncionario )";
			$this->conecta();
			$query = mysql_query($sql) or die(mysql_error());
			unset($_SESSION['funcionario']);
			$this->desconecta();
			
			return $query; 
		}
	
		public function buscar($login)
		{	
			$listaUsuarios = array();
			
			$i=0;
			$sql="select id, idFuncionario, nivel, login, senha from usuario where status=true and login like '%". $login ."%' "; // faltou o id
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query)) 
			{
				$usuario = new Usuario();
				$usuario->setId($row[0]);
				$usuario->setIdFuncionario($row[1]);
				$usuario->setNivel($row[2]);
				$usuario->setLogin($row[3]);
				$usuario->setSenha($row[4]);
				$listaUsuarios[$i] = $usuario;
				$i++;
			}
			$this->desconecta();
			return $listaUsuarios;
        }
		
		public function buscarId($id)
		{	
			$listaUsuarios = array();
			$i=0;
			$sql="select  id,idFuncionario,nivel,login,senha from usuario where status=true and id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_array($query))
			{
				$usuario = new Usuario();
				$usuario->setId($row[0]);
				$usuario->setIdFuncionario($row[1]);
				$usuario->setNivel($row[2]);
				$usuario->setLogin($row[3]);
				$usuario->setSenha($row[4]);
				$listaUsuarios[$i] = $usuario;
				$i++;
			}
			$this->desconecta();
			return $listaUsuarios;
        }
				
		public function excluir($id)
		{
			$sql="update usuario set status=false where id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query; 
		} 
		
		public function editar($usuario)
		{
			$id=$usuario->getId();
			$idFuncionario=$usuario->getIdFuncionario();
			$login=$usuario->getLogin();
			$senha=$usuario->getSenha();
			$sql="update usuario set"." login='$login'".","." senha='$senha'"." where id=".$id." and status=true";
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$this->desconecta();
			return $query;
		
		}
		
		public function logar($usuario)
		{
			$login=$usuario->getLogin();
			$senha=$usuario->getSenha();
			$sql="select id, nivel, login, senha, idFuncionario from usuario where login = '$login' and senha = '$senha' AND status = 1";
			$this->conecta();
			$query=mysql_query($sql) or die (mysql_error());
			
			if( mysql_num_rows( $query ))
			{
				$res = mysql_fetch_object($query);
				$us = new Usuario();
				$us->setId($res->id);
				$us->setLogin($res->login);
				$us->setSenha($res->senha);
				$us->setNivel($res->nivel);
				$us->setIdFuncionario($res->idFuncionario);
				var_dump($us);
			}
			else
			{
				$us = false;	
			}
			
			$this->desconecta();
			return $us; 
		}
		
		   
}
?>