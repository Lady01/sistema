<?php @session_start(); ?>
<html>
<head>
<title>Consulta de Vendas</title>
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
margin-top:30px;
margin: 0 auto;
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
		legend
		{
		margin-left:10px;
		}
		.form_cad_cliente
		{
			width:500px;
			height:200px;
			margin:0 auto;
			background-color:#D3D3D3;
			color:black;
		}
		.form_cad_cliente1
		{
			width:500px;
			height:240px;
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
</style>
<script type="text/javascript" src="Pagamento/visao/jquery.js" ></script>
    <script type="text/javascript" src="Pagamento/visao/jquery.maskMoney.js" ></script>
    <script type="text/javascript">
		$(document).ready(function(){
              $("#vPago").maskMoney({showSymbol:false, symbol:"R$", decimal:".", thousands:""});
        });
		function calcula()
		{
			var result = parseFloat( $("#vPago").val() - $("#aPagar").val() ).toFixed(2);
			$("#troco").val(result);
		}
    </script>

</head>
<body>
<div id="geral" >
<?php 
if( !isset($_SESSION['usuario']) )
{ 
	echo "Sessao inexistente";
	echo '<script> location.href="../sistemalogin/visao/form_login.php";</script>'; 
}
if ( $_SESSION['usuario']['nivel'] !=2)
{
echo "Bem vindo, ". $_SESSION['usuario']['login'];
}
?>
<a href="deslogar.php">Sair</a>
	<form class="form_cad_cliente" action="" method="post">
		<div id="faixa"> <legend>Consulta de vendas</legend></div>
		<div class="form">
		<label>Id:</label><input class="field" type="text" name="id"/></br></br>
		<div id="botoes">
		<input type="submit" name="enviar" value="Consultar"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Pagamento/index.php';">
		</div>
		</div>
	</form>

<div id="listaMarcas">

	<?php /*
		require_once('Venda/controle/ControleVenda.class.php');
		$ctrlItensVenda = new ControleVenda();
		$registrosItensVenda = $ctrlItensVenda->buscarDadosVendaItensLista($_POST['id']);*/
		
	?>
    
<?php 
$i=0;
if( isset($_POST['enviar']) )
{
	require_once('Venda/controle/ControleVenda.class.php');
	$ctrlVenda = new ControleVenda();
	$registrosVenda = $ctrlVenda->buscarDadosVendaItensLista($_POST['id']);
}	

if(isset($registrosVenda)) 
{ 
	
	$idVenda = $registrosVenda[0]['idVenda']; 
	$forma = NULL;
	
	if($registrosVenda[0]['formaPgto']=='Credito')
	{ 
		echo "aqui";
		$forma=1;
	}
	else
	{
		$forma=2;
	}
	?>
    

        
    <table border="1"  class="tabela" width="500px" bgcolor="#D3D3D3">
        <tr class="cabecalho">
            <th>IdVenda</th>
            <th>Nome do cliente</th>
            <th>CPF do cliente</th>
            <th> Data </th>
            <th>Forma de Pagamento</th>
        </tr>
    	<tr>
            <td><?php echo $registrosVenda[0]['idVenda']; ?> </td>
            <td><?php echo $registrosVenda[0]['nomeCliente']; ?> </td>
            <td><?php echo $registrosVenda[0]['cpfCliente']; ?> </td>
            <td><?php echo date('d/m/Y', strtotime($registrosVenda[0]['dataVenda'])); ?>
            <td><?php echo $registrosVenda[0]['formaPgto']; ?> </td>
        </tr>
	</table>
    
    <table border="1"  class="tabela" width="500px" bgcolor="#D3D3D3">
        <tr class="cabecalho">
            <th>IdProduto</th>
            <th>Nome</th>
            <th>Preco</th>
            <th>Quantidade</th>
            <th>Total</th>
        </tr>


	<?php
		if($registrosVenda)
		{ $totalGeral = 0;
		
			unset($_SESSION['tmp']); // inserir esta linha
			foreach( $registrosVenda as $item)
			{

				$totalGeral+=$item['preco']*$item['quantidade'];

				$_SESSION['tmp'][] = array("itemLista"=>$item['itemLista'], "idProduto"=>$item['idProduto'], "qtde"=>$item['quantidade']);
				//$_SESSION['produtoUpdate'][] = array("id"=>$item['idProduto'], "qtde"=>$item['quantidade']);
					?>			
				<tr>
				<td><?php echo $item['idProduto']; ?></td>
				<td><?php echo $item['nomeProduto']; ?></td>
				<td><?php echo $item['preco']; ?></td>
				<td><?php echo $item['quantidade']; ?></td>
				<td><?php echo number_format($item['preco'] * $item['quantidade'],2); ?></td>
				</tr>
			<?php 
			}
	}?>
    
	<tr>
            <td align="right" colspan="4"> Total </td>
            <td align="right"><?php echo number_format($totalGeral, 2, ',', '.') ?></td>
        </tr>
<?php	} 
	?>
	
</table>
</div>
		<form  class="form_cad_cliente1" method="post" action="?pag=Pagamento/controle/verificaAcao.php">
		<input type="hidden" name="controlador" value="ControlePagamento"/>
		<input type="hidden" name="acao" value="inserirPagamentoItensLista"/>
		<input type="hidden" name="idvenda" value="<?php echo @$idVenda; ?>"/>
		<input type="hidden" name="idlista" value="<?php echo @$registrosVenda[0]['idLista']; ?>"/>	<!-- aqui -->	
		
		<input type="hidden" name="forma" value="<?php echo @$forma; ?>"/>
		<div class="form">
		<label style="font-size:14px;">Num de parcelas:</label> 
		<select <?php if ($forma==2){ ?> disabled <?php } ?> name="parcelas">
			<option name="numParcelas" selected value="Selecione">Selecione o numero de parcelas</option>
			<option value="1">1 parcela</option>
			<option value="2">2 parcelas</option>
			<option value="3">3 parcelas</option>
			<option value="4">4 parcelas</option>
			<option value="5">5 parcelas</option>
			<option value="6">6 parcelas</option>
			<option value="7">7 parcelas</option>
			<option value="8">8 parcelas</option>
			<option value="9">9 parcelas</option>
			<option value="10">10 parcelas</option>
		</select><br/><br/><br/>
		<input class="field" id="aPagar" type="hidden" name="valorVenda" value="<?php echo str_replace(',', '', number_format(@$totalGeral)); ?>"/>
		<label style="font-size:14px;">Valor pago:</label><input class="field" id="vPago" autofocus onblur="calcula()" <?php if(@$forma==1){?> disabled  <?php } ?> type="text"  name="dinheiroRecebido"/><br/><br/>
		<label style="font-size:14px;">Troco:</label> <input id="troco" class="field" type="text" <?php if(@$forma==1){?>  disabled  <?php } ?> name="troco" /><br/><br/>
<input id="bP"type="submit" name="finalizarPagamento" value="Finalizar pagamento" />
</div> 
</form>


</div>
</body>
</html>