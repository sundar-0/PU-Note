<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
include 'base.php';
include 'drawer.php';
include '../../../Controller/UserController/get_faculty_program.php';
include '../../../Controller/AdminController/admininformation_controller.php';

?>

<div id="content-wrapper">
<div class="mui--appbar-height"></div>
<div class="mui-container">
  <br>
  <h1>News and Notice</h1>
  <div id="addnoticediv">
      <form class="mui-form" id="addnoticeform" method="POST">
      <textarea id="notice" name="notice" rows="20" cols="50" style=" resize: none;border:solid black"  placeholder="Enter Your notice here">
      </textarea>
      <br><br>
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
      <button type="submit" class="mui-btn mui-btn--raised" id="addnotice">Add Notice</button>
    </form>
  </div>

  <div  id="editnoticediv">
      <form class="mui-form" id="editnoticeform" method="POST">
      <textarea id="notice" name="notice" rows="20" cols="100" style=" resize: none;border:solid black"  placeholder="Enter Your notice here">
      </textarea><br><br>
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
      <button type="submit" class="mui-btn mui-btn--raised" id="updatenotice">Update</button>
    </form>
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

<button class="mui-btn mui-btn--raised" id="sortNotice">Apply</button>

</div><br><br>
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

async function get_all_notice(){
  $.ajax({
        url: '../../../Controller/AdminController/adminnotice_controller.php',
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
function editNotice(id,notice,faculty,program,semester){
$('#addnoticediv').hide();
$('#editnoticediv #notice').val(notice).change()
$("#editnoticediv #faculty").val(faculty).change()
$('#editnoticediv #program').val(program).change()
$('#editnoticediv #semester').val(semester).change()
$('#editnoticediv').show();
$('#editnoticediv #updatenotice').click(function(e)
{
$('#editnoticediv #editnoticeform').submit(function(e){
var fd=new FormData();
var updated_faculty=$("#editnoticediv #faculty").val()
var updated_program=$('#editnoticediv #program').val()
var updated_semester=$("#editnoticediv #semester").val()
var updated_notice=$('#editnoticediv #notice').val();
fd.append('id',id);
fd.append('updated_notice',updated_notice);
fd.append('updated_faculty',updated_faculty);
fd.append('updated_semester',updated_semester);
fd.append('updated_program',updated_program)
fd.append('updateclick','yes')
$.ajax({
        url: '../../../Controller/AdminController/adminnotice_controller.php',
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
    e.preventDefault();
  })
});
}

function deleteNotice(id){
      var fd=new FormData();
      fd.append('id',id);
      fd.append('deleteclick','yes');
      $.ajax({
        url: '../../../Controller/AdminController/adminnotice_controller.php',
        type:'POST',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success: function(data) {
            alert(data);
            get_all_notice();
           
        }
    });
    }



$(document).ready(function(){
  $('#editnoticediv').hide();
    get_all_notice();
    $('#addnoticeform').submit(function(e)
    {
            var fd=new FormData();
            var notice=$('#notice').val()
            var faculty=$('#faculty').val();
            var program=$('#program').val();
            var semester=$('#semester').val();  
            fd.append('notice',notice)
            fd.append('faculty',faculty)
            fd.append('program',program)
            fd.append('semester',semester)
            fd.append('addclick','yes')
            $.ajax({
            url: '../../../Controller/AdminController/adminnotice_controller.php',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data:fd,
            success: function (data) {
              alert(data);
              $('#addnoticeform')[0].reset();
              get_all_notice();
            }
          
        })
        e.preventDefault();
    })
    $('#sortNotice').click(function(e){
      var fd=new FormData();
      var req_program=$('#req_program').val();
      var req_semester=$('#req_semester').val();
      fd.append('req_program',req_program);
      fd.append('req_semester',req_semester);
      fd.append('sortclick','yes');
      $.ajax({
          url:'../../../Controller/AdminController/adminnotice_controller.php',
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
        e.preventDefault();
    })
}

);


</script>