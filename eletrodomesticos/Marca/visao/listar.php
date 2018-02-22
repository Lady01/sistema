<html>
<head>
<title>Consulta de marcas</title>
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
	<div id="faixa"> <legend>Consulta de marcas</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleMarca"/>
		<input type="hidden" name="acao" value="buscar"/>
		<label>Nome: </label><input class="field" type="text" name="nome"/></br>
		<div id="botoes">
		<input type="submit" class="fontB" name="enviar" value="Consultar"/>
		<input type="button" class="fontB" value="Inserir novo" OnClick="location.href='?pag=Marca/visao/inserir.php';">
		<input type="button" class="fontB" value="Voltar" OnClick="location.href='../';">
		</div>
		</div>
	</form>

<div id="listaMarcas">
<?php 

if( isset($_POST['enviar']) )
{
	require_once('Marca/controle/ControleMarca.class.php');
	$ctrlMarca = new ControleMarca();
	$registrosMarca = $ctrlMarca->buscar($_POST['nome']);
	?>
	<!--<td><a href='eletrodomesticos/Marca/visao/editar.php?controlador=ControleMarca&acao=editar&id={$reg->getId()}'>Editar</a></td>-->
	<table class="tabela" width="85%" border="1" cellspacing="2" cellpadding="0">
		<tr class="cabecalho">
			<td>ID</td>
			<td>NOME</td>
			<td>DESCRICAO</td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
		</tr>
	<?php
	//if($numClientes>0)
	if( $registrosMarca )
	{
		
		
			foreach( $registrosMarca as $reg )
			{
				
				print "
				<tr>
					<td> {$reg->getId()} </td>
					<td> {$reg->getNome()} </td>
					<td> {$reg->getDescricao()} </td>
					<td><a href='?pag=Marca/visao/editar.php&controlador=ControleMarca&acao=editar&id={$reg->getId()}'>Editar</a></td>
                    <td><a href='?pag=Marca/controle/verificaAcao.php&controlador=ControleMarca&acao=excluir&id={$reg->getId()}' onclick=\"return confirm('Deseja excluir?');\">Excluir</a></td>	
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