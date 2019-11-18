<?php
session_start (); 
include_once("conexao.php");

    //Declarando variáveis pegando campos do formulário
    $sexo = $_POST['sexo'];
    $nome = filter_input (INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input (INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $nascimento = filter_input (INPUT_POST, 'nascimento', FILTER_SANITIZE_STRING);
    $cpf = filter_input (INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $cep = mysqli_real_escape_string($conn, $_POST['cep']);
    $num = filter_input (INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
	$endereco = mysqli_real_escape_string($conn, $_POST['rua']);
	$bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
	$cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conn, $_POST['uf']);
    $email = filter_input (INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha = filter_input (INPUT_POST, 'senha', FILTER_SANITIZE_STRING);;
    $telefone = filter_input (INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $celular = filter_input (INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
 
 
	$erro = false;
	

	
	// Elimina possivel mascara
	

// Verifica se todos os digitos são iguais
	if (preg_match('/(\d)\1{11}/', $cpf)){
		$erro = true;
        $_SESSION['msg'] = 
  "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> CPF Inválido.
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
        mysqli_close($conn);
        header("Location: http://localhost:81/projeto/Cliente/"); 
}
// Verifica quantidade de caracteres é igual a 11	
    elseif((strlen($dados['cpf'])) == 11){
		$erro = true;
	$_SESSION['msg'] = 
  "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> O CPF informado é muito curto para ser um CPF autêntico.
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
        mysqli_close($conn);
        header("Location: http://localhost:81/projeto/Cliente/"); 

//Verifica se todos os campos foram digitados
}elseif(in_array('',$dados)){
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
	}elseif((strlen($dados['senha'])) > 8){
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
        header("Location: http://localhost:81/projeto/Cliente/");
	}elseif(stristr($dados['senha'], "'")) {
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
        header("Location: http://localhost:81/projeto/Cliente/");

    //Consulta na tabela colaborador se o CPF ja esta sendo utilizado
	}else{
    $result_usuario = "SELECT cpf FROM temp_clientes WHERE cpf= '$cpf'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
            $_SESSION['msg'] =     
  "<div class='row d-flex justify-content-center'>
  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Erro!</strong> Este CPF já está sendo utilizado!
  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
  <span aria-hidden='true'>&times;</span>
  </button>
  </div></div>";
   mysqli_close($conn);
            header("Location: http://localhost:81/projeto/Cliente/");
		}
			
  //Consulta na tabela se o email ja está sendo utilizado
		$result_usuario = "SELECT email FROM temp_clientes WHERE email= '$email'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
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
            header("Location: http://localhost:81/projeto/Cliente/");
		}
    }

if(!$erro){

    //Se não retornar nenhum erro de validação executa query de INSERT abaixo
$result_usuario = "INSERT INTO temp_clientes (
nome, sobrenome, nascimento, cpf, sexo, cep, numero, endereco, bairro, cidade, estado, email, senha, telefone, celular, criadoem) VALUES (
'$nome','$sobrenome','$nascimento','$cpf','$sexo','$cep','$num','$endereco','$bairro','$cidade','$estado','$email',MD5('$senha'),'$telefone','$celular',NOW())";
    $resultado_usuario = mysqli_query($conn, $result_usuario); 
        if(mysqli_insert_id($conn)){
  $_SESSION['msgcad'] ="<script type=\"text/javascript\">alert('Você se cadastrou com sucesso na Market Wine');</script>";
			header("Location: http://localhost:81/projeto/Catalago/");
		}else{
           echo "Error: " . $result_usuario . "<br>" . $conn->error;
        }
    }

?>