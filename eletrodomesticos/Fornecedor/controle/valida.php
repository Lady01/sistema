<?php
function validaData($data)
{
if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $data)) 
{
return true;
}
else
{
return false;
}
}

function validaCep($cep)
{
if (preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep))

{
    return true;

}
else
{
	return false;
}
}

function validaTelefone($tel)
{
if(preg_match('^\(+[0-9]{2,3}\) [0-9]{4}-[0-9]{4}$^', $tel))
{
return true;
  }
else
{
return false;
}
}

function validaCpf($cpf)
{
if(preg_match("^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$", $cpf))
 {
 return true;
 }
 else
 {
 return false;
 }
}
function verificaVazio($palavra)
{
if(!empty($palavra))
 {
 return true;
 }
 else
 {
 return false;
 }
}
?>