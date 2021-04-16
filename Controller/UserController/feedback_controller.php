<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==0)
  {
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
$user=$_SESSION['user'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $feedback=$_POST['feedback'];
        $sql="INSERT INTO `feedback`(`feedback_text`, `feedback_by`) VALUES ('$feedback','$user')";
        $result=$conn->query($sql);
        if($result){
            echo "FeedBack Sent Successfully";
        }
        else{
            echo "Error!!";
        }
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