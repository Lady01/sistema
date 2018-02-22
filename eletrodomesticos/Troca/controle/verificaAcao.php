<?php
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];
if (isset($_REQUEST['acao'])) //
if($avazia=!empty($_REQUEST['acao']))
$acao= $_REQUEST['acao'];
//verificar se arquivo da classe existe
$existeControlador=file_exists('Troca/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('Troca/controle/'.$controlador.'.class.php');
	
	$instancia = new $controlador();


	switch ($acao)
	{
		case 'inserirTroca':
			//verifica se o método existe
			if(method_exists($instancia, 'inserir'))
			{
				try
				{
					//capturo os dados do formulário
					$idItemVenda = $_POST['idItemVenda'];
					$defeito= $_POST['defeito'];
					$data = $_POST['data'];
					$observacao = $_POST['observacao'];
					include_once('Troca/modelo/Troca.class.php');
					$troca = new Troca();
					$troca->setIdItemVenda($idItemVenda);
					$troca->setComDefeito($defeito);
					$troca->setData($data);
					$troca->setObservacao($observacao);
					$instancia->inserir($troca);
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