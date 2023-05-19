<?php
$conn = mysqli_connect('localhost', 'root', '');
$database = mysqli_select_db($conn, 'job-board');

$keyword = $_POST['key'];
$info = $_POST['info'];

if($keyword == 'salary'){
    $SQL = "select * from `job-list` where salary = $info ";
    $exe = mysqli_query($conn, $SQL);
    $check =  mysqli_num_rows($exe);
}
else if($keyword == 'location'){
    $SQL = "select * from `job-list` where location = '$info' ";
    $exe = mysqli_query($conn, $SQL);
    $check =  mysqli_num_rows($exe);

}
else if($keyword == 'title'){
    $SQL = "select * from `job-list` where name = '$info' ";
    $exe = mysqli_query($conn, $SQL);
    $check =  mysqli_num_rows($exe);

}
?>
