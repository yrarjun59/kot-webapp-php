<?php
    session_start();
    error_reporting(0);  

    include("../database/connection.php");
    if(isset($_GET['deleteid'])){
        $_SESSION['role']=1;
        $id = $_GET['deleteid'];

        $sql = "delete from `today-special` where id=$id";
        $result = mysqli_query($conn,$sql);

        if($result){        
          header('location:home.php?delete=item deleted successfully....');            
        }
        else{
            die(mysqli_error($conn));
        }
    }
?>