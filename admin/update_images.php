<?php

include('../server/connection.php');

if(isset($_POST['update_images'])){

    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];

    $image1 =$_FILES['image1']['tmp_name'];

    $image_name1 = $product_name.".jpg";

    move_uploaded_file($image1,"../assets/imgs/".$image_name1);

    $stmt = $conn->prepare("UPDATE products SET product_image=? WHERE product_id=?");
    $stmt->bind_param('si',$image_name1,$product_id);

    if($stmt->execute()){
        header('location: products.php?images_updated=Images have been updated successfully');
    }else{
        header('location: products.php?images_failed=Error occured, try again');
    }
}
?>