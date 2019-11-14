<?php
session_start();
include_once("./config/conexao.php");
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulário Cadastro</title>
  <!-- Bootstrap CSS CDN -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/stylesheet1.css">
  <!-- Font Awesome JS -->
  <script src="https://kit.fontawesome.com/95473a4750.js" crossorigin="anonymous"></script>
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>


  <!-- Adicionando Javascript -->
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
  <!-- Como um span -->
  <nav class="navbar navbar-light bg-danger">
    <span class="navbar-brand mb-0 h1">Market Wine</span>
  </nav>
  </br>
  <div class="content text-center">
    <div class="row">
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <img class="card-img" src="./images/wine2.jpg" alt="Imagem do card">

            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card border-dark  mb-3">
            <div class="card-header">Preencha o Formulário</div>
            <div class="card-body">
              <form method="POST" action="./config/processa.php">
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name='nome' id="nome" placeholder="Nome" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <input type="text" class="form-control" name='sobrenome' id="sobrenome" placeholder="Sobrenome" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <input type="date" class="form-control" id="nascimneto" name="nascimento" max="<?php echo date('2001-10-30', strtotime('-18 year')); ?>" required>
                    <small id="dateInputHelp" class="text-muted">
                      Informe sua data de nascimento.
                    </small>
                  </div>
                  <div class="col-md-4 mb-3">
                    <input type="text" name="cpf" class="form-control" id="cpf" placeholder="CPF" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input name="cep" type="text" class="form-control" id="cep" placeholder="CEP" onblur="pesquisacep(this.value);" required />
                  </div>
                  <div class="col-md-4 mb-3">
                    <input name="rua" type="text" class="form-control" placeholder="Endereço" id="rua" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input name="bairro" type="text" class="form-control" placeholder="Bairro" id="bairro" required />
                  </div>
                  <div class="col-md-3 mb-3">
                    <input name="cidade" type="text" class="form-control" placeholder="Cidade" id="cidade" required />
                  </div>
                  <div class="col-md-1 mb-3">
                    <input name="uf" type="text" class="form-control" placeholder="UF" id="uf" required />
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                    <small id="passwordHelpInline" class="text-muted">
                      Deve ter entre 8 e 20 caracteres.
                    </small>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input type="fone" class="form-control" name="telefone" id="telefone" placeholder="Telefone" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <input type="fone" class="form-control" name="celular" id="celular" placeholder="Whatsapp" required>
                  </div>
                </div>
                <button class="btn btn-primary" type="submit">Enviar</button>
              </form>


            </div>
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
  <!-- JS -->

  <script src="js/main.js"></script>
</body>

</html>