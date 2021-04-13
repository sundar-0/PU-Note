<?php
session_start();
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

}
else{
$user=$_SESSION['user'];
$sql="SELECT `notice_info`,`added_date` FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN notice ON userEnroll.faculty=notice.faculty AND userEnroll.program=notice.program WHERE user='$user' ORDER BY notice.id ASC";
$result=$conn->query($sql);
$notice_count=0;
while($row=mysqli_fetch_array($result)){
    ?>
    <div class="mui--z5  mui--text-left mt-5  p-4"  style="background:tomato;color:#fff;">
    
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


?>