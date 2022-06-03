<?php
session_start();
include("../database/connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $pusername = $_POST['prev-u'];
    $newusername = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($newusername=="" && $password==""&& $cpassword==""&$pusername==""){
        header('location:../components/change_up.php?error=all fields are required');
    }
    else if($pusername==""){
        header('location:../components/change_up.php?error=please enter previous username');
    }
    else if($newusername==""){
        header('location:../components/change_up.php?error=please enter username&pu='.$pusername.'');
    }
    else {
        if($password==""&& $cpassword==""){
            header('location:../components/change_up.php?error=please enter both passwords&user='.$newusername.'&pu='.$pusername.'');
        }

        else if($password!=$cpassword){
            header('location:../components/change_up.php?error=password not match&user='.$newusername.'&pu='.$pusername.'');
        }
        else {
            $mypassword = password_hash("$password",PASSWORD_DEFAULT);
            $query = "UPDATE `login-database` SET `Username`='$newusername',`Password`='$mypassword' WHERE `Username` = '$pusername' ";
            $sql = mysqli_query($conn,$query);
            if($sql){
                header('location:login.php');
                sleep(2);
            }
            else{
                header('location:../components/change_up.php?error=username not found&user='.$newusername.'&pu='.$pusername.'');
            }
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div>
      <form action="" method = "post">
        <div class="update-box">

        <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error'];?></p> 
        <?php }?>

            <div class="textbox">
                <input type="text" name="prev-u" placeholder="previous username" value="<?php if(isset($_GET['pu'])){
              echo $_GET['pu'];
            }?>">
            </div>    

          <div class="textbox">
            <input type="text" name ="username" placeholder="username" value="<?php if(isset($_GET['user'])){
              echo $_GET['user'];
            }?>">
          </div>

          <div class="textbox">
            <input type="password" name ="password" placeholder="enter password">
          </div>

          <div class="textbox">
            <input type="password" name ="cpassword" placeholder="confirm password">
          </div>
                    
          <input type="submit" value="Update" class="btn" required>
        </div>
        </form>
    </div>

</body>
</html>

<script src="../js/login-wait.js"></script>