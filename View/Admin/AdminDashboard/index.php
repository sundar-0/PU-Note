<?php
session_start();
include 'base.php';
include 'drawer.php';
include '../../../Controller/AdminController/admininformation_controller.php';
?>
<div id="content-wrapper">
<div class="mui--appbar-height"></div>

<div class="mui-container">
  <br><br>
  <div class="mui-row">
    <div class="mui-col-md-6" >
    <div class="mui-panel" style="background:tomato;color:#fff;font-size: 20px;">
    <i class="fas fa-user"></i> Total User<br>
    <?php
    echo $user_count;
    ?>
    </div>
    </div>
    <div class="mui-col-md-6">
    <div class="mui-panel" style="background:tomato;color:#fff;font-size: 20px;">
    <i class="far fa-file-pdf"></i> Total Note Uploaded<br>
    <?php
    echo $course_count
    ?>
    </div>
    </div>
    <div class="mui-col-md-6">
    <div class="mui-panel" style="background:tomato;color:#fff;font-size: 20px;">
    <i class="fas fa-question-circle"></i>  Total Old Questions<br>
    <?php
    echo $oldquestion_count;
    ?>
    </div>
    </div>
    <div class="mui-col-md-6">
    <div class="mui-panel" style="background:tomato;color:#fff;font-size:20px;">
    <i class="fas fa-graduation-cap"></i> Total Faculty<br>
    <?php
    echo $faculty_count;
    ?>
    </div>
    </div>
    <div class="mui-col-md-6">
    <div class="mui-panel" style="background:tomato;color:#fff;font-size:20px;">
    <i class="fas fa-book-reader"></i>  Total Program<br>
    <?php
    echo $program_count;
    ?>
    </div>
    </div>
  </div>
</div>
</div>


