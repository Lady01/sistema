<?php
include_once "Relatorios/dao/DaoRelatorio.class.php";
class ControleRelatorio
{

	public function listarClientes($data)
	{		
		
			
		if($data=="")
		{
			echo '
					<script> 
					alert( "Campo vazio!" );
					location.href="?pag=Relatorio/visao/listar.php";
					</script>';

		}
		else
		{
		
			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
			{
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				$daoRelatorio = new DaoRelatorio();
				$lista = $daoRelatorio->listarClientes($data);
				if( !$lista )
				{
					echo '
							<script> 
							alert( "Nenhum registro encontrado!" );
							location.href="?pag=Relatorio/visao/listar.php";
							</script>';

				}
				return $lista;
			}
			else
			{
				echo '
						<script> 
						alert( "Data invalida!" );
						location.href="?pag=Relatorio/visao/listar.php";
						</script>';

			}
		}	
		
		
	}
	
	public function listarAparelhosMaisVendidos($data)
	{
		if($data=="")
		{
			echo '
					<script> 
					alert( "Campovazio!" );
					location.href="?pag=Relatorio/visao/listar.php";
					</script>';

		}
		else
		{
			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
			{	
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				$daoRelatorio = new DaoRelatorio();
				$lista = $daoRelatorio->listarAparelhosMaisVendidos($data);
					if(!$lista)
					{
						echo '
										<script> 
											alert( "Nenhum registro encontrado!" );
											location.href="?pag=Relatorio/visao/listar.php";
										</script>';
			
					}
			
				return $lista;
			}
			else
			{
				echo '
						<script> 
							alert( "Data invalida!" );
							location.href="?pag=Relatorio/visao/listar.php";
						</script>';
			
			}
		}
	}
	
	public function listarProdutosComDefeito($data)
	{
		if($data=="")
		{
			echo '
								<script> 
									alert( "Campo vazio!" );
									location.href="?pag=Relatorio/visao/listar.php";
								</script>';

		}
		else
		{
			if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data))
			{	
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				$daoRelatorio = new DaoRelatorio();
				$lista = $daoRelatorio->listarProdutosComDefeito($data);
				if(!$lista)
				{
					echo '
									<script> 
										alert( "Nenhum registro encontrado!" );
										location.href="?pag=Relatorio/visao/listar.php";
									</script>';

				}
				return $lista;
			}
			else
			{
				echo '
									<script> 
										alert( "Data invalida!" );
										location.href="?pag=Relatorio/visao/listar.php";
									</script>';

			}
		}
	}	
}
?>