<?php
include('config.php');
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
$login_button = '<a href="'.$google_client->createAuthUrl().'"> <button class="mui-btn mui-btn--raised"><img src="static/images/google_logo.png" style="width: 40px; height:25px;"> Login With Google</button></a>';
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
            <td class="mui--text-title">PU Notes</td>
          </tr>
        </table>
      </div>
    </header>
    <div id="content-wrapper" class="mui--text-center">
      <div class="mui--appbar-height"></div>
            <br>
            <br>
            <div class="mui--text-display3">PU Notes</div>
            <br>
            <br>

            <?php
            if($login_button == '')
            {
              
              header('Location:./Dashboard/');
            }
            else{
              echo $login_button.' <strong>Or</strong>'.' <button class="mui-btn mui-btn--raised" onclick="activatesignupModal()">Signup</button>';
            }
            ?>
            <br><br>
            <strong>Already Have Account?</strong><br>
            <button class="mui-btn mui-btn--raised" onclick="activateloginModal()">Login</button>
       
    </div>
    
    <footer>
      <div class="mui-container mui--text-center">
        Made with ♥ by <a href="https://www.muicss.com">MUICSS</a>
      </div>
    </footer>
  </body>
</html>
<script>
  function activatesignupModal() {
    // initialize modal element
    var signupform='<form id="signupform" class="mui-form"><legend>Signup</legend><div class="mui-textfield mui-textfield--float-label"> <input type="email" name="email" required> <label>Required Email Field</label> </div> <div class="mui-textfield mui-textfield--float-label"> <input type="password" name="password" required> <label>Required Password Field</label> </div> <input type="submit"  value="signup" class="mui-btn mui-btn--raised"></form>' ;
    var modalEl = document.createElement('div');
    modalEl.style.width = '400px';
    modalEl.style.height = '300px';
    modalEl.style.margin = '350px auto';
    modalEl.style.padding='20px'
    modalEl.style.backgroundColor = '#fff';
    modalEl.innerHTML=signupform;
    // show modal
    mui.overlay('on',modalEl);
    
    $(document).ready(function(){
    $('#signupform').submit(function(e){
      $.ajax({
        type:"POST",
        url:'../Controller/signup_controller.php',
        data:$('#signupform').serialize(),
        success:function(data){
          alert(data)
          $('#signupform')[0].reset();
        }


      })
      e.preventDefault();
      }
    );
  }
  );
  }
  function activateloginModal() {
    // initialize modal element
    var loginform='<form class="mui-form"><legend>Login</legend><div class="mui-textfield mui-textfield--float-label"> <input type="email" required> <label>Required Email Field</label> </div> <div class="mui-textfield mui-textfield--float-label"> <input type="password" required> <label>Required Password Field</label> </div> <button type="submit" class="mui-btn mui-btn--raised">Submit</button></form>';
    var modalEl = document.createElement('div');
    modalEl.style.width = '400px';
    modalEl.style.height = '300px';
    modalEl.style.margin = '350px auto';
    modalEl.style.padding='20px'
    modalEl.style.backgroundColor = '#fff';
    modalEl.innerHTML=loginform;
    // show modal
    mui.overlay('on',modalEl);
  }




</script>
























































