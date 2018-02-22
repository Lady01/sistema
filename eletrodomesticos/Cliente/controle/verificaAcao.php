<?php
print_r($_REQUEST);
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];
//capturo a ação através do formulário
if (isset($_REQUEST['acao'])) 
$acao= $_REQUEST['acao'];
//verificar se arquivo da classe existe
$existeControlador=file_exists('Cliente/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('Cliente/controle/ControleCliente.class.php');//
	
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
					$nome= $_POST['nome'];
					$cpf= $_POST['cpf'];
					$sexo = $_POST['sexo'];
					$endereco = $_POST['endereco'];
					$cidade = $_POST['cidade'];
					$estado = $_POST['estado'];
					$telefone = $_POST['tel'];
					$dataNasc = $_POST['data'];
					//date('Y-m-d', strtotime($_POST['dataNasc']));
					//$dataNasc = date('Y-m-d', strtotime(str_replace('/','-',$_POST['data'])));
					$status = true;
					include_once('Cliente/modelo/Cliente.class.php');
					$cliente = new Cliente();
					$cliente->setNome($nome);
					$cliente->setCpf($cpf);
					$cliente->setSexo($sexo);
					$cliente->setEndereco($endereco);
					$cliente->setCidade($cidade);
					$cliente->setEstado($estado);
					$cliente->setTelefone($telefone);
					$cliente->setDataNasc($dataNasc);
					$cliente->setStatus($status);
					$instancia->inserir($cliente);
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
						$cpf = $_POST['cpf'];
						$sexo = $_POST['sexo'];
						$endereco = $_POST['endereco'];
						$cidade = $_POST['cidade'];
						$estado = $_POST['estado'];
						$telefone = $_POST['telefone'];
						$dataNasc =$_POST['data'];
						//date('Y-m-d', strtotime(str_replace('/','-',$_POST['data'])));
						//$dataNasc = date('Y-m-d', strtotime($_POST['dataNasc']));
						$status=true;
						include_once('Cliente/modelo/Cliente.class.php');
						$cliente = new Cliente();
						$cliente->setId($id);
						$cliente->setNome($nome);
						$cliente->setCpf($cpf);
						$cliente->setSexo($sexo);
						$cliente->setEndereco($endereco);
						$cliente->setCidade($cidade);
						$cliente->setEstado($estado);
						$cliente->setTelefone($telefone);
						$cliente->setDataNasc($dataNasc);
						$cliente->setStatus($status);
						$instancia->editar($cliente);

					}
					
		break;
		case 'excluir':
					if(method_exists($instancia, 'excluir'))
					{
						if(method_exists($instancia, 'buscarId'))
						{
							$id = $_GET['id'];
							$dadosClientes=$instancia->buscarId( $id);
							if($dadosClientes)
							{
								foreach( $dadosClientes as $dadoCliente )
								{
									$id=$dadoCliente->getId() ;
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