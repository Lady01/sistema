<?php session_start(); ?>
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

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    
    <script language="javascript">
		// função para abrir popup (centralizado na tela) de busca [Marca]
		function popupMarca()
		{
			var wPopup = 500;
			var center = (screen.width / 2) - (wPopup/2);
			window.open('popup.php?popup=Produto/visao/popupMarca.php', null, 'width='+ wPopup +', height=300, top=100, left=' + center );
		}
		function atualiza()
{
	location.href="index.php?pag=Produto/visao/inserir.php";
}
		// função que receberá retorno de popup e atualizará o formulário
		function atualizaForm(id, marca, descricao)
		{
			$("#idMarca").val(id);
			$("#txtMarca").val(marca);
		}

	</script>
    
</head>
<body>
<form id="form_cad_cliente" method="post" action="?pag=Produto/controle/verificaAcao.php">
<div id="faixa"> <legend>Cadastro de produtos</legend></div>
<div id="form">
<input type="hidden" name="controlador" value="ControleProduto" />
<input type="hidden" name="acao" value="inserir" />
<fieldset>
<legend>Dados da marca</legend>

<label>Id:</label><input class="field" type="text" name="idMarca" id="idMarca" value=" <?php echo @$_SESSION['marca']['id']; ?>"readOnly /><br/><br/>
<label>Marca:</label><input type="text" class="field" name="txtMarca" id="txtMarca" value=" <?php echo @$_SESSION['marca']['nome']; ?>"readOnly /> <br/><br/>

<div class="bM"><input type="button" id="bMarca" name="buscarMarca" onClick="popupMarca()" value="Adicionar Marca"/></div>
<br/><br/>
</fieldset>
<fieldset>
<legend>Dados do produto</legend>

<label>Nome: </label> <input type="text" name="nome" class="field" /> <br/><br/>
<label>Descricao: </label><input type="text" name="descricao" class="field" /> <br/><br />
<label>Preco: </label><input type="text" name="preco" class="field" /> <br/>
</fieldset>
<?php //unset($_SESSION['marca']); ?>
<div class="botoes">
<input type="submit" value="Inserir" />
<input type="button" value="Voltar" OnClick="location.href='?pag=Produto/index.php';"></div>
</div>
</div>
</form>
