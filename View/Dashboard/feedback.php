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
    <div class="mui-container mt-5">
    <form id="addfeedbackform">
        <label>Enter Your Feed Back Here</label><br>
        <textarea id="feedback" name="feedback" rows="10" cols="50" required></textarea><br>
      <button type="submit" class="mui-btn mui-btn--raised">Send</button>
    </form>
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
<script>
$(document).ready(function(){
    $('#addfeedbackform').submit(function(e)
    {
      $.ajax({
        type:"POST",
        method:"POST",
        url:'../../Controller/UserController/feedback_controller.php',
        data:$('#addfeedbackform').serialize(),
        success: function (data) {
            alert(data);
          }    
      })
      $('#addfeedbackform')[0].reset();
      e.preventDefault();
    })
  })

</script>
