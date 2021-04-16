<?php
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if(isset($_GET['program']))
{
$program=$_GET['program'];
$sql="select `id`,`course_name` from course where program='$program'";
$result=$conn->query($sql);
?>
<select name="course" id="course"  required>
<?php
while($row=mysqli_fetch_array($result)){?>
<option value="<?php echo $row['id'];?>"><?php echo $row['course_name'];?></option>
<?php 
}?>
</select>
<label>Course</label>
<?php 
}

else {
$sql="select `id`,`course_name` from course";
$result=$conn->query($sql);
?>
<select name="course" id="course"  required>
<?php
while($row=mysqli_fetch_array($result)){?>
<option value="<?php echo $row['id'];?>"><?php echo $row['course_name'];?></option>
<?php 
}?>
</select>
<?php }?>





