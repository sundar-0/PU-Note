<?php
include 'base.php';
include 'drawer.php';
include '../../../Controller/UserController/get_faculty_program.php';
?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container">
  <br>
<div id="addoldquesdiv">
  <h1>Add Old Question</h1>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="file" id="file" name="file" accept="application/pdf">
            <label>Upload Old Question</label>
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
              <div class="mui-select">
              <select name="year" id="year">
                <?php
                $year=array("2015 Spring","2015 Fall","2016 Spring","2016 Fall","2017 Spring","2017 Fall");
                for($i=0;$i<count($year);$i++) {
                  echo '<option  value="'.$year[$i].'">'.$year[$i].'</option>';
                }
                ?> 
              </select>
              <label>Year</label>            
              </div>  
              <button class="mui-btn mui-btn--raised" id="addoldques">Add Old Question</button>
<br><br>
</div>

<div id="editoldquesdiv">
<h1>Edit Old Question</h1>
          <div class="mui-textfield mui-textfield--float-label">
            <input type="file" id="file" accept="application/pdf">
            <label>Upload Old Question</label>
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
              <div class="mui-select">
              <select name="year" id="year">
                <?php
                $year=array("2015 Spring","2015 Fall","2016 Spring","2016 Fall","2017 Spring","2017 Fall");
                for($i=0;$i<count($year);$i++) {
                  echo '<option  value="'.$year[$i].'">'.$year[$i].'</option>';
                }
                ?> 
              </select>
              <label>Year</label>            
              </div>  
              <button class="mui-btn mui-btn--raised" id="updateoldques">Update Old Question</button>

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

<button class="mui-btn mui-btn--raised" id="sortOldQues">Apply</button>

</div><br><br>



<div id="table_info">

</div>

//

//
</div>
</div>


<script>
var windowObjectReference;

function viewOldQues(path) {
  res=path.slice(15,)
  finalpath="http://localhost"+res;

  windowObjectReference = window.open(
    finalpath
  );
}
async function get_past_question()
{
  $.ajax({
          url:'../../../Controller/AdminController/adminoldquestion_controller.php',
          type: 'GET',
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
          if($('#table_info').text()){
            $('#table_info').text("");
            $('#table_info').append(data);
          }
        }
})
  }
function editOldQues(id,filename,path,faculty,program,semester,year){
$('#addoldquesdiv').hide();
$("#editoldquesdiv #faculty").val(faculty).change()
$('#editoldquesdiv #program').val(program).change()
$('#editoldquesdiv #semester').val(semester).change()
$('#editoldquesdiv #year').val(year).change()
$('#editoldquesdiv').show();
$('#editoldquesdiv #updateoldques').click(function(e)
{
var fd=new FormData();
var updated_faculty=$("#editoldquesdiv #faculty").val()
var updated_program=$('#editoldquesdiv #program').val()
var updated_semester=$("#editoldquesdiv #semester").val()
var updated_file=$('#editoldquesdiv #file')[0].files[0]
var updated_year=$('#editoldquesdiv #year').val()
var file_path=path
fd.append('id',id);
fd.append('updated_faculty',updated_faculty);
fd.append('updated_semester',updated_semester);
fd.append('updated_program',updated_program)
fd.append('updated_year',updated_year)
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
        url: '../../../Controller/AdminController/adminoldquestion_controller.php',
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
function deleteOldQues(id,file_path){
      var fd=new FormData();
      fd.append('id',id);
      fd.append('file_path',file_path);
      fd.append('deleteclick','yes');
      $.ajax({
        url: '../../../Controller/AdminController/adminoldquestion_controller.php',
        type:'POST',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success: function(data) {
            alert(data);
            get_past_question();
        }
    });
    }





$(document).ready(function(){
  $('#editoldquesdiv').hide();
  get_past_question();
    $('#addoldques').click(function(e)
    {
            var fd=new FormData();
            var files=$('#file')[0].files[0];
            var faculty=$('#faculty').val();
            var program=$('#program').val();
            var semester=$('#semester').val();  
            var year=$('#year').val() 
            fd.append('faculty',faculty)
            fd.append('program',program)
            fd.append('semester',semester)
            fd.append('file',files) 
            fd.append('year',year)
            fd.append('addclick','yes')
          $.ajax({
          url: '../../../Controller/AdminController/adminoldquestion_controller.php',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data:fd,
          success: function (data) {
            alert(data);
            get_past_question();         
          }
          })
          

    })
    $('#sortOldQues').click(function(e){
      var fd=new FormData();
      var req_program=$('#req_program').val();
      var req_semester=$('#req_semester').val();
      fd.append('req_program',req_program);
      fd.append('req_semester',req_semester);
      fd.append('sortclick','yes');
      $.ajax({
          url:'../../../Controller/AdminController/adminoldquestion_controller.php',
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