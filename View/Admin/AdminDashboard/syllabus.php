<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
include 'base.php';
include 'drawer.php';
include '../../../Controller/UserController/get_faculty_program.php';
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

<hr>
<div>
<h1>Sort By:</h1>
<div class="mui-row">
    <div class="mui-col-md-6" >
        <div class="mui-select">
                      <select name="req_program" id="req_program">
                        <?php
                        foreach($program as $x => $x_value) {
                          echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
                        }
                        ?> 
                      </select>
                      <label>Program</label>
        </div>
    </div>
    <div class="mui-col-md-6" >
          <div class="mui-select">
                        <select name="req_semester" id="req_semester">
                          <?php
                          for($i=1;$i<=8;$i++) {
                            echo '<option  value="'.$i.'">'.$i.'</option>';
                          }
                          ?> 
                        </select>
                        <label>Semester</label>
          </div>
    </div>
</div>

<button class="mui-btn mui-btn--raised" id="sortSyllabus">Apply</button>

</div><br><br>



<div id="table_info">

</div>

//

//
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
var windowObjectReference;
function viewSyllabus(path) {
  res=path.slice(15,)
  finalpath="http://localhost"+res;

  windowObjectReference = window.open(
    finalpath
  );
}
async function get_all_syllabus(){
  $.ajax({
        url: '../../../Controller/AdminController/adminsyllabus_controller.php',
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
          location.reload();
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
            get_all_syllabus();
        }
    });
    }


$(document).ready(function(){
  $('#editsyllabusdiv').hide();
    get_all_syllabus();
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
          $('#addsyllabusdiv #faculty').val("");
          $('#addsyllabusdiv #program').val("");
          $('#addsyllabusdiv #semester').val("");
            get_all_syllabus();
          }
          })
          

    })

    $('#sortSyllabus').click(function(e){
      var fd=new FormData();
      var req_program=$('#req_program').val();
      var req_semester=$('#req_semester').val();
      fd.append('req_program',req_program);
      fd.append('req_semester',req_semester);
      fd.append('sortclick','yes');
      $.ajax({
          url:'../../../Controller/AdminController/adminsyllabus_controller.php',
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

    })
});

</script>