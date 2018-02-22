<?php
//Pego o nome da classe requisitada no formulário
if (isset($_REQUEST['controlador']))//
if(!empty($_REQUEST['controlador']))
$controlador = $_REQUEST['controlador'];//
//capturo a ação através do formulário
if (isset($_REQUEST['acao'])) 
$acao= $_REQUEST['acao'];
//verificar se arquivo da classe existe
$existeControlador=file_exists('Funcionario/controle/'.$controlador.'.class.php');
if ($existeControlador)
{
	require_once('Funcionario/controle/'.$controlador.'.class.php');//
	
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
					//if(isset($_POST['nome']) and (!empty($_POST['nome'])))
					
					$nome = $_POST['nome'];
					$cpf= $_POST['cpf'];
					$sexo = $_POST['sexo'];
					$endereco =$_POST['endereco'];
					$cidade =$_POST['cidade'];
					$estado = $_POST['estado'];
					$telefone = $_POST['telefone'];
					$matricula = $_POST['matricula'];
					//$dataNasc = date('Y-m-d', strtotime(str_replace('/','-',$_POST['dataNasc'])));
					$dataNasc = $_POST['dataNasc'];
					$status = true;
					$cargo = $_POST['cargo'];
					include_once('Funcionario/modelo/Funcionario.class.php');
					$funcionario = new Funcionario();
					$funcionario->setNome($nome);
					$funcionario->setCpf($cpf);
					$funcionario->setSexo($sexo);
					$funcionario->setEndereco($endereco);
					$funcionario->setCidade($cidade);
					$funcionario->setEstado($estado);
					$funcionario->setTelefone($telefone);
					$funcionario->setMatricula($matricula);
					$funcionario->setDataNasc($dataNasc);
					$funcionario->setStatus($status);
					$funcionario->setCargo($cargo);
					$instancia->inserir($funcionario);
				}
				catch( Exception $e)
				{
					echo "Erro ao enviar objeto para o controle!";
				}
				
			}
		break;
		case 'buscar':
		break;
		case 'editar':
					if(method_exists($instancia, 'editar'))
					{ 
						//capturo os dados do formulário
						$id= $_POST['id'];
						$nome = $_POST['nome'];
						$cpf= $_POST['cpf'];
						$sexo = $_POST['sexo'];
						$endereco = $_POST['endereco'];
						$cidade = $_POST['cidade'];
						$estado = $_POST['estado'];
						$telefone = $_POST['telefone'];
						$matricula = $_POST['matricula'];
						$dataNasc = $_POST['data'];
						$cargo = $_POST['cargo'];

						include_once('Funcionario/modelo/Funcionario.class.php');
						$funcionario = new Funcionario();
						$funcionario->setId($id);
						$funcionario->setNome($nome);
						$funcionario->setCpf($cpf);
						$funcionario->setSexo($sexo);
						$funcionario->setEndereco($endereco);
						$funcionario->setCidade($cidade);
						$funcionario->setEstado($estado);
						$funcionario->setTelefone($telefone);
						$funcionario->setMatricula($matricula);
						$funcionario->setDataNasc($dataNasc);
						$funcionario->setCargo($cargo);
						$instancia->editar($funcionario);

					}
					
		break;
		case 'excluir':
					if(method_exists($instancia, 'excluir'))
					{
						if(method_exists($instancia, 'buscarId'))
						{	
							$id = $_GET['id'];
							$dadosFuncionarios=$instancia->buscarId( $id);
							if($dadosFuncionarios)
							{
								foreach( $dadosFuncionarios as $dadoFuncionario )
								{
									$id=$dadoFuncionario->getId() ;
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