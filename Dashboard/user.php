<?php
session_start();
include_once("config/conexao.php");
$busca_pfil = "SELECT * FROM temp_colaboradores where  idColaborador ='" . $_SESSION['usuarioId'] . "'";
$resultado_pfil =  mysqli_query($conn, $busca_pfil) or die(mysqli_error($conn) . '/' . $$busca_pfil);
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
                <h3>Market Wine Dasbord</h3>
                <strong>MW</strong>
            </div>

            <ul class="list-unstyled components">

                <li>
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
                <li class="active">
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        Minha Empresa
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
                        <h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <?php echo "Bem vindo <span style='color:red;'>" . $_SESSION['usuarioNome']; ?></span> Este é o seu Perfil </h2>
                        <ul class="nav navbar-nav ml-auto">
                            <!-- Botão dropleft padrão -->
                            <div class="btn-group dropleft">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Links do menu dropleft -->

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
                                                        <label>Nome da Empresa</label>
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Sobre a Empresa</label>
                                                    <textarea rows="4" cols="80" name="sobre" id="sobre" class="form-control" placeholder="Escreva sobre sua empresa" value=""> <?php echo $rows_pfil['descricao']; ?></textarea>
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
                                        <img src="http://www.vinhoetc.com.br/wp-content/uploads/2015/02/capa1.jpg" width="100%" height="100%" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <div class="author">
                                            <a href="#">
                                                <img class="avatar border-gray" <?php echo '
                                    <img  height="100%" width="100%" src="data:image;base64,' . $rows_pfil['picture'] . '"></div></div>'; ?> <h5 class="title text-center"><?php echo " " . $_SESSION['usuarioNome']; ?></h5>
                                            </a>
                                            <p class="description">

                                                <input type="file" accept="image/*" class="form-control" name="my_picture">
                                                <button type="submit " class="btn btn-info btn-fill" name="submit">Atualizar Foto</button>
                                            </p>
                                        </div>
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