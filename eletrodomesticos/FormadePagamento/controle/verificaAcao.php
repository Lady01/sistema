<?php
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];
//capturo a ação através do formulário
if (isset($_REQUEST['acao']))
if($avazia=!empty($_REQUEST['acao']))
$acao= $_REQUEST['acao'];
//verificar se arquivo da classe existe
$existeControlador=file_exists('FormadePagamento/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('FormadePagamento/controle/ControleFormadePagamento.class.php');//
	
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
					$descricao= $_POST['descricao'];
					$status = true;
					include_once('FormadePagamento/modelo/FormadePagamento.class.php');
					$formadePagamento = new FormadePagamento();
					$formadePagamento->setNome($nome);
					$formadePagamento->setDescricao($descricao);
					$formadePagamento->setStatus($status);
					$instancia->inserir($formadePagamento);
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
					if(method_exists($instancia, 'editar'))
					{
						$id = $_POST['id'];
						$nome = $_POST['nome'];
						$descricao = $_POST['descricao'];
					
						include_once('FormadePagamento/modelo/FormadePagamento.class.php');
						$formadePagamento = new FormadePagamento();
						$formadePagamento->setId($id);
						$formadePagamento->setNome($nome);
						$formadePagamento->setDescricao($descricao);
						$instancia->editar($formadePagamento);

					}
					
		break;
		case 'excluir':
					if(method_exists($instancia, 'excluir'))
					{
						if(method_exists($instancia, 'buscarId'))
						{
							$id=$_GET['id'];
							$dadosFormasdePagamento=$instancia->buscarId( $id);
							if($dadosFormasdePagamento)
							{
								foreach( $dadosFormasdePagamento as $dadoFormasdePag )
								{
									$id=$dadoFormasdePag->getId() ;
								}
								$instancia->excluir($id);
							}
						}
					}
		break;
		default:
		//nada requisitado
		break;
	}
}
?>