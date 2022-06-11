<?php
  session_start();
  include("../database/menu-connection.php");
  if(isset($_POST['submit'])){
    $itemname = $_POST['item-name'];
    $itemprice =$_POST['item-price'];

    if($itemname=="" && $itemprice==""){
      $_SESSION['error'] = "please enter itemname and price";
    }
    else if($itemname==""){
      $_SESSION['error'] = "please enter itemname";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~`?><>,|=_+¬-]/', $itemname)){
      $_SESSION['error'] = "you are not allowed to use special character";
    }
    else if(strlen($itemname)<=4){
      $_SESSION['error'] = "too short name please use full convienent name";
    }
    else{
      $itemprice =$_POST['item-price'];
      if($itemprice==""){
        $_SESSION['error'] = "please enter itemprice";
      }
      else if(!is_numeric($itemprice)){
        $_SESSION['error'] = "please enter numeric value for price";
      }
      else {
        $checkDuplicateItem = "select * from `soup` where item_name = '$itemname' ";
        $result4 = mysqli_query($conn,$checkDuplicateItem);
        $count = mysqli_num_rows($result4);
    
        if($count>0){
          $_SESSION['repeat-item'] = "Item Already Added";
          }
        else {
          $sql = "insert into `soup` (`item_name`,`item_price`) values('$itemname','$itemprice')";
          $result = mysqli_query($conn,$sql);
      
          if(!$result){
            die("not inserted data");
          }
      
          else {
            header('location:menu-soup.php');
          }
        }
      }
    }
  }
?>