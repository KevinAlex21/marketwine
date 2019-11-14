<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
include_once("config/conexao.php");
$conn->set_charset("utf8");
$idColaborador = $_SESSION['usuarioId'];
$my_date = date('d/m/Y', strtotime($date));
//QUERY RETORNA VENDAS DO MÊS
$query = $conn->prepare("SELECT * from temp_produtos");
$query->execute();
$res = $query->get_result();


$pagina = "<html>
			<head>
			Relatório Mercadoria
			</head>
			<body>
			<h1>Relatório de Vinhos registrados </h1>
				<table width='800' border='1' cellspacing='1' cellpadding='1'>
						<thead>
							<tr>
								<th>COD PRODUTO</th>
								<th>NOME</th>
								<th>SAFRA</th>
                                <th>VALOR</th>
                                <th>QUANTIDADE</th>
                                <th>CLASSE</th>
                                <th>COR</th>
                                <th>TEOR</th>
                                <th>TIPO</th>
								<th>CRIADO EM</th>
							</tr>
						</thead>
						<tbody>
				";
foreach ($res as $lista) {
    $data = $lista['criadoem'];
    $safra = $lista['safra'];
    $pagina .= '<tr>' .
        '<td align="center">' . $lista['idProduto'] . '</td>'
        . '<td align="center"> ' . $lista['nome'] . '</td>'
        . '<td align="center"> ' . date('Y', strtotime($safra)) . '</td>'
        . '<td align="center">R$' . $lista['valor'] . '</td>'
        . '<td align="center">' . $lista['quantidade'] . '</td>'
        . '<td align="center">' . $lista['classe'] . '</td>'
        . '<td align="center">' . $lista['cor'] . '</td>'
        . '<td align="center">' . $lista['teor'] . '</td>'
        . '<td align="center">' . $lista['tipo'] . '</td>'
        . '<td align="center">' . date('d/m/Y', strtotime($data)) . '</td>'
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
