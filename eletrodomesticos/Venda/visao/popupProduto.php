<?php session_start(); ?>
<?php //require('Compra/visao/conexao.php') ?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> PopUp </title>
<!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->

<script type="text/javascript" src="Venda/visao/jquery.js" ></script>
    <script type="text/javascript" src="Venda/visao/jquery.maskMoney.js" ></script>
    <script type="text/javascript">
		$(document).ready(function(){
              $("#vPago").maskMoney({showSymbol:false, symbol:"R$", decimal:".", thousands:""});
        });
    </script>
	<script>
window.onunload = function(){
	window.opener.atualiza();
};

function buscar(txtProduto)
{
	$("#lista").html("Carregando...");
	$.post("master-jquery.php?jq=Venda/visao/ajax.php",
	{op:1, produto:txtProduto.value},
		function(valor){
			$("#lista").html(valor);
		}
	);
}

</script>
</head>
<body>
<?php 

	if( !isset($_GET['addProduto']) ) 
	{ 
		echo '
		Nome do produto : <input type="text" name="produto" onKeyUp="buscar(this)" /> <br>
		<label id="lista"></label>';
	}
	
	
	else
	{ 
		//$sql = "SELECT * FROM produto WHERE id = ". $_GET['addProduto'];
		//$qry = mysql_query($sql);
		//$registro = mysql_fetch_object($qry);
		require_once(("Produto/controle/ControleProduto.class.php"));
		$controle= new ControleProduto();
		$produtos=$controle->buscarId($_GET['addProduto']);
?>

<form name="produto" action="" method="post">
	<table width="100%">
	<?php
	foreach ($produtos as $registro){
	?>
    	<tr>
        	<td width="10%"> Cod: </td>
            <td> <input type="text" name="idProduto" value="<?php echo $_GET['addProduto'] ?>" disabled /></td>
        </tr>
        <tr>
        	<td width="10%"> Nome: </td>
            <td> <input type="text" name="nomeProduto" value="<?php echo $registro->getNome(); ?>" disabled /></td>
        </tr>
		<tr>
        	<td width="10%"> Preco do produto: </td>
            <td> <input type="text" name="nomeProduto" value="<?php echo str_replace(',', '', number_format($registro->getPreco(),2)); ?>" disabled /></td>
        </tr>
        <tr>
        	<td width="10%"> Qtde: </td>
            <td> <input type="text" name="qtdeProduto" value="1" autofocus /></td>
        </tr>
        <tr>
        	<td width="10%"> Preco de venda: </td>
            <td> <input type="text" name="valorProduto" /></td>
        </tr>
        <tr>
        	<td></td>
            <td> 
            	<input type="submit" name="salvar" value="Salvar"/> 
                <input type="button" name="cancel" value="Cancelar" onClick="location.href='popup.php'"/>
            </td>
        </tr>
		<?php } ?>
    </table>
</form>

<?php 

}

if( isset($_POST['salvar']) )
{
	
		$_SESSION['produto'][$registro->getId()] = array(
			'nome'=>$registro->getNome(),
			'descricao'=>$registro->getDescricao(),
			'valor'=>$_POST['valorProduto'],
			'qtde'=>$_POST['qtdeProduto']
		);
		
		echo "<script> window.close(); </script>";
		
}
	
?>

</body>
</html>