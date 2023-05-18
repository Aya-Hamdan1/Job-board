<?php
$con = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($con, "job-board");

$encodedData = file_get_contents('php://input');  
$decodedData = json_decode($encodedData, true);

$name =$decodedData['name'];
$job_id=$decodedData['job_id'];
$job_seeker_id=$decodedData['job_seeker_id'];
$cover_letter=$decodedData['cover_letter'];
$status=$decodedData['status'];
$resume=$decodedData['resume'];
$sql0 = "select id from `job-list` where name = '$name' ";
$exe0 = mysqli_query($con, $sql0);
$result = mysqli_fetch_assoc($exe0);
$job_id = $result['id'];
$sql = "select * from `job-applications` where job_id = $job_id and job_seeker_id = $job_seeker_id";
$exe = mysqli_query($con, $sql);
$check0 = mysqli_num_rows($exe);

if($check0 > 0){
	$Response = false;
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
