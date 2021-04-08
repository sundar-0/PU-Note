<?php
session_start();
include '../base.php';
include 'drawer.php';
include '../../Controller/enroll_controller.php';
$user=$_SESSION['user'];
$sql="SELECT first_name,last_name,college from users where id=$user";
$result=$conn->query($sql);//to check whether the user exists or not 
$user_info=mysqli_fetch_object($result);
?>
<div id="content-wrapper">
  <div class="mui--appbar-height"></div>
    <div class="mui-container-fluid">
      <br>
      <h1>Your Profile</h1>
    <ul class="mui-tabs__bar mui-tabs__bar--justified">
      <li class="mui--is-active"><a data-mui-toggle="tab" data-mui-controls="pane-justified-1">About Me</a></li>
      <li><a data-mui-toggle="tab" data-mui-controls="pane-justified-2">Faculty And Program</a></li>
    </ul>
    <div class="mui-tabs__pane mui--is-active" id="pane-justified-1">
    <?php if($user_info->first_name && $user_info->last_name && $user_info->college){?>
    <div class="mui--container">
    <br>
    <form class="mui-form" id="update_signup">
        <input type="hidden" name='user' value="<?php echo $user;?>">
          <div class="mui-textfield mui-textfield--float-label">
            <input type="text" name="first_name" value="<?php echo $user_info->first_name?>">
            <label>Your First Name</label>
          </div>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="text" name="last_name" value="<?php echo $user_info->last_name?>">
            <label>Your Last Name</label>
          </div>
          <div class="mui-textfield mui-textfield--float-label">
                <input type="text" name="college" value="<?php echo $user_info->college?>">
                <label>Your College Name Here</label>
          </div>
        <button type="submit" class="mui-btn mui-btn--raised">Update</button>
      </form>
    </div>
    <?php }
    else{?>
        <div class="mui--container">
        <br>
        <form class="mui-form" id="update_signup">
        <input type="hidden" name='user' value="<?php echo $user;?>">
          <div class="mui-textfield mui-textfield--float-label">
            <input type="text" name="first_name">
            <label>Your First Name</label>
          </div>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="text" name="last_name">
            <label>Your Last Name</label>
          </div>
          <div class="mui-textfield mui-textfield--float-label">
                <input type="text" name="college">
                <label>Your College Name Here</label>
          </div>
          <button type="submit" class="mui-btn mui-btn--raised">Submit</button>
        </form>
        </div>
   <?php }
       ?>
    </div>

    <div class="mui-tabs__pane" id="pane-justified-2">
      <?php if($enroll_user->num_rows>0){?>
        <div class="mui--container">
        <br>
        <?php
       $enroll_user= mysqli_fetch_object($enroll_user);?>
    <form class="mui-form" id='update_enroll' method="POST">   
         <div class="mui-select">
         <select name="faculty">
           <?php
           foreach($faculty as $x => $x_value) {
             if( $enroll_user->faculty==$x_value[0])
             echo '<option value="'.$x_value[0].'" selected>'.$x_value[1].'</option>';
             else
             echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
           }
           ?> 
         </select>
         <label>Your Faculty</label>
         </div>

         <div class="mui-select">
         <select name="program">
           <?php
           foreach($program as $x => $x_value) {
            if( $enroll_user->program==$x_value[0])
             echo '<option  value="'.$x_value[0].'" selected>'.$x_value[1].'</option>';
            else
            echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
           }
           ?> 
         </select>
         <label>Your Program</label>
         </div>
         <input type="hidden"  name="is_update_click" value="off">
         <button id="btn_update_enroll" class="mui-btn mui-btn--raised">Update</button>
       </form>
        </div>
        <?php }
        else{?>
            <div class="mui--container">
            <br>
            <form class="mui-form" id='enroll'>
         
              <div class="mui-select">
              <select name="faculty">
                <?php
                foreach($faculty as $x => $x_value) {
                  echo '<option value="'.$x_value[0].'">'.$x_value[1].'</option>';
                }
                ?> 
              </select>
              <label>Your Faculty</label>
              </div>

              <div class="mui-select">
              <select name="program">
                <?php
                foreach($program as $x => $x_value) {
                  echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
                }
                ?> 
              </select>
              <label>Your Program</label>
              </div>
              <button type="submit" class="mui-btn mui-btn--raised">Submit</button>
            </form>
            </div>
          <?php } ?>

    </div>
  </div>
</div>

<?php 
include '../footer.php';
?>
<script>
$(document).ready(function(){
    $('#enroll').submit(function(e){
      $.ajax({
        type:"POST",
        url:'../../Controller/enroll_controller.php',
        data:$('#enroll').serialize(),
        success:function(data){
          alert(data);
          location.reload();
        }
      })
    })});

    $(document).ready(function(){
    $('#update_signup').submit(function(e){
      $.ajax({
        type:"POST",
        url:'../../Controller/signup_controller.php',
        data:$('#update_signup').serialize(),
        success:function(data){
          alert(data);
          $('#update_signup')[0].reset();
          location.reload();
        }
      })
    })});
    $(document).ready(function(){
    $('#btn_update_enroll').click(function(e){
      $('input[name="is_update_click"]').val('on');
      $('#update_enroll').submit(
      function(e)
      {
        $.ajax({
        type:"POST",
        url:'../../Controller/enroll_controller.php',
        data:$('#update_enroll').serialize(),
        success:function(data){
          alert(data);
          location.reload();
        }
      })
    })
  })
});

</script>
?>