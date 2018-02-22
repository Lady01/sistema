<?php
include_once "Fornecedor/modelo/Fornecedor.class.php";
include_once "Fornecedor/dao/DaoFornecedor.class.php";
class ControleFornecedor
{

	public function inserir(Fornecedor $fornecedor )
	{
		$nome=$fornecedor->getNome();
		$cnpj=$fornecedor->getCnpj();
		$telefone=$fornecedor->getTelefone();
		$endereco=$fornecedor->getEndereco();
		$cidade=$fornecedor->getCidade();
		$estado=$fornecedor->getEstado();
		$descricao=$fornecedor->getDescricao();
		if($nome=="" || $cnpj=="" || $telefone=="" || $endereco=="" || $cidade=="" || $estado=="" || $descricao=="")
		{
			
			echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							location.href="?pag=Fornecedor/visao/inserir.php";
						</script>';

		}
		else
		{
			$daoFornecedor = new DaoFornecedor();
			$inseriu = $daoFornecedor->inserir($fornecedor);
			if ($inseriu)
				echo "Fornecedor cadastrado com suscesso!";
			else
				echo "Erro na inserção!";
			echo '
							<script> 
								alert( "Fornecedor inserido com sucesso!" );
								location.href="?pag=Fornecedor/visao/inserir.php";
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
							location.href="?pag=Fornecedor/visao/listar.php";
						</script>';

		}
		else
		{
			$daoFornecedor = new DaoFornecedor();	
			$fornecedores = $daoFornecedor->buscar($nome);
			
			if( ! $fornecedores)
			{
				echo '
								<script> 
									alert( "Fornecedor nao encontrado!" );
									location.href="?pag=Fornecedor/visao/listar.php";
								</script>';

			}
				
					
			return $fornecedores;
		}
	}
	
	public function buscarId($id)
	{
		$daoFornecedores = new DaoFornecedor();	
		$fornecedores = $daoFornecedores->buscarId($id);
		
	if( !$fornecedores )
	{
        echo " Fornecedor não encontrado! ";
    }
		
		
	return $fornecedores;
		
	}

	public function excluir($id)
	{
		$daofornecedores = new DaoFornecedor();
		$excluiu=$daofornecedores->excluir($id);
		if(!$excluiu)
		{
			echo "Erro na exclusão!";
		}
		
		echo '
							<script> 
								alert( "Fornecedor excluido com sucesso!" );
								location.href="?pag=Fornecedor/visao/listar.php";
							</script>';

	}

	public function editar(Fornecedor $fornecedor)
	{
		$nome=$fornecedor->getNome();
		$cnpj=$fornecedor->getCnpj();
		$telefone=$fornecedor->getTelefone();
		$endereco=$fornecedor->getEndereco();
		$cidade=$fornecedor->getCidade();
		$estado=$fornecedor->getEstado();
		$descricao=$fornecedor->getDescricao();
		if($nome=="" || $cnpj=="" || $telefone=="" || $endereco=="" || $cidade=="" || $estado=="" || $descricao=="")
		{
			
			echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							location.href="?pag=Fornecedor/visao/inserir.php";
						</script>';

		}
		else
		{
		
			$daoFornecedores = new DaoFornecedor();
			$editou=$daoFornecedores->editar($fornecedor);
			if(!$editou)
			{
				echo '
							<script> 
								alert( "Erro na edicao!" );
								location.href="?pag=Fornecedor/visao/listar.php";
							</script>';

			}
			echo '
							<script> 
								alert( "Fornecedor editado com sucesso!" );
								location.href="?pag=Fornecedor/visao/listar.php";
							</script>';

		}
	}
}
?>