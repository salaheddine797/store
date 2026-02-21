<?php
include "config.php";
include "includes/header.php";

if(!isset($_GET['id'])){
  echo "Product not found";
  exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
$product = mysqli_fetch_assoc($result);

if(!$product){
  echo "Product not found";
  exit();
}
?>

<link rel="stylesheet" href="css/style.css">

<div class="product-page">
  <div class="product-image">
    <img src="images/<?php echo $product['image']; ?>" width="300">
  </div>

  <div class="product-info">
    <h2><?php echo $product['name']; ?></h2>
    <p class="price"><?php echo $product['price']; ?> DH</p>
    <p><?php echo $product['description']; ?></p>

    <form method="post" action="cart.php">
      <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

      <label>Size:</label>
      <select name="size">
        <option>S</option>
        <option>M</option>
        <option>L</option>
        <option>XL</option>
      </select>

      <br><br>

      <button type="submit">Add to Cart</button>
    </form>
  </div>
</div>

<?php include "includes/footer.php"; ?>
