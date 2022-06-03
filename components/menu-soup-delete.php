<?php
    session_start();
  $_SESSION['role']==1;

  include("../database/connection.php");

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "delete from `menu-item-soup` where id=$id";
        $result = mysqli_query($conn,$sql);

        if($result){
          header('location:menu-soup.php?delete=soup delete successfully.....');

        }
        else{
            die(mysqli_error($conn));
        }
    }
?>