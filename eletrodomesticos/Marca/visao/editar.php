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
<?php if(isset($_GET['id']))
$id=$_GET['id'];
 //echo $id;
 $nome=null; $idade=null;
require_once('Marca/controle/ControleMarca.class.php');
	$ctrlMarca = new ControleMarca();
	$marcas=$ctrlMarca->buscarId($id);
	if($marcas)
	{
		foreach($marcas as $marca)
		{ 
			$id=$marca->getId();
			$nome=$marca->getNome();
			$descricao=$marca->getDescricao();
		}	
	} 
	
 ?>	
	<form id="form_cad_cliente" action="?pag=Marca/controle/verificaAcao.php&controlador=ControleMarca&acao=editar&id" method="post">
	<!--/eletrodomesticos/Marca/controle/verificaAcao.php?controlador=ControleMarca&acao=editar&id-->
		<div id="faixa"> <legend>Edicao de marcas</legend></div>
			<div id="form">
	
		<input type="hidden" name="controlador" value="ControleMarca"/>
		<input type="hidden" name="acao" value="editar"/>
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<label>Nome: </label><input class="field" type="text" name="nome" value="<?php echo $nome; ?> " />  <br/><br/>
		<label>Descricao: </label> <input class="field" type="text" name="descricao" value="<?php echo $descricao; ?>"/> <br /><br />
		<div class="botoes">
			<input type="submit" value="Editar" onclick="return confirm('Confirma alteração?');"/>
			<input type="button" value="Voltar" OnClick="location.href='../';">
		</div>
		<!--<input type="button" value="Ver listagem" onclick="location.href='/mvcpiloto2/controller/controllercliente.php?a=listar'"/>-->
			</div>
	</form>
</div>
</body>
</html>