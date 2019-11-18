<?php
    session_start();
//Incluindo a conexão com banco de dados   
    include_once("conexao.php");    

//O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['email'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['email']);
        $senha = mysqli_real_escape_string($conn, $_POST['senha']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = md5($senha);
    }
//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM temp_clientes WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultad = mysqli_fetch_assoc($resultado_usuario);
   
//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        if(isset($resultad)){
        $_SESSION ['clienteId'] = $resultad['idCliente'];
        $_SESSION ['clienteEmail'] = $resultad['email'];
        $_SESSION ['clienteNome'] = $resultad['nome'];
        header ('Location:  http://localhost:81/projeto/Catalago/loja.php');
        exit ();
//Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
//redireciona o usuario para a página de login
        }else{
            //Váriavel global recebendo a mensagem de erro
           $_SESSION['msg'] = 
                "<div class='row d-flex justify-content-center'>
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Erro!</strong>Cliente não existe
                <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div></div>";
            header("Location: http://localhost:81/projeto/Catalago/");
        exit ();
    }

?>