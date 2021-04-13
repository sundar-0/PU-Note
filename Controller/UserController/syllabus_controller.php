<?php
session_start();
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

}
else{
$user=$_SESSION['user'];
$sql="SELECT `semester`,`syllabus_name`,`path` FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN syllabus ON userEnroll.faculty=syllabus.faculty AND userEnroll.program=syllabus.program WHERE user='$user' ORDER BY semester ASC";
$result=$conn->query($sql);
while($row=mysqli_fetch_array($result)){
    ?>
    <div class="mui-col-md-4">
    <div class="mui-panel mui--z5" style="background:tomato;color:#fff">
    <?php echo '<h1><i class="fas fa-folder"></i> Semester '." ".$row['semester']."</h1>";?>
    <br>
  
    <button class="mui-btn mui-btn--small  mui-btn--light"  onclick='viewSyllabus("<?php echo $row["path"];?>")'>View</button>
    
    
    </div>
    </div>
    <?php
    }
    ?>

<?php
}
?>