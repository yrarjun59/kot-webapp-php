<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/body.css">
    <title>Body</title>
</head>
<body>

<div class="menu-body">
<!-- menu clickable bar -->
<div class="menu">
      <a href="../components/menu-soup.php">
        <img class= "menu-image" src="https://cdn.pixabay.com/photo/2018/03/07/18/42/menu-3206749_960_720.jpg" alt="cardimage" class="card-image">
      </a>
      <div class="card-body">
      <a href="../components/menu-soup.php">
        <h3 class="card-title">Order your favourite food</h3>
      </a>
      <p class="menu-link">        
        <b>Check the Menu</b>
        <a href="../components/menu-soup.php">
          <i class="fa-solid fa-chevron-right"></i>
        </a>
      </p>
    </div>
  </div>
  
  
  <h5 class="circle">Today Special</h5>
  <div class="today-special">
  <?php if(isset($_GET['success'])) { ?>
      <p class="success"><?php echo $_GET['success'];?></p> 
  <?php }?>
  <?php if(isset($_GET['update'])) { ?>
      <p class="update"><?php echo $_GET['update'];?></p> 
  <?php }?>
  <?php if(isset($_GET['delete'])) { ?>
      <p class="delete"><?php echo $_GET['delete'];?></p> 
  <?php }?>
    <?php
      include("ts-display.php")
    ?>
  </div> 

</div> <!--menu body end -->
</body>
</html>
<script src="../js/logout-inform.js"></script>