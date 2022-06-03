<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordered Items</title>
    <link rel="stylesheet" href="../css/ordered-items.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<?php
    session_start();
    error_reporting(0);
    include("../common/header.php");
    include("../database/connection.php")
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
                    <th>Total Price</th>
                    <th>Status</th>
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
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tbody>
                    <tr>
                        <?php $id = $row['Id'] ?>
                        <th><?php echo $row['Table_no']?></th>
                        <td><?php echo $row['Item_name']?></td>
                        <td><?php echo $row['Item_price']?></td>
                        <td><?php echo $row['Quantity']?></td>
                        <td><?php echo $row['Quantity'] * $row['Item_price']?></td>
                        <td>
                            <?php
                                if($row['Status']==0){
                                    echo 
                                    '<p style="
                                    color:rgb(198, 82, 19);
                                    font-size:13px;">
                                         pending
                                    </p>';
                                } else {
                                    echo
                                    '<p style ="color:green;font-size:13px;">
                                        delivered
                                    </p>';
                                }
                            ?>
                        </td>
                                            </tr>
                    <?php
                    $i++;
                }
            }
            ?>
            <script src="../js/confirm-deliver.js"></script>
            </tbody>
            </table>              
        </div>
    <?php
    $sql = "select * from `customer-order`";
    $result = mysqli_query($conn,$sql);
    $total_data = mysqli_num_rows($result);
    $total_pages = ceil($total_data/$data_per_page);
    
    for($i=1;$i<=$total_pages;$i++){
        echo '<a style="top:30px;margin:20px;" href = "ordered-items.php?pages='.$i.'">'.$i.'</a>';
    }
    ?>
    <h2 style = "text-align:center;font-family:Montserrat;bottom:0;">Page <?php echo $page?> </h2>
        <?php
            include("../common/footer.php");
        ?>
</body>
</html>

<button> <a href="bill.php">Generate Bill</a></button>