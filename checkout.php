<link rel="stylesheet" href="css/style.css">


<?php

include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "<p style='padding:20px;'>Your cart is empty. <a href='index.php'>Go shopping</a></p>";
    exit();
}

/* Confirm order */
if(isset($_POST['confirm'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $total = 0;
    foreach($_SESSION['cart'] as $item){
        $result = mysqli_query($conn, "SELECT price FROM products WHERE id=".$item['id']);
        $row = mysqli_fetch_assoc($result);
        $total += $row['price'];
    }

    $products = json_encode($_SESSION['cart']); // نخزنو المنتجات كـ JSON

    mysqli_query($conn, "INSERT INTO orders (user_id, products, total, name, address, phone)
                        VALUES ('$user_id', '$products', '$total', '$name', '$address', '$phone')");

    unset($_SESSION['cart']); // نفرغو الكارت بعد الطلب
    echo "<p style='padding:20px;color:green;'>Order confirmed! Thank you for shopping. <a href='index.php'>Go back to store</a></p>";
    exit();
}

include "includes/header.php";
?>

<h2 style="padding:20px;">Checkout</h2>

<div class="cart-container">
<?php
$total = 0;

foreach($_SESSION['cart'] as $index => $item){
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=".$item['id']);
    $product = mysqli_fetch_assoc($result);
    $total += $product['price'];
?>
<div class="cart-item">
    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <div class="cart-info">
        <h3><?php echo $product['name']; ?></h3>
        <p><?php echo $product['price']; ?> DH</p>
        <p>Size: <?php echo $item['size']; ?></p>
    </div>
</div>
<?php } ?>
</div>

<h3 style="padding:20px;">Total: <?php echo $total; ?> DH</h3>

<h3 style="padding:20px;">Shipping Information</h3>

<form method="post" style="padding:20px; max-width:400px;">
    <input type="text" name="name" placeholder="Full Name" required style="width:100%; padding:8px; margin-bottom:10px;">
    <input type="text" name="address" placeholder="Address" required style="width:100%; padding:8px; margin-bottom:10px;">
    <input type="text" name="phone" placeholder="Phone Number" required style="width:100%; padding:8px; margin-bottom:10px;">
    <button type="submit" name="confirm" style="background:black;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">Confirm Order</button>
</form>

<?php include "includes/footer.php"; ?>
