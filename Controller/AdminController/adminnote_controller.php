<?php
session_start();
if (isset($_SESSION['status']) && isset($_SESSION['is_admin'])){
    if($_SESSION['status']=='logedin' and $_SESSION['is_admin']==1)
    {
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
$AddedBy=$_SESSION['user'];
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
//Add Note Code Here:
if (isset($_POST['addclick']))
{
if($_POST['addclick']=='yes')
{
$semester=$_POST['semester'];
$faculty_id=$_POST['faculty'];
$program_id=$_POST['program'];
$filename=$_FILES['file']['name'];
$file=explode(".",$filename)[0];
$sql="SELECT faculty_name,program_name FROM faculty JOIN program on faculty.id=program.fact_id WHERE faculty.id=$faculty_id and program.id=$program_id";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/$semester/"; 

$original_path=$path.$filename;
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if (($_FILES['file']['type'] != "application/pdf") )
            {
                echo 'please upload only pdf file';
            }
          else 
          {
               $target_file = basename($_FILES["file"]["name"]);
               $result = move_uploaded_file($_FILES['file']['tmp_name'],$path .$filename);
               if($result== 1){
                   $sql="INSERT INTO `course`(`course_name`,`path`,`faculty`, `program`, `semester`, `added_by`) VALUES ('$file','$original_path','$faculty_id','$program_id','$semester','$AddedBy')";
                   if($conn->query($sql)==TRUE){
                       echo "Note Uploaded Successfully!!!";
                   }
                   else{
                       echo "There was problem on uploading the note!!!";
                   }
               }
           
        }
    }
}
}

//Delete Note Code Here:
if (isset($_POST['deleteclick']))
{
if($_POST['deleteclick']=='yes')
{
$id=$_POST['id'];
$filepath=$_POST['file_path'];
unlink($filepath);
$sql="DELETE FROM `course` WHERE id='$id'";
if($conn->query($sql)==TRUE){
    echo "Note Deleted Successfully!!!";
}
else{
    echo "There was problem on Deleting the note!!!";
}
}
}

//Sort Note Code Here:
if (isset($_POST['sortclick']))
{
    if($_POST['sortclick']=='yes')
    {
        $req_program=$_POST['req_program'];
        $req_semester=$_POST['req_semester'];
        $sql="SELECT * FROM `course` WHERE program='$req_program' AND semester='$req_semester'";
        $result=$conn->query($sql);
        $all_note=mysqli_fetch_all($result);
        if(!empty($all_note)){?>
        <table class="mui-table mui-table--bordered">
        <thead>
            <tr>
            <th>id</th>
            <th>Course Name</th>
            <th>Faculty</th>
            <th>Program</th>
            
            <th>Semester</th>
            <th>Added By</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach($all_note as $x => $x_value) {  
            ?>
            <tr>

            <td><?php echo $x_value[0]?></td>
            <td>
            <?php echo $x_value[1]?>
            <button class="mui-btn mui-btn--small  mui-btn--primary" onclick='viewNote("<?php  echo $x_value[2];?>")'>View </button>
            </td>
            <td><?php echo $x_value[3]?></td>
            <td><?php echo $x_value[4]?></td>
            <td><?php echo $x_value[5]?></td>
            <td><?php echo $x_value[6]?></td>
            <td><button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='editNote(<?php echo $x_value[0];?>,"<?php echo $x_value[1]; ?>","<?php echo $x_value[2]; ?>",<?php echo $x_value[3] ?>,<?php echo $x_value[4] ?>,<?php echo $x_value[5]?>)'>Edit</button> 
            <button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deletenote(<?php echo $x_value[0]?>,"<?php echo $x_value[2]; ?>")'>Delete</button></td>
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




//Update Note Code Here:
if (isset($_POST['updateclick']))

{
        if($_POST['updateclick']=='yes')
    {
        $id=$_POST['id'];
        $updated_faculty=$_POST['updated_faculty'];
        $updated_program=$_POST['updated_program'];
        $updated_semester=$_POST['updated_semester'];
        $previous_filepath=$_POST['file_path'];
        $sql="SELECT faculty_name,program_name FROM faculty JOIN program on faculty.id=program.fact_id WHERE faculty.id=$updated_faculty and program.id=$updated_program" ;
        $result=$conn->query($sql);
        $row=mysqli_fetch_object($result);
    if (isset($_FILES['updated_file']))
    {
            $filename=$_FILES['updated_file']['name'];
            $file=explode(".",$filename)[0];
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/$updated_semester/";    
            $updated_filepath=$path.$filename;
        if (is_uploaded_file($_FILES['updated_file']['tmp_name'])) 
                {

                        if (($_FILES['updated_file']['type'] != "application/pdf") )
                            {
                                echo 'please upload only pdf file';
                            }
                        else 
                        {
                            if($previous_filepath!=$updated_filepath)
                                {
                                    unlink($previous_filepath);
                                    $target_file = basename($_FILES["updated_file"]["name"]);
                                    $result = move_uploaded_file($_FILES['updated_file']['tmp_name'],$path .$filename);
                                    if($result== 1){
                                        $sql="UPDATE `course` SET `course_name`='$file',`path`='$updated_filepath',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
                                        if($conn->query($sql)==TRUE){
                                            echo "Note Updated Successfully!!!";
                                        }
                                        else{
                                            echo "There was problem on Updating the note!!!";
                                        }
                                    }
                                
                                }
                            else{
                                    
                                    $sql="UPDATE `course` SET `course_name`='$file',`path`='$updated_filepath',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
                                    if($conn->query($sql)==TRUE){
                                        echo "Note Updated Successfully!!!";
                                    }
                                    else{
                                        echo "There was problem on Updating the note!!!";
                                    }
                                }
                            
                            }
                }
    }
    else{
            $data=explode("/",$previous_filepath);
            $prev_faculty=$data[7];
            $prev_program=$data[8];
            $prev_sem=$data[11];
            $prev_filename=$data[12];
            //All 3 are True
            if(!($row->faculty_name==$prev_faculty && $row->program_name==$prev_program && $updated_semester==$prev_sem))
            {
                $curr_path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/$updated_semester/$prev_filename"; 
                $result=rename("$previous_filepath","$curr_path");
                if($result==1){
                    $sql="UPDATE `course` SET `path`='$curr_path',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
                    if($conn->query($sql)==TRUE){
                        echo "Note Updated Successfully!!!";
                    }
                    else{
                        echo "There was problem on Updating the note!!!";
                    }
                }
            } 
        }  
    }
}
}

else{

    //Fetch All Note Code Here
    $sql="SELECT * FROM `course`";
    $result=$conn->query($sql);
    $all_note=mysqli_fetch_all($result);
    if(!empty($all_note)){?>
        <table class="mui-table mui-table--bordered">
        <thead>
            <tr>
            <th>id</th>
            <th>Course Name</th>
            <th>Faculty</th>
            <th>Program</th>
            
            <th>Semester</th>
            <th>Added By</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach($all_note as $x => $x_value) {  
            ?>
            <tr>

            <td><?php echo $x_value[0]?></td>
            <td>
            <?php echo $x_value[1]?>
            <button class="mui-btn mui-btn--small  mui-btn--primary" onclick='viewNote("<?php  echo $x_value[2];?>")'>View </button>
            </td>
            <td><?php echo $x_value[3]?></td>
            <td><?php echo $x_value[4]?></td>
            <td><?php echo $x_value[5]?></td>
            <td><?php echo $x_value[6]?></td>
            <td><button class="mui-btn mui-btn--small  mui-btn--primary"  onclick='editNote(<?php echo $x_value[0];?>,"<?php echo $x_value[1]; ?>","<?php echo $x_value[2]; ?>",<?php echo $x_value[3] ?>,<?php echo $x_value[4] ?>,<?php echo $x_value[5]?>)'>Edit</button> 
            <button class="mui-btn mui-btn--small  mui-btn--danger" onclick='deletenote(<?php echo $x_value[0]?>,"<?php echo $x_value[2]; ?>")'>Delete</button></td>
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