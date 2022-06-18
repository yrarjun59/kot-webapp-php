<?php
    session_start();
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display</title>
    <link rel="stylesheet" href="../css/ts-display.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php
            include("../database/connection.php");
        ?>            
        <table class="styled-table">
            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Item-Name</th>
                    <th>Item-Price</th>
                    <?php
                        if($_SESSION['role']==1){
                            echo "<th>Modifications</th>";
                        }
                        else{
                            echo "<th>Orders</th>";
                        }
                    ?>
                </tr>
            </thead>

            <?php
            $data_per_page= 3;

            if(isset($_GET['pages'])){
                $page  = $_GET["pages"];
            }
            else {
                $page = 1;
            }

            $start_from=($page-1)*$data_per_page;
            $sql = "select * from `today-special` limit $start_from,$data_per_page";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result)){
                $i = 1;
                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tbody>
                    <tr>
                        <?php  $sn = $row['id'] ?>
                        <td><?php echo $i?></td>
                        <td><?php echo $row['item_name']?></td>
                        <td><?php echo "Rs ". $row['item_price']?></td>
                         <?php
                            if($_SESSION['role']==1){
                                echo "
                                <td class='modifications'>
                                    <button class='modify-item'>
                                        <a class='update-item' href='ts-update.php?updateid=$sn'>
                                            <i class='fa-solid fa-pen'></i>
                                        </a>
                                    </button>

                                <button class='modify-item'>
                                    <a href='ts-delete.php?deleteid=$sn' onclick='return checkDelete()'>
                                        <i class='fa-solid fa-trash'></i>
                                    </a>
                                </button>
                            </td> 
                                ";
                            }
                            else {
                                ?>
                                     <td>
                                        <button  style='float:none;' class='modify-item'>
                                            <a href='ts-order.php?order-item-id=<?php echo $sn?>&table-number=<?php if(isset($_GET['table-number'])) 
                                                    echo $_GET['table-number']?>'>
                                                <i class='fa-solid fa-circle-check'></i>
                                            </a>
                                        </button>
                                    </td>
                                <?php
                                 }
                            ?>
                    </tr>   

                    <?php
                        $i++;
                           }
                       }
                    ?>
                </tbody> 
        </table>
            <?php
                if($_SESSION['role']==1){
                    echo "
                    <button style = 'text-align:center;' class='add-item' ><a href='ts-add.php'> <i class='fa-solid fa-plus'></i></a></button> 
                    ";
                }
            ?>
 
    </div>

    <h4 style="font-size:10px;color:red;">Page <?php echo $page?></h4>
    <?php
        $sql = "select * from `today-special`";
        $result = mysqli_query($conn,$sql);
        $total_data = mysqli_num_rows($result);
        $total_pages = ceil($total_data/$data_per_page);
        
        for($i=1;$i<=$total_pages;$i++){
            echo '<a style="font-size:12px;color:red;" href="home.php?pages='.$i.'">'.$i.'</a>';
        }
    ?>
    <?php
        include("../crud-message/crud-message.php");
    ?>

</body>
</html>
<script src="../js/delete-confirm.js"></script>
