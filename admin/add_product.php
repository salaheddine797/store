<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

include "../config.php";

if(isset($_POST['add'])){
  $name = $_POST['name'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $gender = $_POST['gender'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  move_uploaded_file($tmp, "../images/".$image);

  mysqli_query($conn, "INSERT INTO products (name, price, image, category, gender)
  VALUES ('$name','$price','$image','$category','$gender')");

  $success = "Product added successfully";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2>Admin</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="logout.php">Logout</a>
  </aside>

  <!-- MAIN -->
  <main class="main">
    <h1>Add New Product</h1>

    <?php if(isset($success)){ ?>
      <p class="success"><?php echo $success; ?></p>
    <?php } ?>

    <form method="post" enctype="multipart/form-data" class="product-form">

      <input type="text" name="name" placeholder="Product name" required>

      <input type="number" name="price" placeholder="Price (DH)" required>

      <select name="category" required>
        <option value="">-- Select category --</option>
        <option value="tshirts">T-shirts</option>
        <option value="hoodies">Hoodies</option>
        <option value="shoes">Shoes</option>
      </select>

      <select name="gender" required>
        <option value="">-- Select gender --</option>
        <option value="men">Men</option>
        <option value="women">Women</option>
      </select>

      <input type="file" name="image" required>

      <button type="submit" name="add">Add Product</button>

    </form>

  </main>
</div>

</body>
</html>
