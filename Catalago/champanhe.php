<?php
session_start();
include_once("config/conexao.php");
$status = "";
if (isset($_POST['nome']) && $_POST['nome'] != "") {
    $code = $_POST['nome'];
    $result = mysqli_query($conn, "SELECT * FROM `temp_produtos` WHERE `nome`='$code'");
    $row = mysqli_fetch_assoc($result);

    $idProduto = $row['idProduto'];
    $name = $row['nome'];
    $price = $row['valor'];
    $image = $row['picture'];
    $idColaborador = $row['idColaborador'];



    $cartArray = array(
        $name => array(
            'idProduto' => $idProduto,
            'nome' => $name,
            'valor' => $price,
            'quantidade' => 1,
            'picture' => $image,
            'idColaborador' => $idColaborador
        )
    );

    if (empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = " 
		<div class='row d-flex justify-content-center'>
		<div class='alert alert-success' role='alert'>
		  <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
		  <span aria-hidden='true'>&times;</span>
		  </button>
		  <h4 class='alert-heading'>Muito bem!</h4>
		  <p>O produto foi adicionado ao carrinho</p>
		  <hr>
		  <p class='mb-0'> Você pode adicionar mais se quiser :)</p>
		</div></div>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($name, $array_keys)) {
            $status = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Ops!</strong> O produto ja existe no carrinho!
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge(
                $_SESSION["shopping_cart"],
                $cartArray
            );
            $status = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Legal!</strong> O produto foi adicionado ao carrinho
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
        }
    }
}

$result_cliente = "SELECT * FROM temp_clientes where  idCliente ='" . $_SESSION['clienteId'] . "'";
$resultado_cliente =  mysqli_query($conn, $result_cliente) or die(mysqli_error($conn) . '/' . $$result_cliente);

//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
//Selecionar todos os vinhos da tabela.
$result_vinho = "SELECT * FROM temp_produtos";
$resultado_vinho = mysqli_query($conn, $result_vinho);
//Contar o total de vinhos
$total_vinhos = mysqli_num_rows($resultado_vinho);

//Seta a quantidade de vinhos por pagina
$quantidade_pg = 8;

