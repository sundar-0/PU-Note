<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
            if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
            {
            include '../base.php';
            include 'drawer.php';
            ?>
            <div id="content-wrapper">
            <div class="mui--appbar-height"></div>

            <div class="mui-container-fluid">
              <br>
              <h1>Developer's Identify</h1>
              <div class="mui-container-fluid">
              <div class="mui-row">
                <div class="mui-col-md-4">
                <div class="mui-panel">md-4</div>
                </div>
                <div class="mui-col-md-4">
                <div class="mui-panel">md-4</div>
                </div>
                <div class="mui-col-md-4">
                <div class="mui-panel">md-4</div>
                </div>
                <div class="mui-col-md-4">
                <div class="mui-panel">md-4</div>
                </div>
                <div class="mui-col-md-4">
                <div class="mui-panel">md-4</div>
                </div>
                <div class="mui-col-md-4">
                <div class="mui-panel">md-4</div>
                </div>
              </div>
            </div>


              <?php
              // if(isset($_SESSION["user_image"]) && isset($_SESSION['user_first_name']) && isset($_SESSION['user_email_address']))
              // {
              //   echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
              //   echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
              //   echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
              // }
              ?>
            </div>
            </div>
            <?php 
            }
            else
            {
            echo "Only User Can View This Page";
            }
}
  else
  {
    echo "You Must Login to have access to this page";
  }
?>


