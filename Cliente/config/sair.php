<?php
	session_start();
	
	unset(
		$_SESSION['idCliente'],
		$_SESSION['clienteNome'],
		$_SESSION['clienteEmail'],
		$_SESSION['clienteSenha']
	);
	
	$_SESSION['logindeslogado'] = "Deslogado com sucesso";
	//redirecionar o usuario para a página de login
	echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:81/projeto/Catalago/'>
				<script type=\"text/javascript\">
					alert(\"Você encerrou sua sessão, Refaça Login para continuar.\");
				</script>
			";	