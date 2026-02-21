<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyStore</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "config.php"; ?>
<?php include "includes/header.php"; ?>

<!-- HERO + FILTER -->
<div class="hero-filter">
  <h2>New Collection 2026</h2>

  <form method="GET">
    <select name="category" onchange="this.form.submit()">
      <option value="all">All</option>
      <option value="tshirts" <?php if(isset($_GET['category']) && $_GET['category']=="tshirts") echo "selected"; ?>>T-shirts</option>
      <option value="hoodies" <?php if(isset($_GET['category']) && $_GET['category']=="hoodies") echo "selected"; ?>>Hoodies</option>
      <option value="shoes" <?php if(isset($_GET['category']) && $_GET['category']=="shoes") echo "selected"; ?>>Shoes</option>
    </select>
  </form>
</div>

<h2>All Products</h2>

<div class="products">
<?php
if(isset($_GET['category']) && $_GET['category'] != "all"){
  $cat = $_GET['category'];
  $result = mysqli_query($conn, "SELECT * FROM products WHERE category='$cat'");
} else {
  $result = mysqli_query($conn, "SELECT * FROM products");
}

while($row = mysqli_fetch_assoc($result)){
?>
  <div class="product">
    <img src="images/<?php echo $row['image']; ?>" width="150">
    <h3><?php echo $row['name']; ?></h3>
    <p><?php echo $row['price']; ?> DH</p>
    <a href="product.php?id=<?php echo $row['id']; ?>">View</a>
  </div>
<?php } ?>
</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
