<?php
function validaData($data)
	{
	
		$t=explode("/","$data");
		if ($t=="")
			return false;
		$dia=$t[0];
		$mes=$t[1];
		$ano=$t[2];
		if (!is_numeric($dia) || !is_numeric($mes) || !is_numeric($ano))
			return false;
			
		if ($dia<1 || $dia>31)
			return false;
		if ($mes<1 || $mes>12)
			return false;
		if ($ano<1800 || $ano>2100)
			return false;
		
		return true;
	}
	
function estaVazio($argumento)
{
if(!empty($argumento))
{
return true;
}
else
{
return false;
}
}
?>