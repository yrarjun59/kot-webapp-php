<?php
  session_start();
  include("connection.php");
  if(isset($_POST['submit'])){
    $itemname =$_POST['item-name'];
    $itemprice =$_POST['item-price'];

    $checkDuplicateItem = "select * from `today-special` where item_name = '$itemname' ";
    $result4 = mysqli_query($conn,$checkDuplicateItem);
    $count = mysqli_num_rows($result4);

    if($count>0){
        $_SESSION['repeat-item'] = "Item Already Added";
        header('location:../components/welcome.php');
      }
    else {
      $sql = "insert into `today-special` (`item_name`,`item_price`) values('$itemname','$itemprice')";
      $result = mysqli_query($conn,$sql);
  
      if(!$result){
        die("not inserted data");
      }
  
      else {
        // echo "data inserted successfully";
        $_SESSION['add-message'] = "Item added Successfully";
        header('location:../components/welcome.php');
      }
    
    }

  }
?>
