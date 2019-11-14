<?php
session_start ();
ob_start();

$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
	include_once 'conexao.php';
	$dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
	$erro = false;
	
	$dados_st = array_map('strip_tags', $dados_rc);
	$dados = array_map('trim', $dados_st);
	
	if (preg_match('/(\d)\1{13}/', $cnpj)){
		$erro = true;
		$_SESSION['msg'] = "CNPJ Inválido!";
	}elseif((strlen($dados['senha'])) < 6){
		$erro = true;
		$_SESSION['msg'] = "A senha deve ter no minímo 6 caracteres";
	}elseif(stristr($dados['senha'], "'")) {
		$erro = true;
		$_SESSION['msg'] = "Caracter ( ' ) utilizado na senha é inválido";
	}else{
		$result_usuario = "SELECT cnpj FROM temp_colaboradores WHERE cnpj='". $dados['cnpj'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "Este CNPJ já está sendo utilizado";
		}
		
		$result_usuario = "SELECT id FROM temp_colaboradores WHERE email='". $dados['email'] ."'";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
			$erro = true;
			$_SESSION['msg'] = "Este e-mail já está cadastrado";
		}
	}
    
    //var_dump($dados);
	if(!$erro){
		//var_dump($dados);
	//	$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
    set_time_limit(90);
    

  //Se não retornar nenhum erro de validação executa query de INSERT abaixo
		$result_usuario = "INSERT INTO temp_colaboradores 
    (nome, cnpj, email, senha, created) VALUES ('$nome','$cnpj','$email',MD5('$senha'), NOW())";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if(mysqli_insert_id($conn)){
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
		  <p class='mb-0'>Em breve você receberá um email de confirmação</p>
		</div></div>";
            mysqli_close($conn);
					header("Location: loginCola.php");	
		}else{
           echo "Error: " . $result_usuario . "<br>" . $conn->error;
           
		} 
  }
  }
    
?>