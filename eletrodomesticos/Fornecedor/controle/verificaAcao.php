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
$existeControlador=file_exists('Fornecedor/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('Fornecedor/controle/ControleFornecedor.class.php');//
	
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
					$cnpj = $_POST['cnpj'];
					$telefone = $_POST['telefone'];
					$endereco = $_POST['endereco'];
					$cidade = $_POST['cidade'];
					$estado = $_POST['estado'];
					$descricao= $_POST['descricao'];
					$status = true;
					include_once('Fornecedor/modelo/Fornecedor.class.php');
					$fornecedor = new Fornecedor();
					$fornecedor->setNome($nome);
					$fornecedor->setCnpj($cnpj);
					$fornecedor->setTelefone($telefone);
					$fornecedor->setEndereco($endereco);
					$fornecedor->setCidade($cidade);
					$fornecedor->setEstado($estado);
					$fornecedor->setDescricao($descricao);
					$fornecedor->setStatus($status);
					$instancia->inserir($fornecedor);
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
						$cnpj= $_POST['cnpj'];
						$telefone= $_POST['telefone'];
						$endereco= $_POST['endereco'];
						$cidade= $_POST['cidade'];
						$estado= $_POST['estado'];
						$descricao = $_POST['descricao'];
						$status=true;
						include_once('Fornecedor/modelo/Fornecedor.class.php');
						$fornecedor = new Fornecedor();
						$fornecedor->setId($id);
						$fornecedor->setNome($nome);
						$fornecedor->setCnpj($cnpj);
						$fornecedor->setTelefone($telefone);
						$fornecedor->setEndereco($endereco);
						$fornecedor->setCidade($cidade);
						$fornecedor->setEstado($estado);
						$fornecedor->setDescricao($descricao);
						$instancia->editar($fornecedor);

					}
					
		break;
		case 'excluir':
					if(method_exists($instancia, 'excluir'))
					{
						$id=$_GET['id'];
						if(method_exists($instancia, 'buscarId'))
						{
							$dadosFornecedores=$instancia->buscarId($id);
							if($dadosFornecedores)
							{
								foreach( $dadosFornecedores as $dadoForn )
								{
									$id=$dadoForn->getId() ;
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