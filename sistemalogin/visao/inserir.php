<?php session_start(); ?>

<!DOCTYPE HTML>
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
			margin-top:10px;
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
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> Cadastro de usuário </title>
</head>

<body>


<script>
function popup(arquivo)
{
	window.open(arquivo, null, 'width=600, height=200, top=100, left=300, scrolling=no');	
}
function atualiza()
{
	location.href="inserir.php";
}
</script>

	<div id="faixa"><legend>Cadastro de usuario</legend></div>
    <table class="func" width="500px" bgcolor="#D3D3D3" border="1">
    	<tr>
        	<td> Id </td>
            <td> <?php echo @$_SESSION['funcionario']['id'] ?> </td>
        </tr>
        <tr>
        	<td> Nome </td>
            <td>  <?php echo @$_SESSION['funcionario']['nome'] ?> </td>
        </tr>
        <tr>
        	<td> Cargo </td>
            <td>  <?php echo @$_SESSION['funcionario']['cargo'] ?> </td>
        </tr>
        <tr>
            <td colspan="2"> <input type="button" value="Pesquisar funcionario" onClick="popup('popupFuncionario.php')"/> </td>
        </tr>
    </table>

<form id="form_cad_cliente" action="../controle/verificaAcao.php?controlador=ControleUsuario&acao=inserir" method="post">
<input type="hidden" name="controlador" value="ControleUsuario"/>
<input type="hidden" name="acao" value="inserir"/>
<label>Usuario:</label>
<input type="text" name="nomeUsuario" class="field" /><br/><br/>
<label> Senha:</label>
<input type="password" name="senha" class="field"/><br/><br/><br/>
<div class="botoes"> 
<input type="submit"  name="inserir" value="Inserir"/>
<input type="button"  name="voltar" value="Voltar" OnClick="location.href='../index.php';"/>
</div>
</form>
</body>
</html>