<?php
	session_start();
	
	unset(
		$_SESSION['usuarioNome'],
		$_SESSION['usuarioEmail'],
		$_SESSION['usuarioSenha'],
		$_SESSION["shopping_cart"]
	);
	
	$_SESSION['logindeslogado'] = "Deslogado com sucesso";
	//redirecionar o usuario para a página de login
	echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:88/projeto/loginCNPJ/'>
				<script type=\"text/javascript\">
					alert(\"Você encerrou sua sessão, Refaça Login para continuar.\");
				</script>
			";	