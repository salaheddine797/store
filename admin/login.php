<?php
session_start();
include "../config.php";

if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM admins WHERE username='$username'";
  $result = mysqli_query($conn, $sql);
  $admin = mysqli_fetch_assoc($result);

  if($admin && password_verify($password, $admin['password'])){
    $_SESSION['admin'] = $admin['username'];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Wrong username or password";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <!-- استعمل نفس css ديال الادمن -->
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="login-container">
  <div class="login-box">
    <h2>Admin Login</h2>

    <?php if(isset($error)){ ?>
      <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</div>

</body>
</html>
