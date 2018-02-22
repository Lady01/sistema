<?php
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))//
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];
//capturo a ação através do formulário
if (isset($_REQUEST['acao'])) //
if($avazia=!empty($_REQUEST['acao']))
$acao= $_REQUEST['acao'];//
//verificar se arquivo da classe existe
$existeControlador=file_exists('Produto/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('Produto/controle/ControleProduto.class.php');//
	
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
					$idMarca = $_POST['idMarca'];
					$nome = $_POST['nome'];
					$descricao= $_POST['descricao'];
					$preco = $_POST['preco'];
					$status = true;
					include_once('Produto/modelo/Produto.class.php');
					$produto = new Produto();
					$produto->setIdMarca($idMarca);
					$produto->setNome($nome);
					$produto->setDescricao($descricao);
					$produto->setPreco($preco);
					$produto->setStatus($status);
					$instancia->inserir($produto);
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
						$id= $_POST['id'];
		
						$nome = $_POST['nome'];
						//$descricao =
							if(isset($_POST['descricao']))
						$descricao =$_POST['descricao'];
						$preco = $_POST['preco'];
						
						include_once('Produto/modelo/Produto.class.php');
						$produto = new Produto();
						$produto->setId($id);
						$produto->setNome($nome);
						$produto->setDescricao($descricao);
						$produto->setPreco($preco);
						$instancia->editar($produto);

					}
					
		break;
		case 'excluir':
					if(method_exists($instancia, 'excluir'))
					{
						if(method_exists($instancia, 'buscarId'))
						{
							$id = $_GET['id'];
							$dadosProdutos=$instancia->buscarId($id);
							if($dadosProdutos)
							{ 
								foreach( $dadosProdutos as $dadoProduto )
								{
									$id=$dadoProduto->getId();
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