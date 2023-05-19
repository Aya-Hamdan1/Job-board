
<?php
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');

$job_name=$_POST['name'];
$employee_name=$_POST['employer_name'];

$SQLU = "select * from `job-list` where name = '$job_name' ";
$exe = mysqli_query($conn, $SQLU);
$res = mysqli_fetch_assoc($exe);
$job_id = $res['id'];

// if ($check != 0) {
$SQLE = "select * from users where name = '$employee_name' ";
$exeE = mysqli_query($conn, $SQLE);
$resE = mysqli_fetch_assoc($exeE);
$employee_id = $resE['id'];


    $SQL1 = "delete from `job-applications` where job_id = $job_id and job_seeker_id = $employee_id";
    $R = mysqli_query($conn, $SQL1);
    if ($R) {
        $Message = "Delete Successfully!";
    } else {
        $Message = "Can't delete ";
    }
// } 
// else {
//     $Message = "not exist";

// }
	$response[] = array("Message" => $Message);

echo json_encode($response);
?>