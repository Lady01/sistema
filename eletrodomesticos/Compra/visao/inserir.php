<?php session_start(); ?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
body
		{
			background-color:#236B8E;
		}
.cliente
{
margin: 0 auto;
margin-bottom:30px;
width:300px;
background-color:#D3D3D3;
color:black;
}
.cabecalho
{
background-color:black;
color:white;
}
.bot
{
margin-left:30px;
}
.tabela
{
margin: 0 auto;
width:500px;
margin-top:30px;
}
p
{
text-align:center;
}
#faixa
		{
		width:100%;
		height:30px;
		line-height:30px;
		background-color:black;
		color:white;
		}
		
		#faixa1
		{
		margin: 0 auto;
		margin-bottom:-30px;
		width:500px;
		height:30px;
		line-height:30px;
		background-color:black;
		color:white;
		}
		legend
		{
		margin-left:10px;
		}
		.form_cad_cliente
		{
			width:500px;
			height:180px;
			margin:0 auto;
			background-color:#D3D3D3;
			color:black;
		}
		.form_cad_cliente1
		{
			width:500px;
			height:220px;
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
			
			margin-left:5px;
		}
		.form
		{
			padding-top:30px;
		}
		#botoes
		{
			width:175px;
			margin-top:40px;
			margin-left:163px;
			margin-right:163px;
		}
		.fontB
		{
		font-size:13px;
		}
		.link
		{
		color:black;
		}
		#pagamento
		{
		width:100%;
		}
		#bP
		{
		margin-left:198px;
		margin-right:198px;
		}
		.agrupamento1, .agrupamento2
		{
		width:505px;
		margin:0 auto;
		}
		.fonteMenor
		{
		font-size:16px;
		}
		.bFinaliza
		{
		margin-left:200px;
		margin-right:200px;
		margin-top:20px
		}
		
		#lista
		{	width:502px;
			margin: 0 auto;
			background-color:pink;
		}
		
		.grupo
		{
		width:506px;
		margin:0 auto;
		}
		t
		{
		margin:0 auto;
		}
		f.
		{
		margin-left:198px;
		margin-right:198px;
		}
		d.
		{
		
		}
		.client
		{
		padding-top:90px;
		}
</style>

<title> Compra </title>
</head>

<body>
<script type="text/javascript" src="Cliente/visao/jquery.js"></script>
	<script type="text/javascript" src="Cliente/visao/jquery.maskedinput.js"></script>
	

<script>
function popup(arquivo)
{
	window.open(arquivo, null, 'width=600, height=200, top=100, left=300, scrolling=no');	
}
function atualiza()
{
	location.href="index.php?pag=Compra/visao/inserir.php";
}
$(document).ready(function(){
	
        
		$("input.data").mask("99/99/9999");
});
</script>

<?php
	if( isset($_GET['addItem']) ) {
		$_SESSION['produto'][$_GET['addItem']]['qtde'] += 1;
		echo "<script> atualiza() </script>";	
	}
	if( isset($_GET['removeItem']) ){
		if( $_SESSION['produto'][$_GET['removeItem']]['qtde'] == 1 ){
			unset($_SESSION['produto'][$_GET['removeItem']]);	
		} else {
			$_SESSION['produto'][$_GET['removeItem']]['qtde'] -= 1;
			echo "<script> atualiza() </script>";
		}
	}
?>
	<div id="faixa1"> Formulario de compra</div>
    <table name="t1" class="tabela" bgcolor="#D3D3D3" border="0">
    	<tr>
        	<td> Cod </td>
			<td> Nome </td>
            
        </tr>
        <tr>
        	<td> <?php echo @$_SESSION['fornecedor']['id'] ?> </td>
            <td>  <?php echo @$_SESSION['fornecedor']['nome'] ?> </td>
        </tr>
        <tr width="20px">
            <td > <input type="button" value="Pesquisar fornecedor" onClick="popup('popup.php?popup=Compra/visao/popupFornecedor.php')"/> </td>
        </tr>
    </table>

