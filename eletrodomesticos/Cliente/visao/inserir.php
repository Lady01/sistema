<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inserção de clientes</title>
	
	
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
			margin-top:90px;
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
	<!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
	<script type="text/javascript" src="Cliente/visao/jquery.js"></script>
	<script type="text/javascript" src="Cliente/visao/jquery.maskedinput.js"></script>
	
<script type="text/javascript">
$(document).ready(function(){
	
        
		$("input.data").mask("99/99/9999");
});
</script>	

</head>


<body>
	
	<form id="form_cad_cliente" action="?pag=Cliente/controle/verificaAcao.php" method="post">
	<div id="faixa"> <legend>Cadastro de clientes</legend></div>
	<div id="form">
		<input class="field" type="hidden" name="controlador" value="ControleCliente"/>
		<input class="field" type="hidden" name="acao" value="inserir"/>
		<label>Nome: </label> <input maxlength="45" class="field" type="text" name="nome" /> <br /> <br />
		<label>Cpf: </label><input type="text" class="cpf" id="cpf" name="cpf" /> <br /><br />
		<label>Sexo:</label> 
		<select name="sexo" id="sexo">
			<option value="">Selecione o sexo</option>
			<option value="f">Feminino</option>
			<option value="m">Masculino</option>
			</select>
		<br /><br />
		<label>Endereco: </label><input class="field" type="text" name="endereco" /><br /><br>
		<label> Cidade: </label> <input class="field" type="text" name="cidade" /> </br><br />
		<label>Estado: </label><input class="field" type="text" name="estado" /> <br /><br />
		<label>Telefone: </label><input type="text" class="tel" id="tel" name="tel"/> <br />
		<!--<label>Data de nascimento: </label><input class="field" type="text" name="dataNasc" id="data" /> --><br />
		<label>Data de nascimento: </label><input type="text" class="data" id="data" name="data"/> 
		
		<div id="botoes"><input type="submit" value="Enviar"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Cliente/index.php';">
		</div>
		<!--<input type="button" value="Ver listagem" onclick="location.href='/mvcpiloto2/controller/controllercliente.php?a=listar'"/>-->
		</div>
	</form>
</body>
</html>