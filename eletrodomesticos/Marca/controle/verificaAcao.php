<?php
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
$existeControlador=file_exists('Marca/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('Marca/controle/'.$controlador.'.class.php');//
	
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
					include_once('Marca/modelo/Marca.class.php');
					$marca = new Marca();
					$marca->setNome($nome);
					$marca->setDescricao($descricao);
					$marca->setStatus($status);
					//var_dump($marca);
					$instancia->inserir($marca);
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
						//if(isset($_POST['id']))
						//if(isset($_POST['nome']))
						$id = $_POST['id'];
						$nome = $_POST['nome'];
						$descricao = $_POST['descricao'];
					
						include_once('Marca/modelo/Marca.class.php');
						$marca = new Marca();
						$marca->setId($id);
						$marca->setNome($nome);
						$marca->setDescricao($descricao);
						$instancia->editar($marca);

					}
					
		break;
		case 'excluir':
					if(method_exists($instancia, 'excluir'))
					{
						if(method_exists($instancia, 'buscarId'))
						{
							$id = $_GET['id'];
							$dadosMarcas=$instancia->buscarId( $id);
							if($dadosMarcas)
							{
								foreach( $dadosMarcas as $dadoMarca )
								{
									$id=$dadoMarca->getId() ;
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