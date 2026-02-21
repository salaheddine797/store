<?php
session_start();
include "config.php";

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  $user = mysqli_fetch_assoc($result);

  if($user && password_verify($password, $user['password'])){
    $_SESSION['user'] = $user['username'];
    $_SESSION['user_id'] = $user['id'];
    header("Location: index.php");
  } else {
    echo "Invalid email or password";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-page">
  <div class="login-box">

    <div class="login-left">
      <img src="images/profile.jpg" alt="login">
    </div>

    <div class="login-right">
      <h2>Member Login</h2>

      <form method="post">
        <input type="email" name="email" placeholder="Email" class="login-input" required>
        <input type="password" name="password" placeholder="Password" class="login-input" required>

        <button type="submit" name="login" class="login-btn">LOGIN</button>
      </form>

      <div class="login-links">
        <p>Create your account → <a href="register.php">Register</a></p>
      </div>
    </div>

  </div>
</div>


</body>
</html>
