
<?php
// include('db.php');
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');

$job_name=$_POST['name'];
$job_id=$_POST['id'];
$employer_email =$_POST['employer_email'];
$employer_id;
$description=$_POST['description'];
$salary=$_POST['salary'];
$location=$_POST['location'];
$requirements=$_POST['requirements'];


$SQLE = "select * from `users` where email = '$employer_email' ";
$exeE = mysqli_query($conn, $SQLE);
$check =  mysqli_num_rows($exeE);
if ($check != 0) {
$res = mysqli_fetch_assoc($exeE);
$employer_id = $res['id'];
}
else{
    $employer_id = null; 
}
$SQLU = "select * from `job-list` where id = '$job_id' ";
$exe = mysqli_query($conn, $SQLU);
$check =  mysqli_num_rows($exe);

if ($check != 0) {
    $SQL1 = "update `job-list` set name='$job_name' , employer_id=$employer_id,description='$description', salary=$salary, location='$location',`requirements`='$requirements' where id='$job_id'";
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