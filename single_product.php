<!-- header -->
<?php 
$title = "single product";
include("layout/header.php");
?>

<?php 

include("server/connection.php");

if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];
  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
  $stmt->bind_param("i", $product_id);
  $stmt->execute();

  $product = $stmt->get_result();

}
// no product id was given
else{
  header("location: index.php");
}


?>





<!-- Single Product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        <?php while($row = $product->fetch_assoc()){ ?>

        <div class="col-lg-5 col-md-6 col-sm-12">
            <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>"
                class="img-fluid w-100 pb-1" id="mainImg">
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <h5 class="p-category"><?php echo $row['product_category']; ?></h5>
            <h3 class="p-name pt-3"><?php echo $row['product_name']; ?></h3>
            <p class="p-price">$<?php echo $row['product_price']; ?></p>

            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" name="product_source" value="<?php echo $row['product_source']; ?>">
                <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
            </form>

            <h4 class="mt-4 mb-2">Courses Details</h4>
            <span><?php echo $row['product_description'] ?></span>
        </div>

        <?php } ?>
    </div>
</section>

<!-- products -->
<section id="related-featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Also may you like</h3>
        <hr class="mx-auto">
        <p>Here you can checkout our courses</p>
    </div>

    <div class="row mx-auto container-fluid">

      <?php 
      
      include("server/connection.php");

      $related_products = "SELECT * FROM products order by rand() LIMIT 4";
      $result = mysqli_query($conn, $related_products);
      while($row = mysqli_fetch_assoc($result)){ ?>
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
<?php include("layout/footer.php") ?>