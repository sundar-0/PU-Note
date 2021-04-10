<?php
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';

//GET USER COUNT
$sql="SELECT COUNT(*) as no_of_users FROM `users` WHERE is_admin='0'";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$user_count=$row->no_of_users;

//GET NOTE UPLOADED COUNT

$sql="SELECT COUNT(*) as no_of_courses FROM `course`";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$course_count=$row->no_of_courses;

//GET Total Old Questions Uploaded

$sql="SELECT COUNT(*) as no_of_oldquestions FROM `old_question`";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$oldquestion_count=$row->no_of_oldquestions;


// GET Total Faculty

$sql="SELECT COUNT(*) as no_of_faculties FROM `faculty`";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$faculty_count=$row->no_of_faculties;


//GET TOTAL PROGRAM

$sql="SELECT COUNT(*) as no_of_programs FROM `program`";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$program_count=$row->no_of_programs;

//GET TOTAL NOTICE COUNT
$sql="SELECT COUNT(*) as `count` FROM notice ORDER BY id ASC LIMIT 5";
$result=$conn->query($sql);
$row=mysqli_fetch_object($result);
$notice_count=$row->count;


?>