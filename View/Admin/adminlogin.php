<?php
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
  if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1){
    echo "You must Logout";
  }
}
else{
include '../base.php';
?>
<header class="mui-appbar mui--z1">
<div class="mui-container">
  <table>
    <tr class="mui--appbar-height">
      <td class="mui--text-title">Admin Site</td>
    </tr>
  </table>
</div>
</header>
<div id="content-wrapper" class="mui--text-center">
<div class="mui--appbar-height"></div>
    <form class="mui-form " id="adminloginform" >
        <legend>Admin Login</legend>
        <div class="mui-textfield mui-textfield--float-label">
        <input type="email" name="email" > <label>Required Email Field</label> </div>
        <div class="mui-textfield mui-textfield--float-label"> <input type="password" name="password" >
        <label>Required Password Field</label> </div> 
        <button type="submit" class="mui-btn mui-btn--raised">Login</button>
    </form>
</div>
<footer>
<div class="mui-container mui--text-center">
Made with ♥ by <a href="https://www.muicss.com">MUICSS</a>
</div>
</footer>
<script>
$(document).ready(function(){
    $('#adminloginform').submit(function(e){
      $.ajax({
        type:"POST",
        url:'../../Controller/AdminController/adminlogin_controller.php',
        data:$('#adminloginform').serialize(),
        success:function(data){
          if(data==="success"){
            alert('Login success.Please Wait!!')
            window.location.href='./AdminDashboard'
          }
          else{
            alert("Auth Failed")
          }
          $('#adminloginform')[0].reset();
        }
      })
      e.preventDefault();
      }
    );
  }
  );
  </script>

 <?php }?>



