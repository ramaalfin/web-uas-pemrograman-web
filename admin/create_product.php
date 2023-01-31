<?php

// include('../server/connection.php');
// if(isset($_FILES['image1'])){
//     $errors= array();
//     $file_name = $_FILES['image1']['name'];
//     $file_size =$_FILES['image1']['size'];
//     $file_tmp =$_FILES['image1']['tmp_name'];
//     $file_type=$_FILES['image1']['type'];
//     $file_ext=strtolower(end(explode('.',$_FILES['image1']['name'])));
    
//     $extensions= array("jpeg","jpg","png");
    
//     if(in_array($file_ext,$extensions)=== false){
//        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
//     }
    
//     if($file_size > 2097152){
//        $errors[]='File size must be excately 2 MB';
//     }
    
//     if(empty($errors)==true){
//        move_uploaded_file($file_tmp,"../assets/imgs/".$file_name);
//        echo "Success";
//     }else{
//        print_r($errors);
//     }
//  }

//  function setImageNames($conn){
//       //create a new user
//       $stmt = $conn->prepare("INSERT INTO products (user_name,user_email,user_password) 
//       VALUES (?,?,?)");

//      // $stmt->bind_param('sss',$name,$email,md5($password));
//  }

include('../server/connection.php');

if(isset($_POST['create_product'])){

 $product_name = $_POST['name'];
 $product_description = $_POST['description'];
 $product_price = $_POST['price'];
 $product_category = $_POST['category'];
 $product_source = $_POST['source'];

 //this is the file itself (image)
 $image1 =$_FILES['image1']['tmp_name'];
 //$file_name = $_FILES['image1']['name'];

 $source = $_FILES['source']['tmp_name'];

 //image names
 $image_name1 = $product_name.".jpg";

 $source_download = $product_name.".zip";

 //upload images
 move_uploaded_file($image1,"../assets/imgs/".$image_name1);
 move_uploaded_file($source,"../files/".$source_download);


  //create a new user
  $stmt = $conn->prepare("INSERT INTO products (product_name,product_description,product_price, product_image, product_category, product_source) VALUES (?,?,?,?,?,?)");
                                                    
   $stmt->bind_param('ssssss',$product_name,$product_description,$product_price,$image_name1,$product_category,$source_download);
    if($stmt->execute()){
        header('location: products.php?product_created=Product has been created successfully');
    }else{
        header('location: products.php?product_failed=Error occured, try again');
    }
}
?>