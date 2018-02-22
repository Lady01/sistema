<?php
include_once "ListadeCasamento/modelo/ListadeCasamento.class.php";
//include_once "../controller/cliente.class.php";
 class DaoListadeCasamento 
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
		
		
		
		public function inserir($listadeCasamento)
		{
			$idCliente=$listadeCasamento->getIdCliente();
			$conjuge=$listadeCasamento->getConjuge();
			$data = $listadeCasamento->getData();
			$endereco=$listadeCasamento->getEndereco();
			$local=$listadeCasamento->getLocal();
			$cidade=$listadeCasamento->getCidade();
			$estado	= $listadeCasamento->getEstado();
			$data=$listadeCasamento->getData();
			$status	= $listadeCasamento->getStatus();
			$errolista=0;
			$sqlLista="insert into listadeCasamento (id, idCliente, endereco, local, cidade, estado, conjuge, data, status) values (NULL, $idCliente,'$endereco', '$local','$cidade','$estado', '$conjuge', '$data', '$status')"; 
			$this->conecta();
			//mysql_query("SET AUTOCOMMIT=0");
			//mysql_query("START TRANSACTION");
			$insertLista=mysql_query($sqlLista) or die (mysql_error());
			
			if( !$insertLista )
			{	$errolista++;
				echo '<script> alert("Erro ao inserir Lista de casamento!") </script>';
				return false;
			}
			else
			{
				$sqlConsulta = "SELECT MAX(id) as id FROM listadecasamento";
				$queryConsulta=mysql_query($sqlConsulta);
				$idLista = mysql_fetch_object( $queryConsulta )->id;
				
				$erroItens = 0;
				foreach( $_SESSION['produto'] as $cod=>$produto )
				{
					$insereItens="INSERT INTO itemlistadecasamento VALUES(
						   NULL,
						   ". $idLista .",
						". $cod .",
						
						". $produto['valor'] .",
						". $produto['qtde'] .",
						". $produto['status'] ."
						
						
					)";
					
					$qryItem=mysql_query($insereItens) or die (mysql_error());
				  /*if( $qryItem = mysql_query("INSERT INTO itemvenda VALUES(
						   NULL,
						". $idVenda .",
						". $cod .",
						". number_format($produto['valor'], 2) .",
						". $produto['qtde'] ."
					)"));*/
					
					// se cadastrar item
					if( $qryItem )
					{
						
						//$novaQtde = mysql_fetch_object(mysql_query("SELECT qtdDisponivel as total FROM produto WHERE id = $cod"))->total + $produto['qtde'];
						//if( !mysql_query("UPDATE produto SET qtdDisponivel = $novaQtde WHERE produto.id = $cod")){
							//$erroAtualiza++; // se erro ao atualizar qtde
						//}
					}
					else {
						$erroItens++; // se eero ao cadastrar itens
					}
				}
				
				if( $errolista || $erroItens  )
				{
					 //mysql_query("ROLLBACK");
					 echo "desfez";
					echo '<script> alert("Erro ao inserir itens na lista de casamento!") </script>';	
					return false;
				}
				
				//else if( $erroAtualiza )
				//{
					//echo '<script> alert("Erro ao alterar quantidade disponível!") </script>';	
					//return false;
				//}
				else
				{
					mysql_query("COMMIT");
					$this->desconecta();
					unset($_SESSION['produto']);
					unset($_SESSION['cliente'])	;
				
					return true;
				}
			}
		}
	
		public function buscarItensLista($id)
		{
			$sql="SELECT produto.id AS idProduto, nome, itemlistadecasamento.preco AS preco, quantidade, itemlistadecasamento.id AS itemlistadecasamento
			FROM  `itemlistadecasamento` 
			INNER JOIN produto ON idProduto = produto.id
			WHERE idListadeCasamento =".$id;
					$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			
			while ($info = mysql_fetch_object($query))
			{
				$item[] = array("idProduto"=>$info->idProduto, "nome"=>$info->nome, "preco"=>$info->preco ,"quantidade"=>$info->quantidade, "itemlistadecasamento"=>itemlistadecasamento);
	
			}
			$this->desconecta();

		}
		
		
		public function buscarNoivos($id)
		{
			$sql="SELECT listadecasamento.id, cliente.nome, listadecasamento.conjuge
			FROM listadecasamento, cliente
			WHERE listadecasamento.idCliente = cliente.id
			AND listadecasamento.id=".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$info = mysql_fetch_object($query);
			$this->desconecta();
			return $info;

		}
		
		public function inserirVendaItensLista( $venda)
		{
			$idListadeCasamento=$venda->getIdListadeCasamento();
			$idCliente=$venda->getIdCliente();
			$idFuncionario=$venda->getIdFuncionario();
			$idFormadePag=$venda->getIdFormadePag();
			$data=$venda->getData();
			$observacao=$venda->getObservacao();
			$sqlVenda="insert into venda (id, idListadeCasamento, idCliente, idFuncionario, idFormadePagamento, data, observacao) values (NULL, $idListadeCasamento, $idCliente, $idFuncionario, $idFormadePag,'$data', '$observacao')"; 
			$this->conecta();
			$insertVenda=mysql_query($sqlVenda) or die (mysql_error());
			if($insertVenda)
			{
				$sqlConsulta = "SELECT MAX(id) as id FROM venda";
				$queryConsulta=mysql_query($sqlConsulta);
				$idVenda = mysql_fetch_object( $queryConsulta )->id;
				for($i=0; $i < count($_SESSION['produtoLista']); $i++ )
				{
					
					$insereItens="INSERT INTO itemvenda VALUES(
						   NULL,
						   ". $_SESSION['produtoLista'][$i]['idProduto'] .",
						". $idVenda .",
						". number_format($_SESSION['produtoLista'][$i]['preco'], 2) .",
						". $_SESSION['produtoLista'][$i]['qtde'] ."
						)";
					$qryItem=mysql_query($insereItens) or die (mysql_error());
				}
				if($qryItem)
				{
				return true;
				}
				else
				{
				return false;
				}
			}
			else
			{
				return false;
			}
			} 
			
			public function buscarLista($idLista)
			{
				$sql = "SELECT idProduto, i.preco, i.id as iditem, p.nome, m.nome as marca, i.quantidade FROM listadecasamento l 
				INNER JOIN itemlistadecasamento i ON l.id = i.idListadeCasamento 
				INNER JOIN produto p ON i.idProduto = p.id 
				INNER JOIN marca m ON m.id = p.idMarca
				WHERE l.id =".$idLista;
				$this->conecta();
				$query = mysql_query($sql);
				while ($info = mysql_fetch_object($query))
				{
					$item[] = array("idProduto"=>$info->idProduto,"preco"=>$info->preco ,"iditem"=>$info->iditem,"nome"=>$info->nome,"marca"=>$info->marca,"quantidade"=>$info->quantidade);
		
				}
				return $item;
				$this->desconecta();

			}
 
}

?>