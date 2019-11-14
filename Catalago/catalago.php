<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<title></title>

<head>
    <meta charset="UTF-8">
</head>

<body>
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
    <!-- Page Content  -->
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
                    <h2>Teste </h2>
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
                                <a class="dropdown-item" href="sair.php">Sair</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>


    </div>
    </div>

    <script src="js/jquery-3.3.1.slim.min.js" </script> <script src="js/popper.min.js" </script> <!-- Bootstrap JS -->
        < script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity = "sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin = "anonymous" >
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>