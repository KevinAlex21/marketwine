<?php
session_start (); 
include_once("conexao.php");


 $cep = mysqli_real_escape_string($conn, $_POST['cep']);
 $endereco = mysqli_real_escape_string($conn, $_POST['rua']);
 $bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
 $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
 $estado = mysqli_real_escape_string($conn, $_POST['uf']);
 $detalhes = mysqli_real_escape_string($conn, $_POST['sobre']);
 $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
 $celular = mysqli_real_escape_string($conn, $_POST['celular']);
 $numero = mysqli_real_escape_string($conn, $_POST['numero']);
 
 $result_usuario = "UPDATE  temp_colaboradores SET telefone='$telefone', celular='$celular', numero='$numero', cep='$cep', endereco='$endereco', bairro = '$bairro', cidade ='$cidade', estado ='$estado', descricao='$detalhes'
					WHERE idColaborador = '". $_SESSION ['usuarioId']."'";
 $resultado_perfil = mysqli_query($conn, $result_usuario);
 
		if(mysqli_affected_rows($conn) !=0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:81/projeto/dashboard/user.php'>
				<script type=\"text/javascript\">
					alert(\"Parabéns seu perfil foi alterado com Sucesso.\");
				</script>
			";	
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=hhttp://localhost:81/meuDash/user.php'>
				<script type=\"text/javascript\">
					alert(\"Ocorreu um erro ao tentar alterar seu Perfil.\");
				</script>
			";	
		}?>
				
 