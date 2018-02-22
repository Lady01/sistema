<?php
session_start();
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))//
if(!empty($_REQUEST['controlador']))
@$controlador = $_REQUEST['controlador'];//
//capturo a ação através do formulário
if (isset($_REQUEST['acao'])) //
if($avazia=!empty($_REQUEST['acao']))
$acao= $_REQUEST['acao'];//
//verificar se arquivo da classe existe
$existeControlador=file_exists('Pagamento/controle/'.$controlador.'.class.php');
if ($existeControlador)
{

	require_once('Pagamento/controle/'.$controlador.'.class.php');//
	
	$controlePagamento = new $controlador();

	switch ($acao)
	{
		case 'inserirPagamento':

			//verifica se o método existe
			if(method_exists($controlePagamento, 'inserir'))
			{
				try
				{

					//capturo os dados do formulário
					$forma=$_POST['forma'];
					if($forma==2)
					{
					$idVenda=$_POST['idvenda'];
					$dinheiroRecebido=$_POST['dinheiroRecebido'];
					$troco=$_POST['troco'];
					$numParcelas = 0;
					$valorVenda = $_POST['valorVenda'];
					}
					else
					{
					$idVenda=$_POST['idvenda'];
					$dinheiroRecebido=0;
					$troco=0;
					$numParcelas = $_POST['parcelas'];
					$valorVenda = $_POST['valorVenda'];
					}
					include_once('Pagamento/modelo/Pagamento.class.php');
					$pagamento = new Pagamento();
					$pagamento->setIdVenda($idVenda);
					$pagamento->setDinheiroRecebido($dinheiroRecebido);
					$pagamento->setTroco($troco);
					$pagamento->setNumParcelas($numParcelas);
					$pagamento->setValorVenda($valorVenda);
					var_dump($pagamento);
					$controlePagamento->inserir($pagamento);
				}
				catch( Exception $e)
				{
					echo "Erro ao enviar objeto para o controle";
				}
				
			}
		break;
		case 'inserirPagamentoItensLista':
			//verifica se o método existe
			if(method_exists($controlePagamento, 'inserirPagamentoItensLista'))
			{
				try
				{

					//capturo os dados do formulário
					$forma=$_POST['forma'];
					if($forma==2)
					{
					
					$idVenda=$_POST['idvenda'];
					$dinheiroRecebido=$_POST['dinheiroRecebido'];
					$troco=$_POST['troco'];
					$numParcelas = 0;
					$valorVenda = $_POST['valorVenda'];
					}
					else
					{
					
					$idVenda=$_POST['idvenda'];
					$dinheiroRecebido=0;
					$troco=0;
					$numParcelas = $_POST['parcelas'];
					$valorVenda = $_POST['valorVenda'];
					}
					$idLista=$_POST['idlista'];
					$_SESSION['idLista']=$idLista;
					include_once('Pagamento/modelo/Pagamento.class.php');
					$pagamento = new Pagamento();
					$pagamento->setIdVenda($idVenda);
					$pagamento->setDinheiroRecebido($dinheiroRecebido);
					$pagamento->setTroco($troco);
					$pagamento->setNumParcelas($numParcelas);
					$pagamento->setValorVenda($valorVenda);
					$controlePagamento->inserirPagamentoItensLista($pagamento);
				}
				catch( Exception $e)
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