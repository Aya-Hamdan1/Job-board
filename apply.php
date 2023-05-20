<?php
$con = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($con, "job-board");

$encodedData = file_get_contents('php://input');  
$decodedData = json_decode($encodedData, true);

// $name =$_POST['name'];

$job_id = $_POST['id'];
$employer_email = $_POST['employer_email'];
// $job_seeker_id=$_POST['job_seeker_id'];
$cover_letter=$_POST['cover_letter'];
$status=$_POST['status'];
$resume=$_POST['resume'];
// $sql0 = "select * from `job-list` where name = '$name' ";
// $exe0 = mysqli_query($con, $sql0);
// $result = mysqli_fetch_assoc($exe0);
// $job_id = $result['id'];

$sql0 = "select id from users where email = '$employer_email' ";
$exe0 = mysqli_query($con, $sql0);
$result = mysqli_fetch_assoc($exe0);
$job_seeker_id = $result['id'];

$sql = "select * from `job-applications` where job_id = $job_id and job_seeker_id = $job_seeker_id";
$exe = mysqli_query($con, $sql);
$check0 = mysqli_num_rows($exe);

if($check0 > 0){
	$Message="already applied";
}
else {
	
	$sql2 = "insert into `job-applications` (job_id, job_seeker_id, cover_letter, status, resume) values ($job_id, $job_seeker_id, '$cover_letter', '$status', '$resume')";
	$exe2 = mysqli_query($con, $sql2);
	if($exe2)
		$Message = 'registered succefull';
	else
{
$Message="registered not succefully";
}
}
$Response[]=array("Message"=>$Message);
echo json_encode($Response);


?>
