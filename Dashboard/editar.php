<?php
    session_start();
	include_once("config/conexao.php");
	$idProduto = $_GET['idProduto'];
	$result_vinho = "SELECT * FROM temp_produtos where  idColaborador ='". $_SESSION ['usuarioId']."' and idProduto='$idProduto'";
	
    $resultado_vinho =  mysqli_query($conn, $result_vinho) or die (mysqli_error($conn).'/'. $result_vinho);
	$rows_vinhos= mysqli_fetch_assoc($resultado_vinho);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MK - Editar</title>
    <!-- Bootstrap CSS CDN -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
		<!-- js !-->
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
 
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

                <li class="active">
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
                <li>
                    <a href="#">
                        <i class="pe-7s-user"></i>
                     Minha Empresa
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-question"></i>
                        FAQ
                    </a>
                </li>
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

                    <button type="button" id="sidebarCollapse" class="btn btn-danger">
                        <i class="fas fa-align-left"></i>

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                        <h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; <?php echo "Bem vindo <span style='color:red;'>".$_SESSION['usuarioNome'];?></span>, Aqui você altera as descrições do seu vinho! </h2>
                        <ul class="nav navbar-nav ml-auto">
                                    <!-- Botão dropleft padrão -->
                                        <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           Menu
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Links do menu dropleft -->
                                             <a class="dropdown-item" href="#">Alguma ação</a>
                                                <a class="dropdown-item" href="#">Outra ação</a>
                                                <a class="dropdown-item" href="#">Alguma coisa aqui</a>
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
								<a href = "vinhos.php">
								<button type="button" class="btn btn-outline-danger  pull-right">Cancelar</button>
								</a>
                                 <h4 class="card-title">Editar Vinho</h4>	
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="./config/attvinho.php">
                                        <div class="row">
										
                                            <div class="col-md-6 pr-1">
                                                <div class="form-group">
                                                    <label>Nome do vinho</label>
                                                    <input type="text" name="nome" class="form-control" id="nome"  value="<?php echo $rows_vinhos['nome']; ?>">
													
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-1">
                                                <div class="form-group">
                                                    <label>Classe</label>
                                                    <input class="form-control" id="classe"name="classe" value="<?php echo $rows_vinhos['classe']; ?>">
                                                </div>
                                            </div>
                                        </div>
                               
                                       
                                        <div class="row">
										        <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Cor</label>
                                                    <input type="text" class="form-control"  name="cor" id="cor" value="<?php echo $rows_vinhos['cor']; ?>""size="10" maxlength="9">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Teor de Açucar</label>
                                                    <input name="teor" type="text" id="teor"class="form-control" value="<?php echo $rows_vinhos['teor']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Origem do vinho</label>
                                                    <input name="tipo" type="text" id="tipo" class="form-control" value ="<?php echo $rows_vinhos['tipo']; ?>">
                                                </div>
                                            </div>	
                                        </div>
										<div class ="row">
										 <div class="col-md-2 pr-1 text-center">
                                                <div class="form-group">
                                                  
                                                </div>
                                           </div>	
										   <div class="col-md-2 pr-1 text-center">
                                                <div class="form-group">
                                                  
                                                </div>
                                           </div>	
                                        <div class="col-md-4 pr-1 text-center">
                                                <div class="form-group">
                                                    <label>Quantidade</label>
                                                    <input name="quantidade" type="number" id="quantidade" class="form-control text-center" value ="<?php echo $rows_vinhos['quantidade']; ?>">
                                                </div>
                                           </div>	
                                        
										<div class="input-group mb-2 text-center">
											  <div class="input-group-prepend text-center">
												<span class="input-group-text">R$</span>
											  </div>
											 <input type="text" name="valor"  id="valor" class="form-control" value ="<?php echo $rows_vinhos['valor']; ?>">
											</div>
                                        </div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 text center">
                                                <div class="form-group text-center">
                                                    <label>Detalhes do vinho</label>
                                                    <textarea rows="4" cols="80" name="descricao" id="descricao" class="form-control" 
													value=""> <?php echo $rows_vinhos['detalhes']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
										<input type="hidden" name="idProduto" value="<?php echo $rows_vinhos['idProduto']; ?>">
                                        <button type="submit" class="btn btn-info btn-fill pull-right" name="submit">Atualizar Vinho</button>
                                        
                                    </form>
                                </div>
                            </div>
							  <div class="col-md-4 text-center" >
                            <div class="card card-user">
							<form method ="POST" action="./config/attfotov.php" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="author">
                                        <a href="#">
                                            <img class="avatar border-gray" <?php echo '
                                    <img  height="100%" width="100%" src="data:image;base64,' . $rows_vinhos['picture'] . '"></div></div>';?>>
                                        </a>                
										
										<input type="file" accept="image/*" class="form-control" name="my_picture" >
										<input type="hidden" name="idProduto" value="<?php echo $rows_vinhos['idProduto']; ?>">
                                           <button type="submit " class="btn btn-info btn-fill text-center" name="submit">Atualizar Foto do vinho</button>
                                       
                                    </div>
                                </div>
                                <hr>
								
								</form>
                        </div>
						
				          
                        </div>		
        </div>
		
    </div>
	</div>
	
<script type="text/javascript">
		$("#valor").mask("999.999.990,00", {reverse: true})
</script>
	
	
	
	

    <script src="js/jquery-3.3.1.slim.min.js" </script> <script src="js/popper.min.js" </script> <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
    </script>
	
	  <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>