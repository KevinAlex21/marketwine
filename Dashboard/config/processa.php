<?php
session_start();
include_once("conexao.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$select_classe = $_POST['select_classe'];
$select_cor = $_POST['select_cor'];
$select_teor = $_POST['select_teor'];
$select_tipo = $_POST['select_tipo'];
$idUsuario = $_SESSION['usuarioId'];
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_STRING);
$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);
$detalhes = filter_input(INPUT_POST, 'detalhes', FILTER_SANITIZE_STRING);
$safra = filter_input(INPUT_POST, 'safra', FILTER_SANITIZE_STRING);


if (getimagesize($_FILES['my_picture']['tmp_name']) == false) {
    echo "error";
} else {
    $image = addslashes($_FILES['my_picture']['tmp_name']);
    $name  = addslashes($_FILES['my_picture']['tmp_name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);
}
$result_usuario = "INSERT INTO temp_produtos (
		nome,
        classe,
        cor,
        teor,
        tipo,
        quantidade,
		valor, 
		detalhes,
        picture,
        idColaborador,
        safra,
        criadoEm
		) VALUES (
        '$nome',
        '$select_classe',
        '$select_cor',
        '$select_teor',
       	'$select_tipo',
        '$quantidade',
		'$valor', 
		'$detalhes',
        '$image',
        '$idUsuario',
        '$safra',
        now()
		)";
$resultado_usuario = mysqli_query($conn, $result_usuario) or die('Erro ao Cadastrar produto: erro ' . mysqli_error($conn) . '/' . $result_usuario);

if (mysqli_insert_id($conn)) {
    $_SESSION['msgcad'] = "<script type=\"text/javascript\">alert('Você cadastrou um Vinho !');</script>";
    header("Location: http://localhost:81/projeto/dashboard/vinhos.php");
} else {
    echo "erro ao cadastrar";
}
