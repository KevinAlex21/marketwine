<?php
session_start();
include_once("config/conexao.php");
$busca_pfil = "SELECT * FROM pedidos where  idCliente ='" . $_SESSION['clienteId'] . "'";
$resultado_pfil =  mysqli_query($conn, $busca_pfil) or die(mysqli_error($conn) . '/' . $$busca_pfil);
$idPedido = $_GET['idPedido'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Pedidos</title>
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
                <h3>Market Wine</h3>
                <strong>MW</strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="http://localhost:81/projeto/Catalago/loja.php">
                        <i class="fas fa-store-alt"></i>
                        Loja
                    </a>
                </li>
                <li class="active">
                    <a href="pedidos.php">
                        <i class="fas fa-box-open"></i>
                        Meus Pedidos
                    </a>
                <li>
                    <a href="perfil.php">
                        <i class="pe-7s-user"></i>
                        Meus Dados
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-question"></i>
                        FAQ
                    </a>
                </li>
                <li>
                    <a href="sac.php">
                        <i class="fas fa-paper-plane"></i>
                        SAC
                    </a>
                </li>
            </ul>

        </nav>

        <!-- Barra de navegação  -->
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
                        <ul class="nav navbar-nav ml-auto">
                            <!-- Botão dropleft padrão -->
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Links do menu dropleft -->
                                    <a class="dropdown-item" href="loja.php">Voltar para Loja</a>
                                    <a class="dropdown-item" href="perfil.php">Meus Dados</a>
                                    <a class="dropdown-item" href="pedidos.php">Meus Pedidos</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./config/sair.php">Sair</a>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row text-center">
                <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Pedidos</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Pagamento</th>
                                <th class="text-center">NF-e</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($pfil = mysqli_fetch_assoc($resultado_pfil)) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $pfil['numPedido']; ?></td>
                                    <td class="text-center"><?php echo $pfil['dataCompra']; ?></td>
                                    <td class="text-center"><?php echo $pfil['tipoPagamento']; ?></td>
                                    <td>
                                        <a href="gerarpdf.php?idPedido=<?php echo $pfil['idPedido']; ?>" target="t_blank">
                                            <button type="button" class="btn btn-primary">Gerar </a></button>

                                        </a>
                                    <?php } ?>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
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

        <!-- JS -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/main.js"></script>
</body>

</html>