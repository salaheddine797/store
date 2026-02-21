<?php
include "config.php";

if(isset($_POST['register'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, email, password)
          VALUES ('$username', '$email', '$password')";

  mysqli_query($conn, $sql);

  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-page">
  <div class="login-box">

    <div class="login-left">
      <img src="images/profile.jpg" alt="register">
    </div>

    <div class="login-right">
      <h2>Create Account</h2>

      <form method="post">
        <input type="text" name="name" placeholder="Full Name" class="login-input" required>
        <input type="email" name="email" placeholder="Email" class="login-input" required>
        <input type="password" name="password" placeholder="Password" class="login-input" required>

        <button type="submit" name="register" class="login-btn">REGISTER</button>
      </form>

      <div class="login-links">
        <p>Already have account? → <a href="login.php">Login</a></p>
      </div>
    </div>

  </div>
</div>


</body>
</html>
