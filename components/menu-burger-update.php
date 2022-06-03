<?php
  session_start();
  error_reporting(0);
  $_SESSION['role']==1;
  $id = $_GET['updateid'];
  include("../database/connection.php");

    // to display the previous result of data
    $sql = "select * from `menu-item-burger` where id=$id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $itemname = $row['burger_name'];
    $itemprice = $row['burger_price'];

  if(isset($_POST['submit'])){
    $itemname =$_POST['item-name'];
    $itemprice =$_POST['item-price'];

    if($itemname==""&&$itemprice==""){
      header('location:menu-burger-update.php?error=please enter itemname and price');
    }
    else if($itemname==""){
      header('location:menu-burger-add.php?error=please enter itemname');
    }
    
    else{
      if($itemprice==""){
      header('location:menu-burger-add.php?error=please enter price');
      }
      else if(!is_numeric($itemprice)){
        header('location:menu-burger-add.php?error=please enter numeric value for price');
      }
      else if($itemprice<=0){
        header('location:menu-burger-add.php?error=price cannot be negative or zero');
      }
      else {
        $sql = " update `menu-item-burger` set burger_name='$itemname', burger_price='$itemprice' where id=$id";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          die("not inserted data");
        }
        else {
          header('location:menu-burger.php?update=burger updated successfully.....');              
        }
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Update Item</title>
    <link rel="stylesheet" href="../css/ts-update.css">
</head>
  <body>
      
    <div>
      <form action="" method = "post">
        <div class="login-box">
        
        <?php if(isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error'];?></p> 
        <?php }?>

        <h2>Update-Burger</h2>

          <div class="textbox">
            <input type="text" name ="item-name" placeholder="Item Name"  autocomplete = "off" value = '<?php echo $itemname;?>'>
          </div>

          <div class="textbox">
            <input type="text" name ="item-price" placeholder="Item Price"  autocomplete = "off"value = '<?php echo $itemprice;?>'>
          </div>
          
          <input type="submit" value="Update" class="btn" name= "submit" required>
        </div>
        </form>
    </div>
    
  </body>
