<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: login.php");
  exit();
}
include "../config.php";

/* حذف المنتج */
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $res = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
  $row = mysqli_fetch_assoc($res);
  if($row && file_exists("../images/".$row['image'])){
    unlink("../images/".$row['image']);
  }

  mysqli_query($conn, "DELETE FROM products WHERE id=$id");
  header("Location: dashboard.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <h2>Admin</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="../logout.php">Logout</a>
  </aside>

  <!-- MAIN -->
  <main class="main">
    <h1>Products</h1>

    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Gender</th>
        <th>Image</th>
        <th>Action</th>
      </tr>

      <?php
      $result = mysqli_query($conn, "SELECT * FROM products");
      while($row = mysqli_fetch_assoc($result)){
      ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?> DH</td>
        <td><?php echo $row['gender']; ?></td>
        <td><img src="../images/<?php echo $row['image']; ?>"></td>
        <td>
          <a class="edit" href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
          <a class="delete" href="dashboard.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
      <?php } ?>

    </table>

  </main>
</div>

</body>
</html>
