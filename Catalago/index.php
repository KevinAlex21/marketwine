<?php
session_start();
include_once("config/conexao.php");

//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
//Selecionar todos os vinhos da tabela.
$result_vinho = "SELECT * FROM temp_produtos";
$resultado_vinho = mysqli_query($conn, $result_vinho);
//Contar o total de vinhos
$total_vinhos = mysqli_num_rows($resultado_vinho);

//Seta a quantidade de vinhos por pagina
$quantidade_pg = 10;

//calcular o número de pagina necessárias para apresentar os vinhos
$num_pagina = ceil($total_vinhos / $quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os vinhos a serem apresentado na página
$result_vinhos = "SELECT * FROM temp_produtos limit $incio, $quantidade_pg";
$resultado_vinhos = mysqli_query($conn, $result_vinhos);
$total_vinhos = mysqli_num_rows($resultado_vinhos);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Catalago de Vinhos</title>
    <!-- Bootstrap CSS CDN -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/95473a4750.js" crossorigin="anonymous"></script>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>



</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <h3>Categorias</h3>

            </div>

            <ul class="list-unstyled components text-center">

                <form class="form-inline text-center" method="GET" action="pesquisar.php">
                    <input class="form-control mr-sm-2 text-center" name="pesquisar" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
                </form>
                <p>
                    <li class="active">
                        <a href="teste.php">
                            <i class="fas fa-wine-glass-alt"></i>
                            Tipos
                        </a>
                    </li>
                    <p>
                        <li>
                            <a href="vinhos.php">
                                <i class="fas fa-wine-bottle"></i>
                                Classes
                            </a>
                            <p>
                        <li>
                            <a href="#">
                                <i class="fas fa-wine-glass-alt"></i>
                                Teores de Açucar
                            </a>
                        </li>
                        <p>
                            <li>
                                <a href="#">
                                    <i class="fas fa-question"></i>
                                    FAQ
                                </a>
                            </li>
                            <p>
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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <h2> </h2>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <!-- Botão para acionar modal -->
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ExemploModalCentralizado">
                                        <i class="fas fa-user"></i>
                                        Entre ou Cadastre-se
                                    </button>
                                </a>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost:88/projeto/LoginCNPJ/">
                                    <button type="button" class="btn btn-danger"><i class="fas fa-user-tag "></i> Seja um COLABORADOR</button>
                                </a>
                            </li>
                            <!-- Modal do botão acesse-->
                            <div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="TituloModalCentralizado">Login</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="./config/valida.php">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Endereço de email</label>
                                                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Seu email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Senha</label>
                                                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
                                                </div>
                                                <button type="submit" class="btn btn-success">Entrar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <a href="http://localhost:88/projeto/Cliente/" onclick="window.close();" class="btn btn-info">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Cadastre-se aqui!
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>

            </nav>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            if (isset($_SESSION['msgcad'])) {
                echo $_SESSION['msgcad'];
                unset($_SESSION['msgcad']);
            }
            ?>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-13">
                            <div class="row text-center">
                                <?php while ($rows_vinhos = mysqli_fetch_assoc($resultado_vinhos)) { ?>
                                    <span class="border">
                                        <div class="card" style="width: 14rem;">
                                            <img class="card-img-top" <?php echo '
													<img  src="data:image;base64,' . $rows_vinhos['picture'] . '"></div'; ?>>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><?php echo $rows_vinhos['nome']; ?></h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $rows_vinhos['tipo']; ?></h6>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><?php echo $rows_vinhos['cor']; ?></li>
                                                </ul>
                                                <li class="list-group-item"><?php echo $rows_vinhos['valor']; ?></li>
                                                </ul>
                                                <hr>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ExemploModalCentralizado">Comprar
                                                    <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </button>
                                                <a href="#" class="btn btn-info btn-sm ">Info
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <hr>
                                            </div>
                                    </span>
                                    <br />
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
                <?php
                //Verificar a pagina anterior e posterior
                $pagina_anterior = $pagina - 1;
                $pagina_posterior = $pagina + 1;
                ?>
                <div class="container text-center">
                    <div class="row text-center">
                        <div class="col-lg-12 offset-lg-5 py-5">
                            <ul class="pagination mx-auto text-center">
                                <li class="page-item">
                                    <?php
                                    if ($pagina_anterior != 0) { ?>
                                        <a class="page-link" href="index.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">

                                            <span aria-hidden="true">«</span>
                                        <?php }  ?>
                                        <span class="sr-only">Previous</span>
                                        </a>

                                </li>
                                <?php
                                //Apresentar a paginacao
                                for ($i = 1; $i < $num_pagina + 1; $i++) { ?>
                                    <li class="page-item">
                                    <li><a class="page-link" href="index.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php } ?>

                                <li class="page-item">
                                    <?php
                                    if ($pagina_posterior <= $num_pagina) { ?>
                                        <a class="page-link" href="index.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        <?php } else { ?>
                                            <span class="sr-only">Next</span>
                                        <?php }  ?>
                                        </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>






            <!-- Bootstrap JS -->
            <script src="js/jquery-3.3.1.slim.min.js"> </script>
            <script src="js/popper.min.js"> </script>


            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
            </script>


</body>

</html>