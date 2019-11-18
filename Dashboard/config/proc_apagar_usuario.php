<?php
session_start();
include_once("conexao.php");
$idProduto = filter_input(INPUT_GET, 'idProduto', FILTER_SANITIZE_NUMBER_INT);
if(!empty($idProduto)){
	$result_usuario = "DELETE FROM temp_produtos WHERE idProduto='$idProduto'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	if(mysqli_affected_rows($conn)){
		$_SESSION['msg'] = "<p style='color:green;'>Item apagado com sucesso</p>";
		header("Location: http://localhost:81/projeto/dashboard/vinhos.php");
	}else{
		
		$_SESSION['msg'] = "<p style='color:red;'>Erro o Item não foi apagado com sucesso</p>";
		header("Location: http://localhost:81/projeto/dashboard/vinhos.php");
	}
}else{	
	$_SESSION['msg'] = "<p style='color:red;'>Necessário selecionar um item</p>";
	header("Location: http://localhost:81/projeto/dashboard/vinhos.php");
}
