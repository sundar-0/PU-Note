<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
include 'base.php';
include 'drawer.php';
$user=$_SESSION['user'];
?>
<div id="content-wrapper">
  <div class="mui--appbar-height"></div>


</div>
<?php 
    }
    else
    {
    echo "Only Admin Can View This Page";
    }
}
  else
  {
    echo "You Must Login to have access to this page";
  }
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
