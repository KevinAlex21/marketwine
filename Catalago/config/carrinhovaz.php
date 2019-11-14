<?php
	session_start();
	
	unset(

		$_SESSION["shopping_cart"]
	);
	
	$_SESSION['logindeslogado'] = "Deslogado com sucesso";
	//redirecionar o usuario para a página de login
	echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:88/projeto/Catalago/loja.php'>
				<script type=\"text/javascript\">
					alert(\"Seu Carrinho Está Vazio.\");
				</script>
";	
?>