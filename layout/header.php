<?php
session_start();

function calculateTotalCart(){
  $total_price = 0;
  $total_quantity = 0;
  if (isset($_SESSION["cart"])){
    foreach($_SESSION['cart'] as $key => $value){
      if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['user_id'] != $value['user_id']) {
          continue;
        }
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
    
        $total_price = $total_price + $price;
        
        $total_quantity = $total_quantity+1;
      }
    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- fontawesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- css -->
  <link rel="stylesheet" href="assets/css/style.css">

  <title><?php echo $title ?></title>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container">
      <!-- <img src="" alt="" class="logo"> -->
      <a class="logo-txt" href="index.php"><span>code</span>course</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse nav-button" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a href="cart.php">
              <i class="fas fa-shopping-cart">
                <?php calculateTotalCart(); ?>
                <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){ ?>
                  <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                <?php } ?>
              </i>
            </a>
            <a href="account.php"><i class="fas fa-user"></i></a>
          </li>
      </div>
    </div>
  </nav>