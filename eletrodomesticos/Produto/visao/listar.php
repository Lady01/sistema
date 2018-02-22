<html>
<head>
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
		.tabela tr td a { color:black; }

</style>
</head>
<body>
<div id="geral">
	<form id="form_cad_cliente" action="" method="post">
	<div id="faixa"> <legend>Consulta de produtos</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="controllercliente"/>
		<input type="hidden" name="acao" value="buscar"/>
		<label>Nome:</label><input class="field" type="text" name="nome"/></br>
		<div id="botoes">
		<input type="submit" name="enviar" value="Consultar"/>
		<input type="button" value="Inserir novo" OnClick="location.href='?pag=Produto/visao/inserir.php';">
		<input type="button" value="Voltar" OnClick="location.href='?pag=Produto/index.php';">
		</div>
		</div>
	</form>

<div id="listaMarcas">
<?php 

if( isset($_POST['enviar']) )
{
	require_once('Produto/controle/ControleProduto.class.php');
	$ctrlProduto = new ControleProduto();
	$registrosProduto = $ctrlProduto->buscar($_POST['nome']);
	?>
	<table class="tabela" width="85%" border="1" cellspacing="2" cellpadding="0">
		<tr class="cabecalho">
			<td>ID</td>
			<td>IDMARCA</td>
			<td>NOME</td>
			<td>DESCRICAO</td>
			<td>QUANTIDADE DISPONIVEL</td>
			<td>PRECO</td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
		</tr>
	<?php
	//if($numClientes>0)
	if( $registrosProduto )
	{
		
			
			foreach( $registrosProduto as $reg )
			{
				
				print "
				<tr>
					<td> {$reg->getId()} </td>
					<td> {$reg->getIdMarca()} </td>
					<td> {$reg->getNome()} </td>
					<td> {$reg->getDescricao()} </td>
					<td> {$reg->getQtdDisponivel()} </td>
					<td> {$reg->getPreco()} </td>
					<td><a href='?pag=Produto/visao/editar.php&controlador=ControleProduto&acao=editar&id={$reg->getId()}'>Editar</a></td>
                    <td><a href='?pag=Produto/controle/verificaAcao.php&controlador=ControleProduto&acao=excluir&id={$reg->getId()}' onclick=\"return confirm('Deseja excluir?');\">Excluir</a></td>	
				</tr>
				";
			}
		
	}
}
?>
</table>
</div>
</div>
</body>
</html>