<?php
  session_start();
  include("connection.php");
  $id = $_GET['updateid'];

    // to display the previous result of data
    $sql = "select * from `today-special` where id=$id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $itemname = $row['item_name'];
    $itemprice = $row['item_price'];

  if(isset($_POST['submit'])){
    $itemname =$_POST['item-name'];
    $itemprice =$_POST['item-price'];

      $sql = " update `today-special` set id=$id, item_name='$itemname', item_price='$itemprice' where id=$id";
      $result = mysqli_query($conn,$sql);
      
      if(!$result){
        die("not updated data");
      }
      else {
        header('location:../components/welcome.php');
      }
    }
?>
