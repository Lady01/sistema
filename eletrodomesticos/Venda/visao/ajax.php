<html>
<head>
<style type="text/css">
a
{
color:black;
}
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
			echo "<a href='?popup=Venda/visao/popupProduto.php&addProduto= ". $row->id ."'>". $row->nome ."</a><br>";	
		}*/
		require_once('Produto/controle/ControleProduto.class.php');
		$controle = new ControleProduto();
		$produtos=$controle->buscar($PRODUTO);
		if($produtos)
		{
		foreach($produtos as $row)
		{
			echo "<a href='?popup=Venda/visao/popupProduto.php&addProduto= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
		}
		}
		
		
		break;
		
		
		
		
		
	case 2:
	
		$cliente = $_POST['cliente'];
	
		/*$sql = "SELECT id, nome FROM cliente WHERE nome LIKE '%$cliente%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			 echo "<a href='?popup=Venda/visao/popupCliente.php&addCliente= ". $row->id ."'>". $row->nome ."</a><br>";	
		}*/
		require_once('Cliente/controle/ControleCliente.class.php');
		$controle = new ControleCliente();
		$clientes=$controle->buscar($cliente);
		if($clientes)
		{
		foreach($clientes as $row)
		{
			echo "<a href='?popup=Venda/visao/popupCliente.php&addCliente= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
		}
		}
		
		
		break;
}

?>
</body>
</html>