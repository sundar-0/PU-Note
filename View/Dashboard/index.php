<?php
session_start();
include '../base.php';
include 'drawer.php';
?>
<div id="content-wrapper">
<div class="mui--appbar-height"></div>

<div class="mui-container-fluid">
  <br>
  <h1>Welcome User</h1>
  <?php
    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
  ?>
</div>
</div>
<?php
include '../footer.php';
?>

