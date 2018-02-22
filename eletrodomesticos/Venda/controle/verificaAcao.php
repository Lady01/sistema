<?php
session_start();
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))//
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];//
//var_dump($controlador);
//capturo a ação através do formulário
if (isset($_REQUEST['acao'])) //
if($avazia=!empty($_REQUEST['acao']))
//var_dump($avazia);
$acao= $_REQUEST['acao'];//
//var_dump($acao);
//verificar se arquivo da classe existe
$existeControlador=file_exists('Venda/controle/'.$controlador.'.class.php');
if ($existeControlador)
{

	require_once('Venda/controle/'.$controlador.'.class.php');//
	
	$controleVenda = new $controlador();

	switch ($acao)
	{
		case 'inserirVenda':

			//verifica se o método existe
			if(method_exists($controleVenda, 'inserir'))
			{
				try
				{

					//capturo os dados do formulário
					$idCliente = $_SESSION['cliente']['id'];
					$idFuncionario=$_SESSION['usuario']['idFuncionario'];
					$idFormadePag=$_POST['forma'];
					$data = $_POST['data'];
					$observacao = $_POST['observacao'];
					include_once('Venda/modelo/Venda.class.php');
					$venda = new Venda();
					$venda->setIdCliente($idCliente);
					
					$venda->setIdFuncionario($idFuncionario);
					$venda->setIdFormadePag($idFormadePag);
					$venda->setData($data);
					$venda->setObservacao($observacao);
					$controleVenda->inserir($venda);
				}
				catch( Exception $e)
				{
					echo "Erro ao enviar objeto para o controle";
				}
				
			}
		break;
		case 'buscar':
		break;
		case 'editar':
		break;
		case 'excluir':
					/*if(method_exists($controleCompra, 'excluir'))
					{
						if(method_exists($controleCompra, 'buscarId'))
						{
							$dadosMarcas=$controleCompra->buscar( $id);
							if($dadosMarcas)
							{
								foreach( $dadosMarcas as $dadoMarca )
								{
									$id=$dadoMarca->getId() ;
								}
								$controleCompra->excluir($id);
							}
						}
					}*/
		break;
		default:
		//nada requisitado
		break;
	}
}
?>