<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}

include "../config.php";

if(!isset($_GET['id'])){
  header("Location: dashboard.php");
  exit();
}

$id = $_GET['id'];

/* جلب بيانات المنتج */
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

/* تحديث المنتج */
if(isset($_POST['update'])){
  $name = $_POST['name'];
  $price = $_POST['price'];
  $gender = $_POST['gender'];
  $description = $_POST['description'];

  if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if(file_exists("../images/".$product['image'])){
      unlink("../images/".$product['image']);
    }

    move_uploaded_file($tmp, "../images/".$image);
  } else {
    $image = $product['image'];
  }

  mysqli_query($conn, "UPDATE products SET
    name='$name',
    price='$price',
    gender='$gender',
    image='$image',
    description='$description'
    WHERE id=$id
  ");

  header("Location: dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
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
    <h1>Edit Product</h1>
    <a href="dashboard.php" class="back-link">⬅ Back to Dashboard</a>

    <form method="post" enctype="multipart/form-data" class="product-form" style="margin-top:15px;">

      <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

      <input type="number" name="price" value="<?php echo $product['price']; ?>" required>

      <select name="gender" required>
        <option value="men" <?php if($product['gender']=='men') echo "selected"; ?>>Men</option>
        <option value="women" <?php if($product['gender']=='women') echo "selected"; ?>>Women</option>
      </select>

      <textarea name="description" placeholder="Description"><?php echo $product['description']; ?></textarea>

      <div class="image-preview">
        <p>Current Image:</p>
        <img src="../images/<?php echo $product['image']; ?>">
      </div>

      <label>Change Image:</label>
      <input type="file" name="image">

      <button type="submit" name="update">Update Product</button>

    </form>
  </main>
</div>

</body>
</html>
