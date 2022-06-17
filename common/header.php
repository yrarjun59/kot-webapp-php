<?php
  session_start();
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOT </title>
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
  <nav class="header">
      <div class="logo">
        <a href="../components/home.php"><img width="100px" src="../image/logo.svg" alt="logo"></a>
      </div>
      
        <ul class="nav-links">
          <li><a href="../components/home.php">Home</a></li>
          <li><a href="../components/menu-soup.php">Menu</a></li>
          <?php
            if($_SESSION['role']==1){
              echo "<li> <a href='../components/ordered-items.php'>Orders</a> </li>";
            }
          ?>
        </ul>

      <div class="buttons">
        <?php
          if($_SESSION['role']==1){
            echo "<p> <a class='logout' href = '../components/logout.php'>Logout</a></p>";
          }
        ?>
      </div>
   </nav>
</body>
</html>

<script src="../js/logout-inform.js"></script>