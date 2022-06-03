<?php    
    $server = "localhost";
    $username = "root";
    $password = "";
    $database_name = "kot";
    
    $conn = new mysqli($server, $username, $password, $database_name);

    if(!$conn){
        die("not connected");
    }
?>

