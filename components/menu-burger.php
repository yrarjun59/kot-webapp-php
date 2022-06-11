<?php
    session_start();
    error_reporting(0);
    include("../database/connection.php");
    include("../common/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="../css/menu-burger.css">
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

    <h2 class="menu-header">Burger</h2>
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
            $sql = "select * from `menu-item-burger`";
            $result = mysqli_query($conn, $sql);
            if($result){
                $sn = 1;
                while($row=mysqli_fetch_assoc($result)){
                ?>
                <tbody>
                    <?php $id = $row['id']?>
                    <tr>
                        <td><?php echo $sn?></td>
                        <td><?php echo $row['burger_name']?></td>
                        <td><?php echo"Rs ". $row['burger_price']?></td>
                        
                            <?php
                                if($_SESSION['role']==1){
                                    echo "
                                    <td class='modifications'>
                                        <button class='modify-item'>
                                        <a href='menu-burger-update.php?updateid=$id'>
                                                <i class='fa-solid fa-pen'></i>
                                            </a>
                                        </button>

                                    <button class='modify-item'>
                                        <a href='menu-burger-delete.php?deleteid=$id' onclick ='return checkDelete()'>
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
                                        <a href='menu-burger-order.php?order-item-id=<?php echo $id?>&table-number=<?php if(isset($_GET['table-number'])) 
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
                <button name = "add-button" class="add-item"><a href="menu-burger-add.php"><i class="fa-solid fa-plus"></i></a></button>
                ';
            }?>
        </div>
</body>
</html>

<script src="../js/delete-confirm.js"></script>
<script src="../js/add-box.js"></script>

<?php
  include("../common/footer.php");
?>

<script>
    let  list = document.querySelectorAll('.list');
    for(let i=0;i<list.length;i++){
        list[i].onclick = function(){
            let j=0;
            while(j <list.length){
                list[j++].className = 'list';
            }
            list[i].className = 'list active';
        }
    }
</script>