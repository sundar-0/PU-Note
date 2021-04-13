<?php
session_start();
include '../base.php';
include 'drawer.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container">
  <br>
  <div class="mui-row" id="info">
  </div>
  <button class="mui-btn" onclick="get_semester()" id="back">Back</button>
</div>
</div>
<script>
var windowObjectReference;

function viewOldQuesYear(path) {
  res=path.slice(15,)
  finalpath="http://localhost"+res;

  windowObjectReference = window.open(
    finalpath
  );
}

async function get_semester()
{
  $.ajax({
          url:'../../Controller/UserController/oldquestion_controller.php',
          type: 'GET',
          cache: false,
          contentType: false,
          processData: false,
          success: function (data) {
          if($('#info').text())
          {
            $('#info').text("");
            $('#info').append(data);
            $('#back').hide();    
          }
    
          }
   })
}

function viewOldQues(semester){
  var fd=new FormData();
  fd.append('semester',semester);
  fd.append('viewclick','yes');
  $.ajax({
          url:'../../Controller/UserController/oldquestion_controller.php',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data:fd,
          success: function (data) {
          if(data){
            $('#info').text("");
            $('#info').append(data);  
            $('#back').show();
          }  
          }
   })

}

$(document).ready(function(){
get_semester();
$('#back').hide();
})

</script>
