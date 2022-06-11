<?php
  session_start();
  error_reporting(0);  
  include("../common/header.php");
  include("../database/connection.php");
  include("./menu-item.php");
  $id = $_GET['updateid'];
  
  // to display the previous result of data
  $sql = "select * from `today-special` where id=$id";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  
  $itemname = $row['item_name'];
  $itemprice = $row['item_price'];
  
  if(isset($_POST['submit'])){
    $_SESSION['role']=1;

    $itemname =$_POST['item-name'];
    $itemprice =$_POST['item-price'];

    if($itemname==""&&$itemprice==""){
      header('location:ts-update.php?error=please enter itemname and price');
    }
    else if($itemname==""){
      header('location:ts-update.php?error=please enter itemname');
    }
    else{
      if($itemprice==""){
      header('location:ts-update.php?error=please enter itemprice');
      }
      else if(!is_numeric($itemprice)){
      header('location:ts-update.php?error=please enter numberic value for price');
      }

      else{
        $sql = " update `today-special` set id=$id, item_name='$itemname', item_price='$itemprice' where id=$id";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          die("not inserted data");
        }
        else {
          header('location:home.php?update=item updated successfully....');
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

        <h1>Update - Item</h1>

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
<?php
  include("../common/footer.php");
?>