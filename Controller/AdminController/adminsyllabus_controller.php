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
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Syllabus/Semester/$semester/"; 
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
                   $sql="INSERT INTO `syllabus`(`syllabus_name`,`path`,`faculty`, `program`, `semester`, `added_by`) VALUES ('$file','$original_path','$faculty_id','$program_id','$semester','$AddedBy')";
                   if($conn->query($sql)==TRUE){
                       echo "Syllabus Uploaded Successfully!!!";
                   }
                   else{
                       echo "There was problem on uploading the syllabus!!!";
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
$sql="DELETE FROM `syllabus` WHERE id='$id'";
if($conn->query($sql)==TRUE){
    echo "Syllabus Deleted Successfully!!!";
}
else{
    echo "There was problem on Deleting the syllabus!!!";
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
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Syllabus/Semester/$updated_semester/";        
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
                                        $sql="UPDATE `syllabus` SET `syllabus_name`='$file',`path`='$updated_filepath',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
                                        if($conn->query($sql)==TRUE){
                                            echo "Syllabus Updated Successfully!!!";
                                        }
                                        else{
                                            echo "There was problem on Updating the syllabus!!!";
                                        }
                                    }
                                
                                }
                            else{
                                    
                                    $sql="UPDATE `syllabus` SET `syllabus_name`='$file',`path`='$updated_filepath',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
                                    if($conn->query($sql)==TRUE){
                                        echo "Syllabus Updated Successfully!!!";
                                    }
                                    else{
                                        echo "There was problem on Updating the Syllabus!!!";
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
                $curr_path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/Syllabus/Semester/$updated_semester/$prev_filename"; 
                $result=rename($previous_filepath,$curr_path);
                if($result==1){
                    $sql="UPDATE `syllabus` SET `path`='$curr_path',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester' WHERE id='$id' ";
                    if($conn->query($sql)==TRUE){
                        echo "Syllabus Updated Successfully!!!";
                    }
                    else{
                        echo "There was problem on Updating the Syllabus!!!";
                    }
                }
            } 
        }  
}
}
}

else{

    //Fetch All Note Code Here
    $sql="SELECT * FROM `syllabus`";
    $result=$conn->query($sql);
    $all_syllabus=mysqli_fetch_all($result);
 
}

?>