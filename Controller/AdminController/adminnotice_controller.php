<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
$AddedBy=$_SESSION['user'];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
//Add Notice Code Here:
if (isset($_POST['addclick']))
{
if($_POST['addclick']=='yes')
{
$notice=$_POST['notice'];
$semester=$_POST['semester'];
$faculty_id=$_POST['faculty'];
$program_id=$_POST['program'];
$sql="INSERT INTO `notice`(`notice_info`,`faculty`, `program`, `semester`, `added_by`) VALUES ('$notice','$faculty_id','$program_id','$semester','$AddedBy')";
if($conn->query($sql)==TRUE){
    echo "Notice Posted Successfully!!!";
}
else{
    echo "Error";
}

}
}


if (isset($_POST['sortclick']))

{
        if($_POST['sortclick']=='yes')
    {  
        $req_program=$_POST['req_program'];
        $req_semester=$_POST['req_semester'];
        $sql="SELECT * FROM `notice` WHERE program='$req_program' AND semester='$req_semester'";
        $result=$conn->query($sql);
        $all_notice=mysqli_fetch_all($result);
        if(!empty($all_notice)){?>
            <table class="mui-table mui-table--bordered mui-table--responsive">
            <thead>
              <tr>
                <th>id</th>
                <th>Notice</th>
                <th>Faculty</th>
                <th>Program</th>
                <th>Semester</th>
                <th>Added By</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
             foreach($all_notice as $x => $x_value) {
               ?>
               <tr>
          
                <td><?php echo $x_value[0]?></td>
                <td>
                <?php echo $x_value[1]?>
                </td>
                <td><?php echo $x_value[2]?></td>
                <td><?php echo $x_value[3]?></td>
                <td><?php echo $x_value[4]?></td>
                <td><?php echo $x_value[5]?></td>
                <td><button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='editNotice(<?php echo $x_value[0];?>,"<?php echo $x_value[1]; ?>","<?php echo $x_value[2]; ?>",<?php echo $x_value[3] ?>,<?php echo $x_value[4] ?>)'>Edit</button> 
                <button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deleteNotice(<?php echo $x_value[0]?>)'>Delete</button></td>
              </tr>
            <?php }?>
            </tbody>
            </table>
            <?php }
            else{
                echo "No Data Found!!";
            }
    }
}

//Delete Notice Code Here:
if (isset($_POST['deleteclick']))
{
if($_POST['deleteclick']=='yes');
$id=$_POST['id'];
$sql="DELETE FROM `notice` WHERE id='$id'";
if($conn->query($sql)==TRUE){
    echo "Notice Deleted Successfully!!!";
}
else{
    echo "Error!";
}
}

//Update Notice Code Here:
if (isset($_POST['updateclick']))

{
        if($_POST['updateclick']=='yes')
    {
        $id=$_POST['id'];
        $updated_notice=$_POST['updated_notice'];
        $updated_faculty=$_POST['updated_faculty'];
        $updated_program=$_POST['updated_program'];
        $updated_semester=$_POST['updated_semester'];
        $sql="UPDATE `notice` SET `notice_info`='$updated_notice',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
        if($conn->query($sql)==TRUE){
            echo "Notice Updated Successfully!!!";
        }
        else{
            echo "Error!";
        }

    }
}
}

else{

    //Fetch All Note Code Here
    $sql="SELECT * FROM `notice`";
    $result=$conn->query($sql);
    $all_notice=mysqli_fetch_all($result);
    if(!empty($all_notice)){?>
    <table class="mui-table mui-table--bordered mui-table--responsive">
    <thead>
      <tr>
        <th>id</th>
        <th>Notice</th>
        <th>Faculty</th>
        <th>Program</th>
        <th>Semester</th>
        <th>Added By</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
     foreach($all_notice as $x => $x_value) {
       ?>
       <tr>
  
        <td><?php echo $x_value[0]?></td>
        <td>
        <?php echo $x_value[1]?>
        </td>
        <td><?php echo $x_value[2]?></td>
        <td><?php echo $x_value[3]?></td>
        <td><?php echo $x_value[4]?></td>
        <td><?php echo $x_value[5]?></td>
        <td><button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='editNotice(<?php echo $x_value[0];?>,"<?php echo $x_value[1]; ?>","<?php echo $x_value[2]; ?>",<?php echo $x_value[3] ?>,<?php echo $x_value[4] ?>)'>Edit</button> 
        <button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deleteNotice(<?php echo $x_value[0]?>)'>Delete</button></td>
      </tr>
    <?php }?>
    </tbody>
    </table>
    <?php }
    else{
        echo "No Data Found!!";
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