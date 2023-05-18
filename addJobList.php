<?php
$CN = mysqli_connect("localhost", "root", "");
$DB = mysqli_select_db($CN, "job-board");

$EncodedData=file_get_contents('php://input');
$DecodedData=json_decode($EncodedData, true);

$name=$DecodedData['name'];
$employer_id=$DecodedData['employer_id'];
$description=$DecodedData['description'];
$salary=$DecodedData['salary'];
$location=$DecodedData['location'];
$requirements=$DecodedData['requirements'];


$SQL2 = "insert into `job-list` ( name, employer_id, description, salary, location, requirements) values ( '$name', $employer_id, '$description', $salary, '$location', '$requirements' )";
$R = mysqli_query($CN, $SQL2);
if($R)
{
$Message="registered succefully";
}
else
{
$Message="registered not succefully";
}
/*}*/
$Response=$Message;
echo json_encode($Response);

?>
