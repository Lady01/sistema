<?php
include_once "Troca/modelo/Troca.class.php";
include_once "Troca/dao/DaoTroca.class.php";
class ControleTroca
{

	public function inserir(Troca $troca )
	{	
		$idItemVenda=$troca->getIdItemVenda();
		$defeito=$troca->getComDefeito();
		$data=$troca->getData();
		$observacao=$troca->getObservacao();
		if(empty($idItemVenda)|| empty($defeito) ||empty($data) || empty($observacao))
		{
		echo '
						<script> 
							alert( "Dados faltando!" );
							location.href="?pag=Troca/visao/listar.php";
						</script>';
	
		}
		else
		{	//verifica a data
			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
			{
				//se data válida, converte para o formato do banco
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				//setto a troca com o novo formato da data
				$troca->setData($data);
				//crio objeto do Dao
				$daoTroca = new DaoTroca();
				//mando-o inserir o objeto troca no banco
				$inseriu = $daoTroca->inserir($troca);
				//se deu algo errado, mensagem de erro, caso contrário, a aplicaçao segue seu fluxo e dispara 
				//uma mensagem de sucesso
				if (!$inseriu)
			echo '
						<script> 
							alert( "Erro na insercao!" );
							location.href="?pag=Troca/visao/listar.php";
						</script>';
			echo '
						<script> 
							alert( "Troca realizada com sucesso!" );
							location.href="?pag=Troca/index.php";
						</script>';
		return $inseriu;
			}
			//se data inválida, chama o formulario de inserção novamente
			else
			{
				echo '
						<script> 
							alert( "Data invalida!" );
							location.href="?pag=Troca/visao/listar.php";
						</script>';
			}
				
		}
	}
}
?>