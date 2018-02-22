<?php
include_once "Marca/modelo/Marca.class.php";
include_once "Marca/dao/DaoMarca.class.php";
class ControleMarca
{

	public function inserir(Marca $marca )
	{ 	$nome=$marca->getNome();
		$descricao=$marca->getDescricao();
		if($nome=="" || $descricao=="")
		{
			echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							location.href="?pag=Marca/visao/inserir.php";
						</script>';
		}
		else
		{
			//Crio um objeto de DaoMarca chamado daoMarca
			$daoMarca = new DaoMarca();
			//Mando o daoMarca inserir o objeto recebido marca
			$inseriu = $daoMarca->inserir($marca);
			//se não teve sucesso na inserção, uma mensagem de erro é disparada
			if (!$inseriu)
				echo '
							<script> 
								alert( "Erro na insercao!" );
								location.href="?pag=Marca/visao/inserir.php";
							</script>';
			//Se correu tudo bem, não executa o if e dispara uma mensagem de sucesso
				echo '
							<script> 
								alert( "Marca inserida com sucesso!" );
								location.href="?pag=Marca/visao/inserir.php";
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
							location.href="?pag=Marca/visao/listar.php";
						</script>';

	}
	else
	{
		//crio um objeto chamado daoMarca de DaoMarca
		$daoMarca = new DaoMarca();
		//mando daoMarca pesquisar pelo nome recebido no parametro, se não teve registro encontrado, diparo mensagem de erro
		$marcas = $daoMarca->buscar($nome);
		if( !$marcas )
		{
			echo '
							<script> 
								alert( "Marca não encontrada!" );
								location.href="?pag=Marca/visao/listar.php";
							</script>';

		}
		//se teve, carrego a variavel marcas com a lista de registros
		return $marcas;
	}	
	}
	//mesma coisa do método acima, mas o parametro é id e não nome
	public function buscarId($id)
	{
		$daoMarca = new DaoMarca();	
		$marcas = $daoMarca->buscarId($id);
		
	if( !$marcas )
	{
        echo " Marca não encontrada! ";
    }
		
		
	return $marcas;
		
	}

	public function excluir($id)
	{
		//recebe o id do registro a ser excluido, cria o objeto de dao marca que manda excluir de acordo com o id
		$daoMarca = new DaoMarca();
		$excluiu=$daoMarca->excluir($id);
		if(!$excluiu)
		{
			echo '
						<script> 
							alert( "Erro na exclusao!" );
							location.href="?pag=Marca/visao/listar.php";
						</script>';

		}
		
		 echo '
						<script> 
							alert( "Marca excluida com sucesso!" );
							location.href="?pag=Marca/visao/listar.php";
						</script>';

	}

	public function editar(Marca $marca)
	{
		$nome=$marca->getNome();
		$descricao=$marca->getDescricao();
		if($nome=="" || $descricao=="")
		{
			echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							location.href="?pag=Marca/visao/listar.php";
						</script>';
		}
		else
		{
			//Crio um objeto do DaoMarca, mando ele editar os dados do objeto passado como parametro
		$daoMarca = new DaoMarca();
		$editou=$daoMarca->editar($marca);
			if(!$editou)
			{
				echo '
							<script> 
								alert( "Erro na edicao!" );
								location.href="?pag=Marca/visao/listar.php";
							</script>';

			}
			echo '
							<script> 
								alert( "Marca editada com sucesso!" );
								location.href="?pag=Marca/visao/listar.php";
							</script>';
		}
	}
}
?>