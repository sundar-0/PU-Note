<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
  {
$user=$_SESSION['user'];
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['viewclick']))
{
    if($_POST['viewclick']=='yes'){
        $semester=$_POST['semester'];
        $sql="SELECT  `year`,`path` FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN old_question ON userEnroll.faculty=old_question.faculty AND userEnroll.program=old_question.program WHERE user='$user' AND semester='$semester' ";
        $result=$conn->query($sql);
    while($row=mysqli_fetch_array($result)){
    ?>
   <div class="mui-col-md-4">
    <div class="mui-panel mui--z1 mt-4 p-4">
    <?php echo '<h1><i class="fas fa-folder"></i> Year '." ".$row["year"]."</h1>";?>
    <br>
  
    <button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='viewOldQuesYear("<?php echo $row["path"];?>")'>View</button>  
    </div>
    </div>
    <?php
    }
    ?>

<?php
}
}
}
else{
/*User Enroll Vako Faculty ra Program Ko
Kun Kun Sem Ko Old Question Upload Vaxa ta*/
$sql="SELECT DISTINCT `semester` FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN old_question ON userEnroll.faculty=old_question.faculty AND userEnroll.program=old_question.program WHERE user='$user' ORDER BY `semester` ASC";
$result=$conn->query($sql);
while($row=mysqli_fetch_array($result)){
    ?>
   <div class="mui-col-md-4">
    <div class="mui-panel mui--z1 mt-4  p-4">
    <?php echo '<h1><i class="fas fa-folder"></i> Semester '." ".$row["semester"]."</h1>";?>
    <br>
  
    <button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='viewOldQues(<?php echo $row["semester"];?>)'>View</button>  
    </div>
    </div>
    <?php
    }
    ?>

<?php
}
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

