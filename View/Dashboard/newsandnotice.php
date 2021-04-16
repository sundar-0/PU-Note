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
<div class="mui-container" id="info">



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
async function get_notice()
{
  $.ajax({
          url:'../../Controller/UserController/notice_controller.php',
          type: 'GET',
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
          $('#info').append(data);  
          }
   })
}


$(document).ready(function(){

  get_notice();
})

</script>


