<?php
include_once "../Funcionario/modelo/Funcionario.class.php";
include_once "../Funcionario/dao/DaoFuncionario.class.php";
class ControleFuncionario
{

	public function inserir(Funcionario $funcionario )
	{	
					$nome=$funcionario->getNome();
					$cpf=$funcionario->getCpf();
					$sexo=$funcionario->getSexo();
					$endereco=$funcionario->getEndereco();
					$cidade=$funcionario->getCidade();
					$estado=$funcionario->getEstado();
					$telefone=$funcionario->getTelefone();
					$matricula=$funcionario->getMatricula();
					$dataNasc=$funcionario->getDataNasc();
					$cargo=$funcionario->getCargo();
				if($nome="" || $cpf=="" || $sexo=="" || $endereco=="" || $cidade=="" || $estado=="" || $telefone=="" || $matricula=="" || $dataNasc=="" || $cargo=="")
				{
				echo  '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=Funcionario/visao/inserir.php";
						</script>';
	
				}
				else
				{
					if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dataNasc))
					{
						//se data válida, converte para o formato do banco
						$dataNasc = date('Y-m-d', strtotime(str_replace('/', '-', $dataNasc)));
						//setto o funcionario com o novo formato da data
						$funcionario->setDataNasc($dataNasc);
						//crio objeto do dao
						$daoFuncionario = new DaoFuncionario();
						//mando inserir objeto funcionario
						$inseriu = $daoFuncionario->inserir($funcionario);
						//senao inseriu, volto para o formulario e disparo mensagem de erro
						if (!$inseriu)
							echo  '
							<script> 
								alert( "Erro na inserção!" );
								location.href="?pag=Funcionario/visao/inserir.php";
							</script>';
						// se tudo certo, disparo uma mensagem de sucesso e volto para o formulario
						echo '
							<script> 
								alert( "Funcionario inserido com sucesso!" );
								location.href="?pag=Funcionario/visao/inserir.php";
							</script>';
						return $inseriu;	
					}
}		
		
	
	}
	public function buscar($nome)
	{
		if($nome=="")
		{
			echo '
						<script> 
							alert( "Campo vazio!" );
							location.href="?pag=Funcionario/visao/listar.php";
						</script>';
		}
		else
		{
			$daoFuncionario = new DaoFuncionario();	
			$funcionarios = $daoFuncionario->buscar($nome);
			
			if( ! $funcionarios)
			{
				echo '
								<script> 
									alert( "Funcionario nao encontrado!" );
									location.href="?pag=Funcionario/visao/listar.php";
								</script>';

			}
				
					
			return $funcionarios;
		}	
	}
	
	public function buscarId($id)
	{
		$daoFuncionario = new DaoFuncionario();	
		$funcionarios = $daoFuncionario->buscarId($id);
		
	if( ! $funcionarios )
	{
        echo " Funcionario não encontrado! ";
    }
		
		
	return $funcionarios;
		
	}

    

	public function excluir($id)
	{
		$daoFuncionario = new DaoFuncionario();
		$excluiu=$daoFuncionario->excluir($id);
		if(! $excluiu)
		{
			echo '
						<script> 
							alert( "Erro na exclusao!" );
							location.href="?pag=Funcionario/visao/listar.php";
						</script>';

		}
		
		 echo '
						<script> 
							alert( "Funcionario excluido com sucesso!" );
							location.href="?pag=Funcionario/visao/listar.php";
						</script>';

	}

	public function editar(Funcionario $funcionario)
	{
		$nome=$funcionario->getNome();
					$cpf=$funcionario->getCpf();
					$sexo=$funcionario->getSexo();
					$endereco=$funcionario->getEndereco();
					$cidade=$funcionario->getCidade();
					$estado=$funcionario->getEstado();
					$telefone=$funcionario->getTelefone();
					$matricula=$funcionario->getMatricula();
					$dataNasc=$funcionario->getDataNasc();
					$cargo=$funcionario->getCargo();
				if($nome="" || $cpf=="" || $sexo=="" || $endereco=="" || $cidade=="" || $estado=="" || $telefone=="" || $matricula=="" || $dataNasc=="" || $cargo=="")
				{
				echo  '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=Funcionario/visao/listar.php";
						</script>';
	
				}
				else
				{
					if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dataNasc))
					{
						//se data válida, converte para o formato do banco
						$dataNasc = date('Y-m-d', strtotime(str_replace('/', '-', $dataNasc)));
						//setto o funcionario com o novo formato da data
						$funcionario->setDataNasc($dataNasc);
					
						$daoFuncionario = new DaoFuncionario();
						$editou=$daoFuncionario->editar($funcionario);
						if(!$editou)
						{
							echo '
										<script> 
											alert( "Erro na ediçao!" );
											location.href="?pag=Funcionario/visao/listar.php";
										</script>';

						}
						echo '
										<script> 
											alert( "Funcionario editado com sucesso!" );
											location.href="?pag=Funcionario/visao/listar.php";
										</script>';
					}
					else
					{
						echo '
										<script> 
											alert( "Data invalida!" );
											location.href="?pag=Funcionario/visao/listar.php";
										</script>';

					}
				}
				
	}
}
?>