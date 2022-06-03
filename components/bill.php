<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="../css/ordered-items.css">
</head>
<body>

<?php
    include("../database/connection.php");
    include("../common/header.php");
?>
    <body>
    <div class="container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Table-No</th>
                    <th>Item-Name</th>
                    <th>Item-Price</th>
                    <th>Quantity</th> 
                    <th>Total</th>                   
                </tr>
            </thead>

            <?php

                $data_per_page= 5;

                if(isset($_GET['pages'])){
                    $page  = $_GET["pages"];
                }
                else {
                    $page = 1;
                }

                $start_from=($page-1)*$data_per_page;
                $sql = "select * from `customer-order` ORDER BY `customer-order`.`Id` DESC limit $start_from,$data_per_page";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result)){
                    $i = 1;
                    $total_amount = 0;
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tbody>
                    <tr>
                        <th><?php echo $row['Table_no']?></th>
                        <td><?php echo $row['Item_name']?></td>
                        <td>Rs <?php echo $row['Item_price']?></td>
                        <td><?php echo $row['Quantity']?></td>
                        <td>Rs <?php  echo $table_total =   $row['Quantity'] * $row['Item_price']?></td>
                    </tr>
                        <?php $total_amount+= $table_total?>
                    <?php
                    $i++;
                }
            }
            ?>
            </tbody>
            </table>   
            <p>Total Amount = Rs <?php echo  $total_amount?></p>

        </div>
        <button class="bill-buton">Print the Bill</button>
        <?php
    $sql = "select * from `customer-order`";
    $result = mysqli_query($conn,$sql);
    $total_data = mysqli_num_rows($result);
    $total_pages = ceil($total_data/$data_per_page);
    
    for($i=1;$i<=$total_pages;$i++){
        echo '<a style="top:30px;margin:20px;" href = "bill.php?pages='.$i.'">'.$i.'</a>';
    }
    ?>
    <h2 style = "text-align:center;font-family:Montserrat;bottom:0;">Bill Page-no: <?php echo $page?> </h2>
        <?php
            include("../common/footer.php");
        ?>

            </body>
</html>