<?php
session_start();
ob_start ();

?>
<!DOCTYPE html>
<html>
  <title></title>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1">
    <link rel="stylesheet" type ="text/css" href="css/bootstrap.min.css">
    <link href="css/stylesheet.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
        <?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			if(isset($_SESSION['msgcad'])){
				echo $_SESSION['msgcad'];
				unset($_SESSION['msgcad']);
			}
		?>
        <div class="login-reg-panel">
                <div class="login-info-box">
                    <h2>Já tem uma conta?</h2>
                    <p>Acesse aqui!</p>
                    <label id="label-register" for="log-reg-show">Login</label>
                    <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
                </div>
                <div class="register-info-box">
                    <h2>Ainda não é um colaborador?</h2>
                    <p>Cadastre-se e venda seus vinhos!</p>
                    <label id="label-login" for="log-login-show">Registre-se</label>
                    <input type="radio" name="active-log-panel" id="log-login-show" >
                </div>
                <div class="white-panel">
                    <div class="login-show">
                    <form action="./config/valida.php" method="POST">
                        <h2>LOGIN</h2>
                        <input type="text" name="email" placeholder="Email/CNPJ">
                        <input type="password" name="senha" placeholder="Senha">
                        <input class="btn btn-primary" name= "btnCadUsuario" type="submit" value="Entrar">
                        <a href="">Esqueceu sua senha?</a>
                        </form>
                          <p>
                    </div>
                    <div>
                     <form action="./config/processa.php" method="POST">
                    <div class="register-show">
                            <h2>Cadastre-se</h2>
						<input type="text" name='nome' placeholder="Nome" required>
                        <input type="text" name='cnpj' placeholder="CNPJ" required>
                        <input type="text" name='email' placeholder="Email">
                        <input type="password" name='senha' placeholder="Senha">
                        <input class="btn btn-primary" type="submit" value="Cadastrar">
                    </form>
                        </div>
                    </div>
                </div>
        </div>
            <script type="text/javascript" src="js/meuarquivo.js"></script>
    </body>
</html>