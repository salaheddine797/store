<?php
$conn = mysqli_connect("localhost", "root", "", "clothing_store");

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}
?>
