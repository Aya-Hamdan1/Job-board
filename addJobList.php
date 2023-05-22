<?php
$CN = mysqli_connect("localhost", "root", "");
$DB = mysqli_select_db($CN, "job-board");

$EncodedData=file_get_contents('php://input');
$DecodedData=json_decode($EncodedData, true);

$name=$_POST['name'];
$employer_id=$_POST['employer_id'];
$description=$_POST['description'];
$salary=$_POST['salary'];
$location=$_POST['location'];
$requirements=$_POST['requirements'];


$SQL2 = "insert into `job-list` ( name, employer_id, description, salary, location, requirements) values ( '$name', $employer_id, '$description', $salary, '$location', '$requirements' )";
$R = mysqli_query($CN, $SQL2);
if($R)
{
$Message="registered successfully";
}
else
{
$Message="registered not successfully";
}
/*}*/
$Response=$Message;
echo json_encode($Response);

?>
