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
        $result_usuario = "SELECT * FROM temp_colaboradores WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
   
   //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        if(isset($resultado)){
        $_SESSION ['usuarioId'] = $resultado['idColaborador'];
        $_SESSION ['usuarioEmail'] = $resultado['email'];
        $_SESSION ['usuarioNome'] = $resultado['nome'];
        
        header ('Location: ../meuDash/teste.php');
        exit ();    
    //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
    //redireciona o usuario para a página de login
        }else{
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: index.php");
        exit ();
    }

?>