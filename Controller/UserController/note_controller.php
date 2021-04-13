<?php
session_start();
$user=$_SESSION['user'];
$sql="SELECT * FROM (SELECT * FROM `users` JOIN `enroll` on users.id=enroll.user) AS `userEnroll` JOIN course ON userEnroll.faculty=course.faculty AND userEnroll.program=course.program WHERE user='$user'";





?>