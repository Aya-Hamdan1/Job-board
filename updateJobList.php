
<?php
// include('db.php');
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');

$encodedData = file_get_contents('php://input');  // take data from react native fetch API
$decodedData = json_decode($encodedData, true);
$job_name=$decodedData['name'];
$employer_name =$decodedData['employer_name'];
$employer_id =$decodedData['employer_id'];
$description=$decodedData['description'];
$salary=$decodedData['salary'];
$location=$decodedData['location'];
$requirements=$decodedData['requirements'];


$SQLE = "select * from `users` where name = '$employer_name' ";
$exeE = mysqli_query($conn, $SQLE);
$res = mysqli_fetch_assoc($exeE);
$employer_id = $res['id'];
$SQLU = "select * from `job-list` where name = '$job_name' ";
$exe = mysqli_query($conn, $SQLU);
$check =  mysqli_num_rows($exe);

if ($check != 0) {
    $SQL1 = "update `job-list` set name='$job_name' , employer_id=$employer_id,description='$description', salary=$salary, location='$location',`requirements`='$requirements' where name='$job_name'";
    $R = mysqli_query($conn, $SQL1);
    if ($R) {
        $Message = "Profile Update Successfully!";
    } else {
        $Message = "Error";
    }
} 
else {
    $Message = "not exist";

}
	$response[] = array("Message" => $Message);

echo json_encode($response);
?>