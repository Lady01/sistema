<?php
include_once "FormadePagamento/modelo/FormadePagamento.class.php";
include_once "FormadePagamento/dao/DaoFormadePagamento.class.php";
class ControleFormadePagamento
{

	public function inserir(FormadePagamento $formadePagamento )
	{	
		$nome= $formadePagamento->getNome();
		$descricao= $formadePagamento->getDescricao();
		if($nome=="" || $descricao=="")
		{
			echo '<script> 
								alert( "Por favor, preencha todos os campos!" );
								location.href="?pag=Formadepagamento/visao/form_inserir.php";
							</script>';
		}
		else
		{
			$daoFormadePagamento = new DaoFormadePagamento();
			$inseriu = $daoFormadePagamento->inserir($formadePagamento);
			if ($inseriu)
				echo '
							<script> 
								alert( "Forma de Pagamento inserida com sucesso!" );
								location.href="?pag=Formadepagamento/visao/form_inserir.php";
							</script>';
			else
				echo '
							<script> 
								alert( "Erro na insercao!" );
								location.href="?pag=Formadepagamento/visao/inserir.php";
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
								location.href="?pag=Formadepagamento/visao/listar.php";
							</script>';

		}
		else
		{
			$daoFormadePagamento = new DaoFormadePagamento();
			$formasdePagamento = $daoFormadePagamento->buscar($nome);
			if( !$formasdePagamento )
			{
			   echo '
								<script> 
									alert( "Forma de Pagamento nao encontrada!" );
									location.href="?pag=Formadepagamento/visao/listar.php";
								</script>';
			}
			return $formasdePagamento;
		}
	}
	
	public function buscarId($id)
	{
		$daoFormadePagamento = new DaoFormadePagamento();	
		$formasdePagamento = $daoFormadePagamento->buscarId($id);
		
	if( !$formasdePagamento )
	{
        echo " Forma de pagamento não encontrada! ";
    }
	return $formasdePagamento;
	}
		
	/*public function buscarTodos()
	{
		$daoFormadePagamento = new DaoFormadePagamento();	
		$formasdePagamento = $daoFormadePagamento->buscarTodos();
		
	if( !$formasdePagamento )
	{
        echo " Nenhum registro! ";
    }
	
	return $formasdePagamento;
		
	}*/

	public function excluir($id)
	{
		$daoFormadePagamento = new DaoFormadePagamento();
		$excluiu=$daoFormadePagamento->excluir($id);
		if(!$excluiu)
		{
			echo '
						<script> 
							alert( "Erro na exclusao!" );
							location.href="?pag=Formadepagamento/visao/listar.php";
						</script>';
		}
		
		 echo '
						<script> 
							alert( "Forma de pagamento excluida com sucesso!" );
							location.href="?pag=Formadepagamento/visao/listar.php";
						</script>';
	}

	public function editar(FormadePagamento $formadePagamento)
	{
		$nome= $formadePagamento->getNome();
		$descricao= $formadePagamento->getDescricao();
		if($nome=="" || $descricao=="")
		{
			echo '<script> 
								alert( "Por favor, preencha todos os campos!" );
								location.href="?pag=Formadepagamento/visao/listar.php";
							</script>';
		}
		else
		{
			$daoFormadePagamento = new DaoFormadePagamento();
			$editou=$daoFormadePagamento->editar($formadePagamento);
			if(!$editou)
			{
				echo '
							<script> 
								alert( "Erro na edicao!" );
								location.href="?pag=Formadepagamento/visao/listar.php";
							</script>';
			}
			echo '
							<script> 
								alert( "Forma de Pagamento editada com sucesso!" );
								location.href="?pag=Formadepagamento/visao/listar.php";
								</script>';
		}
	}
}
?>