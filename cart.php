<?php
include "config.php";

if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = [];
}

/* إضافة المنتج */
if(isset($_POST['product_id'])){
  $product_id = $_POST['product_id'];
  $size = $_POST['size'];
  $_SESSION['cart'][] = [
    "id" => $product_id,
    "size" => $size
  ];
}

/* حذف منتج */
if(isset($_GET['remove'])){
  $remove_index = $_GET['remove'];
  unset($_SESSION['cart'][$remove_index]);
}

include "includes/header.php";
?>

<link rel="stylesheet" href="css/style.css">

<h2 style="padding:20px;">Your Cart</h2>

<div class="cart-container">
<?php
$total = 0;

if(empty($_SESSION['cart'])){
  echo "<p>Cart is empty</p>";
}

foreach($_SESSION['cart'] as $index => $item){
  $id = $item['id'];
  $size = $item['size'];

  $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
  $product = mysqli_fetch_assoc($result);

  $total += $product['price'];
?>
  <div class="cart-item">
    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">

    <div class="cart-info">
      <h3><?php echo $product['name']; ?></h3>
      <p><?php echo $product['price']; ?> DH</p>
      <p>Size: <?php echo $size; ?></p>
    </div>

    <div class="cart-options">
      <form method="post" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <select name="size">
          <option <?php if($size=="S") echo "selected"; ?>>S</option>
          <option <?php if($size=="M") echo "selected"; ?>>M</option>
          <option <?php if($size=="L") echo "selected"; ?>>L</option>
          <option <?php if($size=="XL") echo "selected"; ?>>XL</option>
        </select>
      </form>

      <a href="cart.php?remove=<?php echo $index; ?>"><button>Remove</button></a>
    </div>
  </div>
<?php } ?>
</div>

<div class="cart-total">
  <p>Total: <?php echo $total; ?> DH</p>
  <a href="checkout.php" class="checkout-btn">Checkout</a>
</div>

<?php include "includes/footer.php"; ?>
