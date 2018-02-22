<?php
require('conexao.php');
	
	
switch( $_POST['op'] )
{
	case 1:
			
		$PRODUTO = $_POST['produto'];

		$sql = "SELECT * FROM produto WHERE nome LIKE '%$PRODUTO%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?addProduto= ". $row->id ."'>". $row->nome ."</a><br>";	
		}
		
		break;
		
		
		
		
		
	case 2:
	
		$cliente = $_POST['cliente'];
	
		$sql = "SELECT id, nome FROM cliente WHERE nome LIKE '%$cliente%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?addCliente= ". $row->id ."'>". $row->nome ."</a><br>";	
		}
		
		break;
}

?>
