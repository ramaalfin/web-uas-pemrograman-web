<!-- header -->
<?php 
$title = "order details";
include("layout/header.php");
?>

<?php 

/*
not paid
paid
*/

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);
}
else{
    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details){
    $total_price = 0;
    foreach($order_details as $row){ 
        $product_price = $row['product_price'];
        $total_price = $total_price + $product_price;
    }
    return $total_price;
  }


?>

    <!-- Order Details -->
    <section id="orders" class="orders container my-5 py-5">
        <div class="container mt-5">
            <h2 class="text-center">Order Details</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Courses</th>
                <th>Price</th>
            </tr>

            <?php foreach($order_details as $row){ ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name'] ?>">
                        <div>
                            <p class="mt-3"><?php echo $row['product_name'] ?></p>

                            <?php if($order_status == "paid"){ ?>
                                <a href="download.php?filename=<?php echo $row['product_source']?>">Download</a>
                            <?php } ?>
                        </div>
                    </div>
                </td>

                <td>
                    <span>$<?php echo $row['product_price'] ?></span>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php if($order_status == "not paid"){ ?>
            <form method="POST" action="payment.php" style="text-align: center;">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
                <input type="hidden" name="order_status" value="<?php  echo $order_status;?>">
                <input type="submit" name="order_pay_btn" value="Pay Now" class="btn btn-primary">
            </form>
        <?php } ?>

    </section>

<!-- footer -->
<?php include("layout/footer.php") ?>