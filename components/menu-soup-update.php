<?php
  session_start();
  error_reporting(0);
  $id = $_GET['updateid'];
  include("../common/header.php");
  include("../database/connection.php");
  include("./menu-sidebar.php");

    // to display the previous result of data
    $sql = "select * from `menu-item-soup` where id=$id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $itemname = $row['soup_name'];
    $itemprice = $row['soup_price'];

  if(isset($_POST['submit'])){
    $itemname =$_POST['item-name'];
    $itemprice =$_POST['item-price'];

    if($itemname==""&&$itemprice==""){
      header('location:menu-soup-update.php?error=please enter itemname and price');
    }
    else if($itemname==""){
      header('location:menu-soup-add.php?error=please enter itemname');
    }
    
    else{
      if($itemprice==""){
      header('location:menu-soup-add.php?error=please enter price');
      }
      else if(!is_numeric($itemprice)){
        header('location:menu-soup-add.php?error=please enter numeric value for price');
      }
      else if($itemprice<=0){
        header('location:menu-soup-add.php?error=price cannot be negative or zero');
      }
      else {
        $sql = " update `menu-item-soup` set soup_name='$itemname', soup_price='$itemprice' where id=$id";
        $result = mysqli_query($conn,$sql);
        if(!$result){
          die("not inserted data");
        }
        else {
          header('location:menu-soup.php?update=soup updated successfully.....');              
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

        <h2>Update-Soup</h2>

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