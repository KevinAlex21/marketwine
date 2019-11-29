<?php
//Incluindo a conexão com banco de dados   

//Usa $_POST para pegar as informações digitadas no formulário.
$login = $_POST['usuario'];
$senha = $_POST['senha'];

//Irá comparar as informações que foram digitadas no formulário com o login e senha corretos que estão no formulário.
if($login != administradorwine || $senha != 12345 ) {
echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:81/projeto/admin/'>
				<script type=\"text/javascript\">
					alert(\"Dados Incorretos.\");
				</script>
			";
//Se for iguais os dados, corretos, aparece a página:

}else{
    header('Location:  http://localhost:81/projeto/admin/colaboradores.php');
    
}
