<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FAQ</title>
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
                    <a href="http://localhost:88/projeto/Catalago/loja.php">
                        <i class="fas fa-store-alt"></i>
                        Loja
                    </a>
                </li>
                <li>
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
                <li class="active">
                    <a href="faq.php">
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
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Perguntas e Respostas Frequentes</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>
                                            <font color="black">O FAQ da Market Wine tem como objetivo oferecer entendimento a perguntas frequentes, e responder com qualidade ao consumidor,
                                                caso elas não atendam a sua necessidade, contate-nos no <a href="http://localhost:88/projeto/Catalago/sac.php">
                                                    <font color="blue"> SAC.</font>
                                                </a>
                                        </strong></br>
                                        </br>
                                        <b> <b>1) Como posso me sentir seguro ao comprar na Market wine?</br></b>
                                            Nossa empresa faz a pré-aprovação de todos os colaboradores que almejam vender em nosso site, tornando 100% seguro.</br>
                                            <b> 2) Em quanto tempo chega meu vinho ?</b></br>
                                            O serviço de entrega pode variar de acordo com a política de entrega da empresa de cada colaborador.</br>
                                            <b> 3) Se o vinho vier errado, eu posso trocar ?</b></br>
                                            O serviço de entrega pode variar de acordo com a política de entrega da empresa de cada colaborador.</br>
                                            <b> 4) Como acompanho a entrega do meu vinho ?</b></br>
                                            O colaborador enviará o código de rastreamento para o email do cliente em até 3 dias úteis.</br>
                                            <b> 5) Quais métodos de pagamento?</b></br>
                                            Através do cartão de crédito/ débito.</br>
                                            <b> 6) A minha empresa pode se tornar colaboradora de vocês?</b></br>
                                            Sim, mas você precisa ter um CNPJ, acesse e efetue seu cadastro <a href="http://localhost:88/projeto/loginCNPJ/">
                                                <font color="blue"> AQUI.</font>
                                            </a></strong></br></br>

                                    </p>
                                    </font>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10 text-center">
                            <div class="card card-user text-center">
                                <form method="POST" action="./config/attfoto.php" enctype="multipart/form-data">
                                    <div class="card-image">
                                        <img src="http://www.spa-francorchamps.be/sites/default/files/image/picto-faq.png" width="100%" height="100%" alt="...">
                                    </div>
                                    <hr>
                                </form>
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