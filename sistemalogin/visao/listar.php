<html>
<head>
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:150px;
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
			margin-top:20px;
			margin: 0 auto;
			font-size:18px;
		}
		.field
		{
			margin: 0 auto;
		}
		#form
		{
			padding-top:30px;
		}
		h2
		{
			text-align:center;
			color:black;
		}
		.botoes
		{
			margin-top:30px;
			margin-left:190px;
		}
		option
		{
		color:#236B8E;
		}
		#faixa
		{
		width:500px;
		margin:0 auto;
		height:30px;
		line-height:30px;
		background-color:black;
		color:white;
		}
		legend
		{
		margin-left:10px;
		}
		.func
		{
		margin:0 auto;
		}
		.tabela
{
margin-top:30px;
margin: 0 auto;
}
.tabela tr td a { color:black; }
.tabela tr td a:active { color:black; }
</style>
</head>
<body>
<div id="geral">
<div id="faixa"><legend>Consulta de usuario</legend></div>
	<form id="form_cad_cliente" action="" method="post">
		<input type="hidden" name="controlador" value="ControleUsuario"/>
		<input type="hidden" name="acao" value="buscar"/>
		<label>Usuario:</label><input type="text" name="nome"/><br>
		<div class="botoes">
		<input type="submit" name="enviar" value="Enviar"/>
		<input type="button" value="Voltar" OnClick="location.href='/mvcpiloto2/index.php';">
		</div>
	</form>

<div id="listaUsuarios">
<?php 

if( isset($_POST['enviar']) )
{
	require_once('../controle/ControleUsuario.class.php');
	$ctrlUsuario = new ControleUsuario();
	$registrosUsuario = $ctrlUsuario->buscar($_POST['nome']);
	//var_dump($registrosCliente);
	//$i=0;
	?>
	<table width="85%" border="1" class="tabela" cellspacing="2" cellpadding="0">
		<tr>
			<td>ID</td>
			<td>NOME DE USUARIO</td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
		</tr>
	<?php
	//if($numClientes>0)
	if( $registrosUsuario )
	{
			foreach( $registrosUsuario as $reg )
			{
			
				print "
				<tr>
					<td> {$reg->getId()} </td>
					<td> {$reg->getLogin()} </td>
					<td><a href='../visao/editar.php?controlador=ControleUsuario&acao=editar&id={$reg->getId()}'>Editar</a></td>
                    <td><a href='../controle/verificaAcao.php?controlador=ControleUsuario&acao=excluir&id={$reg->getId()}' onclick=\"return confirm('Deseja excluir?');\">Excluir</a></td>	
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