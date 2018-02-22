<html>
<head>
<title>Relatorios</title>
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
		#form_cad_cliente
		{
			width:500px;
			height:180px;
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
		#form
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
		h2
		{
		text-align:center;
		}

</style>
	<script type="text/javascript" src="Relatorios/visao/jquery.js"></script>
	<script type="text/javascript" src="Relatorios/visao/jquery.maskedinput.js"></script>
	
<script type="text/javascript">
$(document).ready(function(){
	
        
		$("input.data").mask("99/99/9999");
});
</script>	

</head>
<body>
<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php'); 
?>
<div id="geral">
	<form id="form_cad_cliente" action="" method="post">
		<div id="faixa"> <legend>Consulta de relatorio</legend></div>
		<div id="form">
		<input type="hidden" name="controlador" value="ControleRelatorio"/>
		<input type="hidden" name="acao" value="buscar"/>
		<label>Data:</label><input type="text"  name="data" id="data" class="data" /></br>
		<div id="botoes">
		<input type="submit" name="enviar" value="Consultar"/>
		<input type="button" value="Voltar" OnClick="location.href='?pag=Relatorios/index.php';">
		</div>
		</div>
	</form>

<div id="listaMarcas">
<?php 
if( isset($_POST['enviar']) )
{	$data=$_POST['data'];
	require_once('Relatorios/controle/ControleRelatorio.class.php');
	$ctrlRelatorio = new ControleRelatorio();
	$registrosRelatorio=$ctrlRelatorio->listarClientes($data);
	
	?>
	<?php
	
$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTitle("Relatorio 1");
$pdf->MultiCell(0,5,"Relacao semestral dos clientes que mais compram",0,'C');
$pdf->Header();
$pdf->ln(4);
$pdf->Cell(80,5,'Qtde de compras');
$pdf->SetX(70);
$pdf->Cell(150,5,'Nome');
$pdf->SetX(140);
$pdf->Cell(40,5,'Cpf');
$pdf->SetX(77);
	
	if( $registrosRelatorio )
	{
		
		
			foreach( $registrosRelatorio as $reg )
			{
				
				$pdf->ln();
				$pdf->Cell(80,5,$reg['vendas']);
				$pdf->SetX(70);
				$pdf->Cell(150,5,$reg['nome']);
				$pdf->SetX(140);
				$pdf->Cell(40,5,$reg['cpf']);
				$pdf->SetX(77);
 
					
			}
			ob_clean();
		$pdf->Output();
	}
}
?>
</div>
</div>
</body>
</html>