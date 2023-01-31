<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Web Development' LIMIT 4");
$stmt->execute();

$webdev_products = $stmt->get_result();//array = []
?>