<?php
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');

$keyword = $_POST['key'];
$info = $_POST['info'];

if($keyword == 'salary'){
    $SQL = "select * from `job-list` where salary = $info ";
    $exe = mysqli_query($conn, $SQL);
    $check =  mysqli_num_rows($exe);
    if($check >0)
    {
    while($check > 0){
    $row=mysqli_fetch_assoc($exe);
    $description = $row['description'];
    $location = $row['location'];
    $requirements = $row['requirements'];
    $response[]=array($description,$location,$requirements);
    $check=$check-1;
 }
    }
    else{
        $response = 'their is no job with this salary!';
    }
}
else if($keyword == 'location'){
    $SQL = "select * from `job-list` where location = '$info' ";
    $exe = mysqli_query($conn, $SQL);
    $check =  mysqli_num_rows($exe);
    if($check >0)
    {
    while($check > 0){
    $row=mysqli_fetch_assoc($exe);
    $description = $row['description'];
    $salary = $row['salary'];
    $requirements = $row['requirements'];
    $response[]=array($description,$salary,$requirements);
    $check=$check-1;
 };
    }
    else{
        $response = 'their is no job with this Location!';
    }

}
else if($keyword == 'name'){
    $SQL = "select * from `job-list` where name = '$info' ";
    $exe = mysqli_query($conn, $SQL);
    $check =  mysqli_num_rows($exe);
    if($check >0)
    {
    while($check > 0){
    $row=mysqli_fetch_assoc($exe);
    $description = $row['description'];
    $salary = $row['salary'];
    $requirements = $row['requirements'];
    $response[]=array($description,$salary,$requirements);
    $check=$check-1;
 };
    }
    else{
        $response = 'their is no job with this title!';
    }

}
echo json_encode($response);
?>
