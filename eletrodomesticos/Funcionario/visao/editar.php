<!doctype html>
<html lang="en">
<head>
<script type="text/javascript" src="Cliente/visao/jquery.js"></script>
	<script type="text/javascript" src="Cliente/visao/jquery.maskedinput.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
	$("input.data").mask("99/99/9999");
       });
</script>

	<meta charset="UTF-8">
	<title>Edicao de funcionarios</title>
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
	
</head>
<body>
<?php if(isset($_GET['id']))
$id=$_GET['id'];
 
 $nome=null; $idade=null;
require_once('Funcionario/controle/ControleFuncionario.class.php');
	$ctrlFuncionario = new ControleFuncionario();
	$funcionarios=$ctrlFuncionario->buscarId($id);
	if($funcionarios)
	{
	foreach($funcionarios as $func)
{ 
		$id=$func->getId();
		$nome=$func->getNome();
		$cpf=$func->getCpf();
		$sexo=$func->getSexo();
		$endereco=$func->getEndereco();
		$cidade=$func->getCidade();
		$estado=$func->getEstado();
		$telefone=$func->getTelefone();
		$matricula=$func->getMatricula();
		$dataNasc=$func->getDataNasc();
		$cargo=$func->getCargo();
}	
	} 
	
 ?>	
	<form id="form_cad_cliente" action="?pag=Funcionario/controle/verificaAcao.php" method="post">
		<div id="faixa"> <legend>Edicao de funcionarios</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleFuncionario"/>
		<input type="hidden" name="acao" value="editar"/>
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<label>Nome: </label><input class="field" type="text" name="nome" value="<?php echo $nome;?> " />  <br /><br />
		<label>Cpf: </label><input type="text" class="field" name="cpf" value="<?php echo $cpf;?> " />  <br /><br />
		<label>Sexo:</label> 
		<select name="sexo" id="sexo">
			<option value="">Selecione o sexo</option>
			<option value="f" <?php if($sexo == 'f') echo 'selected' ?>>Feminino</option>
			<option value="m" <?php if($sexo == 'm') echo 'selected' ?>>Masculino</option>
		</select>
		<br /><br />
		<label>Endereco: </label><input type="text" class="field" name="endereco" value="<?php echo $endereco;?>"/> <br /><br />
		<label>Cidade: </label><input type="text" class="field" name="cidade" value="<?php echo $cidade;?>"/> <br /><br />
		<label>Estado: </label><input type="text" class="field" name="estado" value="<?php echo $estado;?>"/> <br /><br />
		<label>Telefone: </label> <input type="text" class="field" name="telefone" value="<?php echo $telefone;?>"/> <br /><br />
		<label>Matricula: </label><input type="text" class="field" name="matricula" value="<?php echo $matricula; ?>"/> <br /><br />
		<label>Data de Nascimento: </label><input type="text" name="data" id="data" class="data" value="<?php echo date('d/m/Y', strtotime($dataNasc));?>"/> <br /><br />
		<label>Cargo: </label><input type="text" name="cargo" class="field" value="<?php echo $cargo;?>"/> <br /><br />
		<div id="botoes">
		<input type="submit" value="Editar" onclick="return confirm('Confirma alteração?');"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Funcionario/index.php';">
		</div>
	</div>
	</form>
</body>
</html>