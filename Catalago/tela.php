<?php
session_start();
include_once("config/conexao.php");

//Verificar se está sendo passado na URL a página atual, senao é atribuido a pagina 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
//Selecionar todos os vinhos da tabela.
$result_curso = "SELECT * FROM temp_produtos";
$resultado_curso = mysqli_query($conn, $result_curso);
//Contar o total de cursos
$total_cursos = mysqli_num_rows($resultado_curso);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 6;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_cursos / $quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg * $pagina) - $quantidade_pg;

//Selecionar os cursos a serem apresentado na página
$result_cursos = "SELECT * FROM temp_produtos limit $incio, $quantidade_pg";
$resultado_cursos = mysqli_query($conn, $result_cursos);
$total_cursos = mysqli_num_rows($resultado_cursos);
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
                     <i class="fas fa-glass-cheers"></i>
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
                           <a href="#">
                              <i class="fas fa-paper-plane"></i>
                              Contact
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
                     <!-- Botão para acionar modal -->
                     <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#ExemploModalCentralizado">
                        <i class="fas fa-user"></i>
                        Acesse
                     </button>
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
                                 <form>
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Endereço de email</label>
                                       <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                                    </div>
                                    <div class="form-group">
                                       <label for="exampleInputPassword1">Senha</label>
                                       <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
                                    </div>
                                    <button type="submit" class="btn btn-danger">Entrar</button>
                                 </form>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                 <a href="../clientesform/" onclick="window.close();" class="btn btn-success">
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
         <div class="content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row text-center">
                        <?php while ($rows_vinhos = mysqli_fetch_assoc($resultado_curso)) { ?>
                           <span class="border">
                              <div class="card" style="width: 14rem;">
                                 <img class="card-img-top" <?php echo '
													<img  src="data:image;base64,' . $rows_vinhos['picture'] . '"></div>'; ?>>
                                 <div class="card-body">
                                    <h5 class="card-title text-center"><?php echo $rows_vinhos['nome']; ?></h5>
                                    <p class="card-text"><?php echo $rows_vinhos['detalhes']; ?></p>
                                    <ul class="list-group list-group-flush">
                                       <li class="list-group-item"><?php echo $rows_vinhos['valor']; ?></li>
                                    </ul>
                                    <hr>
                                    <a href="#" class="btn btn-success btn-sm ">Comprar</a>
                                    <a href="#" class="btn btn-info btn-sm ">Info</a>
                                    <hr>
                                 </div>
                           </span>
                           <br />
                        <?php } ?>

                     </div>
                  </div>
               </div>
            </div>

         </div>
         <script src="js/jquery-3.3.1.slim.min.js" </script> <script src="js/popper.min.js" </script> <!-- Bootstrap JS -->
            < script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity = "sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin = "anonymous" >
         </script>


</body>

</html>