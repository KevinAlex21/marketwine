<?php
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
        <div class="login-reg-panel">
                <div class="white-panel">
                    <div class="login-show">
                    <form action="./config/valida.php" method="POST">
                        <h2>LOGIN ADMINISTRADOR</h2>
                        <input type="text" id='usuario' name="usuario" placeholder="Usuario">
                        <input type="password" name="senha"id='senha' placeholder="Senha">
                        <input class="btn btn-primary" name= "btnCadUsuario" type="submit" value="Entrar">
                        </form>
                          <p>
                    </div>
                   
                    </div>
                </div>
        </div>
            <script type="text/javascript" src="js/meuarquivo.js"></script>
    </body>
</html>