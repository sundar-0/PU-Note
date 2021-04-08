<?php
session_start();
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (isset($_POST['addclick']))
{
if($_POST['addclick']=='yes')
{
$semester=$_POST['semester'];
$faculty_id=$_POST['faculty'];
$program_id=$_POST['program'];
$AddedBy=$_SESSION['user'];
$filename=$_FILES['file']['name'];

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


if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    if (($_FILES['file']['type'] != "application/pdf") )
            {
                echo 'please upload only pdf file';
            }
          else 
          {
               $target_file = basename($_FILES["file"]["name"]);
               $result = move_uploaded_file($_FILES['file']['tmp_name'],$path .$filename);
           
        }
    }
}
}
//Update Note Code Here


//Delete Note Code Here
}

else{

    //Fetch All Note Code Here
    $sql="SELECT * FROM `course`";
    $result=$conn->query($sql);
    $all_note=mysqli_fetch_all($result);
 
}

?>