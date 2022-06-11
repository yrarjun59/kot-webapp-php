<?php
  session_start();
  error_reporting(0);
  include("../common/header.php");
  include("./menu-sidebar.php");
  include("../database/connection.php");
  $id = $_GET['order-item-id'];

    // to display the previous result of data
    $sql = "select * from `menu-item-soup` where id=$id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);


    $itemname = $row['soup_name'];
    $itemprice = $row['soup_price'];

  if(isset($_POST['submit'])){
    $tablenumber = $_POST['table-number'];

    if($tablenumber==""){
      header('location:menu-soup-order.php?error=please enter table-number&order-item-id='.$id.'');
    }
    else if(!Is_Numeric($tablenumber)){
      header('location:menu-soup-order.php?error=please enter numeric value for table-number&order-item-id='.$id.'');
    }
    else if($tablenumber>50){
      header('location:menu-soup-order.php?error=please enter the table number between 1-50&order-item-id='.$id.'');
    }
    else if($tablenumber==0 ||$tablenumber<0){
      header('location:menu-soup-order.php?error=table number cannot be zero or negative&order-item-id='.$id.'');
    }
    else {
      $quantity = $_POST['quantity'];
      $_SESSION['table-number'] = $tablenumber;
       
      if(!Is_Numeric($quantity)){
        header('location:menu-soup-order.php?error=please enter numeric value&order-item-id='.$id.'');
      }
      else if($quantity==0||$quantity<0){
        header('location:menu-soup-order.php?error=quantity cannot be zero or negative&order-item-id='.$id.'');
      }

      else {
        $sql = "INSERT INTO `customer-order`(`Table_no`, `Item_name`, `Item_price`, `Quantity`) VALUES ('$tablenumber','$itemname', '$itemprice', '$quantity')";
        $result = mysqli_query($conn,$sql);
          
          if(!$result){
            die("not inserted data");
          }
          else {
            $_SESSION['isOrder'] = true;
            header('location:customer-bill.php?item=soup');
          }
      }
    }

  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Order Item</title>
    <link rel="stylesheet" href="../css/menu-soup-order.css">
</head>
  <body>
      
    <div>
      <form action="" method = "post">
        <div class="login-box">
       
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error'];?></p> 
        <?php }?>

        <h1>Confirm Order</h1>

          <div class="textbox">
            table:no
            <input type="text" name ="table-number" placeholder="Your table Number" autocomplete = "off" value="<?php if(isset($_GET['table-number'])) echo $_GET['table-number']?>">
          </div>

          <div class="textdisplay">
            <p>Item: <?php echo'<h4>'.$itemname.'</h4>';?></p>
          </div>

          <div class="textdisplay">
            <p>Price:<?php echo "Rs"."&nbsp;"  .'<h4>'.$itemprice.'</h4>';?></p>
          </div>

          <div class="textbox">
              quantity
            <input type="text" name="quantity" placeholder = "Enter Quantity" required autocomplete = "off" value = 1>
          </div>
          
          <input type="submit" value="Confirm" class="btn" name= "submit" required>
        </div>
        </form>
    </div>
  </body>
<?php
  include("../common/footer.php");
?>