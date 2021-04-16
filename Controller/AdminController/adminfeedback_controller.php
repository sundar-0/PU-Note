<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
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
    if(!empty($all_feedback)){?>
        <table class="mui-table mui-table--bordered">
        <thead>
            <tr>
            <th>id</th>
            <th>Feedback</th>
            <th>Feedback By</th>
            <th>Date</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach($all_feedback as $x => $x_value) {  
            ?>
            <tr>
            <td><?php echo $x_value[0]?></td>
            <td><?php echo $x_value[1]?></td>
            <td><?php echo $x_value[2]?></td>
            <td><?php echo $x_value[3]?></td>
            <td><button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deleteFeedback(<?php echo $x_value[0]?>)'>Delete</button></td>
            </tr>
        <?php }?>
        </tbody>
        </table>
        <?php }
        else{
            echo "No Data Found";
        }
    
}
}
else
    {
    echo "Only Admin Can View This Page";
    }
}
  else
  {
    echo "You Must Login to have access to this page";
  }
?>


