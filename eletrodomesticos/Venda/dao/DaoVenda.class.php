<?php
include_once "Venda/modelo/Venda.class.php";
//include_once "../controller/cliente.class.php";
 class DaoVenda 
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
			if($this->conectou) 
			{
				$this->conectou=false; 
				mysql_close($this->minhaConexao) or die(mysql_error()); 
				
			}
		}
		
		
		
		public function inserir($venda)
		{
			$idCliente=$venda->getIdCliente();
			$idFuncionario=$venda->getIdFuncionario();
			$idFormadePag=$venda->getIdFormadePag();
			$data = $venda->getData();
			$observacao=$venda->getObservacao();
			
			$sqlVenda="insert into venda (id, idCliente, idFuncionario, idFormadePagamento, data, observacao) values (NULL, $idCliente,$idFuncionario, $idFormadePag,'$data','$observacao')"; 
			$this->conecta();
			$insertVenda=mysql_query($sqlVenda) or die (mysql_error());
			//mysql_query("SET AUTOCOMMIT=0");
			//mysql_query("START TRANSACTION");
			if( !$insertVenda )
			{
				echo '<script> alert("Erro ao inserir Venda!") </script>';
				return false;
			}
			else
			{
				$sqlConsulta = "SELECT MAX(id) as id FROM venda";
				$queryConsulta=mysql_query($sqlConsulta);
				$idVenda = mysql_fetch_object( $queryConsulta )->id;
				
				$erroItens = $erroAtualiza = 0;
				foreach( $_SESSION['produto'] as $cod=>$produto )
				{
					$insereItens="INSERT INTO itemvenda VALUES(
						   NULL,
						". $cod .",
						". $idVenda .",
						". $produto['valor'].",
						". $produto['qtde'] ."
					)";
					$qryItem=mysql_query($insereItens) or die (mysql_error());
				 	
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
				
				if( $erroItens )
				{	
					return false;
				}
				
				
				else
				{
					
					$this->desconecta();
					unset($_SESSION['produto']);
					unset($_SESSION['cliente'])	;
				
					return true;
				}
			}
		}
	
	
	
		public function buscarDadosVendas($id)
		{	
			
			$sql="SELECT * FROM view_venda WHERE idVenda =".$id;					
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			
			$info = mysql_fetch_object($query);
			$this->desconecta();
			return $info;
        }
		
		public function buscarDadosVendaItensLista($id)
		{	
			
			$sql="SELECT * FROM vendaitens WHERE idLista =".$id;
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			
			while($info = mysql_fetch_object($query)){
			
			$item[] = array("idVenda"=>$info->idVenda, "nomeCliente"=>$info->nomeCliente,"cpfCliente"=>$info->cpfCliente,"dataVenda"=>$info->dataVenda,"formaPgto"=>$info->formaPgto,"idLista"=>$info->idLista,"idProduto"=>$info->idProduto, "nomeProduto"=>$info->nomeProduto ,"itemLista"=>$info->itemLista,"preco"=>$info->preco, "quantidade"=>$info->qtde);
			}
			$this->desconecta();
			return $item;
        }
		
		
 
public function buscarDadosItensVendas($id)
		{	
			
			$sql="SELECT produto.id AS idProduto, nome, itemvenda.preco AS preco, quantidade, itemvenda.preco * quantidade AS total, itemvenda.id as itemvenda FROM `itemvenda`
				INNER JOIN produto ON idProduto = produto.id
				WHERE idVenda =".$id;					
			$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			
			while ($info = mysql_fetch_object($query))
			{
				$item[] = array("idProduto"=>$info->idProduto, "nome"=>$info->nome, "preco"=>$info->preco, "quantidade"=>$info->quantidade, "total"=>$info->total, "itemvenda"=>$info->itemvenda);
	
			}
			$this->desconecta();

			return $item;
        }
 
}

?>