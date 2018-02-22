<?php
include_once "Cliente/modelo/Cliente.class.php";
include_once "Cliente/dao/DaoCliente.class.php";
class ControleCliente
{

	public function inserir(Cliente $cliente )
	{
		$nome=$cliente->getNome();
		$cpf=$cliente->getCpf();
		$sexo=$cliente->getSexo();
		$endereco=$cliente->getEndereco();
		$cidade=$cliente->getCidade();
		$estado=$cliente->getEstado();
		$telefone=$cliente->getTelefone();
		$dataNasc=$cliente->getDataNasc();
		$status=$cliente->getStatus();
		if($nome=="" || $cpf=="" || $sexo=="" || $endereco=="" || $cidade==""|| $estado=="" || $telefone=="" || $dataNasc=="" || $status=="")
		{		
				echo '
							<script> 
								alert( "Por favor, preencha todos os campos!" );
								location.href="?pag=Cliente/visao/inserir.php";
							</script>';

		
		}
		else
		{
			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dataNasc))
			{
				//se data válida, converte para o formato do banco
				$dataNasc = date('Y-m-d', strtotime(str_replace('/', '-', $dataNasc)));
				//setto a troca com o novo formato da data
				$cliente->setDataNasc($dataNasc);
				$daoCliente = new DaoCliente();
				$inseriu = $daoCliente->inserir($cliente);
			
				if (!$inseriu)
					echo "Erro na inserção!";
			
					echo '
								<script> 
									alert( "Cliente inserido com sucesso!" );
									location.href="?pag=Cliente/visao/inserir.php";
								</script>';
				return $inseriu;
			}
		}		
		
	
	}
	public function buscar($nome)
	{	
		if($nome=="")
		{
			echo '<script> 
					alert( "Campo vazio!" );
					location.href="?pag=Cliente/visao/listar.php";
				</script>';	
		}
		else
		{
			$daoCliente = new DaoCliente();	
			$clientes = $daoCliente->buscar($nome);
		
	if( ! $clientes)
	{
        echo '
			<script> 
			alert( "Cliente nao encontrado!" );
			location.href="?pag=Cliente/visao/listar.php";
			</script>';

    }
		
			
	return $clientes;
	}
		
	}
	
	public function buscarId($id)
	{
		$daoCliente = new DaoCliente();	
		$clientes = $daoCliente->buscarId($id);
		
	if( ! $clientes )
	{
        echo " Cliente não encontrado! ";
    }
		
		
	return $clientes;
		
	}

    

	public function excluir($id)
	{
		$daoCliente = new DaoCliente();
		$excluiu=$daoCliente->excluir($id);
		if(! $excluiu)
		{
			echo "Erro na exclusão!";
		}
		
		 echo "Excluído com sucesso!";
	}

	public function editar(Cliente $cliente)
	{	
		
		$nome=$cliente->getNome();
		$cpf=$cliente->getCpf();
		$sexo=$cliente->getSexo();
		$endereco=$cliente->getEndereco();
		$cidade=$cliente->getCidade();
		$estado=$cliente->getEstado();
		$telefone=$cliente->getTelefone();
		$dataNasc=$cliente->getDataNasc();
		$status=$cliente->getStatus();
		if($nome=="" || $cpf=="" || $sexo=="" || $endereco=="" || $cidade==""|| $estado=="" || $telefone=="" || $dataNasc=="" || $status=="")
		{		
				echo '
						<script> 
						alert( "Por favor, preencha todos os campos!" );
						location.href="?pag=Cliente/visao/listar.php";
						</script>';

		
		}
		else
		{
			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dataNasc))
			{
				$dataNasc = date('Y-m-d', strtotime(str_replace('/', '-', $dataNasc)));
				//setto a troca com o novo formato da data
				$cliente->setDataNasc($dataNasc);
				$daoCliente = new DaoCliente();
				$editou=$daoCliente->editar($cliente);
				if(!$editou)
				{
					echo '
									<script> 
										alert( "Erro na edicao!" );
										location.href="?pag=Cliente/visao/listar.php";
									</script>';

				}
				echo '
									<script> 
										alert( "Editado com sucesso!" );
										location.href="?pag=Cliente/visao/listar.php";
									</script>';

			
	
			}
			else
			{
				echo '
									<script> 
										alert( "Data invalida!" );
										location.href="?pag=Cliente/visao/listar.php";
									</script>';

			}
		}
	}
}
?>