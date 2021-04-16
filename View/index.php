<?php
include('config.php');
include '../Controller/connection.php';
include('../Controller/UserController/get_faculty_program.php');
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
  if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0){
    echo "You must Logout";
  }
}
else{
$login_button = '';
if(isset($_GET["code"]))
{
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error']))
 {
  $google_client->setAccessToken($token['access_token']);
  $_SESSION['access_token'] = $token['access_token'];
  $google_service = new Google_Service_Oauth2($google_client);
  $data = $google_service->userinfo->get(); 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }
  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }
  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }
  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }
  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
if(!isset($_SESSION['access_token']))
{
$login_button = '<a href="'.$google_client->createAuthUrl().'"> <button class="mui-btn mui-btn--raised"><img src="static/images/google_logo.png" style="width: 42px; height:28px;">Google Login</button></a>';
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PU Note</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link href="https://cdn.muicss.com/mui-latest/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link href="static/style.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.muicss.com/mui-latest/js/mui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
  </head>
      <body>
        <header class="mui-appbar mui--z1">
          <div class="mui-container">
            <table>
              <tr class="mui--appbar-height">
                <td class="mui--text-title">FUEL PU</td>
              </tr>
            </table>
          </div>
        </header>
        
        <div class="mui-container">
                  <div class="mui--appbar-height"></div>
                      
                        <?php
                        if($login_button == '')
                        {
                          
                          header('Location:./Dashboard/');
                        }
                        else{
                        ?>
                        <div class="row">
                          <div class="mui-panel mui-col-12 mui-col-md-6" id="signup_enroll">
                              <form class="mui-form" id="signup_enrollform">
                              <legend>Signup</legend>
                                <div class="mui-textfield mui-textfield--float-label"> <input type="email" id="email" name="email" placeholder="Enter Your Email" required></div> 
                                <div class="mui-textfield mui-textfield--float-label"> <input type="password" id="password" name="password" placeholder="Enter Your Password" required></div>
                                <div class="mui-textfield mui-textfield--float-label"> <input type="text" id="fname" name="fname" placeholder="Enter Your First Name" required></div>
                                <div class="mui-textfield mui-textfield--float-label"> <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name" required></div>
                                <div class="mui-textfield mui-textfield--float-label"> <input type="text" id="college" name="college" placeholder="Enter Your College" required></div>
                                <div class="mui-select">
                                  <select name="faculty" id="faculty" required>
                                    <?php
                                    foreach($faculty as $x => $x_value) {
                                      echo '<option value="'.$x_value[0].'">'.$x_value[1].'</option>';
                                    }
                                    ?> 
                                  </select>
                                  <label>Faculty</label>
                                </div>
                                  <div class="mui-select">
                                  <select name="program" id="program" required>
                                    <?php
                                    foreach($program as $x => $x_value) {
                                      echo '<option  value="'.$x_value[0].'">'.$x_value[1].'</option>';
                                    }
                                    ?> 
                                  </select>
                                  <label>Program</label>
                                  </div>
                                  <button  class="mui-btn mui-btn--primary" id="signupclick">SignUp</button>
                              </form> 
                        </div>
                        <div class="mui-col-12 mui-col-md-1"></div>
                        <div class=" mui-panel mui-col-12 mui-col-md-5" id="login">
                              <form class="mui-form" id="login_form">
                              <legend>Login</legend>
                                <div class="mui-textfield mui-textfield--float-label"> <input type="email" id="email" name="email" placeholder="Enter Your Email" required></div> 
                                <div class="mui-textfield mui-textfield--float-label"> <input type="password" id="password" name="password" placeholder="Enter Your Password" required></div>
                                <button class="mui-btn mui-btn--primary" type="submit">Login</button>
                              </form>
                              <strong>Or</strong>
                              <?php echo $login_button;?>
                        </div>
                    </div>
                <?php }?>
            </div>  

            <hr>
              <footer>
                <div class="mui-container mui--text-center">
                  Made with ♥ by <a href="https://www.muicss.com">INitDevelops</a>
                </div>
              </footer>
    </body>
</html>
<?php }?>
<script>



// function activatesignupModal() {
//     // initialize modal element
//     var modalEl = document.createElement('div');
//     modalEl.style.width = '400px';
//     modalEl.style.height = '400px';
//     modalEl.style.margin = '200px auto';
//     modalEl.style.padding='20px'
//     modalEl.style.backgroundColor = '#fff';

//     modalEl.innerHTML=$('#user_info').html();
//     // show modal
//     mui.overlay('on',modalEl);
// }

 


$(document).ready(function(){
  $('#signup_enrollform').submit(function(e){
      var fd=new FormData();
      var email=$('#signup_enroll #email').val()
      var password=$('#signup_enroll #password').val()
      var fname=$('#signup_enroll #fname').val()
      var lname=$('#signup_enroll #lname').val()
      var college=$('#signup_enroll #college').val()
      var faculty=$("#signup_enroll #faculty").val()
      var program=$('#signup_enroll #program').val()
      fd.append('email',email)
      fd.append('password',password)
      fd.append('college',college)
      fd.append('faculty',faculty)
      fd.append('program',program)
      fd.append('fname',fname)
      fd.append('lname',lname)
      fd.append('signupclick',"yes")
      $.ajax({
        type:"POST",
        url:'../Controller/UserController/signup_enroll_controller.php',
        cache: false,
        contentType: false,
        processData: false,
        data:fd,
        success:function(data){
          alert(data);
          $('#signup_enrollform')[0].reset()
        }
      })
      e.preventDefault()
})

$('#login_form').submit(function(e){
      $.ajax({
        type:"POST",
        url:'../Controller/UserController/login_controller.php',
        data:$('#login_form').serialize(),
        success:function(data){
          if(data==="success"){
            alert('Login success.Please Wait!!')
            window.location.href="../View/Dashboard"
          }
          else{
            alert("Auth Failed")
          }
          $('#login_form')[0].reset();
        }
      })
      e.preventDefault();
      });
  });
</script>
























































