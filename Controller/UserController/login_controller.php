<?php
$email=$_POST['email'];
$pass=$_POST['password'];
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
$sql="SELECT * FROM users WHERE email='$email' and password='$pass'";
$result=$conn->query($sql);//to check whether the user exists or not 
if($result->num_rows>0)//if there exists a user
{ 
$sql="SELECT id from users where email='$email' and password='$pass' ";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$user=$row->id;
session_start();
$_SESSION['status']='logedin';
$_SESSION['email']=$email;
$_SESSION['user']=$user;
echo "success";
}
else{
echo "failed";
}
?>
