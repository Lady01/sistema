<?php
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))//
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];//
var_dump($controlador);
//capturo a ação através do formulário
if (isset($_REQUEST['acao'])) //
if($avazia=!empty($_REQUEST['acao']))
var_dump($avazia);
$acao= $_REQUEST['acao'];//
var_dump($acao);
//verificar se arquivo da classe existe
$existeControlador=file_exists($controlador.'.php');
$arquivoModelo='cliente.class.php';
$existeModelo=file_exists($arquivoModelo);
var_dump($existeModelo); echo "existe model";
var_dump($existeControlador);
if ($existeControlador)
{
	require_once('controllercliente.php');//
	
	$instancia = new $controlador();

	switch ($acao)
	{
		case 'inserir':
			//verifica se o método existe
			if(method_exists($instancia, 'inserir'))
			{
				try
				{
					//capturo os dados do formulário
					$nome = $_POST['nome'];
					$idade= $_POST['idade'];
					$status = true;
					//jogo-os num array
					$parametros = array ($nome, $idade, $status);
					var_dump($parametros);
					//chamo a classe, o método e mando os parâmetros
					//eval($instancia.'->'.$acao.'('.$parametros.')');
					$chamou=call_user_func_array(array($controlador, $acao),$parametros);
					var_dump($chamou);
				}
				catch( Exception $e)
				{
					echo "erro";
				}
				
			}
		break;
		case 'buscar':
		break;
		case 'editar':
		break;
		case 'excluir':
		break;
		default:
		//nada requisitado
		break;
	}
}
?>