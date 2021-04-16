<?php
session_start();
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{     
        if(isset($_POST['signupclick']))
        {
                if($_POST['signupclick']=='yes')
                {
                        $email=$_POST['email'];
                        $password=$_POST['password'];
                        $fname=$_POST['fname'];
                        $lname=$_POST['lname'];
                        $faculty=$_POST['faculty'];
                        $college=$_POST['college'];
                        $program=$_POST['program'];

                        $sql="SELECT * FROM `users` WHERE email='$email'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0)
                        {
                                echo "Email Already Exists";
                        }
                        else
                        {
                                $sql="INSERT INTO `users` ( `email`, `password`,`first_name`, `last_name`,`college`) VALUES('$email','$password','$fname','$lname','$college')";
                                if($conn->query($sql)){
                                $sql="SELECT `id` FROM `users` WHERE email='$email'";
                                $result=$conn->query($sql);
                                $row=mysqli_fetch_object($result);
                                $user=$row->id;
                                $sql="INSERT INTO `enroll`(`user`,`faculty`,`program`) VALUES('$user','$faculty','$program')";
                                if($conn->query($sql)){
                                        echo "Signup Successfully!!!";
                                }
                                else
                                {
                                        echo "Error!!";
                                }
                                }
                        }   

                }
        }
        if(isset($_POST['updateclick'])){
                if($_POST['updateclick']=='yes'){       
                        $user=$_SESSION['user']; 
                        $updated_fname=$_POST['updated_fname'];
                        $updated_lname=$_POST['updated_lname'];
                        $updated_faculty=$_POST['updated_fac'];
                        $updated_program=$_POST['updated_prog'];
                        $updated_clg=$_POST['updated_clg'];
                        $sql="UPDATE users JOIN enroll on users.id=enroll.user SET users.first_name='$updated_fname',users.last_name='$updated_lname',users.college='$updated_clg',enroll.faculty='$updated_faculty',enroll.program='$updated_program' WHERE users.id='$user'";
                        $result=$conn->query($sql);
                        if($result)
                        echo "Profile Updated Successfully";
                        else
                        echo "Error";
                        }
                   

                }
}



else
{
        if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
                if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
              {          
        $user=$_SESSION['user']; 
        $sql="SELECT `first_name`,`last_name`,`college`,`faculty_name`,`program_name`,`faculty`,`program` FROM (SELECT * FROM `users` JOIN enroll on users.id=enroll.user) AS UserEnroll JOIN faculty on UserEnroll.faculty=faculty.id JOIN program  on UserEnroll.program=program.id WHERE user=$user";
        $result=$conn->query($sql);
        $profile_info=mysqli_fetch_all($result);
        if(!empty($profile_info)){?>
    
        <?php
        foreach($profile_info as $x => $x_value) {  ?>
                <ul class="mui-list--inline">
                First Name: <?php echo $x_value[0]?>   
                </ul>
                <hr>
                <ul class="mui-list--inline">Last Name: <?php echo $x_value[1]?></ul>
                <hr>
                <ul class="mui-list--inline">College: <?php echo $x_value[2]?></ul>
                <hr>
                <ul class="mui-list--inline">Faculty:<?php echo $x_value[3]?></ul>
                <hr>
                <ul class="mui-list--inline">Program: <?php echo $x_value[4]?></ul>

                <button onclick='editInfo("<?php echo  $x_value[0];?>","<?php echo  $x_value[1];?>","<?php echo  $x_value[2];?>",<?php echo  $x_value[5];?>,<?php echo  $x_value[6];?>)'>Edit Your Info</button>
           <?php }?>

          
        <?php }
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

}


?>