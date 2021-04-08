<?php

include 'connection.php';
$user=$_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
if(isset($_POST['faculty'])&&isset($_POST['program']))
{
$faculty=$_POST['faculty'];
$program=$_POST['program'];

if(isset($_POST['is_update_click']))
{
if($_POST['is_update_click']=='on')
{
$sql = "UPDATE `enroll` set faculty=$faculty,program=$program where user=$user";
$result=mysqli_query($conn, $sql);
if($result)
{
echo "Information Updated Successfully!!";
}
}
}
else{
$sql = "INSERT INTO `enroll`( `user`,`faculty`, `program`) VALUES ('$user','$faculty','$program')";
$result=mysqli_query($conn, $sql);
if($result)
{
    echo "Information Added Successfully!!";
}
}
}
}

else
{
$sql="SELECT faculty,program from enroll where user=$user";
$enroll_user=$conn->query($sql);
$sql="SELECT * FROM  faculty";
$result2=$conn->query($sql);
$faculty=mysqli_fetch_all($result2);
$sql="SELECT * FROM program";
$result3=$conn->query($sql);
$program=mysqli_fetch_all($result3);
}


?>