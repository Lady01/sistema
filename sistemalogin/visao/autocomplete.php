<?php
require('conexao.php');
	
		$funcionario = $_POST['funcionario'];
	
		$sql = "SELECT id, nome, cargo FROM funcionario WHERE nome LIKE '%$funcionario%'";
		$qry = mysql_query($sql);
		while( $row = mysql_fetch_object($qry) )
		{
			echo "<a href='?addFuncionario= ". $row->id ."'>". $row->nome ."</a><br>";	
		}
		
	

?>
