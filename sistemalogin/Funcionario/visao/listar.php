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
background-color:#D3D3D3;
color:white;
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
		.primeiraLinha
		{
		background-color:black;
		}
		
	
</style>
</head>
<body>
<div>	
	<form id="form_cad_cliente" name="listar" border="1" action="" method="post">
		<div id="faixa"> <legend>Consulta de funcionarios</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleFuncionario"/>
		<input type="hidden" name="acao" value="buscar"/>
		<label>Nome: </label><input class="field" type="text" name="nome"/></br>
		<div id="botoes">
		<input class="fontB"type="submit" name="enviar" value="Consultar"/>
		<input class="fontB" type="button" value="Inserir novo" OnClick="location.href='?pag=Funcionario/visao/inserir.php';">
		<input class="fontB" type="button" value="Voltar" OnClick="location.href='?pag=Funcionario/index.php';">
		</div>
		</div>
	</form>
</div>
<div id="listaFuncionarios">
<?php 

if( isset($_POST['enviar']) )
{
	require_once('Funcionario/controle/ControleFuncionario.class.php');
	$ctrlFuncionario = new ControleFuncionario();
	$registrosFuncionario = $ctrlFuncionario->buscar($_POST['nome']);
	?>
	<table class="tabela" width="85%" border="1" cellspacing="2" cellpadding="0">
		<tr class="primeiraLinha">
			<td>ID</td>
			<td>NOME</td>
			<td>CPF</td>
			<td>SEXO</td>
			<td>ENDERECO</td>
			<td>CIDADE</td>
			<td>ESTADO</td>
			<td>TELEFONE</td>
			<td>MATRICULA</td>
			<td>DATA DE NASCIMENTO</td>
			<td>CARGO</td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
		</tr>
	<?php
	if( $registrosFuncionario)
	{
			foreach( $registrosFuncionario as $reg )
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
					<td> {$reg->getMatricula()} </td>
					<td> {$reg->getDataNasc()} </td>
					<td> {$reg->getCargo()} </td>
					<td><a href='?pag=Funcionario/visao/editar.php&controlador=ControleFuncionario&acao=editar&id={$reg->getId()}'>Editar</a></td>
                    <td><a href='?pag=Funcionario/controle/verificaAcao.php&controlador=ControleFuncionario&acao=excluir&id={$reg->getId()}' onclick=\"return confirm('Deseja excluir?');\">Excluir</a></td>	
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