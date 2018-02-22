<?php
include_once "Venda/modelo/Venda.class.php";
include_once "ListadeCasamento/modelo/ListadeCasamento.class.php";
include_once "ListadeCasamento/dao/DaoListadeCasamento.class.php";
class ControleListadeCasamento
{

	public function inserir(ListadeCasamento $listadeCasamento )
	{
					$conjuge=$listadeCasamento->getConjuge();
					$endereco=$listadeCasamento->getEndereco();
					$local=$listadeCasamento->getLocal();
					$cidade=$listadeCasamento->getCidade();
					$estado=$listadeCasamento->getEstado();
					$data=$listadeCasamento->getData();
					if($conjuge=="" || $endereco=="" || $local=="" || $cidade=="" || $estado=="" || $data=="")
					{
					echo '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=ListadeCasamento/visao/inserir.php";
						</script>';

					}
					else
					{
							if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
							{
				//se data válida, converte para o formato do banco
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				//setto a troca com o novo formato da data
				$listadeCasamento->setData($data);
					
		//Crio um objeto de DaoMarca chamado daoMarca
		$daoListadeCasamento = new DaoListadeCasamento();
		//Mando o daoMarca inserir o objeto recebido marca
		$inseriu = $daoListadeCasamento->inserir($listadeCasamento);
		//se não teve sucesso na inserção, uma mensagem de erro é disparada
		if (!$inseriu)
			echo '
						<script> 
							alert( "Erro na insercao!" );
							location.href="?pag=ListadeCasamento/visao/inserir.php";
						</script>';
		//Se correu tudo bem, não executa o if e dispara uma mensagem de sucesso
			echo '
				<script> 
					alert( "Lista  inserida com sucesso!" );
					location.href="?pag=ListadeCasamento/index.php";
				</script>';
		return $inseriu; 	
		}
		else
		{
			echo '
						<script> 
							alert( "Data invalida!" );
							location.href="?pag=ListadeCasamento/visao/inserir.php";
						</script>';
		}
		
	}
	}
	
	
	public function buscarNoivos($id)
	{
		$daoListadeCasamento = new DaoListadeCasamento();	
		$noivos = $daoListadeCasamento->buscarnoivos($id);
		
		if( !$noivos)
		{
			echo " Noivos não encontrados! ";
		}

		return $noivos;
		
	}
	
	public function buscarDadosItensLista($id)
	{
		
		$daoListadeCasamento = new DaoListadeCasamento();	
		$itens = $daoVenda->buscarDadosItensVendas($id);
		if( !$itens)
		{
			echo " Itens não encontrados! ";
		}
		
	
		return $itens;
	}
	
	public function inserirVendaItensLista( Venda $venda)
	{
			$idCliente=$venda->getIdCliente();
			$idFuncionario=$venda->getIdFuncionario();
			$idFormadePag=$venda->getIdFormadePag();
			$data=$venda->getData();
			$observacao=$venda->getObservacao();
			if($idCliente=="" || $idFuncionario=="" || $idFormadePag=="" || $data=="" || $observacao=="")
			{
				echo '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=ListadeCasamento/visao/listar.php";
						</script>';

			}
			else
			{
				if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
					{
						//se data válida, converte para o formato do banco
						$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
						//setto a troca com o novo formato da data
						$venda->setData($data);	
						$daoListadeCasamento = new DaoListadeCasamento();
						$inseriu=$daoListadeCasamento->inserirVendaItensLista($venda);
						if(!$inseriu)
						{
							echo '
								<script> 
									alert( "Erro na insercao!" );
									location.href="?pag=ListadeCasamento/visao/listar.php";
								</script>';
						}
				
							echo '
								<script> 
									alert( "Venda de itens da lista efetuada com sucesso!" );
									location.href="?pag=ListadeCasamento/visao/listar.php";
								</script>';
				
		
					}
					else
					{
						echo '
						<script> 
							alert( "Data invalida!" );
							location.href="?pag=ListadeCasamento/visao/listar.php";
						</script>';
					}
			}

	}
	public function buscarLista($idLista)
	{
		$daoListadeCasamento = new DaoListadeCasamento();
		$itens=$daoListadeCasamento->buscarLista($idLista);
		if(!$itens)
		{
			echo "Itens da lista nao encontrados";
		}
		else
		{
			return $itens;
		}
	}
	

}
?>