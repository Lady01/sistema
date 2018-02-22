<?php
include_once "Pagamento/modelo/Pagamento.class.php";
include_once "Pagamento/dao/DaoPagamento.class.php";
class ControlePagamento
{

	public function inserir(Pagamento $pagamento )
	{
		$idVenda=$pagamento->getIdVenda();
				
		$dinheiroRecebido=$pagamento->getDinheiroRecebido();
		$troco=$pagamento->getTroco();
		$numParcelas=$pagamento->getNumParcelas();
		$valorVenda=$pagamento->getValorVenda();
		
		if(empty($idVenda)  || empty($valorVenda))
		{
			echo '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=Pagamento/visao/listar.php";
						</script>';
		}
		else
		{
		//Crio um objeto de DaoMarca chamado daoMarca
		$daoPagamento = new DaoPagamento();
		//Mando o daoMarca inserir o objeto recebido marca
		$inseriu = $daoPagamento->inserir($pagamento);
		//se não teve sucesso na inserção, uma mensagem de erro é disparada
		if (!$inseriu)
			echo '
						<script> 
							alert( "Erro na insercao!" );
							location.href="?pag=Pagamento/visao/listar.php";
						</script>';
		//Se correu tudo bem, não executa o if e dispara uma mensagem de sucesso
			
			echo '<script> 
							alert( "Pagamento efetuado com sucesso!" );
							location.href="?pag=Pagamento/index.php";
						</script>';
			
						
		return true;
}		
	}

public function inserirPagamentoItensLista(Pagamento $pagamento )
	{
		$idVenda=$pagamento->getIdVenda();
				
		$dinheiroRecebido=$pagamento->getDinheiroRecebido();
		$troco=$pagamento->getTroco();
		$numParcelas=$pagamento->getNumParcelas();
		$valorVenda=$pagamento->getValorVenda();
		
		if(empty($idVenda)  || empty($valorVenda))
		{
			echo '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=Pagamento/visao/listar.php";
						</script>';
		}
		else
		{
		//Crio um objeto de DaoMarca chamado daoMarca
		$daoPagamento = new DaoPagamento();
		//Mando o daoMarca inserir o objeto recebido marca
		$inseriu = $daoPagamento->inserirPagamentoItensLista($pagamento);
		//se não teve sucesso na inserção, uma mensagem de erro é disparada
		if (!$inseriu)
			echo '
						<script> 
							alert( "Erro na insercao!" );
							location.href="?pag=Pagamento/visao/listar.php";
						</script>';
		//Se correu tudo bem, não executa o if e dispara uma mensagem de sucesso
			
			echo '<script> 
							alert( "Pagamento efetuado com sucesso!" );
							location.href="?pag=Pagamento/index.php";
						</script>';
			
						
		return true;
}		
	}
	
}
?>