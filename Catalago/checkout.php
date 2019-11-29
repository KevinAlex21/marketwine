<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include_once("./config/conexao.php");



$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
$endereco = mysqli_real_escape_string($conn, $_POST['rua']);
$cep = mysqli_real_escape_string($conn, $_POST['cep']);
$num = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
$bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
$estado = mysqli_real_escape_string($conn, $_POST['uf']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$tipoPag = mysqli_real_escape_string($conn, $_POST['tipoPagamento']);
$cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
$idc = $_SESSION['clienteId'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>checkout</title>

  <!-- Principal CSS do Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/demo.css">
  <!-- Estilos customizados para esse template -->
  <link href="form-validation.css" rel="stylesheet">
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

<body class="bg-light">

  <div class="container">

    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h2>Formulário de checkout</h2>
      <p class="lead">Preencha o formulário de Checkout, é onde você coloca o endereço de entrega dos vinhos. E escolha o metodo de pagamento. OBS: A Market Wine não salva os dados do seu metodo de pagamento como o numero de cartão ou ccv, para lhe oferecer maior segurança.</p>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Seu carrinho</span>
          <span class="badge badge-secondary badge-pill"><?php echo $_SESSION["icon"]; ?></span>
        </h4>
        <?php
        foreach ($_SESSION["shopping_cart"] as $product) {
          ?>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0"><?php echo $product["nome"]; ?></h6>
                <small class="text-muted"><?php echo $product["quantidade"]; ?> Unidade</small>
              </div>
              <span class="text-muted">R$<?php echo  $product["valor"]; ?></span>
            </li>
          <?php } ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (BRL)</span>
            <strong>R$ <?php echo  number_format($_SESSION["total"], 2, ',', '.') ?></strong>
          </li>
          </ul>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Informações de entrega</h4>
        <form class="needs-validation" enctype="multpart/form-data" method="post" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="primeiroNome">Nome</label>
              <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="" required>
              <div class="invalid-feedback">
                É obrigatório inserir um nome válido.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="sobrenome">Sobrenome</label>
              <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="" value="" required>
              <div class="invalid-feedback">
                É obrigatório inserir um sobre nome válido.
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="fulano@exemplo.com">
            <div class="invalid-feedback">
              Por favor, insira um endereço de e-mail válido, para atualizações de entrega.
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cep">CEP</label>
              <input type="text" class="form-control" name="cep" id="cep" placeholder="" onblur="pesquisacep(this.value);" required>
              <div class="invalid-feedback">
                É obrigatório inserir um CEP.
              </div>
            </div>
            <div class="col-md-7 mb-3">
              <label for="rua">Endereço</label>
              <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua dos bobos, nº 0" required>
              <div class="invalid-feedback">
                Por favor, insira seu endereço de entrega.
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="numero">Número</label>
              <input type="number" class="form-control" name="numero" id="numero" placeholder="10" required>
              <div class="invalid-feedback">
                Por favor, insira um número válido.
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="bairro">Bairro</label>
              <input type="text" class="form-control" name="bairro" id="bairro" placeholder="" required>
              <div class="invalid-feedback">
                É obrigatório inserir um Bairro.
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="cidade">Cidade</label>
              <input type="text" class="form-control" name="cidade" id="cidade" placeholder="" required>
              <div class="invalid-feedback">
                É obrigatório inserir uma Cidade.
              </div>
            </div>
            <div class="col-md-2 mb-3">
              <label for="uf">UF</label>
              <input type="text" class="form-control" name="uf" id="uf" placeholder="RJ" required>
              <div class="invalid-feedback">
                Por favor, insira um UF.
              </div>
            </div>
          </div>
          <hr class="mb-4">

          <h4 class="mb-3">Pagamento</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credito" name="tipoPagamento" type="radio" class="custom-control-input" value="Cartao de Credito" required>
              <label class="custom-control-label" for="credito">Cartão de crédito</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debito" name="tipoPagamento" type="radio" class="custom-control-input" value="Cartao de Debito" required>
              <label class="custom-control-label" for="debito">Cartão de débito</label>
            </div>
          </div>
          <div class="creditCardForm">
            <div class="heading">
              <h1>Confirmar dados do cartão</h1>
            </div>
            <div class="payment">

              <div class="form-group owner">
                <label for="owner">Nome do Titular</label>
                <input type="text" class="form-control" id="owner" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um Nome do Titular.
                </div>
              </div>
              <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um CCV.
                </div>
              </div>
              <div class="form-group" id="card-number-field">
                <label for="cardNumber">Número do Cartão</label>
                <input type="text" class="form-control" id="cardNumber" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um Número do Cartão.
                </div>
              </div>
              <div class="form-group" id="expiration-date">
                <label>Validade</label>
                <select>
                  <option value="01">Janeiro</option>
                  <option value="02">Fevereiro </option>
                  <option value="03">Março</option>
                  <option value="04">Abril</option>
                  <option value="05">Maio</option>
                  <option value="06">Junho</option>
                  <option value="07">Julho</option>
                  <option value="08">Agosto</option>
                  <option value="09">Setembro</option>
                  <option value="10">Outubro</option>
                  <option value="11">Novembro</option>
                  <option value="12">Dezembro</option>
                </select>
                <select>
                  <option value="16"> 2019</option>
                  <option value="17"> 2020</option>
                  <option value="18"> 2021</option>
                  <option value="19"> 2022</option>
                  <option value="20"> 2023</option>
                  <option value="21"> 2024</option>
                </select>
              </div>
              <div class="form-group" id="credit_cards">
                <img src="images/visa.jpg" id="visa">
                <img src="images/mastercard.jpg" id="mastercard">
                <img src="images/amex.jpg" id="amex">
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#pedido" name="enviar">Finalizar Pedido</button>
        </form>

      </div>
    </div>
    <?php
    $now = new DateTime();
    $datetime = $now->format('#Y-md-Hi-s');

    if (isset($_POST['enviar'])) {
      $b =  $_SESSION["total"];
      $sqlInserirVenda = mysqli_query($conn, "INSERT INTO pedidos (numPedido,total,tipoPagamento,enderecoEntrega,CEP,Bairro,Estado,numero,cidade,idCliente)
   VALUES ('$datetime','$b','{$tipoPag}','{$endereco}','{$cep}','{$bairro}','{$estado}','{$num}','{$cidade}','{$idc}')");
      $idVenda = mysqli_insert_id($conn);



      /*foreach($product as $prodInsert => $vinhos):
  $magia = $vinhos['idProduto'];
   echo "<script>alert ($magia) </script>";
  $qry_insert = "INSERT INTO itens_pedido (idPedido,idProduto,quantidade) VALUES ($idVenda ,$prodInsert,$magia)";
  $sqlInsertItens = mysqli_query($conn,$qry_insert) Or die('Erro: ' . mysqli_error($conn) . '  || SQL: ' . $qry_insert);
  endforeach;
  echo "<script>alert (Pedido Realizado)</script>";*/
      foreach ($_SESSION["shopping_cart"] as $carrinho) {

        foreach ($carrinho as $prodInsert => $produto) {
          $codigo = $carrinho['idProduto'];
          $qtd = $carrinho["quantidade"];
          $nomes = $carrinho["nome"];
          $colaborador = $carrinho["idColaborador"];
          $_SESSION["qtd"] = $qtd;
          $valorUni =  $carrinho["valor"];
        }
        
        $qry_insert = "INSERT INTO itens_pedido (idPedido,idProduto,quantidade,nome,valorUni) VALUES ($idVenda,$codigo,$qtd,'$nomes','$valorUni')";
        mysqli_query($conn, $qry_insert) or die('Erro: ' . mysqli_error($conn) . '  || SQL: ' . $qry_insert . ' Fim ' . $carrinho);

        $qry_venda = "INSERT INTO faturamento (idColaborador,idProduto,item,quantidade,valor,dataVenda,idPedido,total) VALUES ($colaborador,$codigo,'$nomes',$qtd,'$valorUni',now(),$idVenda,$b)";
        mysqli_query($conn, $qry_venda) or die('Erro ' . mysqli_error($conn) . ' || SQL' . $qry_venda . ' Fim ');
        $qry_vendeu = "UPDATE temp_produtos SET quantidade =  ( quantidade - '{$qtd}') WHERE idProduto = '{$codigo}'";
        mysqli_query($conn, $qry_vendeu) or die('Erro ' . mysqli_error($conn) . ' || SQL' . $qry_vendeu . ' Fim ');
      }

      echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost:81/projeto/catalago/loja.php'>
				<script type=\"text/javascript\">
					alert(\"Sua compra foi finalizada com sucesso.\");
				</script>
			";



      unset(
      $_SESSION["shopping_cart"],
      $_SESSION["totals"],
      $_SESSION["total"],
      $_SESSION["qtd"]);
    }



    ?>
    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2019-2020 Market Wine</p>
    </footer>
  </div>

  <!-- Principal JavaScript do Bootstrap
    ================================================== -->
  <!-- Foi colocado no final para a página carregar mais rápido -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src=".js/jquery-slim.min.js"><\/script>')
  </script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/vendor/holder.min.js"></script>
  <script>
    // Exemplo de JavaScript para desativar o envio do formulário, se tiver algum campo inválido.
    (function() {
      'use strict';

      window.addEventListener('load', function() {
        // Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
        var forms = document.getElementsByClassName('needs-validation');

        // Faz um loop neles e previne envio
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>

  <script src="js/jquery.payform.min.js" charset="utf-8"></script>
  <script src="js/jquery.payform.min.js" charset="utf-8"></script>
  <script src="js/script.js"></script>
  <script src="js/script.js"></script>
  </script>
</body>

</html>