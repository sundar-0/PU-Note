<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
            if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
            {
include '../base.php';
include 'drawer.php';
include '../../Controller/UserController/get_faculty_program.php';
?>
<div id="content-wrapper">
  <div class="mui--appbar-height"></div>

    <div class="mui-container mt-5">
    <div class="mui-col-12 mui-col-md-6 mui-panel mui--text-left" id="profile">
        <h3>Your Information</h3><hr>

    </div>
    <div class="mui-col-12 mui-col-md-6 mui-panel mui--text-left" id="editprofile">
        <h3>Edit Information</h3><hr>
        <form id="editform" method="POST">
       <label>First Name:</label> 
        <input type="text" name="fname" id="fname"><hr>
       <label>Last Name</label>
        <input type="text" name="lname" id="lname"><hr>
        <label>Faculty</label>
        <select name="faculty" id="faculty">
        <?php
        foreach($faculty as $x => $x_value) {
                  echo '<option value="'.$x_value[0].'">'.$x_value[1].'</option>';
                }
        ?> 
        </select><hr>
        <label>Program</label>
        <select name="program" id="program">
        <?php
                foreach($program as $x => $x_value) {
                  echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
                }
                ?> 
        </select><hr>
        <label>College</label>
        <input type="text" name="college" id="college"><hr>
        <button id="updateProfile">Update</button>
        </form>
    </div>
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

async function get_user_profile()
{
  $.ajax({
        type:"GET",
        url:'../../Controller/UserController/signup_enroll_controller.php',
        success: function(data) {
            $('#profile').append(data);
          }
        })
}
function editInfo(fname,lname,clg,fact,prog){
console.log('working')
$('#profile').hide();
$('#editprofile').show();
$('#fname').val(fname).change()
$('#lname').val(lname).change()
$('#college').val(clg).change()
$('#faculty').val(fact).change()
$('#program').val(prog).change()
}

$(document).ready(function(){
    get_user_profile();
    $('#editprofile').hide();
    $('#editform').submit(function(e){
      var fd=new FormData();
      var updated_fname=$('#fname').val()
      var updated_lname=$('#lname').val()
      var updated_clg=$('#college').val()
      var updated_fac=$("#faculty").val()
      var updated_prog=$('#program').val()
      fd.append('updated_fname',updated_fname)
      fd.append('updated_lname',updated_lname)
      fd.append('updated_clg',updated_clg)
      fd.append('updated_fac',updated_fac)
      fd.append('updated_prog',updated_prog)
      fd.append('updateclick',"yes")
      $.ajax({
        type:"POST",
        url:'../../Controller/UserController/signup_enroll_controller.php',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success:function(data){
          alert(data);
        }
      })
    })
  });
   


</script>