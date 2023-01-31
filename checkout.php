<!-- header -->
<?php 
$title = "checkout";
include("layout/header.php");
?>

<?php 
if(!empty($_SESSION['cart'])){
  // let user in

}
// if checkout is empty send user to home page
else{
  header('location: index.php');
}
?>

  <!-- Checkout -->
  <section class="my-5 py-3">
    <div class="container text-center mt-5">
      <h2 class="form-weight-bold">Check Out</h2>
      <hr class="mx-auto">
    </div>

    <div class="container mx-auto">
      <form action="/server/place_order.php" method="POST" id="checkout-form">
      <p class="text-center" style="color: red; ">
        <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>

        <?php if(isset($_GET['message'])){  ?>
          <a href="login.php" class="btn btn-primary">Login</a>
        <?php } ?>          
      </p>

        <div class="form-group checkout-small-element">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="checkout-name" name="name" placeholder="...">
        </div>

        <div class="form-group checkout-small-element">
          <label for="regitser">Email</label>
          <input type="email" class="form-control" id="checkout-email" name="email" placeholder="...">
        </div>

        <div class="form-group checkout-small-element">
          <label for="text">Phone</label>
          <input type="text" class="form-control" id="checkout-phone" name="phone" placeholder="...">
        </div>

        <div class="form-group checkout-small-element">
          <label for="city">City</label>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="...">
        </div>

        <div class="form-group checkout-large-element">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="checkout-address" name="address" placeholder="...">
          </div>

        <div class="form-group checkout-btn-container">
          <p>Total amount: $ <?php echo $_SESSION['total']; ?></p>
          <input type="submit" class="btn" id="checkout-btn" value="Place Order" name="place_order">
        </div>
      </form>
    </div>
  </section>

<!-- footer -->
<?php include("layout/footer.php") ?>