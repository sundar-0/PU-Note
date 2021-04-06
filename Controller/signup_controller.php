<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
include 'connection.php';
$email=$_POST['email'];
$pass=$_POST['password'];
//signup-process
//check whether the given user exists
$sql="SELECT * FROM `users` WHERE email='$email'";
$result=mysqli_query($conn, $sql);
$count=mysqli_num_rows($result);
if($count>0)
{
echo "Email is already in use!!!";
}
else{
$sql = "INSERT INTO `users`( `email`, `password`) VALUES ('$email','$pass')";
if (mysqli_query($conn, $sql)) 
{
echo "Signup successfully!!!";
} 
else 
{
echo "There was problem on signup";
}
}
mysqli_close($conn);
}
?>