<?php
include '../base.php';
include 'drawer.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container mt-5">
<div class="mui-row" id="info">


</div>
</div>
</div>
<script>
async function get_syllabus()
{
  $.ajax({
          url:'../../Controller/UserController/syllabus_controller.php',
          type: 'GET',
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
          $('#info').append(data);  
          }
   })
}
var windowObjectReference;

function viewSyllabus(path) {
  res=path.slice(15,)
  finalpath="http://localhost"+res;

  windowObjectReference = window.open(
    finalpath
  );
}

$(document).ready(function(){

  get_syllabus();
})

</script>
