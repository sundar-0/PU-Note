<?php
session_start();
include 'base.php';
include 'drawer.php';
include '../../../Controller/UserController/enroll_controller.php';
include '../../../Controller/AdminController/adminsyllabus_controller.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container">
  <br>
<div id="addsyllabusdiv">
  <h1>Add Syllabus</h1>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="file" id="file" name="file" accept="application/pdf">
            <label>upload Syllabus</label>
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
              <button class="mui-btn mui-btn--raised" id="addsyllabus">Add Syllabus</button>
<br><br>
</div>

<div id="editsyllabusdiv">
<h1>Edit Syllabus</h1>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="file" id="file" accept="application/pdf">
            <label>Upload Syllabus</label>
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
              <button class="mui-btn mui-btn--raised" id="updatesyllabus">Update Syllabus</button>

  </div>
<br><br>



  <table class="mui-table mui-table--bordered">
  <thead>
    <tr>
      <th>id</th>
      <th>Syllabus Name</th>
      <th>Faculty</th>
      <th>Program</th>
      <th>Semester</th>
      <th>Added By</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if(!empty($all_syllabus))
   foreach($all_syllabus as $x => $x_value) {
     ?>
     <tr>

      <td><?php echo $x_value[0]?></td>
      <td>
      <?php echo $x_value[1]?>
      <button class="mui-btn mui-btn--small  mui-btn--primary" onclick='viewSyllabus("<?php  echo $x_value[2];?>")'>View </button>
      </td>
      <td><?php echo $x_value[3]?></td>
      <td><?php echo $x_value[4]?></td>
      <td><?php echo $x_value[5]?></td>
      <td><?php echo $x_value[6]?></td>
      <td><button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='editSyllabus(<?php echo $x_value[0];?>,"<?php echo $x_value[1]; ?>","<?php echo $x_value[2]; ?>",<?php echo $x_value[3] ?>,<?php echo $x_value[4] ?>,<?php echo $x_value[5]?>)'>Edit</button> 
      <button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deleteSyllabus(<?php echo $x_value[0]?>,"<?php echo $x_value[2]; ?>")'>Delete</button></td>
    </tr>
  <?php }?>
  </tbody>
</table>
</div>
</div>


<script>
var windowObjectReference;

function viewSyllabus(path) {
  res=path.slice(15,)
  finalpath="http://localhost"+res;

  windowObjectReference = window.open(
    finalpath
  );
}
function editSyllabus(id,filename,path,faculty,program,semester){
$('#addsyllabusdiv').hide();
$("#editsyllabusdiv #faculty").val(faculty).change()
$('#editsyllabusdiv #program').val(program).change()
$('#editsyllabusdiv #semester').val(semester).change()
$('#editsyllabusdiv').show();
$('#editsyllabusdiv #updatesyllabus').click(function(e)
{
var fd=new FormData();
var updated_faculty=$("#editsyllabusdiv #faculty").val()
var updated_program=$('#editsyllabusdiv #program').val()
var updated_semester=$("#editsyllabusdiv #semester").val()
var updated_file=$('#editsyllabusdiv #file')[0].files[0]
var file_path=path
fd.append('id',id);
fd.append('updated_faculty',updated_faculty);
fd.append('updated_semester',updated_semester);
fd.append('updated_program',updated_program)
if(updated_file!==undefined)
{
fd.append('updated_file',updated_file)
}
else
{
fd.append('updated_file',null)
}
fd.append('file_path',file_path)
fd.append('updateclick','yes')
$.ajax({
        url: '../../../Controller/AdminController/adminsyllabus_controller.php',
        type:'POST',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success: function(data) {
            alert(data);
            location.reload()
        }
    });

})
}
function deleteSyllabus(id,file_path){
      var fd=new FormData();
      fd.append('id',id);
      fd.append('file_path',file_path);
      fd.append('deleteclick','yes');
      $.ajax({
        url: '../../../Controller/AdminController/adminsyllabus_controller.php',
        type:'POST',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success: function(data) {
            alert(data);
            location.reload()
        }
    });
    }





$(document).ready(function(){
  $('#editsyllabusdiv').hide();
    $('#addsyllabus').click(function(e)
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
          url: '../../../Controller/AdminController/adminsyllabus_controller.php',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data:fd,
          success: function (data) {
            alert(data);
            location.reload()
           
          }
          })
          

    })
});

</script>