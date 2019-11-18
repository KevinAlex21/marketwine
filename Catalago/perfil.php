<?php
session_start();
include_once("config/conexao.php");
$busca_pfil = "SELECT * FROM temp_clientes where  idCliente ='" . $_SESSION['clienteId'] . "'";
$resultado_pfil =  mysqli_query($conn, $busca_pfil) or die(mysqli_error($conn) . '/' . $busca_pfil);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MK - Perfil</title>
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

    <script type="text/javascript">
        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);
                document.getElementById('bairro').value = (conteudo.bairro);
                document.getElementById('cidade').value = (conteudo.localidade);
                document.getElementById('uf').value = (conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>
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
                <li>
                    <a href="pedidos.php">
                        <i class="fas fa-box-open"></i>
                        Meus Pedidos
                    </a>
                <li class="active">
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
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Seu Perfil</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="./config/attperfil.php">
                                        <div class="row">
                                            <?php while ($rows_pfil = mysqli_fetch_assoc($resultado_pfil)) { ?>
                                                <div class="col-md-5 pr-1">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input type="text" class="form-control" disabled="" placeholder="Company" value="<?php echo $rows_pfil['nome']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pl-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email</label>
                                                        <input type="email" class="form-control" placeholder="Email" disabled="" value="<?php echo $rows_pfil['email']; ?>">
                                                    </div>
                                                </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label for="pincode">CEP</label>
                                                    <input type="text" class="form-control" name="cep" id="cep" value="<?php echo $rows_pfil['cep']; ?>""size=" 10" maxlength="9" onblur="pesquisacep(this.value);" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Cidade</label>
                                                    <input name="cidade" type="text" id="cidade" class="form-control" value="<?php echo $rows_pfil['cidade']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Estado</label>
                                                    <input name="uf" type="text" id="uf" class="form-control" value="<?php echo $rows_pfil['estado']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Bairro</label>
                                                    <input name="bairro" type="text" id="bairro" class="form-control" value="<?php echo $rows_pfil['bairro']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Endereço</label>
                                                    <input name="rua" type="text" id="rua" class="form-control" value="<?php echo $rows_pfil['endereco']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-fill pull-right" name="submit">Atualizar Perfil</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <div class="card card-user text-center">
                                <form method="POST" action="./config/attfoto.php" enctype="multipart/form-data">
                                    <div class="card-image">
                                        <img src="https://www.meionorte.com/uploads/imagens/2019/2/18/5641934e-ab33-4f24-b7df-f0057ebc7f43-4ddcf505-53e0-48d4-8f2d-54bbd6eb7caa.jpg" width="100%" height="100%" alt="...">
                                    </div>
                                    <hr>
                                <?php } ?>
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