<?php
session_start();
if(!isset($_SESSION['usuario']))
{ 
	echo "Sessao inexistente";
	echo '<script> location.href="../visao/form_login.php";</script>'; 
}
else if ( $_SESSION['usuario']['nivel'] != 3)
{
echo "Voce nao tem permissao para acessar este conteudo";
	echo '<script> location.href="../visao/form_login.php";</script>';
}
else
{
$mensagem="Oi, '$_SESSION['usuario']['login']'";
echo $mensagem;
}
?>
<h4>Teste nivel 3</h4>