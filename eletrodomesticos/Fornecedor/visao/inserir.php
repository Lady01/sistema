<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:480px;
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
			margin-top:40px;
			margin-left:190px;
		}
		option
		{
		color:#236B8E;
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

</style>
</head>
<body>
	<form id="form_cad_cliente" action="?pag=Fornecedor/controle/verificaAcao.php" method="post">
		<div id="faixa"> <legend>Cadastro de fornecedores</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleFornecedor"/>
		<input type="hidden" name="acao" value="inserir"/>
		<label>Nome: </label> <input class="field" type="text" name="nome" />  <br /><br />
		<label>Cnpj: </label> <input class="field" type="text" name="cnpj" /> <br /><br />
		<label>Telefone: </label><input class="field" type="text" name="telefone" /> <br /><br />
		<label>Endereco: </label><input class="field" type="text" name="endereco" /> <br /><br />
		<label>Cidade: </label> <input class="field" type="text" name="cidade" /> <br /><br />
		<label>Estado: </label> <input class="field" type="text" name="estado" /> <br /><br />
		<label>Descricao: </label> <input class="field" type="text" name="descricao" /> <br /><br />
		<div class="botoes">
		<input type="submit" value="Inserir"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Fornecedor/index.php';">
		</div>
		</div>
	</form>
</body>
</html>