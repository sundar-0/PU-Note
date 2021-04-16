<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
{
$user=$_SESSION['user'];
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
$sql="SELECT `notice_info`,`added_date` FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN notice ON userEnroll.faculty=notice.faculty AND userEnroll.program=notice.program WHERE user='$user' ORDER BY notice.id ASC";
$result=$conn->query($sql);
$notice_count=0;
while($row=mysqli_fetch_array($result)){
    ?>
    <div class="mui-panel mui--z1  mui--text-left mt-5  p-4">
    
    <?php echo '<h3> <i class="fas fa-bullhorn"></i> '.$row['notice_info'].'</h3>';?>
    <hr>
    <?php echo '<strong><i class="far fa-calendar"></i> Posted On:'.$row['added_date'].'</strong>';?>
    <br>    
    </div>
    <?php
    $notice_count++;
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