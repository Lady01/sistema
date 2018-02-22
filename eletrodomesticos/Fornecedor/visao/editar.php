<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edicão de Fornecedores</title>
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
<?php if(isset($_GET['id']))
$id=$_GET['id'];

 $nome=null; $idade=null;
require_once('Fornecedor/controle/ControleFornecedor.class.php');
	$ctrlFornecedor = new ControleFornecedor();
	$fornecedores=$ctrlFornecedor->buscarId($id);
	if($fornecedores)
	{
	
	foreach($fornecedores as $forn)
{ 
$id=$forn->getId();
$nome=$forn->getNome();
$cnpj=$forn->getCnpj();
$telefone=$forn->getTelefone();
$endereco=$forn->getEndereco();
$cidade=$forn->getCidade();
$estado=$forn->getEstado();
$descricao=$forn->getDescricao();
}	
	} 
	
 ?>	
	<form id="form_cad_cliente" action="?pag=Fornecedor/controle/verificaAcao.php" method="post">
		<div id="faixa"> <legend>Edicao de fornecedores</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleFornecedor"/>
		<input type="hidden" name="acao" value="editar"/>
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<label>Nome: </label><input class="field" type="text" name="nome" value="<?php echo $nome;?> " />  <br/><br/>
		<label>Cnpj: </label><input class="field" type="text" name="cnpj" value="<?php echo $cnpj;?>"/> <br/><br/>
		<label>Telefone: </label><input class="field" type="text" name="telefone" value="<?php echo $telefone;?>"/> <br /><br />
		<label>Endereco: </label><input class="field" type="text" name="endereco" value="<?php echo $endereco;?>"/> <br /><br />
		<label>Cidade: </label><input class="field" type="text" name="cidade" value="<?php echo $cidade;?>"/> <br /><br />
		<label>Estado: </label><input class="field" type="text" name="estado" value="<?php echo $estado;?>"/> <br /><br />
		<label>Descricao: </label><input class="field" type="text" name="descricao" value="<?php echo $descricao;?>"/> <br /><br />
		<div class="botoes">
		<input type="submit" value="Editar" onclick="return confirm('Confirma alteração?');"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Fornecedor/index.php';">
		</div>
		</div>
	</form>
</body>
</html>