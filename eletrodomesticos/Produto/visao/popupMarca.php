<?php session_start(); ?>


<html>


<head>
	<title> Consulta de fornecedor </title>
	<!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
	<script type="text/javascript" src="Produto/visao/jquery.js"></script>
    <script language="javascript">

	// função responsável para enviar os dados buscados à função atualizaForm da página pai
	window.onunload = function(){
		window.opener.atualiza();
	};
	
	function buscar(txtMarca)
	{
		$("#lista").html("Carregando...");
		$.post("master-jquery.php?jq=Produto/visao/ajax.php",
		{op:1, marca:txtMarca.value},
			function(valor){
				$("#lista").html(valor);
			}
		);
	}
    </script>
</head>
<body>

Marca: <input type="text" name="marca" onKeyUp="buscar(this)" /> <br>
<label id="lista"></label>



<?php


if( isset( $_GET['addMarca'] ))
{ echo $_GET['addMarca'];

	//$sql = "SELECT * FROM fornecedor WHERE id = ". $_GET['addFornecedor'];
	//$qry = mysql_query($sql);
	//$registro = mysql_fetch_object($qry);
	require_once("Marca/controle/ControleMarca.class.php");
	$controle = new ControleMarca();
	$marcas=$controle->buscarId($_GET['addMarca']);
	
if($marcas){
	foreach($marcas as $registro)
	{
	$_SESSION['marca'] = array(
		'id'=>$registro->getId(),
		'nome'=>$registro->getNome()
	);
	}
	
	echo "<script> window.close(); </script>";
}		


}
?>

</body>
</html>