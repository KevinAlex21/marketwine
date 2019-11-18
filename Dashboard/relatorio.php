<?php
session_start();
ini_set('max_execution_time', 60);
require_once __DIR__ . '/vendor/autoload.php';
include_once("config/conexao.php");
if (isset($_POST['inicio'])) {
    $dataIni = $_POST['inicio'];
}
if (isset($_POST['fim'])) {
    $dataFim = $_POST['fim'];
}

$idColaborador = $_SESSION['usuarioId'];
$my_date = date('d/m/Y', strtotime($date));
$conn->set_charset("utf8");
$query2 = "SELECT sum(cast(REPLACE(valor, ',', '.') as decimal(8,2))) as faturou from faturamento
 where idColaborador ='$idColaborador' and DATE(dataVenda) BETWEEN DATE ('{$dataIni}') AND DATE ('{$dataFim}') ORDER BY dataVenda DESC";
$result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn) . '/' . $$query2);
while ($faturou = mysqli_fetch_assoc($result2)) {
    $count3 = $faturou['faturou'];
}


//QUERY RETORNA Colaborador logado
$queryClient = "SELECT * FROM TEMP_COLABORADORES  WHERE idColaborador = $idColaborador";
$resultadoClient = mysqli_query($conn, $queryClient);
$row_cliente = mysqli_fetch_assoc($resultadoClient);
//QUERY RETORNA VENDAS DO MÊS
$query = $conn->prepare("SELECT faturamento.*, temp_produtos.*, pedidos.* from faturamento
                        INNER JOIN temp_produtos ON faturamento.idProduto = temp_produtos.idProduto
                        INNER JOIN pedidos ON faturamento.idPedido = pedidos.idPedido
						where faturamento.idColaborador= '$idColaborador' and DATE(dataVenda) BETWEEN DATE ('{$dataIni}') AND DATE ('{$dataFim}')");
$query->execute();
$res = $query->get_result();


$pagina = "<html>
			<head>
			Relatório de Vendas
			<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
			<style>
#customers {
  font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #c60000;;
  color: white;
}
</style>
			</head>
			<body>
			<div class='header'>
  <a href='#default' class='logo'>" . $row_cliente['nome'] . "</a>
  <div class='header-right'>
    <a class='' href=''>CNPJ: " . $row_cliente['cnpj'] . "</a>&nbsp;&nbsp;&nbsp;
    <a href='#contact'>Email: " . $row_cliente['email'] . "</a>&nbsp;&nbsp;&nbsp;&nbsp;
  </div>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src='img/logo1.png' width'15%' height='15%'>
			<h1>Relatório Consolidado de Período</h1>
				<table id='customers'>
						<thead>
							<tr>
								<th>CODIGO</th>
								<th>NOME</th>
								<th>SAFRA</th>
                                <th>VALOR</th>
                                <th>DESTINO</th>
								<th>DATA</th>
							</tr>
						</thead>
						<tbody>
				";
foreach ($res as $lista) {
    $data = $lista['dataVenda'];
    $safra = $lista['safra'];
    $pagina .= '<tr>' .
        '<td align="center">' . $lista['idProduto'] . '</td>'
        . '<td align="center"> ' . $lista['nome'] . '</td>'
        . '<td align="center"> ' . date('Y', strtotime($safra)) . '</td>'
        . '<td align="center">R$' . $lista['valor'] . '</td>'
        . '<td align="center">' . $lista['Estado'] . '</td>'
        . '<td align="center">' . date('d/m/Y', strtotime($data)) . '</td>'
        . "<br>";
}

$pagina .= "
				</tr>
				</tbody>
				</table>
				<br>
				<table id='customers'>
						<thead>
							<tr>
								<th>TOTAL</th>
							</tr>
							</thead>
						<tbody>
						<tr>
				<td>R$" . number_format($count3, 2, ',', '.') . "</td>
				</tr>
				</tbody>
				</table>
				</body>
				</html>";

$mpdf = new \Mpdf\Mpdf(['tempDir' == '/tmp']);
$mpdf->WriteHTML($pagina);
$mpdf->Output();

// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
?>