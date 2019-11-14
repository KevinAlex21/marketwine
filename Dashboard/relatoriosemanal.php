<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
include_once("config/conexao.php");
$conn->set_charset("utf8");
$idColaborador = $_SESSION['usuarioId'];
$my_date = date('d/m/Y', strtotime($date));
//QUERY RETORNA VENDAS DO MÊS
$query = $conn->prepare("SELECT faturamento.*, temp_produtos.* from faturamento
							INNER JOIN temp_produtos ON faturamento.idProduto = temp_produtos.idProduto
                            where faturamento.idColaborador= '$idColaborador' and YEARWEEK(dataVenda, 1) = YEARWEEK(CURDATE(), 1)");

$query->execute();
$res = $query->get_result();


$pagina = "<html>
			<head>
			Relatório de Vendas
			</head>
			<body>
			<h1>Relatório semanal de Vendas </h1>
				<table width='800' border='1' cellspacing='1' cellpadding='1'>
						<thead>
							<tr>
								<th>CÓDIGO</th>
                                <th>NOME</th>
                                <th>SAFRA</th>
								<th>VALOR</th>
								<th>DATA</th>
							</tr>
						</thead>
						<tbody>
				";
foreach ($res as $lista) {
    $data = $lista['safra'];
    $dataVenda = $lista['safra'];
    $pagina .= '<tr>' .
        '<td align="center">' . $lista['idProduto'] . '</td>'
        . '<td align="center"> ' . $lista['nome'] . '</td>'
        . '<td align="center"> ' . date('Y', strtotime($data)) . '</td>'
        . '<td align="center">R$' . $lista['valor'] . '</td>'
        . '<td align="center">' . date('d/m/Y', strtotime($dataVenda)) . '</td>'
        . "<br>";
}

$pagina .= "
				</tr>
				</tbody>
				</table>
				<br><br>
				</body>
				</html>";

$mpdf = new \Mpdf\Mpdf(['tempDir' == '/tmp']);
$mpdf->WriteHTML($pagina);
$mpdf->Output();

// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
