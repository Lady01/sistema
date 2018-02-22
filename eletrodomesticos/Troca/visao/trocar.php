<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar</title>
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:280px;
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
		
		#seleciona
		{
		margin: 0 auto;
		}
		#ultimo
		{
		font-size:16px;
		}

</style>	
	<script type="text/javascript" src="Cliente/visao/jquery.js"></script>
	<script type="text/javascript" src="Cliente/visao/jquery.maskedinput.js"></script>
	
<script type="text/javascript">
$(document).ready(function(){
	
        
		$("input.data").mask("99/99/9999");
});
</script>	

</head>
<body>
<div id="geral">

<?php if(isset($_GET['id']))
$id=$_GET['id'];
	
 ?>	
	<form id="form_cad_cliente" action="?pag=Troca/controle/verificaAcao.php" method="post">
		<div id="faixa"> <legend>Troca de aparelhos</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleTroca"/>
		<input type="hidden" name="acao" value="inserirTroca"/>
		<label>Id de item:</label><input type="text" name="idItemVenda" value="<?php echo $id; ?>"/><br/><br/>
		<label>Defeito?</label>
		<select name="defeito" id="seleciona">
		<option value="">Selecione uma opcao</option>
		<option value="1">Sim</option>
		<option value="0">Nao</option>
		</select></br></br>
		<label>Data: </label> <input type="text" name="data" id="data" class="data"/><br/><br/>
		<label id="ultimo">Observacao: </label><input class="field" type="text" name="observacao" /> <br/><br/>
		<div class="botoes">
		<input type="submit" value="Trocar" onclick="return confirm('Confirma troca?');"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Troca/index.php';">
		</div>
		</div>
	</form>
</div>
</body>
</html>