//calcular o número de pagina necessárias para apresentar os vinhos
$num_pagina = ceil($total_vinhos / $quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os vinhos a serem apresentado na página
$result_vinhos = "SELECT * FROM temp_produtos where classe ='Champanhe' limit $incio, $quantidade_pg";
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
    <link rel='stylesheet' href='css/style1.css' type='text/css' media='all' />
    <!-- Font Awesome JS -->
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

            <ul class="list-unstyled components">

                <li class="">
                    <a href="#classeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Classes</a>
                    <ul class="collapse list-unstyled" id="classeSubmenu">
                        <li>
                            <a href="Demesa.php">De mesa</a>
                        </li>
                        <li>
                            <a href="leve.php">Leve</a>
                        </li>
                        <li>
                            <a href="champanhe.php">Champanhe</a>
                        </li>
                        <li>
                            <a href="licoroso.php">Licoroso</a>
                        </li>
                        <li>
                            <a href="composto.php">Composto</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#corSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cores</a>
                    <ul class="collapse list-unstyled" id="corSubmenu">
                        <li>
                            <a href="tinto.php">Tinto</a>
                        </li>
                        <li>
                            <a href="rosado.php">Rosado</a>
                        </li>
                        <li>
                            <a href="branco.php">Branco</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#teorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Teores</a>
                    <ul class="collapse list-unstyled" id="teorSubmenu">
                        <li>
                            <a href="seco.php">Seco</a>
                        </li>
                        <li>
                            <a href="doce.php">Meio Doce (Demi-Sec)</a>
                        </li>
                        <li>
                            <a href="suave.php">Suave</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#tipoSubmennu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Origem</a>
                    <ul class="collapse list-unstyled" id="tipoSubmennu">
                        <li>
                            <a href="#">Bordeaux</a>
                        </li>
                        <li>
                            <a href="#">Mabernet Franc)</a>
                        </li>
                        <li>
                            <a href="#">Cabernet Sauvignon</a>
                        </li>
                        <li>
                            <a href="#">Cabernet Sauvignon</a>
                        </li>
                        <li>
                            <a href="#">Chardonnay</a>
                        </li>
                        <li>
                            <a href="#">Malbec</a>
                        </li>
                        <li>
                            <a href="#">Merlot</a>
                        </li>
                        <li>
                            <a href="#">Pinot Noir</a>
                        </li>
                        <li>
                            <a href="porto.php">Porto</a>
                        </li>
                        <li>
                            <a href="#">Sangiovese</a>
                        </li>
                        <li>
                            <a href="#">Sauvignon Blanc</a>
                        </li>
                        <li>
                            <a href="#">Syrah (Shiraz)</a>
                        </li>
                    </ul>
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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        &nbsp;&nbsp;&nbsp; <strong>Makert Wine</strong>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $status; ?>
                        <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        } ?>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <?php
                                if (!empty($_SESSION["shopping_cart"])) {
                                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                                    ?>
                                    <a href="carrinho.php">
                                        <button type="button" class="btn btn-primary"><i class="fas fa-shopping-cart fa-lg"></i>
                                            <span class="badge badge-light"><?php echo $cart_count; ?></span>
                                            <span class="sr-only"></span>
                                        </button>
                                    </a>

                                <?php
                                } ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"></a>
                            </li>
                            <li class="nav-item">

                            </li>
                            <li class="nav-item">
                                <!-- botão Menu-->
                                <div class="btn-group pull-left">
                                    <div class="btn-group dropleft pull-left" role="group">
                                        <button type="button" class="btn btn-info pull-left dropdown-toggle dropdown-toggle-split pull-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Links do menu dropleft -->
                                            <a class="dropdown-item" href="perfil.php">Meus Dados</a>
                                            <a class="dropdown-item" href="pedidos.php">Meus Pedidos</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="./config/sair.php">Sair</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-info">
                                        <?php echo "Oi <span style='color:red;'>" . $_SESSION['clienteNome']; ?>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <ul class="resultado">
            </ul>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row text-center">

                                <?php
                                while ($row = mysqli_fetch_assoc($resultado_vinhos)) { ?>
                                    <span class="border">
                                        <div class="card" style="width: 16rem;">
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
                                                <button type="submit" class="btn btn-success"><i class="fas fa-cart-plus fa-lg"></i></button>
                                                </button>
                                                <a href="detalhes.php?idProduto=<?php echo $row['idProduto']; ?>" class="btn btn-info ">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </form>

                                            <!--	<a href="#" class="btn btn-info btn-sm ">Info
                        <i class="fas fa-info-circle"></i>
                        </a> -->
                                            <hr>
                                        </div>
                                    </span>
                                    <br />

                                <?php }
                                mysqli_close($conn); ?>

                            </div>
                        </div>
                    </div>

                </div>
                <div style="clear:both;"></div>

                <div class="message_box" style="margin:10px 0px;">
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
                                        <a class="page-link" href="loja.php?pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous">

                                            <span aria-hidden="true">«</span>
                                        <?php }  ?>
                                        <span class="sr-only">Previous</span>
                                        </a>

                                </li>
                                <?php
                                //Apresentar a paginacao
                                for ($i = 1; $i < $num_pagina + 1; $i++) { ?>
                                    <li class="page-item">
                                    <li><a class="page-link" href="loja.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php } ?>

                                <li class="page-item">
                                    <?php
                                    if ($pagina_posterior <= $num_pagina) { ?>
                                        <a class="page-link" href="loja.php?pagina=<?php echo $pagina_posterior; ?>" aria-label="Next">
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
        </div>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
        <script type="text/javascript" src="config/personalizado.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/jquery-3.3.1.slim.min.js"> </script>
        <script src="js/popper.min.js"> </script>
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