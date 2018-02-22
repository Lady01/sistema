<?php session_start(); ?>
<?php require('ListadeCasamento/visao/conexao.php') ?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> PopUp </title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
window.onunload = function(){
	window.opener.atualiza();
};
function buscar(txtLista)
{
	$("#lista").html("Carregando...");
	$.post("master-jquery.php?jq=ListadeCasamento/visao/ajax.php",
	{op:1, lista:txtLista.value},
		function(valor){
			$("#lista").html(valor);
		}
	);
}
</script>
<body>
<?php 
if( !isset($_GET['addLista']) ) 
	{ 
		echo '
		Id da lista : <input type="text" name="lista" onKeyUp="buscar(this)" /> <br>
		<label id="lista"></label>';
	}
	else
	{
	$addLista=$_GET['addLista'];
?>





<form name="produto" action="" method="post">
	<table width="100%" id="lista">
    	<tr>
        	<th colspan="4"> Lista </th>
        </tr>
    	<tr>
        	<td width="2%"> cod </td>
            <td> produto </td>
            <td> marca </td>
            <td> valor </td>
            <td> qtde </td>
            <td> comprar </td>
        <tr>
<?php

	/*$sql = "SELECT idProduto, i.preco, i.id as idItem, p.nome, m.nome as marca, i.quantidade FROM listadecasamento l 
   INNER JOIN itemlistadecasamento i ON l.id = i.idListadeCasamento 
   INNER JOIN produto p ON i.idProduto = p.id 
   INNER JOIN marca m ON m.id = p.idMarca
   WHERE l.id = $addLista";
			
	$query = mysql_query($sql);
	while ( $row = mysql_fetch_object($query) )
	{ 
		
		echo "
		<tr>
			<td>". $row->idProduto ."</td>
			<td>". $row->nome  ."</td>
			<td>". $row->marca  ."</td>
			<td>". number_format($row->preco, 2) ."</td>
			<td> <input type='text' name='qtde[]' value='". $row->quantidade ."' size='1'> </td>
			<td> <input type='checkbox' name='produto[]' value='".$row->idProduto.";".$row->idItem.";".trim($row->nome).";".$row->preco."'> </td>
		</tr>";
	
	}*/
require_once("ListadeCasamento/controle/ControleListadeCasamento.class.php");
$controle = new ControleListadeCasamento();
$itens = $controle->buscarLista($addLista);
foreach($itens as $item)
{
echo "
		<tr>
			<td>". $item['idProduto'] ."</td>
			<td>". $item['nome']  ."</td>
			<td>". $item['marca']  ."</td>
			<td>". number_format($item['preco'], 2) ."</td>
			<td> <input type='text' name='qtde[]' value='". $item['quantidade'] ."' size='1'> </td>
			<td> <input type='checkbox' name='produto[]' value='".$item['idProduto'].";".$item['iditem'].";".trim($item['nome']).";".$item['preco']."'> </td>
		</tr>";
	
}

	
	
?>
        	<td></td>
            <td> 
            	<input type="submit" name="salvar" value="salvar"/> 
                <input type="button" name="cancel" value="cancel" onClick="location.href='popup.php'"/>
            </td>
        </tr>
    </table>
	</form>

<?php 
}

/*if( isset($_POST['salvar']) )
{
	
		$_SESSION['produto'][$row->idProduto] = array(
			'nome'=>$row->nome,
			'preco'=>$row->preco,
			'valor'=>$_POST['valorProduto'],
			'qtde'=>$_POST['quantidade']
		);
		
		echo "<script> window.close(); </script>";
		
}*/

/*if( isset($_POST['salvar']) )
{
 
 if( isset($_POST['produto']))
 {
  
  for($i = 0; $i < count($_POST['produto']); $i++ )
  {
   echo $_POST['produto'][$i]; echo '<br>';
   echo $_POST['qtde'][$i]; echo '<br>';
  }
  
 }
 else
 {
  echo '<script>alert("Escolha um item!")</script>'; 
 }
 
}*/
if( isset($_POST['salvar']) )
{
 
 if( isset($_POST['produto']))
 {
  for($i = 0; $i < count($_POST['produto']); $i++ )
  {
   $produto = explode(';',$_POST['produto'][$i]); 
   $_SESSION['produtoLista'][] = array(
    "idProduto"=>$produto[0],
    "idItem"=>$produto[1],
    "nomeProduto"=>$produto[2],
    "preco"=>number_format($produto[3], 2),
    "qtde"=>$_POST['qtde'][$i]
   );
   echo "<script> window.close(); </script>";
  }
 }
 else
 {
  echo '<script>alert("Escolha um item!")</script>'; 
 }
 $_SESSION['idLista'] = $addLista;

 
}	
?>

</body>
</html>