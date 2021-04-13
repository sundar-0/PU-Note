<?php
session_start();
include '../base.php';
include 'drawer.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container" id="info">



</div>

</div>
</div>


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


