<?php include_once("config/conexao.php");
$idProduto = $_GET['idProduto'];
$result_vinhos = "SELECT * FROM temp_produtos WHERE idProduto='$idProduto'";
$resultado_vinhos = mysqli_query($conn, $result_vinhos);
$row = mysqli_fetch_assoc($resultado_vinhos);
$my_date = date('d/m/Y', strtotime($date));
$query = "SELECT * FROM temp_colaboradores WHERE idColaborador = '" . $row['idColaborador'] . "'";
$roda = mysqli_query($conn, $query);
$row2 = mysqli_fetch_assoc($roda);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar pagina com abas</title>
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
                    </a>;
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
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost:81/projeto/catalago/loja.php">
                                    <button type="button" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Voltar</button>
                                </a>
                            </li>
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
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row text-center">


                                <span class="border">
                                    <div class="card" style="width: 20rem;">
                                        <form method="post" action="">
                                            <input type="hidden" name="nome" value="<?php echo $row['nome']; ?>" />
                                            <img class="card-img-top" <?php echo '
													<img  src="data:image;base64,' . $row['picture'] . '"></div>'; ?> <div class="card-body">
                                            <h5 class="card-title text-center"><?php echo $row['nome']; ?></h5>

                                            <p class="card-text"><?php echo $row['classe']; ?></p>
                                            <p class="card-text"><?php echo $row['tipo']; ?></p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">R$<?php echo number_format($row['valor'], 2, ',', '.'); ?></li>
                                            </ul>

                                            <hr>
                                            </button>
                                            <a href="detalhes.php?idProduto=<?php echo $row['idProduto']; ?>" class="btn btn-info ">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </form>
                                        <hr>
                                    </div>
                                </span>
                                <br />
                                <div class="col-md-8 text-center">
                                    <div class="card card-user text-center">
                                        <div class="card-header">
                                            Detalhes
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['nome']; ?></h5>
                                            <p class="card-text"><font color = "black"><?php echo $row['detalhes']; ?><br><br>
                                                Vinho com a classe de <?php echo $row['classe']; ?>,
                                                com a cor <?php echo $row['cor']; ?>
                                                com um teor ótimo do estilo <?php echo $row['teor']; ?>,
                                                de origem <?php echo $row['tipo']; ?>.
                                                Com a safra de <?php $safra = $row2['safra']; echo date('Y', strtotime($safra)) ?>.
                                            </p>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="col-md-13 text-center">
                                        <div class="card card-user text-center">
                                            <div class="card-header">
                                                Vendio e Entregue por:
                                            </div>
                                            <div class="card-body">
                                                <div class="author">
                                                    <a href="#">
                                                        <img class="avatar border-gray" <?php echo '
                                    <img  height="30%" width="30%" src="data:image;base64,' . $row2['picture'] . '"></div></div>'; ?> <h5 class="title text-center"><?php echo " " . $_SESSION['usuarioNome']; ?></h5>
                                                    </a>
                                                    <h4 class="card-title"><?php echo $row2['nome']; ?></h4>
                                                    <p class="description"><?php echo $row2['descricao']; ?> </p>
                                                    <p class="description">
                                                        Empresa Localizada na <?php echo $row2['endereco']; ?> No bairro de <?php echo $row2['bairro']; ?>
                                                        na cidade <?php echo $row2['cidade'] ?>,&nbsp;<?php echo $row2['estado']; ?>&nbsp;CEP - <?php echo $row2['cep']; ?><br>
                                                        Em casos de Troca por favor, contate-nos via Email:&nbsp;<?php echo $row2['email']?> </font>
                                                    </p>
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

                        <!-- JS -->
                        <script src="vendor/jquery/jquery.min.js"></script>
                        <script src="js/main.js"></script>
</body>

</html>