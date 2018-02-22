<html>
<head>
<title> P&aacute;gina de Login</title>
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:220px;
			margin:0 auto;
			margin-top:50px;
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
		#btLogin
		{
		margin-left:230px;
		}
		.tit{margin:0 auto;}
</style>
</head>
<body>
<div id="geral">
<h1 class="tit"> Sistema de Gerenciamento de Vendas de Eletrodom&eacute;sticos</h1>

<form id="form_cad_cliente" action="../controle/verificaAcao.php?controlador=ControleUsuario&acao=logar" method="post">
<div id="faixa"><legend>Formulario de login</legend> </div>
<input type="hidden" name="controlador" value="ControleUsuario"/>
<input type="hidden" name="acao" value="logar"/>
<label>Usuario:</label>
<input class="field" type="text" name="loginUsuario"/><br/><br/>
<label>Senha:</label>
<input class="field" type="password" name="senhaUsuario"/><br/><br/>
<input type="submit" id="btLogin" value="Enviar"/>
</form>
</div>
</body>
</html>