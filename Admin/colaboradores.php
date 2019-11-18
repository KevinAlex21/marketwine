<?php
session_start();
include_once("config/conexao.php");

//Selecionar os colaboradores a serem apresentado na página
$result_colaboradores = "SELECT * FROM temp_colaboradores";
$resultado_colaboradores= mysqli_query($conn, $result_colaboradores);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Vendas</title>
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
                <li class = "active">
                    <a href="colaboradores.php">
                        <i class="fas fa-home"></i><strong>
                        Colaboradores</strong>
                    </a>
                </li>
                <li>
                    <a href="clientes.php">
                        <i class="pe-7s-wine"></i><strong>
                        Clientes
                        </strong>
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
                </div>
            </nav> 
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                    <div class="row text">
                            <div class="col-md-14">
                            <div class="row">
                                <?php while ($row = mysqli_fetch_assoc($resultado_colaboradores)) { ?>
                                    <span class="border">
                                        <div class="card">
                                        <h5 class="card-header">Dados do Colaborador</h5>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['nome'];?></h5>
                                            <p class="card-text"><font color = "black">Endereço:&nbsp;&nbsp;<?php echo $row['endereco'];?>
                                            &nbsp;&nbsp;-&nbsp;&nbsp;N:<?php echo $row['numero'] ?>&nbsp;&nbsp;-&nbsp;&nbsp;
                                            <?php echo $row['cep'] ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $row['bairro']?>
                                            &nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $row['cidade']?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $row['estado']?>
                                         </p><br>
                                         <p><strong>Email:&nbsp;</strong><?php echo $row['email']?></br>
                                        <strong>Telefone:&nbsp;</strong><?php echo $row['telefone']?></br>
                                        <strong>Celular:&nbsp;</strong><?php echo $row['celular']?></br>
                                        </p>
                                            <a href="#" class="btn btn-danger">Apagar</a>
                                            </font>
                                        </div>
                                        </div>
                                    </span>
                                    <br/>
                                <?php } ?>
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