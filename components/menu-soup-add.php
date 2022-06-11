<?php
  session_start();
  error_reporting(0);
  include("../common/header.php");
  include("../database/connection.php");
  include("./menu-sidebar.php");
  
  if(isset($_POST['submit'])){
    $_SESSION['role']==1;
    $itemname = $_POST['item-name'];
    $itemprice =$_POST['item-price'];

    if($itemname=="" && $itemprice==""){
      header('location:menu-soup-add.php?error=please enter itemname and price');
    }
    else if($itemname==""){
      header('location:menu-soup-add.php?error=please enter itemname');
    }
    else{
      $itemprice =$_POST['item-price'];
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
        $checkDuplicateItem = "select * from `menu-item-soup` where soup_name = '$itemname' ";
        $result4 = mysqli_query($conn,$checkDuplicateItem);
        $count = mysqli_num_rows($result4);
    
        if($count>0){
        header('location:menu-soup-add.php?error=this item already added');

          }
        else {
          $sql = "insert into `menu-item-soup` (`soup_name`,`soup_price`) values('$itemname','$itemprice')";
          $result = mysqli_query($conn,$sql);
      
          if(!$result){
            die("not inserted data");
          }
      
          else {
            header('location:menu-soup.php?success=soup added successfully.....');
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
    <title>Add Soup</title>
    <link rel="stylesheet" href="../css/ts-add.css">
</head>
  <body>
    <div>
      <form action="" method = "post">
        <div class="login-box">
        
        <?php if(isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error'];?></p> 
        <?php }?>
        
      <h2>Add - Soup</h2>
          <div class="textbox">
            <input type="text" name ="item-name" placeholder="Item Name"  autocomplete = "off">
          </div>

          <div class="textbox">
            <input type="text" name ="item-price" placeholder="Item Price"  autocomplete = "off">
          </div>

          <input type="submit" value="Add" class="btn" name= "submit" required>
        </div>
        </form>
    </div>
    
  </body>
</html>

<?php
  include("../common/footer.php");
?>