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
$year=$_POST['year'];
$filename=$_FILES['file']['name'];
$file=explode(".",$filename)[0];
$sql="SELECT faculty_name,program_name FROM faculty JOIN program on faculty.id=program.fact_id WHERE faculty.id=$faculty_id and program.id=$program_id";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/OldQuestions/Semester/$semester/$year/"; 
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
                   $sql="INSERT INTO `old_question`(`question`,`path`,`faculty`, `program`, `semester`,`year`, `added_by`) VALUES ('$file','$original_path','$faculty_id','$program_id','$semester','$year','$AddedBy')";
                   if($conn->query($sql)==TRUE){
                       echo "Old Questions Uploaded Successfully!!!";
                   }
                   else{
                       echo "There was problem on uploading the Old Question!!!";
                   }
               }
           
        }
    }
}
}

//Delete Note Code Here:
if (isset($_POST['deleteclick']))
{
if($_POST['deleteclick']=='yes');
$id=$_POST['id'];
$filepath=$_POST['file_path'];
unlink($filepath);
$sql="DELETE FROM `old_question` WHERE id='$id'";
if($conn->query($sql)==TRUE){
    echo "Old Question Deleted Successfully!!!";
}
else{
    echo "There was problem on Deleting the Old QUestion!!!";
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
        $updated_year=$_POST['updated_year'];
        $sql="SELECT faculty_name,program_name FROM faculty JOIN program on faculty.id=program.fact_id WHERE faculty.id=$updated_faculty and program.id=$updated_program" ;
        $result=$conn->query($sql);
        $row=mysqli_fetch_object($result);
    if (isset($_FILES['updated_file']))
    {
            $filename=$_FILES['updated_file']['name'];
            $file=explode(".",$filename)[0];
            $path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/OldQuestions/Semester/$updated_semester/$updated_year/";     
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
                                        $sql="UPDATE `old_question` SET `question`='$file',`path`='$updated_filepath',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester',`year`='$updated_year' WHERE id='$id' ";
                                        if($conn->query($sql)==TRUE){
                                            echo "Old Question Updated Successfully!!!";
                                        }
                                        else{
                                            echo "There was problem on Updating the Old Question!!!";
                                        }
                                    }
                                
                                }
                            else{
                                    
                                $sql="UPDATE `old_question` SET `question`='$file',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester',`year`='$updated_year' WHERE id='$id' ";
                                    if($conn->query($sql)==TRUE){
                                        echo "Old Question Updated Successfully!!!";
                                    }
                                    else{
                                        echo "There was problem on Updating the Old Question!!!";
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
            $prev_year=$data[12];
            $prev_filename=$data[13];
            if(!($row->faculty_name==$prev_faculty && $row->program_name==$prev_program && $updated_semester==$prev_sem && $updated_year==$prev_year))
            {
                $curr_path ="C:/xampp/htdocs/PUNotes/View/static/Faculty/$row->faculty_name/$row->program_name/OldQuestions/Semester/$updated_semester/$updated_year/$prev_filename"; 
                $result=rename($previous_filepath,$curr_path);
                if($result==1){
                    $sql="UPDATE `old_question` SET `path`='$curr_path',`faculty`='$updated_faculty',`program`='$updated_program',`semester`='$updated_semester',`year`='$updated_year' WHERE id='$id' ";
                    if($conn->query($sql)==TRUE){
                        echo "Old Question Updated Successfully!!!";
                    }
                    else{
                        echo "There was problem on Updating the Old Question!!!";
                    }
                }
            }
         }

    }
}


else{

    //Fetch All Note Code Here
    $sql="SELECT * FROM `old_question`";
    $result=$conn->query($sql);
    $all_oldques=mysqli_fetch_all($result);
 
}

?>