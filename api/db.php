<?php

$conn = mysqli_connect('localhost', 'root', '', 'job-board');
// $database = mysqli_select_db($conn, 'job-board');
if(!$conn){
  die("Connection Failed: ".mysqli_connect_errno());
}
?>