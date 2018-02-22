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
html{ background-color:#236B8E; }
h1 { color:black; }
.menu { width: 800px; margin: 0 auto; }
.menu{margin-top:50px;}
.menu td { text-align:center;  width:50%; }
.menu td:hover, .menu td#ativo { background:white ; }
.menu td a { display:block; text-decoration: none; color:#333; font-size:20px; }
.content { width:900px; margin:0 auto; padding:15px;  }
.footer { background: #CCC; padding: 10px; }
h1
{
text-align:center;
color:white;
}
.principal
{
height:600px;
}
.logo
{
height:60px;
background-color: #333333;
line-height:60px;
width:100%;
}
.footer {
 
position:fixed; bottom:0; width:100%; background-color: #333333; color:white;}

</style>

<div class="content">
<div class="logo">	
    <h1> Sistema de Controle de Vendas de Eletrodomésticos </h1>
</div>
<a href="deslogar.php">Sair</a>
    <table class="menu" cellspacing="5" >

	
	
	
		<?php 
if( !isset($_SESSION['usuario']) )
{ 
	echo "Sessao inexistente";
	echo '<script> location.href="../sistemalogin/visao/form_login.php";</script>'; 
}
if ( $_SESSION['usuario']['nivel'] == 1)
{
echo "Bem vindo, ". $_SESSION['usuario']['login'];
echo $_SESSION['usuario']['idFuncionario'];
?>

	
	
	
	
	
		<tr>
			<td>
                <a href="../eletrodomesticos/index.php" title="home">
                    [home]
                </a> 
            </td>
            <td>
                <a href="?pag=Pagamento/index.php" title="Pagamento">
                    [pagamento]
                </a> 
            </td>
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
                <a href="?pag=Funcionario/index.php" title="Funcionario">
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
        </tr>
		
		
		
		<?php } ?>
		
		<?php if ( $_SESSION['usuario']['nivel'] <> 3){ 
		echo "Bem vindo, ". $_SESSION['usuario']['login'];  ?>
		<td>
                <a href="?pag=Venda/index.php" title="Venda">
                    [venda]
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
                <a href="?pag=Cliente/index.php" title="Cliente">
                    [cliente]
                </a> 
            </td>

		<?php } ?>
		
		<?php if ( $_SESSION['usuario']['nivel'] <> 2){ 
		echo "Bem vindo, ". $_SESSION['usuario']['login'];
		?>
		
		
		<td>
                <a href="?pag=Pagamento/index.php" title="Pagamento">
                    [pagamento]
                </a> 
            </td>
		
		<?php } ?>
		
    </table>
    <br/>
<div class="principal">

	<?php
    
		if( isset($_GET['pag']) )
		{
			require($_GET['pag']);	
		}
    
    ?>
    </div>
    <br/>
    <!--<div class="footer">
    Desenvolvido por: Leidiane Borges e Renata Melo
    </div>-->

</div>

</body>
</html>