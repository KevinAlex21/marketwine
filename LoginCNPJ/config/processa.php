<?php
session_start();
ob_start();
include_once("conexao.php");

//Declaração das variaves
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING); //irá retirar tags html de string
$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);


$erro = false;

$dados_st = array_map('strip_tags', $dados_rc);
$dados =    array_map('trim', $dados_st);

// Verifica se todos os digitos são iguais
if (preg_match('/(\d)\1{13}/', $cnpj)) {
  $erro = true;
  $_SESSION['msg'] =
    "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> CNPJ Inválido
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
  mysqli_close($conn);
  header("Location: http://localhost:81/projeto/loginCNPJ/");
}
// Verifica quantidade de caracteres é igual a 18	
elseif ((strlen($dados['cnpj'])) < 14) {
  $erro = true;
  $_SESSION['msg'] =
    "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> O CNPJ informado é muito curto para ser um CNPJ autêntico.
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
  mysqli_close($conn);
  header("Location: http://localhost:81/projeto/loginCNPJ/");

  //Verifica se todos os campos foram digitados
} elseif (in_array('', $dados)) {
  $erro = true;
  $_SESSION['msg'] =
    "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> É Necessário preencher todos os campos!
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
  mysqli_close($conn);
  header("Location: loginCola.php");

  //Verifica se a senha digitada é maior que 8
} elseif ((strlen($dados['senha'])) < 8) {
  $erro = true;
  $_SESSION['msg'] =
    "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> A senha deve ter no minímo 8 caracteres!
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";

  //Verifica se esta o caractere ' na senha
  mysqli_close($conn);
  header("Location: http://localhost:81/projeto/loginCNPJ/");
} elseif (stristr($dados['senha'], "'")) {
  $erro = true;
  $_SESSION['msg'] =
    "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong>Caracter ( ' ) utilizado na senha é inválido
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
  mysqli_close($conn);
  header("Location: http://localhost:81/projeto/loginCNPJ/");

  //Consulta na tabela colaborador se o CNPJ ja esta sendo utilizado
} else {
  $result_usuario = "SELECT cnpj FROM temp_colaboradores WHERE cnpj='" . $dados['cnpj'] . "'";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  if (($resultado_usuario) and ($resultado_usuario->num_rows != 0)) {
    $erro = true;
    $_SESSION['msg'] =
      "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> Este CNPJ já está sendo utilizado!
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
    mysqli_close($conn);
    header("Location: http://localhost:81/projeto/loginCNPJ/");
  }

  //Consulta na tabela se o email ja está sendo utilizado
  $result_usuario = "SELECT idColaborador FROM temp_colaboradores WHERE email='" . $dados['email'] . "'";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  if (($resultado_usuario) and ($resultado_usuario->num_rows != 0)) {
    $erro = true;
    $_SESSION['msg'] =
      "<div class='row d-flex justify-content-center'>
<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> Este email já esta sendo utilizado!
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
</div></div>";
    mysqli_close($conn);
    header("Location: http://localhost:81/projeto/loginCNPJ/");
  }
}

//var_dump($dados);
if (!$erro) {
  //var_dump($dados); 
  //Se não retornar nenhum erro de validação executa query de INSERT abaixo
  $result_usuario = "INSERT INTO temp_colaboradores 
		(nome, cnpj, email, senha, created) VALUES ('$nome','$cnpj','$email',MD5('$senha'), NOW())";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  if (mysqli_insert_id($conn)) {
    $_SESSION['msgcad'] =
      "
		<div class='row d-flex justify-content-center'>
		<div class='alert alert-success' role='alert'>
		  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
		  <span aria-hidden='true'>&times;</span>
		  </button>
		  <h4 class='alert-heading'>Muito bem!</h4>
		  <p>Você se cadastrou com sucesso no MarketWine!</p>
		  <hr>
		  <p class='mb-0'>Você deverá preencher todas as informações de contato!
		</div></div>";
    mysqli_close($conn);
    header("Location: http://localhost:81/projeto/loginCNPJ/");
  } else {
    echo "Error: " . $result_usuario . "<br>" . $conn->error;
  }
}
