<!-- header -->
<?php 
$title = "account";
include("layout/header.php");
?>

<?php 

include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
  header('location: register.php');
  exit;
}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    
    header("location: login.php");
    exit;
  }
}


// Change password
if(isset($_POST['change_password'])){

  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $user_email = $_SESSION['user_email'];

   // if password dont match
   if($password !== $confirm_password){
    header('location: account.php?error=passwords dont match');
  }
  // if password is less than  char
  else if(strlen($password) < 6){
    header("location: account.php?error=password must be at least 6 characters");
  }
  // if no errors
  else{
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=? ");
    $stmt->bind_param('ss', md5($password), $user_email);

    if($stmt->execute()){
      header('location: account.php?message=password has been updated successfully');
    }
    else{
      header('location: account.php?error=could not update password');
    }
  }

}

// get orders
if(isset($_SESSION['logged_in'])){

  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");

  $stmt->bind_param("i", $user_id);

  $stmt->execute();

  $orders = $stmt->get_result();
}

?>


<!-- Account -->
<section class="my-5 py-5">
    <?php if(isset($_GET['payment_message'])){ ?>
    <p class="mt-5 text-center" style="color: green;"><?php echo $_GET['payment_message'] . " " . $_SESSION['user_name']; ?></p>
    <?php } ?>

    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color: green;">
                <?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; } ?></p>
            <p class="text-center" style="color: green;">
                <?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; } ?></p>
            <h3>Account Info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name : <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; }  ?></span>
                </p>
                <p>Email :
                    <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; }  ?></span>
                </p>
                <p><a href="#orders" class="" id="orders-btn">Your orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <form method="POST" id="account-form" action="account.php">
                <p class="text-center" style="color: red;">
                    <?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <p class="text-center" style="color: green;">
                    <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?></p>
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="account-password" placeholder="..." name="password"
                        required>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" placeholder="..."
                        name="confirm_password" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Change Password" class="btn" id="change-pass-btn"
                        name="change_password">
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Orders -->
<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h3 class="text-center">Your Orders</h3>
        <hr class="mx-auto">
    </div>
    <table class="mt-5 pt-5">
        <tr>
            <th>Order ID</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
            <th>Order Details</th>
        </tr>

        <?php while($row = $orders->fetch_assoc()){ ?>
        <tr>
            <td>
                <div class="product-info">
                    <!-- <img src="assets/imgs/ionic.jpg" alt=""> -->
                    <div>
                        <p class="mt-3"><?php echo $row['order_id']; ?></p>
                    </div>
                </div>
            </td>

            <td>
                <span>$<?php echo $row['order_cost']; ?></span>
            </td>

            <td>
                <span><?php echo $row['order_status']; ?></span>
            </td>

            <td>
                <span><?php echo $row['order_date']; ?></span>
            </td>

            <td>
                <form method="POST" action="order_details.php">
                    <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <input type="submit" class="btn order-details-btn" name="order_details_btn" value="details"></input>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</section>

<!-- footer -->
<?php include("layout/footer.php") ?>