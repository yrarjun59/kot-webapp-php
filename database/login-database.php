<?php
session_start();
include("connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = $_POST['username'];
    $password = $_POST['password'];

    if($myusername=="" && $password ==""){
        header('location:../components/login.php?error= username and password is required');
    }

    else if($myusername==""){
        header('location:../components/login.php?error=please enter username');
    }
    else {
        if($password==""){
            header('location:../components/login.php?error=please enter password&user='.$myusername.'');
        }
        else {
            $mypassword = password_hash($password,PASSWORD_DEFAULT);   

            // $sql = "INSERT INTO `login-database`(`Username`, `Password`) VALUES ('$myusername','$mypassword')"; 
            // $result = mysqli_query($conn,$sql);  
            // if($result){
            //     echo "inserted";
            // }
            // else{
            //     echo "not inserted";
            // }
               
            $sql = "SELECT * FROM `login-database` WHERE `Username`='$myusername'"; 
            $result = mysqli_query($conn,$sql);    
            $count = mysqli_num_rows($result);
            if($count == 1) {
                while($row = mysqli_fetch_assoc($result)){
                    $role = $row['Role'];
                    $_SESSION['role'] = $role;
                    if(password_verify($password,$row['Password'])){
                        sleep(2);
                        header('location:../components/home.php');
                    }
                    else{
                        header('location:../components/login.php?error=your password is wrong&user='.$myusername.'&password='.$password.'');
                    }
                }
            }
            else{
                header('location:../components/login.php?error=your username or password is not match&user='.$myusername.'&password='.$password.'');
            }
        }
    }
}
?>
