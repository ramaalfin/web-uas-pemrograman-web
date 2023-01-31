<?php 
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Basic Programming' LIMIT 4");
$stmt->execute();

$basprog_product = $stmt->get_result();//array = []
?>