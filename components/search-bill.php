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
        <h2 style="text-align:center;">Today Bill</h2>
        <h3>Bill Page-no: <?php if(isset($_GET['pages'])){
            echo $_GET['pages'];} 
            else {
                echo "1";}?> </h3>

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
                if(isset($_GET['date'])){  
                    $data_per_page= 4;

                    if(isset($_GET['pages'])){
                        $page  = $_GET["pages"];
                    }
                    else {
                        $page = 1;
                    }
                    $start_from=($page-1)*$data_per_page;
                    $now_date = $_GET['date'];
                    $sql = "select * from `customer-order` where `Date`='$now_date' ORDER BY `customer-order`.`Id` DESC limit $start_from,$data_per_page";
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
        }
            ?>
            </tbody>
            </table>   
            <p style="font-weight:bold;color:white;background-color: rgb(243, 93, 12);">Total Amount = Rs <?php echo $total_amount?></p>

        </div>
        <a href="#" class="bill-button">Print the Bill<a>
    <?php
        $sql = "select * from `customer-order` where `Date`='$now_date'";
        $result = mysqli_query($conn,$sql);
        $total_data = mysqli_num_rows($result);
        $total_pages = ceil($total_data/$data_per_page);
        
        for($i=1;$i<=$total_pages;$i++){
            echo '<a class="pagination-link" href = "search-bill.php?pages='.$i.'">'.$i.'</a>';
        }
    ?>
</html>
<?php
    include("../common/footer.php");
?>