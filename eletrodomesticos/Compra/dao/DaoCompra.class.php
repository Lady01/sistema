<?php
include_once "Compra/modelo/Compra.class.php";
//include_once "../controller/cliente.class.php";
 class DaoCompra 
{
		  private $servidor = 'localhost'; // servidor
	      private $usuario = 'root'; // usuario do banco
	      private $senha = ''; // senha do usuario do banco
	      private $nomeBanco = 'eletrodomesticos'; // nome do banco
		  private $conectou=false;
		  private $minhaConexao=null;
		  private $selecionaBanco=null;
		  
		 public function conecta ()
		 {
			$this->minhaConexao = mysql_connect($this->servidor,$this->usuario,$this->senha) or die(mysql_error()); //this*********************
			
			if($this->minhaConexao) 		{
				
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
		
		
		
		public function inserir($compra)
		{

			$data = $compra->getData();
			$observacao=$compra->getObservacao();
			$idFornecedor=$compra->getIdFornecedor();
			$sqlCompra="insert into compra (id, idFornecedor, data, observacao) values (NULL, $idFornecedor,'$data','$observacao' )";
			$this->conecta();
			//mysql_query("SET AUTOCOMMIT=0");
			//mysql_query("START TRANSACTION");
			if( !mysql_query($sqlCompra) )
			{
				echo '<script> alert("Erro ao inserir Compra!") </script>';
				return false;
			}
			else
			{
				$sqlConsulta = "SELECT MAX(id) as id FROM compra";
				$queryConsulta=mysql_query($sqlConsulta);
				$idCompra = mysql_fetch_object( $queryConsulta )->id;
				
				$erroItens = $erroAtualiza = 0;
				foreach( $_SESSION['produto'] as $cod=>$produto )
				{

				  if( $qryItem = mysql_query("INSERT INTO itemcompra VALUES(
						   NULL,
						". $idCompra .",
						". $cod .",
						". number_format($produto['valor'], 2) .",
						". $produto['qtde'] ."
					)"));
					
					// se cadastrar item
					if( $qryItem )
					{
						$novaQtde = mysql_fetch_object(mysql_query("SELECT qtdDisponivel as total FROM produto WHERE id = $cod"))->total + $produto['qtde'];
						if( !mysql_query("UPDATE produto SET qtdDisponivel = $novaQtde WHERE produto.id = $cod")){
							$erroAtualiza++; // se erro ao atualizar qtde
						}
					}
					else {
						$erroItens++; // se eero ao cadastrar itens
					}
				}
				
				if( $erroItens )
				{
					echo '<script> alert("Erro ao inserir itens de compra!") </script>';	
					return false;
				}
				else if( $erroAtualiza )
				{
					echo '<script> alert("Erro ao alterar quantidade disponível!") </script>';	
					return false;
				}
				else
				{
					
					$this->desconecta();
					unset($_SESSION['produto']);
					unset($_SESSION['fornecedor'])	;
				
					return true;
				}
			}
		}
	
	
	
		
		
		
		

 
        		
		
	
		
		   
}
?>