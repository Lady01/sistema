<?php
//include_once "Marca/modelo/Marca.class.php";
//include_once "../controller/cliente.class.php";
 class DaoRelatorio 
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
		
			
		public function listarClientes($data)
		{	
			$sql="SELECT COUNT( venda.idCliente ) AS vendas, cliente.nome AS nome, cliente.cpf AS cpf
					FROM venda, cliente
					WHERE venda.idCliente = cliente.id
					AND venda.data
					BETWEEN DATE_SUB( '$data' , INTERVAL 186 
					DAY ) 
					AND '$data' 
					GROUP BY venda.idCliente
					ORDER BY vendas DESC"; 
			$foi=$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_object($query))
			{
				$clientes[] = array("vendas"=>$row->vendas,  "nome"=>$row->nome, "cpf"=>$row->cpf);
				
			}
			$this->desconecta();
			return $clientes;
        }
		
		public function listarAparelhosMaisVendidos($data)
		{
			$sql="SELECT produto.id AS id, produto.nome AS nome, produto.descricao AS descricao, SUM( itemvenda.quantidade ) AS quantidade
				FROM produto, itemvenda, venda
				WHERE produto.id = itemvenda.idProduto
				AND itemvenda.idVenda = venda.id
				AND venda.data
				BETWEEN DATE_SUB( '$data' , INTERVAL 186 
				DAY ) 
				AND '$data' 
				GROUP BY produto.id
				ORDER BY quantidade DESC 
				LIMIT 0 , 30
				"; 
			$foi=$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_object($query))
			{
				$produtos[] = array("id"=>$row->id, "nome"=>$row->nome, "descricao"=>$row->descricao, "quantidade"=>$row->quantidade);
				
			}
			$this->desconecta();
			return $produtos;
	
		}
		
		public function listarProdutosComDefeito($data)
		{	
			//$produtosComDefeito  = array();
			$sql="SELECT (
COUNT( id ) / t.total
) *100 AS percentual, comDefeito
FROM TROCA
JOIN (

SELECT COUNT( * ) AS total
FROM TROCA WHERE dataTroca BETWEEN DATE_SUB(  '$data', INTERVAL 186 DAY ) 
AND  '$data'
) AS t
WHERE dataTroca
BETWEEN DATE_SUB(  '$data', INTERVAL 186 
DAY ) 
AND  '$data'
GROUP BY comDefeito";				
			$foi=$this->conecta();
			$query=mysql_query($sql) or die(mysql_error());
			$num_rows = mysql_num_rows($query);
			while ($row = mysql_fetch_object($query))
			{
				$produtosComDefeito[] = array("percentual"=>$row->percentual, "comDefeito"=>$row->comDefeito);
				//$produtosComDefeito = array("percentual"=>$row->percentual, "comDefeito"=>$row->comDefeito);
			print_r($row);	
			}
			
			$this->desconecta();
			return $produtosComDefeito;
		}   
}
?>