<?php session_start(); ?>
<html>
<head>
<title>Troca</title>
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
.cliente
{
margin: 0 auto;
margin-bottom:30px;
width:300px;
background-color:#D3D3D3;
color:black;
}
.cabecalho
{
background-color:black;
color:white;
}
.bot
{
margin-left:30px;
}
.tabela
{
margin-top:30px;
margin: 0 auto;
}
p
{
text-align:center;
}
#faixa
		{
		width:100%;
		height:30px;
		line-height:30px;
		background-color:black;
		color:white;
		}
		legend
		{
		margin-left:10px;
		}
		#form_cad_cliente
		{
			width:500px;
			height:180px;
			margin:0 auto;
			background-color:#D3D3D3;
			color:black;
		}
		label, input[type="text"]
		{
			float:left;
			display:block;
		}
		label
		{
			padding-left:120px;
			width:80px;
			margin-left: 20px;
			margin: 0 auto;
			font-size:18px;
		}
		.field
		{
			
			margin-left:5px;
		}
		#form
		{
			padding-top:30px;
		}
		#botoes
		{
			width:175px;
			margin-top:40px;
			margin-left:163px;
			margin-right:163px;
		}
		.fontB
		{
		font-size:13px;
		}
		.link
		{
		color:black;
		}
		h2
		{
		text-align:center;
		}
		.tabela th tr td a { color:black; }
		</style>
</head>
<body>
<div id="geral">
<h2>Digite o id da venda para relizar troca</h2>
	<form id="form_cad_cliente" action="" method="post">
		<div id="faixa"> <legend>Consulta de aparelho para troca</legend></div>
		<div id="form">
			<label>Id:</label><input type="text" name="id"/></br>
			<div id="botoes">
				<input type="submit" name="enviar" value="Consultar"/>
				<input type="button" value="Voltar" OnClick="location.href='?pag=Troca/index.php';">
		</div>
		</div>
	</form>

<div id="listaMarcas">
<?php 
$i=0;
if( isset($_POST['enviar']) )
{
	require_once('Venda/controle/ControleVenda.class.php');
	$ctrlVenda = new ControleVenda();
	$registrosVenda = $ctrlVenda->buscarDadosVendas($_POST['id']);
	
}	
?>

<?php if(isset($registrosVenda)) { ?>

    <table class="tabela" border="1"  width="100%">
        <tr class="cabecalho">
            <th>IdVenda</th>
            <th>Nome do cliente</th>
            <th>CPF do cliente</th>
            <th>Nome do funcionário</th>
            <th> Data </th>
            <th>Forma de Pagamento</th>
        </tr>
    	<tr>
            <td><?php echo $registrosVenda->idVenda; ?> </td>
            <td><?php echo $registrosVenda->nomeCliente; ?> </td>
            <td><?php echo $registrosVenda->cpfCliente; ?> </td>
            <td><?php echo $registrosVenda->nomeFuncionario; ?> </td>
            <td><?php echo date('d/m/Y', strtotime($registrosVenda->dataVenda)); ?>
            <td><?php echo $registrosVenda->formaPgto; ?> </td>
        </tr>
	</table>
    
    <table border="1"  width="100%">
        <tr class="cabecalho">
            <th>IdProduto</th>
            <th>Nome</th>
            <th>Preco</th>
            <th>Quantidade</th>
            <th>Total</th>
        </tr>
	<?php
		require_once('Venda/controle/ControleVenda.class.php');
		$ctrlItensVenda = new ControleVenda();
		$registrosItensVenda = $ctrlItensVenda->buscarDadosItensVendas($_POST['id']);

	?>

	<?php
	
		if($registrosItensVenda)
		{
			$totalGeral = 0;
			foreach( $registrosItensVenda as $item)
			{
			$totalGeral += $item['total'];
			$_SESSION['produtoUpdate'][] = array("id"=>$item['idProduto'], "qtde"=>$item['quantidade']);
	?>			
	
				<tr>
				<td><?php echo $item['idProduto']; ?></td>
				<td><?php echo $item['nome']; ?></td>
				<td><?php echo $item['preco']; ?></td>
				<td><?php echo $item['quantidade']; ?></td>
				<td><?php echo $item['total']; ?></td>
				<td><?php echo $item['itemvenda']; ?></td>
				<td><a href='?pag=Troca/visao/trocar.php&controlador=ControleTroca&acao=inserirTroca&id=<?php echo $item['itemvenda'];?>'>Trocar</a></td>
				</tr>
	<?php 
			}
		}
		?>
     	
        <tr>
            <td align="right" colspan="4"> Total </td>
            <td align="right"><?php echo number_format($totalGeral, 2, ',', '.') ?></td>
        </tr>   
        
<?php        
	} 
	?>
	
</table>
</div>
</div>
</body>
</html>