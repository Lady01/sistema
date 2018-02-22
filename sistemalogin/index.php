<?php session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> Index </title>
</head>

<body>
<style type="text/css">
*{ margin:0; padding:0; }
html{ background: #0CF; }
h1 { color:black; }
.menu { width: 800px; margin: 0 auto; }
.menu td { text-align:center;  width:50%; }
.menu td:hover, .menu td#ativo { background: #BBB; }
.menu td a { display:block; text-decoration: none; color:#333; font-size:20px; }
.content { width:900px; margin:0 auto; padding:15px; background:white; }
.footer { background: #CCC; padding: 10px; }
</style>

<div class="content">
	
    <h1> Sistema de Controle de Vendas de Eletrodomésticos </h1>

    <table class="menu" cellspacing="5" bgcolor="#0099FF">
	<tr>
	<?php 
if( !isset($_SESSION['usuario']) )
{ 
	echo "Sessao inexistente";
	echo '<script> location.href="../visao/form_login.php";</script>'; 
}
if ( $_SESSION['usuario']['nivel'] == 1)
{
?>
<td>
                <a href="controle/nivel1.php" title="Pagamento">
                    [pagamento]
                </a> 
            </td>

 <?php } 
 
 else if ($_SESSION['usuario']['nivel'] == 2){
 ?>
        
            
            <td>
                <a href="?pag=Venda/index.php" title="Venda">
                    [venda]
                </a> 
            </td>
			<td>
                <a href="?pag=Compra/index.php" title="Compra">
                    [compra]
                </a> 
            </td>
			<td>
                <a href="?pag=ListadeCasamento/index.php" title="ListadeCasamento">
                    [lista de casamento]
                </a> 
            </td>
			<td>
                <a href="?pag=Troca/index.php" title="Troca">
                    [troca]
                </a> 
            </td>
			<td>
                <a href="?pag=Marca/index.php" title="Marca">
                    [marca]
                </a> 
            </td>
			</tr>
			<tr>
			<td>
                <a href="?pag=Produto/index.php" title="Produto">
                    [produto]
                </a> 
            </td>
			<td>
                <a href="?pag=Funcionario/visao/listar.php" title="Funcionario">
                    [funcionario]
                </a> 
            </td>
			<td>
                <a href="?pag=Cliente/index.php" title="Cliente">
                    [cliente]
                </a> 
            </td>
			<td>
                <a href="?pag=FormadePagamento/index.php" title="FormadePagamento">
                    [forma de pagamento]
                </a> 
            </td>
			<td>
                <a href="?pag=Fornecedor/index.php" title="Fornecedor">
                    [fornecedor]
                </a> 
            </td>
			<td>
                <a href="?pag=Relatorios/index.php" title="Relatorios">
                    [relatorios]
                </a> 
            </td>
			<?php } ?>
        </tr>
    </table>
    <br/>


	<?php
    
		if( isset($_GET['pag']) )
		{
			require($_GET['pag']);	
		}
    
    ?>
    
    <br/>
    <div class="footer">
    	Rodapé
    </div>

</div>

</body>
</html>