<?php
session_start();
include 'base.php';
include 'drawer.php';
include '../../../Controller/AdminController/adminfeedback_controller.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container">
  <br>
  <h1>Feedback</h1>
  <table class="mui-table mui-table--bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>Feedback</th>
      <th>Feedback_By</th>
      <th>Feedback_date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if(!empty($all_feedback))
   foreach($all_feedback as $x => $x_value) {
     ?>
     <tr>

      <td><?php echo $x_value[0]?></td>
      <td>
      <?php echo $x_value[1]?>
      </td>
      <td><?php echo $x_value[2]?></td>
      <td><?php echo $x_value[3]?></td>
      <td>
      <button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deleteFeedback(<?php echo $x_value[0]?>)'>Delete</button></td>
    </tr>
  <?php }?>
  </tbody>
  </table>

</div>
</div>


<script>

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
            location.reload();
        }
    });
}


</script>