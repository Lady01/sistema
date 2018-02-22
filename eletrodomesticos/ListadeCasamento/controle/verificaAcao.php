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
$existeControlador=file_exists('ListadeCasamento/controle/'.$controlador.'.class.php');
if ($existeControlador)
{

	require_once('ListadeCasamento/controle/'.$controlador.'.class.php');//
	
	$controleListadeCasamento = new $controlador();

	switch ($acao)
	{
		case 'inserirListadeCasamento':

			//verifica se o método existe
			if(method_exists($controleListadeCasamento, 'inserir'))
			{
				try
				{

					//capturo os dados do formulário
					//$idCliente =1; 
					$idCliente=@$_SESSION['cliente']['id'];
					$conjuge= $_POST['nomeConjuge'];
					$endereco = $_POST['endereco'];
					$local = $_POST['local'];
					$cidade = $_POST['cidade'];
					$estado = $_POST['estado'];
					$data = $_POST['data'];
					$status = "em aberto";
					include_once('ListadeCasamento/modelo/ListadeCasamento.class.php');
					$listadeCasamento = new ListadeCasamento();
					$listadeCasamento->setIdCliente($idCliente);
					$listadeCasamento->setConjuge($conjuge);
					$listadeCasamento->setEndereco($endereco);
					$listadeCasamento->setLocal($local);
					$listadeCasamento->setCidade($cidade);
					$listadeCasamento->setEstado($estado);
					$listadeCasamento->setData($data);
					$listadeCasamento->setStatus($status);
					
					$controleListadeCasamento->inserir($listadeCasamento);
				}
				catch( Exception $e)
				{
					echo "Erro ao enviar objeto para o controle";
				}
				
			}
		break;
		case 'inserirVendaItensLista':
		
			if(method_exists($controleListadeCasamento, 'inserirVendaItensLista'))
			{
				try
				{
					$idListadeCasamento=$_SESSION['idLista'];
					$idCliente = $_SESSION['cliente']['id'];
					$idFuncionario=1;
					$idFormadePag=$_POST['forma'];
					$data = $_POST['data'];
					//date('Y-m-d', strtotime(str_replace('/', '-', $_POST['data'])));
					$observacao = $_POST['observacao'];
					include_once('Venda/modelo/Venda.class.php');
					$venda = new Venda();
					$venda->setIdListadeCasamento($idListadeCasamento);
					$venda->setIdCliente($idCliente);
					$venda->setIdFuncionario($idFuncionario);
					$venda->setIdFormadePag($idFormadePag);
					$venda->setData($data);
					$venda->setObservacao($observacao);
					$controleListadeCasamento->inserirVendaItensLista($venda);

				}
				catch(Exception $e)
				{
					echo "Erro ao enviar objeto para o controle";
				}
			}
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