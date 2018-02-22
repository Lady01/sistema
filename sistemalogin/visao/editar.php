<html>
<head>
<title>Edicão de Usuário</title>
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

</head>
<body>
<?php

require_once('../controle/ControleUsuario.class.php');
$id = $_GET['id'];
$controleUsuario = new ControleUsuario();
$usuarios = $controleUsuario->buscarId($id);
if($usuarios)
{
	foreach($usuarios as $usuario )
	{
		$id=$usuario->getId();
		$idFuncionario=$usuario->getIdFuncionario();
		$login=$usuario->getLogin();
		$senha=$usuario->getSenha();
		
	}
	
	require_once('../Funcionario/controle/ControleFuncionario.class.php');
	$controleF= new ControleFuncionario();
	$funcs=$controleF->buscarId($idFuncionario);
	foreach($funcs as $row)
	{
	$idF=$row->getId();
	$nomeF=$row->getNome();
	}
} 
?>
<div id="faixa"><legend>Edicao de usuario</legend></div>
<form id="form_cad_cliente" action="../controle/verificaAcao.php?controlador=ControleUsuario&acao=editar" method="post">
<input type="hidden" name="controlador" value="ControleUsuario"/>
<input type="hidden" name="acao" value="editar"/>
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<br/>
<label style="font-size:14px;">Id do funcionario: </label> <input type="text" class="field" name="nomeUsuario"  value=" <?php echo $idF; ?>"/><br/><br/>
<label>Nome: </label> <input type="text" class="field" name="nomeUsuario"  value=" <?php echo $nomeF; ?>"/><br/><br/>
<label>Usuario: </label> <input type="text" class="field" name="nomeUsuario"  value=" <?php echo $login; ?>"/><br/><br/>
<label>Senha:</label> <input type="password" class="field" name="senha" value="<?php echo $senha; ?>"/><br/><br/>
<div class="botoes">
<input type="submit" name="enviar" value="Enviar"/>
<input type="button" name="voltar" value="Voltar" OnClick="location.href='../index.php';"/>
</div>
</form>
</body>
</html>