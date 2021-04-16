<?php 
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
if(isset($_POST['email'])&&isset($_POST['password'])){
//signup-process
//check whether the given user exists
$email=$_POST['email'];
$pass=$_POST['password'];
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
}
elseif(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['user'])&&isset($_POST['college'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$college=$_POST['college'];
$user=$_POST['user'];
$sql="UPDATE `users` SET `first_name`='$fname',`last_name`='$lname',`college`='$college' WHERE `id`='$user'";
$result=mysqli_query($conn, $sql);
if($result)
{
    echo "profile updated successfully!!!";
}
}
mysqli_close($conn);
}
else
{
    echo "404 Not Found";
}

?>