<?php
include_once "Venda/modelo/Venda.class.php";
include_once "Venda/dao/DaoVenda.class.php";
include_once "Venda/controle/valida.php";
class ControleVenda
{

	public function inserir(Venda $venda )
	{	$idFuncionario=$venda->getIdFuncionario();
		$idFormadePag=$venda->getIdFormadePag();
		$data=$venda->getData();
		$observacao=$venda->getObservacao();
			//verifica se existem campos vazios
			//se existem, chama o formulário de volta
		if(empty($idFuncionario) || empty($idFormadePag) || empty($data) || empty($observacao))
		{
			echo '
						<script> 
							alert( "Por favor, preencha todos os campos!" );
							
						</script>';
		}
		//senao, verifica a data
		else
		{
			

			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
			{
				//se é válida, converte para o formato do banco
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				//setto a venda com o novo formato da data
				$venda->setData($data);
				//Crio um objeto de DaoVenda chamado daoVenda
				$daoVenda = new DaoVenda();
				//Mando o daoVenda inserir o objeto recebido venda
				$inseriu = $daoVenda->inserir($venda);
				//se não teve sucesso na inserção, uma mensagem de erro é disparada
				if (!$inseriu)
					echo '
								<script> 
									alert( "Erro na insercao!" );
									location.href="?pag=Venda/visao/inserir.php";
								</script>';
				//Se correu tudo bem, não executa o if e dispara uma mensagem de sucesso
					echo '
						<script> 
							alert( "Venda inserida com sucesso!" );
							location.href="?pag=Venda/index.php";
						</script>';
				return $inseriu; 	
		}
		//se data inválida, volta para o formulario
		else
		{
			echo '
							<script> 
								alert( "Data inválida!" );
								location.href="?pag=Venda/visao/inserir.php";
							</script>';

		}
	}
	}
	
	
	public function buscarDadosVendas($id)
	{
		if(empty($id))
		{
			echo "Campo vazio!";
		}
		else
		{
			$daoVenda = new DaoVenda();	
			$vendas = $daoVenda->buscarDadosVendas($id);
			
			if( !$vendas)
			{
				echo " Venda não encontrada! ";
			}

			return $vendas;
		}
	}
	
	public function buscarDadosItensVendas($id)
	{
		
		$daoVenda = new DaoVenda();	
		$vendas = $daoVenda->buscarDadosItensVendas($id);
		if( !$vendas)
		{
			echo " Itens não encontrados! ";
		}
		
	
		return $vendas;
	}
	
	public function buscarDadosVendaItensLista($id)
	{
		
		$daoVenda = new DaoVenda();	
		$vendas = $daoVenda->buscarDadosVendaItensLista($id);
		if( !$vendas)
		{
			echo " Itens não encontrados! ";
		}
		
	
		return $vendas;
	}

}
?>