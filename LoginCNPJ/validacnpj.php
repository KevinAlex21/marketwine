<?php
include_once ("conexao.php");
session_start ();
function validar_cnpj($cnpj){

	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;
		 $_SESSION['msg'] = 
				"<div class='row d-flex justify-content-center'>
				<div class='alert alert-warning alert-dismissible fade show' role='alert'>
				<strong>Oloco, meu!</strong> CNPJ Inválido1!
				<button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
				<span aria-hidden='true'>&times;</span>
				</button>
				</div></div>";
				header("Location: loginCola.php");
	// Verifica se todos os digitos são iguais
	if (preg_match('/(\d)\1{13}/', $cnpj))
		return false;
				 $_SESSION['msg'] = 
				"<div class='row d-flex justify-content-center'>
				<div class='alert alert-warning alert-dismissible fade show' role='alert'>
				<strong>Oloco, meu!</strong> CNPJ Inválido2!
				<button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
				<span aria-hidden='true'>&times;</span>
				</button>
				</div></div>";
				header("Location: loginCola.php");
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj{$i} * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);

	// Lista de CNPJs inválidos
	$invalidos = [
	'00000000000000',
	'11111111111111',
	'22222222222222',
	'33333333333333',
	'44444444444444',
	'55555555555555',
	'66666666666666',
	'77777777777777',
	'88888888888888',
	'99999999999999'
];

// Verifica se o CNPJ está na lista de inválidos
if (in_array($cnpj, $invalidos)) {	
	return false;
				 $_SESSION['msg'] = 
				"<div class='row d-flex justify-content-center'>
				<div class='alert alert-warning alert-dismissible fade show' role='alert'>
				<strong>Oloco, meu!</strong> CNPJ Inválido!
				<button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
				<span aria-hidden='true'>&times;</span>
				</button>
				</div></div>";
				header("Location: loginCola.php");
}
}
var_dump(validar_cnpj('11.444.777/0001-61'));
?>
