<?php
$con = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($con, 'job-board');

$job_name = $_POST['name'];


$SQLC = "select * from `job-list` where name = '$job_name'";
$exe = mysqli_query($con, $SQLC);
$row5=mysqli_fetch_assoc($exe);
$jobId=$row5['id'];
$name=$row5['name'];
$employer_id=$row5['employer_id'];
$description=$row5['description'];
$salary=$row5['salary'];
$location=$row5['location'];
$requirements=$row5['requirements'];
$SQLC = "select * from `job-applications` where job_id = $jobId";
$app = mysqli_query($con, $SQLC);
$checkName =  mysqli_num_rows($app);
if($checkName >0)
{
while($checkName > 0){
$row=mysqli_fetch_assoc($app);
$employer_id = $row['job_seeker_id'];
$cover_letter = $row['cover_letter'];
$status =  $row['status'];
$resume = $row['resume'];

$SQLC = "select * from users where id = $employer_id";
$exe = mysqli_query($con, $SQLC);
$row=mysqli_fetch_assoc($exe);
$employee_name = $row['name'];
$email = $row['email'];

	$response1[]=array($employee_name,$email,$cover_letter,$resume);
	$checkName=$checkName-1;
}
}
else{
	$response1 = false;
}
$response=array($name,$description,$salary,$location,$requirements);
echo json_encode($response);
echo json_encode($response1);
?>
