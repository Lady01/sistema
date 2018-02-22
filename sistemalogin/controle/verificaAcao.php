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
$existeControlador=file_exists($controlador.'.class.php');
if ($existeControlador)
{
	require_once('ControleUsuario.class.php');//
	
	$controleUsuario = new $controlador();

	switch ($acao)
	{
		case 'inserir':
			//verifica se o método existe
			if(method_exists($controleUsuario, 'inserir'))
			{
				try
				{
					//capturo os dados do formulário
					//$nivel=$_POST['nivelUsuario'];
					$idFuncionario = $_SESSION['funcionario']['id'];
					$cargo=$_SESSION['funcionario']['cargo'];
					if($cargo=='gerente')
					$nivel=1;
					if($cargo=='vendedor')
					$nivel=2;
					if($cargo=='operador de caixa')
					$nivel=3;
					$login = $_POST['nomeUsuario'];
					$senha= $_POST['senha'];
					$status = true;
					include_once('../modelo/Usuario.class.php');
					$usuario = new Usuario();
					$usuario->setIdFuncionario($idFuncionario);
					$usuario->setNivel($nivel);
					$usuario->setLogin($login);
					$usuario->setSenha($senha);
					$usuario->setStatus($status);
					$controleUsuario->inserir($usuario);
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
					if(method_exists($controleUsuario, 'editar'))
					{
						$id=$_POST['id'];
						$idFuncionario = $_POST['id'];
						$login = $_POST['nomeUsuario'];
						$senha = $_POST['senha'];
						echo $senha;
					
						include_once('../modelo/Usuario.class.php');
						$usuario = new Usuario();
						$usuario->setId($id);
						$usuario->setIdFuncionario($idFuncionario);
						$usuario->setLogin($login);
						$usuario->setSenha($senha);
						$controleUsuario->editar($usuario);

					}
					
		break;
		case 'excluir':
					if(method_exists($controleUsuario, 'excluir'))
					{
						if(method_exists($controleUsuario, 'buscarId'))
						{
							$id=$_GET['id'];
							$dadosUsuarios=$controleUsuario->buscar( $id);
							if($dadosUsuarios)
							{
								foreach( $dadosUsuarios as $dadoUsuario )
								{
									$id=$dadoUsuario->getId() ;
								}
								$controleUsuario->excluir($id);
							}
						}
					}
		break;
		case 'logar':
				if(method_exists($controleUsuario, 'logar'))
				{	
					//if(isset($_POST['loginUsuario']))
						$login=$_POST['loginUsuario'];
					//if(isset($_POST['senhaUsuario']))
						$senha=$_POST['senhaUsuario'];

						
					include_once('../modelo/Usuario.class.php');
					$usuario = new Usuario();
					$usuario->setLogin($login);
					$usuario->setSenha($senha);
					$controleUsuario->logar($usuario);
				}
		break;
		default:
		//nada requisitado
		break;
	}
}
?>