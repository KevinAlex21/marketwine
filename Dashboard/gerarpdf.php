<?php
ini_set('max_execution_time', 60);
session_start();
require_once __DIR__ . '/vendor/autoload.php';
include_once("config/conexao.php");
$conn->set_charset("utf8"); ;
$idPedido = $_GET['idPedido'];
$idCliente = $_SESSION ['clienteId'];

	$queryClient = "SELECT * FROM TEMP_CLIENTES  WHERE idCliente ='". $_SESSION ['clienteId']."'";
	$resultadoClient = mysqli_query($conn, $queryClient);	
	$row_cliente = mysqli_fetch_assoc($resultadoClient) Or die('Erro: ' . mysqli_error($conn) . '  || SQL: ' . $resultadoClient.' Fim '. $queryClient);	

	$result_usuario = "  SELECT pedidos.*, itens_pedido.* from pedidos
							INNER JOIN itens_pedido ON pedidos.idPedido = itens_pedido.idPedido
							where pedidos.idCliente=$idCliente and itens_pedido.idPedido = '$idPedido'";
	$resultado_usuario = mysqli_query($conn, $result_usuario);	
	$row_usuario = mysqli_fetch_assoc($resultado_usuario) Or die('Erro: ' . mysqli_error($conn) . '  || SQL: ' . $resultado_usuario.' Fim '. $result_usuario);
		$total = $row_usuario['total'];	
		$query = $conn->prepare("SELECT pedidos.*, itens_pedido.* from pedidos
							INNER JOIN itens_pedido ON pedidos.idPedido = itens_pedido.idPedido
							where pedidos.idCliente=$idCliente and itens_pedido.idPedido = '$idPedido'");
		$query->execute();
		$res = $query->get_result();

				$pagina = "<html>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<head>
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
			<img src='img/NFee.png' width'100%' height='100%'>
				Numero do Pedido: ".$row_usuario['numPedido']."<br>
				Tipo de Pagamento: ".$row_usuario['tipoPagamento']."<br><br>
				Nome: ".$row_cliente['nome']." ".$row_cliente['sobrenome']."<br>
				CPF: ".$row_cliente['cpf']."<br>
				Endereço:  ".$row_usuario['enderecoEntrega']." Nº:".$row_usuario['enderecoEntrega']."<br>
				Bairro:  ".$row_usuario['Bairro']."<br>
				Cidade:  ".$row_usuario['cidade']."<br>
				Estado:  ".$row_usuario['Estado']."<br>
				
				<h3>Lista de itens:<h3>
				
				<table id='customers'>
						<thead>
							<tr>
								<th>Nome</th>
								<th>Valor</th>
								<th>Quantidade</th>
							</tr>
						</thead>
						<tbody>
				";
				foreach ($res as $lista){
				$pagina .= '<tr>'.
				'<td align="center">'.$lista['nome'].'</td>' 
				.'<td align="center">R$ '.$lista['valorUni']. '</td>' 
				.'<td align="center">'.$lista['quantidade'].'</td>' 
				."<br>";
                }

				$pagina .= "
				</tr>
				</tbody>
				</table>
				<br><br>
				<table id='customers'>
				<thead>
				<tr>
				<th>Total:</th>
				</tr>
				</thead>
				<td>R$".number_format($total, 2, ',', '.')."</td>
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