<div width="515px" border="1" class="d"align="center">
    	<table border="1" bgcolor="#D3D3D3" class="t" width="500px">
        	<tr>
                <td>ID</td>
                <td>PRODUTO</td>
                <td>VALOR</td>
                <td>QTDE</td>
                <td align="right">TOTAL</td>
            </tr>
            

            
			<?php
            
                if( isset( $_SESSION['produto'] ) )
                {
                    
					$total = 0;
                    foreach( $_SESSION['produto'] as $cod=>$produto )
                    {
                        print "
						<tr>
							<td>{$cod}</td>
							<td>{$produto['nome']}</td>
							<td>". number_format($produto['valor'], 2) ."</td>
							<td>
								<a href='?pag=Compra/visao/inserir.php&removeItem={$cod}'> - </a> 
								{$produto['qtde']}
								<a href='?pag=Compra/visao/inserir.php&addItem={$cod}'> + </a> 
							</td>
							<td align='right'>". number_format(($produto['valor']*$produto['qtde']), 2) ."</td>
						</tr>";
						$total += $produto['valor']*$produto['qtde'];
                    }
                }
            
            ?>
            	<tr>
                	<td colspan="3" align="right"> </td>
                    <th bgcolor="#CCCCCC"> Total </th>
                    <th bgcolor="#CCCCCC" align="right"><?php echo @number_format($total, 2, ',', '.') ?></th>
                </tr>
				<tr>
					<td border="1" width="20px"><input type="button" value="Adicionar produto" onClick="popup('popup.php?popup=Compra/visao/popupProduto.php')"/></td>
				<tr>
            </table>
    
    
    </div>
    <form class="form_cad_cliente" name="compra" method="post" action="?pag=Compra/controle/verificaAcao.php">
		<input type="hidden" name="controlador" value="ControleCompra"/>
		<input type="hidden" name="acao" value="inserirCompra"/>
		<label>Data:</label><input type="text" class="data" id="data" name="data" value="<?php //echo date('d/m/Y') ?>"/><br/><br/>
    	<label class="fonteMenor">Observação: </label><input type="text" name="observacao"> <br/><br/>
		<?php if(isset($_SESSION['produto']) && isset($_SESSION['fornecedor']) ) { ?>        
    	<input class="bFinaliza" type="submit" name="finalizarCompra" value="Finalizar compra" />
        <?php } ?> 
    </form>

<?php

/*if( isset( $_POST['finalizarCompra']) )
{

	require('conexao.php');

	// insere na tabela compras
	echo $sql = "INSERT INTO compra  VALUES(
					DEFAULT,
				 	". $_SESSION['sFornecedor']['id'] .", 
				 	'". date('Y-m-d') ."', 
				 	1,
				 	'". addslashes($_POST['obs']) ."'
				)";
				
	$query = mysql_query($sql);
	
	
	
	// pegar o id da compra;
	$sql = "SELECT MAX(id) as id FROM compra";
	$idCompra = mysql_fetch_object( mysql_query( $sql ) )->id;
	
	
	// inserindo itens de compra
	$erro = 0;
	foreach( $_SESSION['produto'] as $cod=>$produto )
    {
		$sql = "INSERT INTO itemcompra VALUES(
					NULL,
					". $idCompra .",
					". $cod .",
					". number_format($produto['valor'], 2) .",
					". $produto['qtde'] ."
				)";	
		if( !mysql_query($sql) )
		{
			$erro++;
		}
	}
	
	
	
	//se ocorrer algum erro
	if( $erro )
	{
		echo "Erro na inserÃ§Ã£o";
	}
	else
	{
		unset($_SESSION['produto']);
		unset($_SESSION['sFornecedor'])	;
		echo "
			<script>
				alert('Cadastrado com sucesso!');
				location.href='index.php';
			</script>
		";
	}
	
}*/

?>


</body>
</html>