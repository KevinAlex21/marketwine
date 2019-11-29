<?php
session_start();
?>
<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<html>
  <title></title>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale-1">
    <link rel="stylesheet" type ="text/css" href="css/bootstrap.min.css">
    <link href="css/stylesheet1.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <?php
        if(isset($_SESSION['msgn'])){
				echo $_SESSION['msgn'];
				unset($_SESSION['msgn']);
      }
      ?>
        <div class="login-reg-panel">
                <div class="white-panel">
                    <div class="login-show">
                    <form action="./config/validaCliente.php" method="POST">
                        <h2>Alterar Senha Cliente</h2>
                        <input type="text" id='email' name="email" placeholder="Email">
                        <input type="text" name="cpf"id='cpf' placeholder="CPF">
                        <input type="password" name="senha" id='senha' placeholder="Nova Senha">
                        <input class="btn btn-primary" name= "btnCadUsuario" type="submit" value="Alterar">
                        </form>
                          <p>
                    </div>
                   
                    </div>
                </div>
        </div>
            <script type="text/javascript" src="js/meuarquivo.js"></script>
    </body>
</html>