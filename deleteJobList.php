
<?php
// include('db.php');
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');

// $job_name=$_POST['name'];
$job_id=$_POST['id'];


$SQLU = "select * from `job-list` where id = '$job_id' ";
$exe = mysqli_query($conn, $SQLU);
$check =  mysqli_num_rows($exe);

if ($check != 0) {
    $SQL1 = "delete from `job-list` where id = '$job_id'";
    $R = mysqli_query($conn, $SQL1);
    if ($R) {
        $Message = "Delete Successfully!";
    } else {
        $Message = "There are people applying for this job";
    }
} 
else {
    $Message = "not exist";

}
	$response[] = array("Message" => $Message);

echo json_encode($response);
?>