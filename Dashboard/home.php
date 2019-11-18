<?php
session_start();
include_once("config/conexao.php");
$mes_atual = date("m");
$numero = "SELECT DISTINCT idPedido from faturamento where idColaborador ='" . $_SESSION['usuarioId'] . "'";
$executaNum =  mysqli_query($conn, $numero);
$totalnumVendas = mysqli_num_rows($executaNum);
$estoque = "select SUM(quantidade) AS total  from temp_produtos where idColaborador ='" . $_SESSION['usuarioId'] . "'";
$query = "select count(idColaborador) as vendendo from temp_produtos where idColaborador ='" . $_SESSION['usuarioId'] . "'";
$query1 = "select count(idColaborador) as vendeu from faturamento where idColaborador ='" . $_SESSION['usuarioId'] . "' and YEARWEEK(dataVenda, 1) = YEARWEEK(CURDATE(), 1)";
$query2 = "select sum(cast(REPLACE(valor, ',', '.') * quantidade as decimal(8,2))) as faturou from faturamento where idColaborador ='" . $_SESSION['usuarioId'] . "' and MONTH(dataVenda) = '$mes_atual' group by dataVenda";

$resul = mysqli_query($conn, $estoque);
$result = mysqli_query($conn, $query);
$result1  = mysqli_query($conn, $query1) or die(mysqli_error($conn) . '/' . $$query1);
$result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn) . '/' . $$query2);
while ($daata = mysqli_fetch_array($result1)) {
    $count1 = $daata['vendeu'];
}
while ($data = mysqli_fetch_array($result)) {
    $count = $data['vendendo'];
}
while ($dat = mysqli_fetch_array($resul)) {
    $count2 = $dat['total'];
}
while ($faturou = mysqli_fetch_array($result2)) {
    $count3 = $faturou['faturou'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard</title>
    <!-- Bootstrap CSS CDN -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Market Wine </h3>
                <strong>MW</strong>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="home.php">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="vinhos.php">
                        <i class="pe-7s-wine"></i>
                        Meus Vinhos
                    </a>
                <li>
                    <a href="vendas.php">

                        <i class="fas fa-piggy-bank"></i>
                        Minhas Vendas
                        <span class="badge badge-light"><?php echo $totalnumVendas; ?></span>
                    </a>
                </li>
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        Minha Empresa
                    </a>
                </li>

            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-danger">
                        <i class="fas fa-align-left"></i>

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <?php echo "Bem vindo " . $_SESSION['usuarioNome']; ?> </h2>
                        <ul class="nav navbar-nav ml-auto">
                            <li>
                                <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                                <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
                                    <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                                    <input type="hidden" name="currency" value="BRL" />
                                    <input type="hidden" name="receiverEmail" value="marketwine@outlook.com" />
                                    <input type="hidden" name="iot" value="button" />
                                    <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                                </form>
                                <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
                            </li>
                            <li>
                                <!-- Botão dropleft padrão -->
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Menu
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Links do menu dropleft -->
                                        <!--   <a class="dropdown-item" href="#">Alguma ação</a>
                                    <a class="dropdown-item" href="#">Outra ação</a>
                                    <a class="dropdown-item" href="#">Alguma coisa aqui</a>-->
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="./config/sair.php">Sair</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <p>
                <h1>&nbsp;</h1>
            </p>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="card text-white bg-success mb-3 text-center" style="max-width: 18rem;">
                            <a href="relatoriosemanal.php" target="t_blank">
                                <div class="card-header">Faturamento</div>
                                <div class="card-body">
                                    <i class="fas fa-thumbs-up fa-3x"></i><br><br>
                                    <h5 class="card-title text-center">
                                        Você vendeu <h2><?php echo $count1; ?> </h2>Vinhos essa semana.</h5>
                                </div>
                            </a>
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="card text-white bg-info mb-3 text-center" style="max-width: 18rem;">
                            <a href="vinhos.php">
                                <div class="card-header">Produtos á venda</div>
                                <div class="card-body">
                                    <i class="fas fa-handshake fa-3x"></i></i><br><br>
                                    <h5 class="card-title text-center">Você tem <h2><?php echo $count; ?> </h2>Produtos á Venda</h5>
                                </div>
                            </a>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="card text-white bg-dark mb-3 text-center" style="max-width: 18rem;">
                            <a href="relatorioprodutos.php" target="t_blank">
                                <div class="card-header">
                                    Quantidade
                                </div>
                                <div class="card-body">
                                    <i class="fas fa-wine-glass fa-3x"></i><br><br>
                                    <h5 class="card-title text-center">
                                        Você tem um total de <h2><?php echo $count2; ?> </h2>Vinhos disponíveis.
                                    </h5>
                                </div>
                            </a>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="card border-success mb-3 text-center" style="max-width: 18rem;">
                            <a href="relatoriomensal.php" target="t_blank">
                                <div class="card-header">
                                    <font color="black">Faturamento Mensal</font>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        <i class="fas fa-hand-holding-usd fa-3x"></i><br><br>
                                        <font color="black">Você faturou <h2>R$<?php echo  number_format($count3, 2, ',', '.'); ?> </h2>Neste mês</font>
                                    </h5>
                                </div>
                            </a>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="card text-white bg-warning mb-3 text-center" style="max-width: 18rem;">
                            <div class="card-header"><font color ="black">Relatório de Vendas</div>
                            <div class="card-body">
                                <form method="post" action="relatorio.php">
                                    <h5 class="card-title">Do dia:</h5>
                                    <input type="date" class="form-control" id="inicio" name="inicio"><br>
                                    <h5 class="card-title">Até o dia:</h5>
                                    <input type="date" class="form-control" id="fim" name="fim"><br>
                                    <div class="card-footer bg-transparent border-success"></div>
                                    <button type="submit" target="t_blank" class="btn btn-primary ">Gerar </a></button>
                            </font></div>

                            </form>
                            <p class="card-text"></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    <script src="js/jquery-3.3.1.slim.min.js"> </script>
    <script src="js/popper.min.js"> </script> <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>