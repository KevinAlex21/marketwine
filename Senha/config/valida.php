<?php
    session_start();
  
        //Incluindo a conexão com banco de dados   
    include_once("conexao.php");    


        $usuario =  $_POST['email'];
        $cnpj = $_POST['cnpj'];
        $senha = filter_input (INPUT_POST, 'senha', FILTER_SANITIZE_STRING);;

    
    //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM temp_colaboradores WHERE email = '$usuario' && cnpj = '$cnpj' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario)  or die(mysqli_error($conn) . '/' . $qry);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
   
   //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        if(isset($resultado)){
		   $qry = "update temp_colaboradores set senha= MD5('$senha') where cnpj =  '$cnpj'";
		   $result_qry = mysqli_query($conn, $qry);
		   if(mysqli_affected_rows($conn) !=0) {
        	$_SESSION['msgupd'] = 
                "<div class='row d-flex justify-content-center'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Erro!</strong>Senha Alterada
                <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div></div>";
        header("Location: http://localhost:81/projeto/loginCNPJ/");
		exit ();    
		   }
    //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    //redireciona o usuario para a página de login
        }else{
            //Váriavel global recebendo a mensagem de erro
           $_SESSION['msgn'] = 
                "<div class='row d-flex justify-content-center'>
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Erro!</strong> Dados Incorretos.
                <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div></div>";
            header("Location: http://localhost:81/projeto/Senha/");
        exit ();
    }

?>