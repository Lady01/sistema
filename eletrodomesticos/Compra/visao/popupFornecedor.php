<?php session_start(); ?>
<?php require('Compra/visao/conexao.php') ?>

<html>
<head>
	<title> Consulta de fornecedor </title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script language="javascript">

	// função responsável para enviar os dados buscados à função atualizaForm da página pai
	window.onunload = function(){
		window.opener.atualiza();
	};
	
	function buscar(txtFornecedor)
	{
		$("#lista").html("Carregando...");
		$.post("master-jquery.php?jq=Compra/visao/ajax.php",
		{op:2, fornecedor:txtFornecedor.value},
			function(valor){
				$("#lista").html(valor);
			}
		);
	}
    </script>
</head>
<body>


Nome do Fornecedor : <input type="text" name="fornecedor" onKeyUp="buscar(this)" /> <br>
<label id="lista"></label>

<?php


if( isset( $_GET['addFornecedor'] ))
{

	//$sql = "SELECT * FROM fornecedor WHERE id = ". $_GET['addFornecedor'];
	//$qry = mysql_query($sql);
	//$registro = mysql_fetch_object($qry);
	require_once("Fornecedor/controle/ControleFornecedor.class.php");
	$controle = new ControleFornecedor();
	$fornecedores=$controle->buscarId($_GET['addFornecedor']);
	foreach($fornecedores as $registro)
	{
	$_SESSION['fornecedor'] = array(
		'id'=>$registro->getId(),
		'nome'=>$registro->getNome(),
		'cnpj'=>$registro->getCnpj()
	);
	}
	
	echo "<script> window.close(); </script>";
}		


?>

</body>
</html>