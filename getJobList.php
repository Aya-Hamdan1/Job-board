<?php
$con = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($con, 'job-board');

$encodedData = file_get_contents('php://input');  
$decodedData = json_decode($encodedData, true);

$SQLC = "select * from `job-list` ";
$tableC = mysqli_query($con, $SQLC);
$checkName =  mysqli_num_rows($tableC);
if($checkName >0)
{
while($checkName > 0){
$row5=mysqli_fetch_assoc($tableC);
$jobId=$row5['id'];
$name=$row5['name'];
$employer_id=$row5['employer_id'];
$description=$row5['description'];
$salary=$row5['salary'];
$location=$row5['location'];
$requirements=$row5['requirements'];

	$response[]=array($jobId,$name,$employer_id,$description,$salary,$location,$requirements);
	$checkName=$checkName-1;
}
}
else{
	$response = false;
}

echo json_encode($response);
?>
