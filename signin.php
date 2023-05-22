<?php
// include('db.php');
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');



$email = $_POST['email'];
$password= md5($_POST['password']); 

$SQL = "select * from users where email = '$email' and password = '$password'";
$exeSQL = mysqli_query($conn, $SQL);
$checkName =  mysqli_num_rows($exeSQL);

if ($checkName == 0) {
	$Message = 'Email or password is invalid!!!';
	}
else {
        $Message = 'Login success!';
    }


$response = $Message;
echo json_encode($response);
?>