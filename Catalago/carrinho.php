<?php
session_start();
include_once("./config/conexao.php");
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
    #$qualquer = print_r ($key);
    #$outra = print_r ($value); 
    #$lula = ($_POST['nome']);
    #echo "<script>alert ($qualquer) </script>";
		if($_POST["nome"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
                <div class='row d-flex justify-content-center'>
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Removido!</strong>  O produto foi removido do seu carrinho.
                <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>
              </div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as & $value){
    if($value['nome'] === $_POST["nome"]){
        $value['quantidade'] = $_POST["quantidade"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
  <!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Carrinho de Compras</title>
      <!-- Bootstrap CSS CDN -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Our Custom CSS -->
      <link rel="stylesheet" href="css/style.css">
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
       
		
      <!-- Barra de navegação  -->
      <div id="content">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <h2>Carrinho de Compras</h2>
                  <ul class="nav navbar-nav ml-auto">
					<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
$_SESSION["icon"] = $cart_count;
?>
<div class="cart_div">
<a href="cart.php">
<img src="cart-icon.png" /> 
<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>
</ul>
  </div>
</div>
  </nav>
 <div class="cart">
 <?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table table-striped text-center">
  <thead>
    <tr class="bg-danger">
      <th scope="col"></th>
	  <th scope="col">Nome do Item</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Preço Unitário</th>
      <th scope="col">Valor total por Item</th>
    </tr>
	<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><?php echo '<img height="70" width="100" src="data:image;base64,' . $product['picture'] . '">';?></th>
      <td><?php echo $product["nome"];?>
	  <form method='post' action=''>
    <input type='hidden' name='nome' value="<?php echo $product["nome"]; ?>" />
		<input type='hidden' name='action' value="remove" />
		<button type='submit' class="btn btn-outline-danger btn-sm" ><i class="fas fa-trash-alt"></i></button>
		</form></td>
      <td><form method='post' action=''>
		<input type='hidden' name='nome' value="<?php echo $product["nome"]; ?>" />
		<input type='hidden' name='action' value="change" />
		<select name='quantidade' class='quantity' onchange="this.form.submit()">
		<option <?php if($product["quantidade"]==1) echo "selected";?> value="1">1</option>
		<option <?php if($product["quantidade"]==2) echo "selected";?> value="2">2</option>
		<option <?php if($product["quantidade"]==3) echo "selected";?> value="3">3</option>
		<option <?php if($product["quantidade"]==4) echo "selected";?> value="4">4</option>
		<option <?php if($product["quantidade"]==5) echo "selected";?> value="5">5</option>
		</select>

		</form></td>
      <td><?php echo "R$". number_format($product["valor"], 2, ',', '.'); ?></td>
	  <td><?php echo "R$".number_format($product["valor"]*$product["quantidade"], 2, ',', '.'); ?>
   <?php $totals = number_format($product["valor"]*$product["quantidade"], 2, ',', '.');
   $_SESSION["totals"] = $totals; ?>
	  </td>
    </tr>
    <tr>
	<?php
 $total_price += ($product["valor"]*$product["quantidade"]);

 $_SESSION["total"] = $total_price;

}

?>
  <tr>
<td colspan="5" align="right">
<strong>TOTAL: R$ <?php echo number_format($_SESSION['total'], 2, ',', '.'); ?></strong>
</td>

</tr>
</tbody>
</table>
  <?php
}else{
  $_SESSION['msg'] = 
                "<div class='row d-flex justify-content-center'>
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Seu Carrinho está Vazio!</strong>   Você retornou para a loja.
                <button type='button' class='close' data-dismiss='alert' aria-label='Clos'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div></div>";
            header("Location: http://localhost:81/projeto/catalago/loja.php");
        exit ();
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
<?php
$now = new DateTime();
$datetime = $now->format('#Y-md-Hi-s');

if(isset($_POST['enviar'])){
  $sqlInserirVenda = mysqli_query ($conn,"INSERT INTO pedidos (numPedido,total) VALUES ('$datetime','$total_price')");
  $idVenda = mysqli_insert_id($conn);
  
  /*foreach($product as $prodInsert => $vinhos):
  $magia = $vinhos['idProduto'];
   echo "<script>alert ($magia) </script>";
  $qry_insert = "INSERT INTO itens_pedido (idPedido,idProduto,quantidade) VALUES ($idVenda ,$prodInsert,$magia)";
  $sqlInsertItens = mysqli_query($conn,$qry_insert) Or die('Erro: ' . mysqli_error($conn) . '  || SQL: ' . $qry_insert);
  endforeach;
  echo "<script>alert (Pedido Realizado)</script>";*/
foreach ($_SESSION["shopping_cart"] as $carrinho) {

     foreach($carrinho as $prodInsert => $produto){
        $codigo = $carrinho['idProduto'];
        $qtd = $carrinho["quantidade"];
        $_SESSION["qtd"] = $qtd;
      }
        $qry_insert = "INSERT INTO itens_pedido (idPedido,idProduto,quantidade) VALUES ($idVenda,$codigo,$qtd)";
        mysqli_query($conn,$qry_insert) Or die('Erro: ' . mysqli_error($conn) . '  || SQL: ' . $qry_insert.' Fim '. $carrinho);     
  }
 echo "<script>alert ('Pedido Realizado') </script>";
 unset ($_SESSION["shopping_cart"]);
  

}

?>
<a
type="button" href="http://localhost:81/projeto/Catalago/checkout.php" class="btn btn-outline-success btn-lg pull-right">
<strong>Finalizar Pedido</strong><i class="fas fa-angle-double-right fa-lg"></i>
</button></a>
<!--<form action="" enctype="multpart/form-data" method="post">
<input type="submit" name="enviar" value="Fechar Pedido" class="btn btn-outline-success btn-lg pull-right">
</form>
!-->
<a
type="button" href="http://localhost:81/projeto/Catalago/loja.php" class="btn btn-outline-warning btn-lg">
<strong><i class="fas fa-angle-double-left fa-lg"></i>  Continuar Comprando</strong>
</button></a> 

</div>

</div>
      <script src="js/jquery-3.3.1.min.js"> </script>
      <script src="js/jquery-3.3.1.slim.min.js"> </script>
      <script src="js/popper.min.js"> </script>
      
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" 
      integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
       crossorigin="anonymous"></script>
  
	 
   </body>
</html>