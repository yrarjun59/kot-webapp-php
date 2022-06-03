<?php
  session_start();
  error_reporting(0);  
  include("../database/connection.php");
  if(isset($_POST['submit'])){
    $_SESSION['role']=1;
    $itemname = $_POST['item-name'];
    $itemprice =$_POST['item-price'];

    if($itemname=="" && $itemprice==""){
      header('location:ts-add.php?error=please enter itemname and price');
    }
    else if($itemname==""){
      header('location:ts-add.php?error=please enter itemname');
    }
    
    else{
      $itemprice =$_POST['item-price'];
      if($itemprice==""){
        header('location:ts-add.php?error=please enter itemprice');
      }
      else if(!is_numeric($itemprice)){
        header('location:ts-add.php?error=please enter numberic value for price');        $_SESSION['error'] = "please enter numeric value for price";
      }
      else {
        $checkDuplicateItem = "select * from `today-special` where item_name = '$itemname' ";
        $result4 = mysqli_query($conn,$checkDuplicateItem);
        $count = mysqli_num_rows($result4);
    
        if($count>0){
          header('location:ts-add.php?error=please enter numberic value for price');        $_SESSION['error'] = "please enter numeric value for price";
          }
        else {
          $sql = "insert into `today-special` (`item_name`,`item_price`) values('$itemname','$itemprice')";
          $result = mysqli_query($conn,$sql);
      
          if(!$result){
            die("not inserted data");
          }
          else {       
          header('location:home.php?success=item added successfully....');
          }
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Add Today Special</title>
    <link rel="stylesheet" href="../css/ts-add.css">
</head>
  <body>
    <div>
      <form action="" method = "post">
        <div class="login-box">
        
        <?php if(isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error'];?></p> 
        <?php }?>

        <h2>Add - Item</h2>
          
        <div class="textbox">
            <input class="input" type="text" name ="item-name" placeholder="Item Name"  autocomplete = "off">
          </div>

          <div class="textbox">
            <input class="input" type="text" name ="item-price" placeholder="Item Price"  autocomplete = "off">
          </div>
          
          <input type="submit" value="Add" class="btn" name= "submit" required>
        </div>
        </form>
    </div>
    
  </body>
</html>