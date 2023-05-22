<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){

    // $jobList = getList();
    // echo $jobList;
    if(isset($_GET['key'])){
        $jobList = getJop($_GET);
        echo $jobList;
        
    }
    else{

        $jobList = getList();
        echo $jobList;
    }
}
else
{

    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header("Http/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

// $conn = mysqli_connect('localhost', 'root', '', 'job-board');
// // $database = mysqli_select_db($conn, 'job-board');
// if(!$conn){
//   die("Connection Failed: ".mysqli_connect_errno());
// }
?>