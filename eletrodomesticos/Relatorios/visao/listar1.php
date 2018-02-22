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
	<script type="text/javascript" src="Cliente/visao/jquery.js"></script>
	<script type="text/javascript" src="Cliente/visao/jquery.maskedinput.js"></script>
	
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
		<label>Data:</label><input type="text"  id="data" class="data" name="data" /></br>
		<div id="botoes">
			<input type="submit" name="enviar" value="Consultar"/>
			<input type="button" value="Voltar" OnClick="location.href='?pag=Relatorios/index.php';">
		</div>
		</div>
	</form>

<div id="listaMarcas">
<?php 
if( isset($_POST['enviar']) )
{
	$data=$_POST['data'];
	require_once('Relatorios/controle/ControleRelatorio.class.php');
	$ctrlRelatorio = new ControleRelatorio();
	$registrosRelatorio=$ctrlRelatorio->listarAparelhosMaisVendidos($data);
	
	?>
	<?php
	
$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTitle("Relatorio 1");
$pdf->MultiCell(0,5,"Relacao semestral dos aparelhos mais vendidos",0,'C');
$pdf->Header();
$pdf->ln(4);

$pdf->Cell(40,5,'Id');
$pdf->SetX(35);
$pdf->Cell(200,5,'Aparelho');
$pdf->SetX(100);
$pdf->Cell(250,5,'Descricao');
$pdf->SetX(150);
$pdf->Cell(50,5,'Qtde vendida');
$pdf->SetX(45);
	
	if( $registrosRelatorio )
	{
		
		
			foreach( $registrosRelatorio as $reg )
			{
				
				$pdf->ln();
				$pdf->Cell(40,5,$reg['id']);
				$pdf->SetX(35);
				$pdf->Cell(200,5,$reg['nome'] );
				$pdf->SetX(100);
				$pdf->Cell(250,5,$reg['descricao']);
				$pdf->SetX(150);
				$pdf->Cell(50,5,$reg['quantidade']);
				$pdf->SetX(45);
 
					
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