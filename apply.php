<?php
$con = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($con, "job-board");

$encodedData = file_get_contents('php://input');  
$decodedData = json_decode($encodedData, true);

$name =$_POST['name'];
$job_id;
$job_seeker_id=$_POST['job_seeker_id'];
$cover_letter=$_POST['cover_letter'];
$status=$_POST['status'];
$resume=$_POST['resume'];
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
		$Message = 'registered successfully';
	else
{
$Message="registered not successfully";
}
}
$Response[]=array("Message"=>$Message);
echo json_encode($Response);


?>
