<?php
include_once "Pagamento/modelo/Pagamento.class.php";
//include_once "../controller/cliente.class.php";
 class DaoPagamento 
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
		
		
		
		public function inserir($pagamento)
		{
			$idVenda=$pagamento->getIdVenda();
			$dinheiroRecebido=$pagamento->getDinheiroRecebido();
			$troco=$pagamento->getTroco();
			$numParcelas=$pagamento->getNumParcelas();
			$valorVenda=$pagamento->getValorVenda();
			
			$sqlPagamento="insert into pagamento (id, idVenda, dinheiroRecebido, troco, numParcelas, valorVenda) values (NULL, $idVenda, $dinheiroRecebido, $troco, $numParcelas,$valorVenda)";
			echo $sqlPagamento; 
			$this->conecta();
			$insertPagamento=mysql_query($sqlPagamento) or die (mysql_error());
			//mysql_query("SET AUTOCOMMIT=0");
			//mysql_query("START TRANSACTION");
			if( !$insertPagamento )
			{
				echo '<script> alert("Erro ao inserir Pagamento!") </script>';
				return false;
			}
			else
			{
				$erroAtualiza = 0;
				foreach( $_SESSION['produtoUpdate'] as $valor=>$produtoUpdate )
						{

						$novaQtde = @mysql_fetch_object(mysql_query("SELECT qtdDisponivel as total FROM produto WHERE id = $valor"))->total - $produtoUpdate['qtde'];
						if( !mysql_query("UPDATE produto SET qtdDisponivel = $novaQtde WHERE produto.id = $valor"))
						{
							$erroAtualiza++; // se erro ao atualizar qtde
						}
					
					
				}
				
				if( $erroAtualiza )
				{
					echo '<script> alert("Erro ao alterar quantidade disponível!") </script>';	
					return false;
				}
				else
				{	
					
					echo '<script> alert("Pagamento registrado com sucesso!") </script>';
					$this->desconecta();
					unset($_SESSION['produto']);
									
					return true;
				}
			}
		}
	
	
		
		
		
		
 
    public function inserirPagamentoItensLista($pagamento)
{
	mysql_query("SET AUTOCOMMIT=0");
	mysql_query("START TRANSACTION");
	
	$idVenda = $pagamento->getIdVenda();
	$dinheiroRecebido = $pagamento->getDinheiroRecebido();
	$troco = $pagamento->getTroco();
	$numParcelas = $pagamento->getNumParcelas();
	$valorVenda = $pagamento->getValorVenda();

	$this->conecta();
	$sqlPagamento = "insert into pagamento (id, idVenda, dinheiroRecebido, troco, numParcelas, valorVenda) 
   				     values (NULL, $idVenda, $dinheiroRecebido, $troco, $numParcelas, $valorVenda)";

	$erro = 0;
	if( mysql_query($sqlPagamento)) 
	{
	   
    	for($i=0; $i < count($_SESSION['tmp']); $i++ )
    	{
			
			$sqlPro = "UPDATE produto 
					   SET qtdDisponivel = qtdDisponivel - ".$_SESSION['tmp'][$i]['qtde']." 
					   WHERE produto.id =".$_SESSION['tmp'][$i]['idProduto'];


			if( mysql_query($sqlPro) )
			{

				$sqlItem = "UPDATE itemlistadecasamento SET status = 0 
							WHERE id = ". $_SESSION['tmp'][$i]['itemLista']; 
				
					if( !mysql_query($sqlItem) )				
				{
		
					$erro++;
				}
				
			}
			else
			{
		
				$erro++;
			}
			
		} 
	}
	else
	{
		echo 'Erro ao inserir pagto!';
		$erro++;
	}
	
	
	
	if( !$erro )
	{

		$sql = "SELECT * FROM itemlistadecasamento
				WHERE status = 1
				AND idListadecasamento = ". $_SESSION['idLista'];
		
		$produtosAtivos = (int)mysql_num_rows(mysql_query($sql));
		
		
		if( !$produtosAtivos )
		{
			
			$sql = "UPDATE listadecasamento
					SET status = 'fechado'
					WHERE id = ". $_SESSION['idLista'];	
			
			if( !mysql_query($sql))
			{
					
				mysql_query("ROOLBACK");
				return false;
			}
			else
			{
				
				mysql_query("COMMIT");
				return true;	
			}
		}
		else
		{
			
			mysql_query("COMMIT");
			return true;
		}
	}
	else
	{
		
		return false;
	}
}     
}
?>