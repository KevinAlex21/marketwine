<?php
session_start();
include_once("config/conexao.php");
$result_vinho = "SELECT * FROM temp_produtos where  idColaborador ='" . $_SESSION['usuarioId'] . "'";
$resultado_vinho =  mysqli_query($conn, $result_vinho) or die(mysqli_error($conn) . '/' . $$result_vinho);
$idProduto = $_GET['idProduto'];


$numero = "SELECT DISTINCT idPedido from faturamento where idColaborador ='" . $_SESSION['usuarioId'] . "'";
$executaNum =  mysqli_query($conn,$numero);
$totalnumVendas = mysqli_num_rows($executaNum);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MK - Meus Vinhos</title>
    <!-- js !-->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
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
        <!-- Inicio do Sidebar (barra lateral) -->
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Market Wine </h3>
                <strong>MW</strong>
            </div>

            <ul class="list-unstyled components">

                <li>
                    <a href="home.php">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li class="active">
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
        <!-- Fim do SideBar -->
        </nav>

        <!-- Inicio da Barra do topo   -->
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
                        <?php
                        if (isset($_SESSION['msgcad'])) {
                            echo $_SESSION['msgcad'];
                            unset($_SESSION['msgcad']);
                        }
                        ?>
                        <h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <?php echo "Bem vindo <span style='color:red;'>" . $_SESSION['usuarioNome']; ?> </span> </h2>
                        <ul class="nav navbar-nav ml-auto">
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
                        </ul>
                    </div>
                </div>
                <!-- Fim da barra do topo -->
            </nav>

            <div class="container theme-showcase" role="main">
                <div class="page-header">
                    <h1>Meus Vinhos</h1>
                </div>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <!--Botao cadastar!-->
                <div class="pull-right">
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModalCad">Cadastrar</button>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Nome do Vinho</th>
                                    <th class="text-center">R$</th>
                                    <th class="text-center">Quantidade</th>
                                    <th class="text-center">Ilustração</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rows_vinhos = mysqli_fetch_assoc($resultado_vinho)) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $rows_vinhos['idProduto']; ?></td>
                                        <td class="text-center"><?php echo $rows_vinhos['nome']; ?></td>
                                        <td class="text-center"><?php echo $rows_vinhos['valor']; ?></td>
                                        <td class="text-center"><?php echo $rows_vinhos['quantidade']; ?></td>
                                        <td class="text-center"><?php echo '
                                    <img  height="200" width="200" src="data:image;base64,' . $rows_vinhos['picture'] . '"></div></div>'; ?></td>
                                        <td>
                                            <a href="editar.php?idProduto=<?php echo $rows_vinhos['idProduto']; ?>">
                                                <button type="button" class="badge badge-warning pull-right">Editar</button>
                                            </a>
                                            <?php echo "<a href='./config/proc_apagar_usuario.php?idProduto=" . $rows_vinhos['idProduto'] . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>
								    <button type='button' class='badge badge-danger pull-right'>Apagar</button>
                                    </a><br><hr>"; ?>
                                        <?php } ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    ...
                </div>
            </div>
        </div>

        <!-- Janela(modal) Cadastrar!-->

        <div class="modal fade" id="myModalCad<?php echo $rows_vinhos['idProduto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar</button>
                        <h4 class="modal-title text-center" id="myModalLabel">Cadastrar Vinho</h4>
                    </div>
                    <div class="modal-body">


                        <form method="POST" action="config/processa.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Nome:</label>
                                <input name="nome" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="recipient-classe">Classe</label>
                                    </div>
                                    <select name="select_classe" class="custom-select">
                                        <option>Selecione</option>
                                        <?php
                                        $result_clas = "SELECT * FROM pop_classe";          //Faz consulta na tabela
                                        $resultado_clas = mysqli_query($conn, $result_clas); //Grava resultado da consulta
                                        while ($row_clas = mysqli_fetch_assoc($resultado_clas)) { ?>
                                            <!--Se retornar alguma linha do banco aparece no combobox -->
                                            <option value="<?php echo $row_clas['nome']; ?>"><?php echo $row_clas['nome']; ?></option> <?php #O que for selecionado será o q vai ser inserido
                                                                                                                                        }
                                                                                                                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="recipient-cor">Cor</label>
                                    </div>
                                    <select name="select_cor" class="custom-select">
                                        <option>Selecione</option>
                                        <?php
                                        $result_cor = "SELECT * FROM pop_cor";
                                        $resultado_cor = mysqli_query($conn, $result_cor);
                                        while ($row_cor = mysqli_fetch_assoc($resultado_cor)) { ?>
                                            <option value="<?php echo $row_cor['nome']; ?>"><?php echo $row_cor['nome']; ?></option> <?php
                                                                                                                                        }
                                                                                                                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="recipient-teor">Teor</label>
                                    </div>
                                    <select class="custom-select" name="select_teor">
                                        <option>Selecione</option>
                                        <?php
                                        $result_teor = "SELECT * FROM pop_teor";
                                        $resultado_teor = mysqli_query($conn, $result_teor);
                                        while ($row_teor = mysqli_fetch_assoc($resultado_teor)) { ?>
                                            <option value="<?php echo $row_teor['nome']; ?>"><?php echo $row_teor['nome']; ?></option> <?php
                                                                                                                                        }
                                                                                                                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="recipient-tipo">Origem</label>
                                    </div>
                                    <select class="custom-select" name="select_tipo">
                                        <option>Selecione</option>
                                        <?php
                                        $result_tipo = "SELECT * FROM pop_tipo";
                                        $resultado_tipo = mysqli_query($conn, $result_tipo);
                                        while ($row_tipo = mysqli_fetch_assoc($resultado_tipo)) { ?>
                                            <option value="<?php echo $row_tipo['nome']; ?>"><?php echo $row_tipo['nome']; ?></option> <?php
                                                                                                                                        }
                                                                                                                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="recipient-quantidade" class="control-label">Safra:</label>
                                <input name="safra" type="date" class="form-control" id="safra">
                            </div>
                            <div class="form-group">
                                <label for="recipient-quantidade" class="control-label">Quantidade:</label>
                                <input name="quantidade" type="number" class="form-control" id="quantidade">
                            </div>
                            <div class="form-group">
                                <label for="imagem"><span class="badge badge-dark">Upload your image:</span></label>
                                <input type="file" accept="image/*" class="form-control" name="my_picture">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="recipient-valor">R$</label>
                                </div>
                                <input name="valor" type="text" class="form-control" aria-label="Quantia" id="valor">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">Detalhes:</label>
                                <textarea name="detalhes" class="form-control" id="detalhes"></textarea>
                            </div>

                            <input name="id" type="hidden" class="form-control" id="id-vinho" value="">

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="uploadfilesub" value="upload" class="btn btn-success">Cadastrar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Modal Cadastrar-->
        <script type="text/javascript">
            $("#valor").mask("999.999.990,00", {
                reverse: true
            })
        </script>

        <script>
            $(document).ready(function() {
                        $('.money').mask('000.000.000.000.000,00', {
                            reverse: true
                        });
                        $('.money2').mask("#.##0,00", {
                            reverse: true
                        });
                    }
        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                var recipientnome = button.data('whatevernome')
                var recipientclasse = button.data('whateverclasse')
                var recipientcor = button.data('whatevercor')
                var recipientteor = button.data('whateverteor')
                var recipientorigem = button.data('whateverorigem')
                var recipientquantidade = button.data('whateverquantidade')
                var recipientvalor = button.data('whatevervalor')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('' + recipientnome)
                modal.find('#id-curso').val(recipient)
                modal.find('#recipient-name').val(recipientnome)
                modal.find('#classe').val(recipientclasse)
                modal.find('#cor').val(recipientcor)
                modal.find('#teor').val(recipientteor)
                modal.find('#origem').val(recipientorigem)
                modal.find('#quantidade').val(recipientquantidade)
                modal.find('#valor').val(recipientvalor)
            })
        </script>
        <script src="js/personalizado.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
</body>

</html>