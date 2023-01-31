<!-- header -->
<?php 
$title = 'home';
include("layout/header.php") ;
?>

  <!-- MAIN -->
  <section id="home">
    <div class="container">
      <h5 class="text-uppercase">new arrivals</h5>
      <h1 class="text-capitalize"><span>best prices</span> this season</h1>
      <p>codecourse offers the best courses for the most affordable prices</p>
      <a href="shop.php"><button class="buy-btn text-uppercase">shop now</button></a>
    </div>
  </section>

  <!-- web development -->
  <section id="webdev" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Web Development</h3>
      <hr class="mx-auto">
      <p>Here you can check out our Web Development courses</p>
    </div>

    <div class="row mx-auto container-fluid">

      <?php include("server/get_webdev_courses.php"); ?>

      <?php while($row = $webdev_products->fetch_assoc()){ ?>

      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?php echo $row["product_image"] ?>" alt="" class="img-fluid mb-3">
        <h5 class="p-name"><?php echo $row["product_name"] ?></h5>
        <p class="p-price">$<?php echo $row["product_price"] ?></p>
        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>

      <?php } ?>
    </div>
  </section>

  <!-- mobile development -->
  <section id="mobdev" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Mobile Development</h3>
      <hr class="mx-auto">
      <p>Here you can check out our Mobile Development courses</p>
    </div>

    <div class="row mx-auto container-fluid">

      <?php include("server/get_mobdev_courses.php"); ?>

      <?php while($row = $mobdev_products->fetch_assoc()){ ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?php echo $row["product_image"]; ?>" alt="" class="img-fluid mb-3">
        <h5 class="p-name"><?php echo $row["product_name"]; ?></h5>
        <h4 class="p-price">$<?php echo $row["product_price"]; ?></h4>
        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>

      <?php } ?>
    </div>
  </section>

  <!-- basic programming -->
  <section id="basic-programming" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Basic Programming</h3>
      <hr class="mx-auto">
      <p>Here you can check out our Basic Programming courses</p>
    </div>

    <div class="row mx-auto container-fluid">

      <?php include("server/get_basprog_courses.php"); ?>

      <?php while($row = $basprog_product->fetch_assoc()){ ?>
      <div class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img src="assets/imgs/<?php echo $row["product_image"]; ?>" alt="" class="img-fluid mb-3">
        <h5 class="p-name"><?php echo $row["product_name"]; ?></h5>
        <h4 class="p-price">$<?php echo $row["product_price"]; ?></h4>
        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
      </div>
      <?php } ?>
    </div>
  </section>

<!-- footer -->
<?php include("layout/footer.php"); ?>