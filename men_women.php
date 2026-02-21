<?php
include "config.php";

$gender = isset($_GET['gender']) ? $_GET['gender'] : 'all';
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

$sql = "SELECT * FROM products";

if($gender != "all" && $category != "all"){
  $sql .= " WHERE gender='$gender' AND category='$category'";
}
elseif($gender != "all"){
  $sql .= " WHERE gender='$gender'";
}
elseif($category != "all"){
  $sql .= " WHERE category='$category'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Products</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<div class="hero">
  <h2>Our Products</h2>
</div>

<form method="get" style="padding:20px; display:flex; gap:15px; justify-content:center;">
  
  <select name="gender">
    <option value="all">All</option>
    <option value="men" <?php if($gender=="men") echo "selected"; ?>>Men</option>
    <option value="women" <?php if($gender=="women") echo "selected"; ?>>Women</option>
  </select>

  <select name="category">
    <option value="all">All</option>
    <option value="tshirts" <?php if($category=="tshirts") echo "selected"; ?>>T-shirts</option>
    <option value="hoodies" <?php if($category=="hoodies") echo "selected"; ?>>Hoodies</option>
    <option value="shoes" <?php if($category=="shoes") echo "selected"; ?>>Shoes</option>
  </select>

  <button type="submit">Filter</button>
</form>

<div class="products">

<?php
if(mysqli_num_rows($result) == 0){
  echo "<p style='padding:20px;'>No products found.</p>";
}

while($row = mysqli_fetch_assoc($result)){
?>
  <div class="product">
    <img src="images/<?php echo $row['image']; ?>">
    <h3><?php echo $row['name']; ?></h3>
    <p><?php echo $row['price']; ?> DH</p>
    <a href="product.php?id=<?php echo $row['id']; ?>">View</a>
  </div>
<?php } ?>

</div>

<?php include "includes/footer.php"; ?>
</body>
</html>
