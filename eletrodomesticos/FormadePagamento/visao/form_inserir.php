<html>
<head>
<title> Cadastro de Formas de pagamento </title>
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:200px;
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


</style>

</head>


<body>
	<div id="geral">
		
		<form  id="form_cad_cliente" method="post" action="?pag=FormadePagamento/controle/verificaAcao.php">
		<div id="faixa"> <legend>Cadastro de forma de pagamento</legend></div>
			<div id="form">
			<label>Nome: </label><input type="text" name="nome"  class="field"/> <br/><br/> 
			<label>Descricao: </label><input type="text" name="descricao" class="field" /> <br/><br/>
			<input type="hidden" name="controlador" value="ControleFormadePagamento">
			<input type="hidden" name="acao" value="inserir">
			<div class="botoes">

			
			<input type="submit" name="enviar" value="Inserir"/>
			
			<input type="button" value="Voltar" OnClick="location.href='?pag=FormadePagamento/index.php';"> 
			</div>

			</div>
		</form>
	</div>
</body>
</html>
	
