<html>
<body>
<head>
<style type="text/css">
a
{
color:black;
}
</style>
</head>
<?php
//require('conexao.php');
	
	
switch( $_POST['op'] )
{
	case 1:
			
		$marca = $_POST['marca'];

		/*$sql = "SELECT * FROM produto WHERE nome LIKE '%$PRODUTO%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?popup=Compra/visao/popupProduto.php&addProduto= ". $row->id ."'>". $row->nome ."</a><br>";	
		}*/
		require_once('Marca/controle/ControleMarca.class.php');
		$controle = new ControleMarca();
		$marcas=$controle->buscar($marca);
		if($marcas)
		{
		foreach($marcas as $row)
		{ 
			echo "<a href='?popup=Produto/visao/popupMarca.php&addMarca= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
		}
		 }
		 		break;
		} 

		

		
		
		
		
		
	//case 2:
			
		//break;


?>

</body>
</html>