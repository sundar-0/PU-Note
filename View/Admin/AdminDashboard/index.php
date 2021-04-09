<?php
session_start();
include 'base.php';
include 'drawer.php';
?>
<div id="content-wrapper">
<div class="mui--appbar-height"></div>

<div class="mui-container-fluid">
  <br>
  <h1>Welcome Admin</h1>
  <?php
  if(isset($_SESSION["user_image"]) && isset($_SESSION['user_first_name']) && isset($_SESSION['user_email_address']))
  {
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
  }
  ?>
</div>
</div>


