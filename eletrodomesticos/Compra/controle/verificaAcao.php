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
$existeControlador=file_exists('Compra/controle/'.$controlador.'.class.php');
if ($existeControlador)
{

	require_once('Compra/controle/'.$controlador.'.class.php');//
	
	$controleCompra = new $controlador();

	switch ($acao)
	{
		case 'inserirCompra':

			//verifica se o método existe
			if(method_exists($controleCompra, 'inserir'))
			{
				try
				{

					//capturo os dados do formulário
					$idFornecedor = $_SESSION['fornecedor']['id'];
					$data = $_POST['data'];
					//date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data'])));
					$observacao = $_POST['observacao'];
					include_once('Compra/modelo/Compra.class.php');
					$compra = new Compra();
					$compra->setIdFornecedor($idFornecedor);
					$compra->setData($data);
					$compra->setObservacao($observacao);
					$controleCompra->inserir($compra);
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