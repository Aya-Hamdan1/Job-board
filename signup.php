<?php
$CN = mysqli_connect("localhost", "root", "");
$DB = mysqli_select_db($CN, "job-board");



$name=$_POST['name'];
$password = md5($_POST['password']);
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
$Message="registered successfully";
}
else
{
$Message="registered not successfully";
}
}
$Response[]=array("Message"=>$Message);
echo json_encode($Response);
?>