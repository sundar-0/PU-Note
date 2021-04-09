<?php
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
session_start();

//Add Note Code Here:
if (isset($_POST['addclick']))
{
if($_POST['addclick']=='yes')
{
$semester=$_POST['semester'];
$faculty_id=$_POST['faculty'];
$program_id=$_POST['program'];
$AddedBy=$_SESSION['user'];
$filename=$_FILES['file']['name'];
$file=explode(".",$filename)[0];
$sql="SELECT faculty_name,program_name FROM faculty JOIN program on faculty.id=program.fact_id WHERE faculty.id=$faculty_id and program.id=$program_id";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
if($semester==1)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/1/"; 
elseif($semester==2)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/2/"; 
elseif($semester==3)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/3/"; 
elseif($semester==4)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/4/"; 
elseif($semester==5)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/5/"; 
elseif($semester==6)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/6/"; 
elseif($semester==7)
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/7/"; 
else
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/8/"; 



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
            if($updated_semester==1)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/1/"; 
            elseif($updated_semester==2)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/2/"; 
            elseif($updated_semester==3)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/3/"; 
            elseif($updated_semester==4)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/4/"; 
            elseif($updated_semester==5)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/5/"; 
            elseif($updated_semester==6)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/6/"; 
            elseif($updated_semester==7)
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/7/"; 
            else
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/8/"; 
            
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
            if($row->faculty_name==$prev_faculty && $row->program_name==$prev_program && $updated_semester==$prev_sem)
            {
                echo "Note Updated Successfully!!!";
            }
            elseif(($row->faculty_name==$prev_faculty && $row->program_name==$prev_program && $updated_semester!=$prev_sem) ||($row->faculty_name==$prev_faculty && $row->program_name!=$prev_program && $updated_semester!=$prev_sem))
            {

                $curr_path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/$updated_semester/$prev_filename"; 
                $result=rename($previous_filepath,$curr_path);
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
            else
            {
                $curr_path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Notes/Semester/$updated_semester/$prev_filename"; 
                $result=rename($previous_filepath,$curr_path);
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
 
}

?>