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
<div class="mui-row" id="info">


</div>
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
