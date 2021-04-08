<?php
session_start();
include 'base.php';
include 'drawer.php';
$user=$_SESSION['user'];
?>
<div id="content-wrapper">
  <div class="mui--appbar-height"></div>

</div>


<?php 
include '../../footer.php';
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