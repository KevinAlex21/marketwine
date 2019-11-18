<?php
session_start (); 
include_once("conexao.php");


 $nome = mysqli_real_escape_string($conn, $_POST['nome']);
 $classe = mysqli_real_escape_string($conn, $_POST['classe']);
 $cor = mysqli_real_escape_string($conn, $_POST['cor']);
 $teor = mysqli_real_escape_string($conn, $_POST['teor']);
 $tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
 $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
 $valor = mysqli_real_escape_string($conn, $_POST['valor']);
 $detalhes = mysqli_real_escape_string($conn, $_POST['descricao']);
 $idProduto = $_POST['idProduto'];
 
 $query = "UPDATE  temp_produtos SET nome='$nome', classe='$classe', cor = '$cor', teor ='$teor', tipo ='$tipo', detalhes='$detalhes',
             valor='$valor', quantidade='$quantidade'
					WHERE idProduto = '$idProduto'";
 $resultado_vinho = mysqli_query($conn, $query);
 
		if(mysqli_affected_rows($conn) !=0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;http://localhost:81/projeto/dashboard/vinhos.php'>
				<script type=\"text/javascript\">
					alert(\"Parabéns seu vinho foi alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:81/projeto/dashboard/vinhos.php'>
				<script type=\"text/javascript\">
					alert(\"Ocorreu um erro ao tentar alterar seu Perfil.\");
				</script>
			";	
		}?>
				
 