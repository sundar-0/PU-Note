<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
include 'base.php';
include 'drawer.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container">
<br><br>
<div id="table_info">

</div>
</div>
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
async function get_all_feedback(){
  $.ajax({
        url: '../../../Controller/AdminController/adminfeedback_controller.php',
        type:'GET',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          if($('#table_info').text()){
            $('#table_info').text("");
            $('#table_info').append(data);
          }
        }
    });
}

function deleteFeedback(id){
  var fd=new FormData();
      fd.append('id',id);
      fd.append('deleteclick','yes');
      $.ajax({
        url: '../../../Controller/AdminController/adminfeedback_controller.php',
        type:'POST',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success: function(data) {
            alert(data);
            get_all_feedback();
        }
    });
}

$(document).ready(function(){
    get_all_feedback();
    $('#sortFeedback').click(function(e){
      var fd=new FormData();
      var req_program=$('#req_program').val();
      var req_semester=$('#req_semester').val();
      fd.append('req_program',req_program);
      fd.append('req_semester',req_semester);
      fd.append('sortclick','yes');
      $.ajax({
          url:'../../../Controller/AdminController/adminfeedback_controller.php',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data:fd,
          success: function (data) {
         if($('#table_info').text()){
           $('#table_info').text("");
           $('#table_info').append(data);  
         }
         
          }
          })
          e.preventDefault()

    });
})


</script>