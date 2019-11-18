<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as & $value){
    if($value['code'] === $_POST["code"]){
        $value['quantidade'] = $_POST["quantidade"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<html>
<head>
<title>Demo Shopping Cart - AllPHPTricks.com</title>
<link rel='stylesheet' href='css/style1.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2>Demo Shopping Cart</h2>   

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart.php">
<img src="cart-icon.png" /> Cart
<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}
?>

<div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>Nome do Item</td>
<td>Quantidade</td>
<td>Preço Unitário</td>
<td>Total por Item</td>
</tr>	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td><?php echo '<img height="40" width="50" src="data:image;base64,' . $product['picture'] . '">';?></td>

<td><?php echo $product["nome"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantidade' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantidade"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantidade"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantidade"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantidade"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantidade"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>
<td><?php echo "R$".$product["valor"]; ?></td>
<td><?php echo "R$".$product["valor"]*$product["quantidade"]; ?></td>
</tr>
<?php
$total_price += ($product["valor"]*$product["quantidade"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "R$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>


<br /><br />
<a href="http://localhost:81/projeto/Catalago/loja.php"><strong>Continuar Comprando</strong></a> <br /><br />
<a href="http://localhost:81/projeto/Catalago/config/carrinhovaz.php"><strong>Apagar Carrinho</strong></a> <br /><br />
For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/"><strong>AllPHPTricks.com</strong></a>
</div>
</body>
</html>