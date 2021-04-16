<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
  {
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
$user=$_SESSION['user'];
$sql="SELECT `semester`,`syllabus_name`,`path` FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN syllabus ON userEnroll.faculty=syllabus.faculty AND userEnroll.program=syllabus.program WHERE user='$user' ORDER BY semester ASC";
$result=$conn->query($sql);
while($row=mysqli_fetch_array($result)){
    ?>
    <div class="mui-col-md-4">
    <div class="mui-panel mui--z1 m-4 p-4">
    <?php echo '<h1><i class="fas fa-folder"></i> Semester '." ".$row['semester']."</h1>";?>
    <br>
  
    <button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='viewSyllabus("<?php echo $row["path"];?>")'>View</button>
    
    
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