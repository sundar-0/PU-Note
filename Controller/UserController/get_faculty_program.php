<?php
include 'C:\xampp\htdocs\PUNotes\Controller\connection.php';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  $sql="SELECT * FROM  faculty";
  $result1=$conn->query($sql);
  $faculty=mysqli_fetch_all($result1);
  $sql="SELECT * FROM program";
  $result2=$conn->query($sql);
  $program=mysqli_fetch_all($result2);
}  
?>