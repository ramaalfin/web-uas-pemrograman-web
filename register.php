<!-- header -->
<?php 
$title = "register";
include("layout/header.php");
?>

<?php 
include('server/connection.php');

// if user has already registered, then take user to account page
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

// if user create registration
if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // if password dont match
  if($password !== $confirm_password){
    header('location: register.php?error=passwords dont match');
  }

  // if password is less than  char
  else if(strlen($password) < 6){
    header("location: register.php?error=password must be at least 6 characters");
  }

  // if there is no error
  else{
    // check whether there is a user with this email or not
    $stmt1 = $conn->prepare('SELECT count(*) FROM users where user_email=?');
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();
  
    // if there is a user already registered with this email
    if($num_rows != 0){
      header('location: register.php?error=user with this email already exists');
    }
    // if no user registered this email before
    else{
      // create a new user
      $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?,?,?)");
    
      $stmt->bind_param("sss", $name, $email, md5($password));

      // if account was created successfully
      if($stmt->execute()){
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register_success=Your registration was successfully');
      }
      // account couldn't be created
      else{
        header('location: register.php?error=could not create an account at the moment');
      }
    }
  }
}


?>

  <!-- regsiter -->
  <section class="my-5 py-5">
    <div class="container text-center mt-5">
      <h2 class="form-weight-bold">Register</h2>
      <hr class="mx-auto">
    </div>

    <div class="container mx-auto">
      <form action="register.php" method="POST" id="register-form">
        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="...">
        </div>

        <div class="form-group">
          <label for="regitser">Email</label>
          <input type="email" class="form-control" id="register-email" name="email" placeholder="...">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="...">
        </div>

        <div class="form-group">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" class="form-control" id="register-confirm-password" name="confirm_password" placeholder="...">
        </div>

        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" value="Register" name="register">
        </div>

        <div class="form-group">
          <a href="login.php" id="login-url" class="btn">Do you have an account? Login</a>
        </div>
      </form>
    </div>
  </section>

<!-- footer -->
<?php include("layout/footer.php") ?>