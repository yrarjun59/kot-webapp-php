<?php
    // require("../common/header.php");
    error_reporting(0);  
    session_start();
    include("../database/connection.php");
    $table_no = $_SESSION['table-number'];
    $category = $_GET['item'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bill.css">
    <script src="../js/show-confirm.deliver.js" defer></script>
    <title>Bill </title>
</head>
<body>
    
    <div class="container">
        <h3 style ="text-align:center;color: #FF4742;">Your Bill</h3>
        <h4 style="text-align:center;">Your Table No: <?php echo $table_no?></h4>
        
        <?php if(isset($_GET['update'])) { ?>
            <p class="update"><?php echo $_GET['update'];?></p> 
        <?php }?>
        
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Item-Name</th>
                    <th>Item-Price</th>
                    <th>Quantity</th> 
                    <th>Total</th> 
                </tr>
            </thead>

            <?php
                $sql = "select * from `customer-order`  where `Table_no`= $table_no and `Status` = 0";
                $result = mysqli_query($conn, $sql);
                
                if(mysqli_num_rows($result)){
                    $i = 1;
                    $total_amount = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['Item_name']?></td>
                        <td>Rs <?php echo $row['Item_price']?></td>
                        <td><?php echo $row['Quantity']?></td>
                        <td><?php echo $total_price =$row['Quantity']*$row['Item_price'] ?></td>
                        
                    </tr>
                    <?php $total_amount+= $total_price?>

                    <?php
                    $i++;
                }
            }
            ?>
            </tbody>
        </table>
        
        <p>Total Amount = Rs <?php echo  $total_amount?></p>

        <div class="ask-user">
            <form action="" method="post">
                <strong>Is Your All  Order Deliver?</strong>
                <input type="checkbox" name="confirm-order" value="yes">Yes
                <input type="checkbox" name="confirm-order" value="no">No
                <input type="submit" name="Send" class="confirm-order">
            </form>
        </div>

        <?php 
            if($category=="ts"){?>
                <a class="order-more" href="home.php?table-number=<?php echo $table_no;?>">order more</a>
            <?php 
            }
            else if($category=="burger"){?>
                <a class="order-more" href="menu-burger.php?table-number=<?php echo $table_no;?>">order more</a>
            <?php } else {?>
                <a class="order-more" href="menu-soup.php?table-number=<?php echo $table_no;?>">order more</a>
            <?php }?>
    </div>   
    </body>
</html

<?php
    require("../common/footer.php");
?>

<?php
    if(isset($_POST['Send'])){
    $confirmValue = $_POST['confirm-order'];
    function convertRadioToNumber ($va){
        if($va=="yes"){
            $va=1;
        }
        else {
            $va = 0;
        }
        return $va;
    }

    $selectConfirm = convertRadioToNumber($confirmValue);
    if($selectConfirm==0){
        header('location:customer-bill.php?update=please wait your order will avaliable soon...');
    }
    else {
        $query = "update `customer-order` set `Status`= $selectConfirm where `Table_no`= $table_no && `Status`= 0";
        $sql = mysqli_query($conn,$query);
        if($sql){
            header('location:home.php?success=Thank you for the visit');
        }
        else{
            echo "yoo not update";   
        }
    }
}   
?>

<style>
    .order-more{
        position: absolute;
        height: 20px;
        background-color: rgb(198, 82, 19);
        color:white;
        top: 10%;
        padding: 5px;
        text-align: center;
        margin-bottom:5px;
        border-radius: 5px;
    }

    a{
        text-align: center;
        font-size: 13px;
        font-family: "Montserrat";
    }

</style>