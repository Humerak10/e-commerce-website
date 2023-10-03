<?php
$pencil = $_POST['pencil'];
//database co
$conn = new mysqli('localhost','root','','product details');

if($conn->connect_error){
    die('Connection Failed :' .$conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into product details(name,price,image,description)")
    values(?,?,?,?);
      $stmt->bind_param("siss",$name, $price, $image, description)
          $stmt->execute();
      $stmt->close();
      $conn->close();
     
    }
?>