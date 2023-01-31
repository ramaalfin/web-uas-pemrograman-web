<!-- header -->
<?php 
$title = "cart";
include("layout/header.php");
?>

<?php 

// include("server/connection.php");

if(isset($_POST['add_to_cart'])){
  if(!$_SESSION['logged_in']){
    echo "<script>alert('You must login first')</script>";
    header('location: login.php');
  }
  // if user has already added a product to cart
  if(isset($_SESSION['cart'])){
    $products_array_user_ids = array_column($_SESSION['cart'], "user_id"); // [2,3,4,5]
    $products_array_ids = array_column($_SESSION['cart'], "product_id"); // [2,3,4,5]
    $error = 0;
    foreach($_SESSION["cart"] as $cart) {
      if ($cart['product_id'] == $_POST["product_id"] && $cart['user_id'] == $_SESSION['user_id']) {
        $error = 1;
        break;
      }
    }
    // if product has already been added to cart or not
    if($error == 0){

      $product_id = $_POST['product_id'];

      $product_array = array(
                        "user_id" => $_SESSION['user_id'],
                        "product_id" => $_POST['product_id'],
                        "product_name" => $_POST['product_name'],
                        "product_price" => $_POST['product_price'],
                        "product_image" => $_POST['product_image'],
                        "product_source" => $_POST['product_source'],
      );

      $_SESSION["cart"][] = $product_array;
    }

    // product has already been added
    else{
      echo "<script>alert('Product was already to cart')</script>";
    }
  }
  // if this is the first product
  else{
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id']; 
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_source = $_POST['product_source'];
    
    $product_array = array(
                      'user_id' => $user_id,
                      'product_id' => $product_id,
                      'product_name' => $product_name,
                      'product_price' => $product_price,
                      'product_image' => $product_image,
                      'product_source' => $product_source,
    );
    $_SESSION["cart"][] = $product_array;
  }
  // calculate total
  calculateTotalCart();
}
// remove product from the cart
elseif (isset($_POST['remove_product'])) {
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  // calculate total
  calculateTotalCart();
}



?>
  <!-- Cart -->
  <section class="cart container my-5 py-5">
    <div class="container mt-5" >
      <h2 class="font-weight-bolde">Your Cart</h2>
      <hr>
    </div>
    <table class="mt-5 pt-5">
      <tr>
        <th>Courses</th>
        <th>Sub Total</th>
      </tr>

      <?php if(isset($_SESSION["cart"])){ ?>

        <?php foreach($_SESSION['cart'] as $key => $value){ ?>
        <?php if($_SESSION['user_id'] != $value['user_id']){
          continue;
        } ?>
        <tr>
          <td>
            <div class="product-info">
              <img src="assets/imgs/<?php echo $value['product_image']; ?>" alt="<?php echo $value['product_name']; ?>">
              <div>
                <p><?php echo $value['product_name']; ?></p>
                <span>$<?php echo $value['product_price']; ?></span>
                <br>
                <form action="cart.php" method="POST">
                  <input type="hidden" name="product_source" value="<?php echo $value['product_source']; ?>">
                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                  <input type="submit" name="remove_product" class="remove-btn" value="Remove">
                </form>
              </div>
            </div>
          </td>

          <td>
            <span>$</span>
            <span class="product-price"><?php echo $value['product_price']; ?></span>
          </td>
        </tr>

        <?php } ?>
      <?php } ?>
        
    </table>
    <div class="cart-total">
      <table>
        <tr>
          <td>Total</td>
          <?php if(isset($_SESSION['cart'])) { ?>
            <td>$<?php echo $_SESSION['total']; ?></td>
          <?php }?>
        </tr>
      </table>
    </div>

    <div class="checkout-container">
      <form action="checkout.php" method="post">
        <input class="btn checkout-btn" value="Checkout" name="checkout" type="submit">
      </form>
    </div>

  </section>

  <!-- footer -->
<?php include("layout/footer.php") ?>