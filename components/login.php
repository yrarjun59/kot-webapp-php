<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login Page</title>
</head>
<link rel="stylesheet" href="../css/login.css">
  <body>
    <div>
      <form action="../database/login-database.php" method = "post">
        <div class="login-box">
        <p class="hide">Logged in.......</p>
        <h2>Login</h2>
          <?php if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error'];?></p> 
            <?php }?>

            
            <div class="textbox">
            <input type="text" name ="username" placeholder="Enter Username" value="<?php if(isset($_GET['user'])){
              echo $_GET['user'];
            }?>">
          </div>

          <div class="textbox">
            <input type="password" name ="password" placeholder="Enter Password" value="<?php if(isset($_GET['password'])){
              echo $_GET['password'];
            }?>">
          </div>
          
          <input type="submit" value="Login" class="btn" required>
          <a href="change_up.php">change username & password?</a>
        </div>
        </form>
    </div>
    
  </body>
</html>
<script src="../js/login-wait.js"></script>