<?php
session_start();
if( !isset($_SESSION['usuario']) )
{ 
	echo "Sessao inexistente";
	echo '<script> location.href="../visao/form_login.php";</script>'; 
}
else if ( $_SESSION['usuario']['nivel'] != 1)
{
echo "Voce nao tem permissao para acessar este conteudo";
	echo '<script> location.href="../visao/form_login.php";</script>';
}
else
{
$mensagem="Oi,".$_SESSION['usuario']['login'];
echo $mensagem;
}
?>
<h4>Teste nivel 1</h4>
<h4>Teste nivel 1</h4>
<br/><br/><br/>
<a href="deslogar.php">Deslogar</a>