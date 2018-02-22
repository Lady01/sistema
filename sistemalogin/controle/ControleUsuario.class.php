<?php
session_start();
include_once "../modelo/Usuario.class.php";
include_once "../dao/DaoUsuario.class.php";
class ControleUsuario
{

	public function inserir(Usuario $usuario )
	{ 	
		$nivel=$usuario->getNivel();
		$login=$usuario->getLogin();
		$senha=$usuario->getSenha();
		if($nivel=="" || $login=="" || $senha=="")
		echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							location.href="../visao/inserir.php";
						</script>';
		else{
		//Crio um objeto de DaoUsuario chamado daoUsuario
		$daoUsuario = new DaoUsuario();
		//Mando o daoUsuario inserir o objeto recebido usuario
		$inseriu = $daoUsuario->inserir($usuario);
		//se não teve sucesso na inserção, uma mensagem de erro é disparada
		if (!$inseriu)
			echo '
						<script> 
							alert( "Erro na insercao!" );
							location.href="../visao/inserir.php";
						</script>';
		//Se correu tudo bem, não executa o if e dispara uma mensagem de sucesso
			echo '
						<script> 
							alert( "Usuario inserido com sucesso!" );
							location.href="../visao/inserir.php";
						</script>';
		return $inseriu; 	
	}
	}
	public function buscar($nome)
	{
		if($nome=="")
		{ 
			echo '
						<script> 
							alert( "Campo vazio!" );
							location.href="../visao/listar.php";
						</script>';
		}
		else
		{
			//crio um objeto chamado daoUsuaio de DaoUsuario
			$daoUsuario = new DaoUsuario();
			//mando daoUuario pesquisar pelo nome recebido no parametro, se não teve registro encontrado, diparo mensagem de erro
			$usuarios = $daoUsuario->buscar($nome);
			if( !$usuarios )
			{
				echo '
								<script> 
									alert( "Usuario não encontrado!" );
									location.href="../visao/listar.php";
								</script>';

			}
			//se teve, carrego a variavel marcas com a lista de registros
			return $usuarios;
		}
	}
	//mesma coisa do método acima, mas o parametro é id e não nome
	public function buscarId($id)
	{
		$daoUsuario = new DaoUsuario();	
		$usuarios = $daoUsuario->buscarId($id);
		
	if( !$usuarios )
	{
        echo " Usuario não encontrado! ";
    }
		
	return $usuarios;
		
	}

	public function excluir($id)
	{
		//recebe o id do registro a ser excluido, cria o objeto de dao usuario que manda excluir de acordo com o id
		$daoUsuario = new DaoUsuario();
		$excluiu=$daoUsuario->excluir($id);
		if(!$excluiu)
		{
			echo '
						<script> 
							alert( "Erro na exclusao!" );
							location.href="../visao/listar.php";
						</script>';

		}
		
		 echo '
						<script> 
							alert( "Usuario excluido com sucesso!" );
							location.href="../visao/listar.php";
						</script>';

	}

	public function editar(Usuario $usuario)
	{
		$login=$usuario->getLogin();
		$senha=$usuario->getSenha();
		if($login=="" || $senha=="")
		{
			echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							location.href="../visao/inserir.php";
						</script>';
		}
		else
		{
			$daoUsuario = new DaoUsuario();
			$editou=$daoUsuario->editar($usuario);
			if(!$editou)
			{
				echo '
							<script> 
								alert( "Erro na edicao!" );
								location.href="../visao/listar.php";
							</script>';

			}
			echo '
							<script> 
								alert( "Usuario editado com sucesso!" );
								location.href="../visao/listar.php";
							</script>';
		}
	}
	public function logar(Usuario $usuario)
	{
		$daoUsuario = new DaoUsuario();
		$usuario = $daoUsuario->logar($usuario);
		if(!$usuario)
		{
			echo '<script>
					alert("Dados invalidos");
					location.href="../visao/form_login.php";
					</script>';
		} 
		else
		{
			$_SESSION['usuario'] = array(
				'id'=>$usuario->getId(),
				'login'=>$usuario->getLogin(),
				
				'nivel'=>$usuario->getNivel(),
				'idFuncionario'=>$usuario->getIdFuncionario()
				
			);
			echo '<script>
					location.href="../../eletrodomesticos/index.php";
					</script>';
		}

		/*switch($_SESSION['usuario']['nivel']){
			case 1:
			//echo '<script>
					//location.href="nivel1.php";
					//</script>'; 
			echo '<script>
					location.href="../index.php";
					</script>'; 
			
			break;
			case 2:
			echo '<script>
					location.href="nivel2.php";
					</script>';
			break;
			case 3:
			echo '<script>
					location.href="nivel3.php";
					</script>';
			break;
			}*/
	
	}
}
?>