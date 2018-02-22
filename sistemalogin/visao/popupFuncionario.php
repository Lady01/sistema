<?php session_start(); ?>
<?php require('conexao.php') ?>

<html>
<head>
	<title> Consulta de funcionario </title>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script language="javascript">

	// função responsável para enviar os dados buscados à função atualizaForm da página pai
	window.onunload = function(){
		window.opener.atualiza();
	};
	
	function buscar(txtFuncionario)
	{
		$("#lista").html("Carregando...");
		$.post("autocomplete.php", {funcionario:txtFuncionario.value},
			function(valor){
				$("#lista").html(valor);
			}
		);
	}
    </script>
</head>
<body>


Nome do Funcionario : <input type="text" name="funcionario" onKeyUp="buscar(this)" /> <br>
<label id="lista"></label>




<?php


if( isset( $_GET['addFuncionario'] ))
{

	$sql = "SELECT id, nome, cargo FROM funcionario WHERE status = true and id = ". $_GET['addFuncionario'];
	$qry = mysql_query($sql);
	$registro = mysql_fetch_object($qry);
	
	$_SESSION['funcionario'] = array(
		'id'=>$registro->id,
		'nome'=>$registro->nome,
		'cargo'=>$registro->cargo
	);
	
	echo "<script> window.close(); </script>";
}		


?>

</body>
</html>