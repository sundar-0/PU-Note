<?php
session_start();
include 'base.php';
include 'drawer.php';
include '../../../Controller/enroll_controller.php';
include '../../../Controller/AdminController/adminnote_controller.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container-fluid">
  <br>
  <h1>Add Notes</h1>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="file" id="file" name="file" accept="application/pdf">
            <label>upload Note</label>
          </div>
          <div class="mui-select">
              <select name="faculty" id="faculty">
                <?php
                foreach($faculty as $x => $x_value) {
                  echo '<option value="'.$x_value[0].'">'.$x_value[1].'</option>';
                }
                ?> 
              </select>
              <label>Faculty</label>
              </div>

              <div class="mui-select">
              <select name="program" id="program">
                <?php
                foreach($program as $x => $x_value) {
                  echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
                }
                ?> 
              </select>
              <label>Program</label>
              </div>

              <div class="mui-select">
              <select name="semester" id="semester">
                <?php
                for($i=1;$i<=8;$i++) {
                  echo '<option  value="'.$i.'">'.$i.'</option>';
                }
                ?> 
              </select>
              <label>Semester</label>
              </div>
              <button class="mui-btn mui-btn--raised" id="addnote">Add Note</button>
<br><br>
  <table class="mui-table mui-table--bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>Course Name</th>
      <th>Faculty</th>
      <th>Program</th>
    
      <th>Added By</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if(!empty($all_note))
   foreach($all_note as $x => $x_value) {
    echo'
    <tr>
      <td>"'.$x_value[0].'"</td>
      <td>"'.$x_value[1].'"?></td>
      <td>"'.$x_value[2].'"?></td>
      <td>"'.$x_value[3].'"?></td>
      <td>"'.$x_value[4].'"</td>
      <td><button class="mui-btn mui-btn--small  mui-btn--primary " id="btn_edit_note">Edit</button> <button class="mui-btn mui-btn--small  mui-btn--danger"  id="btn_delete_note">Delete</button></td>
    </tr>';
   }?>
  </tbody>
</table>


</div>
</div>

<?php 
include '../../footer.php';
?>
<script>
$(document).ready(function(){
    $('#addnote').click(function(e)
    {
            var fd=new FormData();
            var files=$('#file')[0].files[0];
            var faculty=$('#faculty').val();
            var program=$('#program').val();
            var semester=$('#semester').val();   
            fd.append('faculty',faculty)
            fd.append('program',program)
            fd.append('semester',semester)
            fd.append('file',files) 
            fd.append('addclick','yes')
          $.ajax({
          url:'../../../Controller/AdminController/adminnote_controller.php',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data:fd,
          success: function (data) {
            alert(data);
          }
          })
          

    })
});

</script>