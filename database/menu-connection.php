<?php    
    $server = "localhost";
    $username = "root";
    $password = "";
    $database_name = "menu-items";
    
    $conn = new mysqli($server, $username, $password, $database_name);
    // var_dump($conn);

    if(!$conn){
        die("not connected");
    }

?>