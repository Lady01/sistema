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
			font-size:24px;
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
		
.tabela tr td a { color:black; }	
</style>
</head>
<body>
<div>	
	<form id="form_cad_cliente" name="listar" border="1" action="" method="post">
		<div id="faixa"> <legend>Consulta de clientes</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleCliente"/>
		<input type="hidden" name="acao" value="buscar"/>
		<label>Nome: </label><input class="field" type="text" name="nome"/></br>
		<div id="botoes">
		<input class="fontB"type="submit" name="enviar" value="Consultar"/>
		<input class="fontB" type="button" value="Inserir novo" OnClick="location.href='?pag=Cliente/visao/inserir.php';">
		<input class="fontB" type="button" value="Voltar" OnClick="location.href='?pag=Cliente/index.php';">
		</div>
		</div>
	</form>
</div>
<div id="listaFornecedores">
<?php 

if( isset($_POST['enviar']) )
{
	require_once('Cliente/controle/ControleCliente.class.php');
	$ctrlCliente = new ControleCliente();
	$registrosCliente = $ctrlCliente->buscar($_POST['nome']);
	?>
	<table class="tabela" width="85%" border="1" cellspacing="2" cellpadding="0">
		<tr class="cabecalho">
			<td>ID</td>
			<td>NOME</td>
			<td>CPF</td>
			<td>SEXO</td>
			<td>ENDERECO</td>
			<td>CIDADE</td>
			<td>ESTADO</td>
			<td>TELEFONE</td>
			<td>DATA DE NASCIMENTO</td>
				<td>&nbsp;  </td>
				<td>&nbsp;  </td>
		</tr>
	<?php
	if( $registrosCliente)
	{
			foreach( $registrosCliente as $reg )
			{
				
				print "
				<tr>
					<td> {$reg->getId()} </td>
					<td> {$reg->getNome()} </td>
					<td> {$reg->getCpf()} </td>
					<td> {$reg->getSexo()} </td>
					<td> {$reg->getEndereco()} </td>
					<td> {$reg->getCidade()} </td>
					<td> {$reg->getEstado()} </td>
					<td> {$reg->getTelefone()} </td>
					<td> {$reg->getDataNasc()} </td>
					<td><a href='?pag=Cliente/visao/editar.php&controlador=ControleCliente&acao=editar&id={$reg->getId()}'>Editar</a></td>
                    <td><a href='?pag=Cliente/controle/verificaAcao.php&controlador=ControleCliente&acao=excluir&id={$reg->getId()}' onclick=\"return confirm('Deseja excluir?');\">Excluir</a></td>	
				</tr>
				";
			}
	}
}
?>
</table>
</div>
</body>
</html>