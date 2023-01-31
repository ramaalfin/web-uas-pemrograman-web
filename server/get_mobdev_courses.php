<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Mobile Development' LIMIT 4");
$stmt->execute();

$mobdev_products = $stmt->get_result();//array = []
?>