<?php session_start(); ?>
<header>
  <h1>MyStore</h1>
  <nav>
    <a href="index.php">Home</a>
<a href="men_women.php?gender=men&category=all">Men</a>
<a href="men_women.php?gender=women&category=all">Women</a>


    <a href="cart.php">Cart</a>

    <?php if(isset($_SESSION['user'])){ ?>
      <span style="color:white;">Hello, <?php echo $_SESSION['user']; ?></span>
      <a href="logout.php">Logout</a>
    <?php } else { ?>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    <?php } ?>
  </nav>
</header>
