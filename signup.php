<?php
$CN = mysqli_connect("localhost", "root", "");
$DB = mysqli_select_db($CN, "job-board");



$name=$_POST['name'];
$password=$_POST['password'];
$email=$_POST['email'];
$SQL = "select * from users where email = '$email' ";
$exeSQL = mysqli_query($CN, $SQL);
$check = mysqli_num_rows($exeSQL);
 

if ($check != 0) {
    $Message = "Already exist";
}
 else {

$IQ="insert into users(email,name,password) VALUES ('$email','$name','$password')";

$R=mysqli_query($CN,$IQ);

if($R)
{
$Message="registered succefully";
}
else
{
$Message="registered not succefully";
}
}
$Response[]=array("Message"=>$Message);
echo json_encode($Response);
?>