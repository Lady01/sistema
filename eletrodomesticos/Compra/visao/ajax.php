<html>
<head>
<style type="text/css">
a
{
color:black;
}
tr td a{ color:black; }
</style>
</head>
<body>
<?php
require('conexao.php');
	
	
switch( $_POST['op'] )
{
	case 1:
			
		$PRODUTO = $_POST['produto'];

		/*$sql = "SELECT * FROM produto WHERE nome LIKE '%$PRODUTO%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?popup=Compra/visao/popupProduto.php&addProduto= ". $row->id ."'>". $row->nome ."</a><br>";	
		}*/
		require_once('Produto/controle/ControleProduto.class.php');
		$controle = new ControleProduto();
		$produtos=$controle->buscar($PRODUTO);
		if($produtos)
		{
		foreach($produtos as $row)
		{
			echo "<a href='?popup=Compra/visao/popupProduto.php&addProduto= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
		}
		}

		
		break;
		
		
		
		
		
	case 2:
	
		$FORNECEDOR = $_POST['fornecedor'];
	
		/*$sql = "SELECT * FROM fornecedor WHERE nome LIKE '%$FORNECEDOR%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?popup=Compra/visao/popupFornecedor.php&addFornecedor= ". $row->id ."'>". $row->nome ."</a><br>";	
		}*/
		require_once('Fornecedor/controle/ControleFornecedor.class.php');
		$controle = new ControleFornecedor();
		$fornecedores=$controle->buscar($FORNECEDOR);
		//if($fornecedores)
		//{
			//foreach($fornecedores as $row)
			//{
				//echo "<a href='?popup=Compra/visao/popupFornecedor.php&addFornecedor= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
			//}
		//}?>
<table style="margin:0 auto;" width="85%" border="1" cellspacing="2" cellpadding="0">
		<tr class="primeiraLinha">
			<td>ID</td>
			<td>NOME</td>
			<td>CNPJ</td>
				<td> &nbsp; </td>
		</tr>
			<?php
			if($fornecedores)
			{
				foreach($fornecedores as $row)
				{
				print "
				<tr>
					<td> {$row->getId()} </td>
					<td> {$row->getNome()} </td>
					<td> {$row->getCnpj()} </td>
					<td><a href='?popup=Compra/visao/popupFornecedor.php&addFornecedor=&addFornecedor={$row->getId()}'>Selecionar</a></td>
				</tr>
				";
				}
			}
			?>
			</table>
		<?php break;
}

?>
</body>
</html>

