<?php
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    //Delete Notice Code Here:
    if (isset($_POST['deleteclick']))
    {
    if($_POST['deleteclick']=='yes');
    $id=$_POST['id'];
    $sql="DELETE FROM `feedback` WHERE id='$id'";
    if($conn->query($sql)==TRUE){
        echo "Feedback Deleted Successfully!!!";
    }
    else{
        echo "Error!";
    }
    }
    }

else{
    $sql="SELECT * FROM `feedback`";
    $result=$conn->query($sql);
    $all_feedback=mysqli_fetch_all($result);
}
?>