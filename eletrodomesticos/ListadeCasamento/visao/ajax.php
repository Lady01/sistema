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
			
		$lista = $_POST['lista'];

		/*$sql = "SELECT * FROM produto WHERE nome LIKE '%$PRODUTO%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?popup=ListadeCasamento/visao/popupProduto.php&addProduto= ". $row->id ."'>". $row->nome ."</a><br>";	
		}*/
		/*require_once('Cliente/controle/ControleCliente.class.php');
		$controle = new ControleCliente();
		$clientes=$controle->buscar($cliente);
		
		if($clientes)
  {
   echo '
   <table border="1" width="100%">
    <tr>
     <td> cod </td>
     <td> nome </td>
     <td> telefone </td>
     <td> cidade </td>
    </tr>';
   
   foreach($clientes as $row)
   { 
    echo '<tr>';
    echo "<td>". $row->getId() ."</td>";
    echo "<td><a href='?popup=ListadeCasamento/visao/popupLista.php&addCliente= ". $row->getId() ."'>". $row->getNome() ."</a></td>";
    echo "<td>". $row->getTelefone() ."</td>"; 
    echo "<td>". $row->getCidade() ."</td>";
    echo '</tr>';
   }
   echo '</table>';
'  }*/
  
  //$sql = "SELECT  l.id as id, c.nome as nome, l.conjuge as conjuge from cliente c, listadecasamento l
	//		where c.id=l.idCliente 
		//	AND l.status = 'em aberto' and l.id=".$lista;
	//$query = mysql_query($sql);
	//$infCliente = mysql_fetch_object($query);
	require_once("ListadeCasamento/controle/ControleListadeCasamento.class.php");
	$controle = new ControleListadeCasamento();
	$noivos = $controle->buscarNoivos($lista);

	?>
	<style>#infoCli tr td, #lista tr:nth-child(1n+3):not(:last-child) td{ background: #DDD;}</style>
	<table width="100%" id="infoCli">
	<tr>
    	<th colspan="3"> Noivos </th>
    </tr>
    <tr>
    	<td colspan="3"><?php echo "<a href='?popup=ListadeCasamento/visao/popupLista.php&addLista=".$noivos->id."'>".$noivos->nome." e ".$noivos->conjuge."</a>";  ?> </td>
        

	</tr>
</table>
		
		
	<?php	break;
		
		
		
		
		
	case 2:
	
		$cliente = $_POST['cliente'];
	
		
		require_once('Cliente/controle/ControleCliente.class.php');
		$controle = new ControleCliente();
		$clientes=$controle->buscar($cliente);
		if($clientes)
		{
		foreach($clientes as $row)
		{
			echo "<a href='?popup=ListadeCasamento/visao/popupCliente.php&addCliente= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
		}
		}
		
		break;
		
		case 3:
		$PRODUTO=$_POST['produto'];
		require_once('Produto/controle/ControleProduto.class.php');
		
		$controle = new ControleProduto();
		$produtos=$controle->buscar($PRODUTO);
		if($produtos)
		{
		foreach($produtos as $row)
		{
			echo "<a href='?popup=ListadeCasamento/visao/popupProduto.php&addProduto= ". $row->getId() ."'>". $row->getNome() ."</a><br>";	
		}
		}
		break;
}

?>
</body>
</html>