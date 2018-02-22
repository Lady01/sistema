<?php session_start(); ?>
<?php require('ListadeCasamento/visao/conexao.php') ?>

<html>
<head>
	<title> Consulta de cliente </title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script language="javascript">

	// função responsável para enviar os dados buscados à função atualizaForm da página pai
	window.onunload = function(){
		window.opener.atualiza();
	};
	
	function buscar(txtCliente)
	{
		$("#lista").html("Carregando...");
		$.post("master-jquery.php?jq=ListadeCasamento/visao/ajax.php",
		{op:2, cliente:txtCliente.value},
			function(valor){
				$("#lista").html(valor);
			}
		);
	}
    </script>
</head>
<body>


Nome do Cliente : <input type="text" name="cliente" onKeyUp="buscar(this)" /> <br>
<label id="lista"></label>




<?php


if( isset( $_GET['addCliente'] ))
{
//
	//$sql = "SELECT id, nome FROM cliente WHERE id = ". $_GET['addCliente'];
	//$qry = mysql_query($sql);
	//$registro = mysql_fetch_object($qry);
	require_once('Cliente/controle/ControleCliente.class.php');
	$controle = new ControleCliente();
	$clientes=$controle->buscarId($_GET['addCliente']);
	foreach($clientes as $registro)
	{
	$_SESSION['cliente'] = array(
		'id'=>$registro->getId(),
		'nome'=>$registro->getNome()
	);
	}
	
	echo "<script> window.close(); </script>";
}		


?>

</body>
</html>