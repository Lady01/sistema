<?php
include_once "Produto/modelo/Produto.class.php";
include_once "Produto/dao/DaoProduto.class.php";
class ControleProduto
{

	public function inserir(Produto $produto )
	{
		$idMarca=$produto->getIdMarca();
		$nome=$produto->getNome();
		$descricao=$produto->getDescricao();
		$preco=$produto->getPreco();
		
		
		if(empty($idMarca) || $nome=="" || $descricao=="" || empty($preco))
		{
			echo '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=Produto/visao/inserir.php";
						</script>';

		}
		else
		{
			$daoProduto = new DaoProduto();
			$inseriu = $daoProduto->inserir($produto);
			if ($inseriu)
				echo '
							<script> 
								alert( "Produto inserido com sucesso!" );
								location.href="?pag=Produto/visao/inserir.php";
							</script>';
			else
			echo '
						<script> 
							alert( "Erro na insercao" );
							location.href="?pag=Produto/visao/inserir.php";
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
							location.href="?pag=Produto/visao/listar.php";
						</script>';

		}
		else
		{
			$daoProduto = new DaoProduto();	
			$produtos = $daoProduto->buscar($nome);
			if( !$produtos )
			{
				echo '
							<script> 
								alert( "Produto nao encontrado!" );
								location.href="?pag=Produto/visao/listar.php";
							</script>';
			}
			return $produtos;
		}
	}
	
	public function buscarId($id)
	{
	
		$daoProduto = new DaoProduto();	 
		$produtos=$daoProduto->buscarId($id);
			if( !$produtos )
	{
        echo " Produto não encontrado! ";
    }
		
		
	return $produtos;
		
	}

    

	public function excluir($id)
	{
		$daoProduto = new DaoProduto();
		$excluiu=$daoProduto->excluir($id);
		if(!$excluiu)
		{
			echo '
						<script> 
							alert( "Erro na exclusao!" );
							location.href="?pag=Produto/visao/listar.php";
						</script>';
		}
		
		 echo '
						<script> 
							alert( "Produto excluido com sucesso!" );
							location.href="?pag=Produto/visao/listar.php";
						</script>';
	}

	public function editar(Produto $produto)
	{	
		$idMarca=$produto->getIdMarca();
		$nome=$produto->getNome();
		$descricao=$produto->getDescricao();
		$preco=$produto->getPreco();
		
		
		//if(empty($idMarca) || $nome=="" || $descricao=="" || empty($preco))
		//{
			//echo '
				//		<script> 
					//		alert( "Por favor, preencha todos os campos" );
						//	location.href="?pag=Produto/visao/listar.php";
						//</script>';

		//}
		//else
		//{
		
			$daoProduto = new DaoProduto();
			$editou=$daoProduto->editar($produto);
			if(!$editou)
			{
				echo '
							<script> 
								alert( "Erro na edicao!" );
								location.href="?pag=Produto/visao/listar.php";
							</script>';
			}
			echo '
							<script> 
								alert( "Produto editado com sucesso!" );
								location.href="?pag=Produto/visao/listar.php";
							</script>';
		//}
	}
}
?>