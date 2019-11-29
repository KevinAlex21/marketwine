<?php 
session_start (); 
include_once("conexao.php");

 if (getimagesize($_FILES['my_picture']['tmp_name']) == false) {
    echo "error";
} else {
    $image = addslashes($_FILES['my_picture']['tmp_name']);
    $name  = addslashes($_FILES['my_picture']['tmp_name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);
}
 $idProduto = $_POST['idProduto'];
$result_usuario =  "UPDATE  temp_produtos SET picture = '$image' WHERE idProduto = '$idProduto'";
$resultado_perfil = mysqli_query($conn, $result_usuario);


		if(mysqli_affected_rows($conn) !=0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;http://localhost:81/projeto/dashboard/user.php'>
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
