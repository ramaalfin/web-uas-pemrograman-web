<!-- header -->
<?php 
$title = "Shop";
include("layout/header.php") ;
?>

<?php 
include("server/connection.php");

// use the search section
if(isset($_POST['search'])){

  // 1. determine page number
  if(isset($_GET['page_number']) && $_GET['page_number'] != ""){

    // if user has already entered page then page number is the one that they selected
    $page_number = $_GET['page_number'];
  }

  // if user just entered the default page then page is 1
  else{
    $page_number = 1;
  }

  // 2. return number of products 
  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=? ");
  $stmt1->bind_param('si', $category, $price);
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  //3. products per page
  $total_records_per_page = $total_records;
  $offset = ($page_number-1) * $total_records_per_page;

  $previous_page = $page_number - 1;
  $next_page = $page_number + 1;

  $adjacents = "2";

  if($total_records > 0){
    $total_number_of_pages = ceil($total_records/$total_records_per_page);
  }

   //4. get all products

   $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset,$total_records_per_page");
   $stmt2->bind_param("si",$category,$price);
   $stmt2->execute();
   $products = $stmt2->get_result();//[]
}

// return all products 
else{

  // 1. determine page number
  if(isset($_GET['page_number']) && $_GET['page_number'] != ""){

    // if user has already entered page then page number is the one that they selected
    $page_number = $_GET['page_number'];
  }
  
  // if user just entered the default page then page is 1
  else{
    $page_number = 1;
  }

  // 2. return number of products 
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();

  // 3. products per page
  $total_records_per_page = 8;
  $offset = ($page_number-1) * $total_records_per_page;
  $previous_page = $page_number - 1;
  $next_page = $page_number + 1;

  $adjacents = "2";

  if($total_records > 0){
    $total_number_of_pages = ceil($total_records/$total_records_per_page);
  }

  // 4. get all products
  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
  $stmt2->execute();
  $products = $stmt2->get_result();
}

?>

  <!-- side menu for search categories and prices -->
  <section id="search" class="my-5 py-3 ms-2">
    <div class="container mt-5 py-3">
      <p>Search Courses</p>
      <hr>
    </div>

    <form action="shop.php" method='post'>
      <div class="row container mx-auto">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Categories</p>
          <div class="form-check">
            <input type="radio" name="category" value="Basic Programming" class="form-check-input" id="category_one" <?php if(isset($category) && $category=="Basic Programming"){ echo 'checked';} ?>>
            <label for="flexRadioDefault1" class="form-check-label">Basic Programming</label>
          </div>

          <div class="form-check">
            <input type="radio" name="category" value="Web Development" class="form-check-input" id="category_two" <?php if(isset($category) && $category=="Web Development"){ echo 'checked';} ?>>
            <label for="flexRadioDefault2" class="form-check-label">Web Development</label>
          </div>

          <div class="form-check">
            <input type="radio" name="category" value="Mobile Development" class="form-check-input" id="category_three" <?php if(isset($category) && $category=="Mobile Development"){ echo 'checked';} ?>>
            <label for="flexRadioDefault3" class="form-check-label">Mobile Development</label>
          </div>
        </div>
      </div>

      <div class="row container mx-auto mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Price</p>
          <input type="range" name="price" id="customRange2" class="form-range w-50" min="1" max="100" value="<?php if(isset($price)){ echo $price; }else{ echo "50";} ?>">
          <div class="w-50">
            <span style="float: left;">1</span>
            <span style="float: right;">100</span>
          </div>
        </div>
        <div class="form-group my-3 mx-3">
          <input type="submit" value="Search" name="search" class="btn btn-primary">
        </div>

      </div>
    </form>
  </section>

  <!-- Courses -->
  <section id="shop" class="my-5 py-3">
    <div class="container mt-5 py-3">
      <h3>Our Courses</h3>
      <hr>
      <p>Here you can check out the courses</p>
    </div>

    <div class="row mx-auto container">
      
      <?php while($row = $products->fetch_assoc()){ ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="img-fluid mb-3">
          <h5 class="p-name"><?php echo $row['product_name'] ?></h5>
          <p class="p-price">$<?php echo $row['product_price'] ?></p>
          <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
        </div>
      <?php } ?>

    </div>

  <!-- pagination -->
  <?php if(isset($_POST['search'])){ ?>
    
  <?php } else { ?>
    <nav aria-label="Page navigation example" class="mx-auto">
      <ul class="pagination mt-5 mx-auto">

        <li class="page-item <?php if($page_number <= 1){ echo 'disabled'; } ?>">
          <a class="page-link" href="<?php if($page_number <= 1){ echo'#';} else { echo "?page_number=".($page_number-1); } ?>">Previous</a>
        </li>

        <li class="page-item"><a class="page-link" href="?page_number=1">1</a></li>

        <li class="page-item"><a class="page-link" href="?page_number=2">2</a></li>

        <?php if($page_number >= 3){ ?>
        <li class="page-item"><a href="#" class="page-link">...</a></li>
        <li class="page-item"><a class="page-link" href="<?php echo "?page_number=" . $page_number; ?>"><?php echo $page_number; ?></a></li>
        <?php } ?>

        <li class="page-item <?php if($page_number >= $total_number_of_pages){ echo 'disabled';} ?>">
          <a  class="page-link" href="<?php if($page_number >= $total_number_of_pages){ echo '#'; } else{ echo "?page_number=" . ($page_number+1); } ?>">Next</a>
        </li>
      </ul>
    </nav>
  <?php } ?>
  </section>

<!-- footer -->
<?php include("layout/footer.php") ?>