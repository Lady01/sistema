<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insercao de funcionarios</title>
		<title>Inserção de clientes</title>
	
	
	<style type="text/css">
		body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:540px;
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
		#botoes
		{
			margin-top:20px;
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
	<script type="text/javascript" src="Cliente/visao/jquery.js"></script>
	<script type="text/javascript" src="Cliente/visao/jquery.maskedinput.js"></script>
	
	<script>
$(document).ready(function(){
	
        
		$("input.dataNasc").mask("99/99/9999");
});
</script>

</head>
<body>
	<form id="form_cad_cliente" action="?pag=Funcionario/controle/verificaAcao.php" method="post">
		<div id="faixa"> <legend>Cadastro de funcionarios</legend></div>
		<div id="form">
		<input class="field" type="hidden" name="controlador" value="ControleFuncionario"/>
		<input class="field" type="hidden" name="acao" value="inserir"/>
		<label>Nome: </label><input class="field" type="text" name="nome" />  <br /></br>
		<label>Cpf: </label><input type="text" class="field" name="cpf" /> <br /><br />
		<label>Sexo:</label> 
		<select name="sexo" id="sexo">
			<option value="">Selecione o sexo</option>
			<option value="f">Feminino</option>
			<option value="m">Masculino</option>
			</select>
		<br /><br />
		<label>Endereço: </label><input type="text" class="field" name="endereco" /></br></br>
		<label> Cidade: </label><input type="text" name="cidade" class="field" /> </br></br>
		<label>Estado: </label><input type="text" name="estado" class="field" /> <br /><br />
		<label>Telefone: </label><input type="text" name="telefone" class="field" /> <br /><br />
		<label>Matricula: </label><input type="text" name="matricula" class="field" /> <br /><br />
		<label>Data de Nascimento: </label><input type="text" class="dataNasc" id="dataNasc" name="dataNasc" /> <br /><br />
		<label>Cargo: </label><input type="text" name="cargo" class="field"/> <br /><br />
		<div id="botoes">
		<input type="submit" value="Inserir"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Funcionario/index.php';">
		</div>
		
		</div>
	</form>
</body>
</html>