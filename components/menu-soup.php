<?php
    session_start();
    error_reporting(0);
    include("../common/header.php");
    include("../database/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soup Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="../css/menu-soup.css">
</head>
<body>
    <?php
    include("menu-sidebar.php")
    ?>    
    <div class="menu-items">
        
    <?php if(isset($_GET['success'])) { ?>
      <p class="success"><?php echo $_GET['success'];?></p> 
    <?php }?>

    <?php if(isset($_GET['update'])) { ?>
      <p class="update"><?php echo $_GET['update'];?></p> 
    <?php }?>

    <?php if(isset($_GET['delete'])) { ?>
        <p class="delete"><?php echo $_GET['delete'];?></p> 
    <?php }?>  
            
        <h2 class="menu-header">Soup</h2>
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
                        else {
                            echo "<th>Orders</th>";
                        }
                    ?>
                </tr>
            </thead>
        <?php
            $sql = "select * from `menu-item-soup`";
            $result = mysqli_query($conn, $sql);
            if($result){
                $sn = 1;
                while($row=mysqli_fetch_assoc($result)){
                ?>
                <tbody>
                    <?php $id = $row['id']?>
                    <tr>
                        <td><?php echo $sn?></td>
                        <td><?php echo $row['soup_name']?></td>
                        <td><?php echo"Rs ". $row['soup_price']?></td>
                        
                            <?php
                                if($_SESSION['role']==1){
                                    echo "
                                    <td class='modifications'>
                                        <button class='modify-item'>
                                        <a href='menu-soup-update.php?updateid=$id'>
                                                <i class='fa-solid fa-pen'></i>
                                            </a>
                                        </button>

                                    <button class='modify-item'>
                                        <a href='menu-soup-delete.php?deleteid=$id' onclick ='return checkDelete()'>
                                            <i class='fa-solid fa-trash'></i>
                                        </a>
                                    </button>
                                </td> 
                                ";
                                }
                                else {
                                    ?>
                                    <td>
                                    <button style='float:none' class='modify-item'>
                                        <a href='menu-soup-order.php?order-item-id=<?php echo $id?>&table-number=<?php if(isset($_GET['table-number'])) 
                                            echo $_GET['table-number']?>'><i class='fa-solid fa-circle-check'></i></a></button>
                                    <button>
                                    </td>
                                      
                                <?php
                                }
                            ?>       
                        
                        
                    </tr>
                </tbody>
                <?php
                $sn++;
                    }
                }   
            ?>
        </table>
        <?php
            if($_SESSION['role']==1){
                echo '
                <button name = "add-button" class="add-item"><a href="menu-soup-add.php"><i class="fa-solid fa-plus"></i></a></button>
                ';
            }
        ?>
    </div>
</body>
</html>
<?php
  include("../common/footer.php");
?>
<script src="../js/delete-confirm.js"></script>
<script src="../js/add-box.js"></script>