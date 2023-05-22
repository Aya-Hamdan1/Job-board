<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('application.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "PUT"){

    $input = json_decode(file_get_contents("php://input"),true);
    
    $updated = updateApp($input, $_GET);
    
}
else
{

    $data = [
        'status' => 405,
        'message' => $requestMethod. '  Method Not Allowed',
    ];
    header("Http/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>