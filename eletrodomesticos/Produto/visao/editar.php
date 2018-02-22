<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar</title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    
    <script language="javascript">
		// função para abrir popup (centralizado na tela) de busca [Marca]
		function popupMarca()
		{
			var wPopup = 500;
			var center = (screen.width / 2) - (wPopup/2);
			window.open('popup.php?popup=Produto/visao/popupMarca.php', null, 'width='+ wPopup +', height=300, top=100, left=' + center );
		}
		// função que receberá retorno de popup e atualizará o formulário
		function atualizaForm(id, marca, descricao)
		{
			$("#idMarca").val(id);
			$("#txtMarca").val(marca);
		}
		function atualiza()
{
	location.href="index.php?pag=Produto/visao/editar.php";
}

	</script>
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
		#form_cad_cliente
		{
			width:500px;
			height:420px;
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
			margin-top:25px;
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
.bM
{
width:98px;
height:20px;
margin-left:199px;
margin-right:199px;
}

</style>	
</head>
<body>
<div id="geral">
<?php if(isset($_GET['id']))
$id=$_GET['id'];
 $nome=null; $idade=null;
require_once('Produto/controle/ControleProduto.class.php');

$id=$_GET['id'];
	$ctrlProduto = new ControleProduto();
	$produtos=$ctrlProduto->buscarId($id);
	if($produtos)
	{
		foreach($produtos as $produto)
		{ 
			$idP=$produto->getId();
			$idMarca=$produto->getIdMarca();
			$nome=$produto->getNome();
			$descricao=$produto->getDescricao();
			$preco=$produto->getPreco();
		}	
	}
require_once('Marca/controle/ControleMarca.class.php');
$controleMarca = new ControleMarca();
$marcas=$controleMarca->buscarId($idMarca);
if($marcas)
{
	foreach($marcas as $marca)
	{
		$idM=$marca->getId();
		$nomeMarca=$marca->getNome();
	}
}
 ?>	
	<form id="form_cad_cliente" action="?pag=Produto/controle/verificaAcao.php" method="post">
		<div id="faixa"> <legend>Edicao de produtos</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleProduto"/>
		<input type="hidden" name="acao" value="editar"/>
		<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<input type="hidden" name="idMarca" value="<?php  echo  $idMarca;  ?>"/>
		<fieldset>
		<legend>Dados da marca</legend> 
		<label>Id:</label><input class="field" type="text" name="idMarca" id="idMarca" value="<?php  echo $idMarca;  ?>" readOnly /><br/><br/>
		<label>Marca:</label><input type="text" class="field" name="txtMarca" id="txtMarca" readOnly value="<?php  echo $nomeMarca; ?>"/> <br/><br/>
		<!--<div class="bM"><input type="button" id="bMarca" name="buscarMarca" onClick="popupMarca()" value="Editar marca"/></div>-->
		<br/><br/>
</fieldset>
<fieldset>
<legend>Dados do produto</legend>
		<label>Nome: </label><input type="text" name="nome" value="<?php echo $nome;?> " />  <br/><br/>
		<label>Descricao: </label> <input type="text" name="descricao" value="<?php echo $descricao;?>"/> <br/><br/>
		<label>Preco: </label><input type="text" name="preco" value="<?php echo $preco; ?>"/> <br /><br />
		</fieldset>
		<div class="botoes">
		<input type="submit" value="Editar" onclick="return confirm('Confirma alteração?');"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Produto/index.php';">
		</div>
<?php unset($_SESSION['marca']); ?>
		</div>
	</form>
</div>
</body>
</html>