<?php

require 'db.php';
function getList(){ //get all job GET

    global $conn;
    $sql = "select * from `job-list`";
    $exe = mysqli_query($conn, $sql);

    if($exe){
        if(mysqli_num_rows($exe) > 0){
            $res = mysqli_fetch_all($exe, MYSQLI_ASSOC);

            $data = [
                'status' =>200,
                'message' => 'Job List fetch successfully',
                'data' => $res,
            ];
            header("Http/1.0 200 success");
            return json_encode($data);

        }else{
            $data = [
                'status' => 404,
                'message' => 'No Job List',
            ];
            header("Http/1.0 404 No Job List");
            return json_encode($data);
        }


    }
    else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("Http/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("Http/1.0 422 Unprocessable Entity");
    echo json_encode($data);
}
function addApp($input){  //insert new app POST
   global $conn;
   
   $job_id = mysqli_real_escape_string($conn, $input['job_id']);
   $employer = mysqli_real_escape_string($conn, $input['employer_email']);
   $cover_letter = mysqli_real_escape_string($conn, $input['cover_letter']);
   $status = mysqli_real_escape_string($conn, $input['status']);
   $resume = mysqli_real_escape_string($conn, $input['resume']);
   
   
   if(empty(trim($job_id))){
    return error422('Enter Job Id!');
   }
   elseif(empty(trim($cover_letter))){
    return error422('Enter cover_letter!');
   }
   elseif(empty(trim($status))){
    return error422('Enter status!');
   }
   elseif(empty(trim($resume))){
    return error422('Enter yor resume!');
   }
   else{
    if(!empty(trim(($employer)))){
        $sql0 = "select id from users where email = '$employer' ";
        $exe0 = mysqli_query($conn, $sql0);
        $result = mysqli_fetch_assoc($exe0);
        $job_seeker_id = $result['id'];
        
    //    }

    /************* */
    $sql = "select * from `job-applications` where job_id = $job_id and job_seeker_id = $job_seeker_id";
    $exe = mysqli_query($conn, $sql);
    $check0 = mysqli_num_rows($exe);

    if($check0 > 0){
        $data = [
            'status' => 201,
            'message' => 'already applied',
        ];
        header("Http/1.0 201 already applied");
        echo json_encode($data);
    }
    else {
    
    /********** */
    
    $sql1 = "insert into `job-applications` (job_id, job_seeker_id, cover_letter, status, resume) values ($job_id, $job_seeker_id, '$cover_letter', '$status', '$resume')";
    $R = mysqli_query($conn, $sql1);
    if($R)
    {
        $data = [
            'status' => 201,
            'message' => 'Applied Successfully',
        ];
        header("Http/1.0 201 Applied");
        echo json_encode($data);
    }
    else
    {
        $data = [
            'status' => 405,
            'message' => 'Internal Server Error',
        ];
        header("Http/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
    }
}
    
    else{
        return error422('Enter yor Email!');
       }
   }

}

function getJop($input0){ //search by Key GET
    global $conn;
    $keyword = mysqli_real_escape_string($conn, $input0['key']);
    $info = mysqli_real_escape_string($conn,$input0['info']);

    if($keyword == 'salary'){
        $SQL = "select * from `job-list` where salary = $info ";
        $exe = mysqli_query($conn, $SQL);
        if($exe){
            if(mysqli_num_rows($exe) > 0){
                $res = mysqli_fetch_all($exe, MYSQLI_ASSOC);
    
                $data = [
                    'status' =>200,
                    'message' => 'Job List fetch successfully',
                    'data' => $res,
                ];
                header("Http/1.0 200 success");
                return json_encode($data);


            }
        else{
            $data = [
                'status' => 404,
                'message' => 'No Job with this salary',
            ];
            header("Http/1.0 404 No Job with this salary");
            return json_encode($data);
           
        }
        }
    }
    else if($keyword == 'location'){
        $SQL = "select * from `job-list` where location = '$info' ";
        $exe = mysqli_query($conn, $SQL);
        if($exe){
            if(mysqli_num_rows($exe) > 0){
                $res = mysqli_fetch_all($exe, MYSQLI_ASSOC);
    
                $data = [
                    'status' =>200,
                    'message' => 'Job List fetch successfully',
                    'data' => $res,
                ];
                header("Http/1.0 200 success");
                return json_encode($data);


            }
        else{
            $data = [
                'status' => 404,
                'message' => 'No Job with this Location',
            ];
            header("Http/1.0 404 No Job with this Location");
            return json_encode($data);
           
        }
        }
     
    
    }
    else if($keyword == 'name'){
        $SQL = "select * from `job-list` where name = '$info' ";
        $exe = mysqli_query($conn, $SQL);
        if($exe){
            if(mysqli_num_rows($exe) > 0){
                $res = mysqli_fetch_all($exe, MYSQLI_ASSOC);
    
                $data = [
                    'status' =>200,
                    'message' => 'Job List fetch successfully',
                    'data' => $res,
                ];
                header("Http/1.0 200 success");
                return json_encode($data);


            }
        else{
            $data = [
                'status' => 404,
                'message' => 'No Job with this name',
            ];
            header("Http/1.0 404 No Job with this name");
            return json_encode($data);
           
        }
        }
    
    }
}

function updateJob($input, $params){ //update job PUT
    global $conn;
   
    if(!isset($params['id'])){
        return error422(('Job id not found '));
    }
    elseif(empty(trim($params['id']))){
        return error422(('Enter job id'));
    }
    $job_id=mysqli_real_escape_string($conn, $params['id']);

    $name =mysqli_real_escape_string($conn, $input['name']);
    $employer_email = mysqli_real_escape_string($conn, $input['employer_email']);
    $description=mysqli_real_escape_string($conn, $input['description']);
    $salary=mysqli_real_escape_string($conn, $input['salary']);
    $location=mysqli_real_escape_string($conn, $input['location']);
    $requirements=mysqli_real_escape_string($conn, $input['requirements']);
   
   
   if(empty(trim($name))){
    return error422('Enter Job Title!');
   }
   elseif(empty(trim($description))){
    return error422('Enter Job description!');
   }
   elseif(empty(trim($salary))){
    return error422('Enter Job salary!');
   }
   elseif(empty(trim($location))){
    return error422('Enter Job Location!');
   }
   elseif(empty(trim($requirements))){
    return error422('Enter Job requirements!');
   }
   else{
    $SQLU = "select * from `job-list` where id = '$job_id' ";
    $exe = mysqli_query($conn, $SQLU);
    $check =  mysqli_num_rows($exe);
    if($check > 0){
    if(!empty(trim(($employer_email)))){
        $sql0 = "select id from users where email = '$employer_email' ";
        $exe0 = mysqli_query($conn, $sql0);
        $result = mysqli_fetch_assoc($exe0);
        $employer_id = $result['id'];
        
    //    }
    
    $sql1 = "update `job-list` set name='$name' , employer_id=$employer_id,description='$description', salary=$salary, location='$location',`requirements`='$requirements' where id='$job_id'";
    $R = mysqli_query($conn, $sql1);
    if($R)
    {
        $data = [
            'status' => 201,
            'message' => 'Updated Successfully',
        ];
        header("Http/1.0 201 Created");
        echo json_encode($data);
    }
    else
    {
        $data = [
            'status' => 405,
            'message' => 'Internal Server Error',
        ];
        header("Http/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
    }
    else{
        $sql1 = "update `job-list` set name='$name' , employer_id=null,description='$description', salary=$salary, location='$location',`requirements`='$requirements' where id='$job_id'";
    $R = mysqli_query($conn, $sql1);
    if($R)
    {
        $data = [
            'status' => 201,
            'message' => 'Updated Successfully',
        ];
        header("Http/1.0 200 Success");
        echo json_encode($data);
    }
    else
    {
        $data = [
            'status' => 405,
            'message' => 'Internal Server Error',
        ];
        header("Http/1.0 500 Internal Server Error");
        echo json_encode($data);
    }
       }
    }
   }

}

function delete($params){ //delete application
    global $conn;

    if(!isset($params['id'])){
        return error422(('Job id not found '));
    }
    elseif(!isset($params['email'])){
        return error422(('employer_email not found '));
    }
    elseif(empty(trim($params['id']))){
        return error422(('Enter job id'));
    }
    elseif(empty(trim($params['email']))){
        return error422(('Enter Employer email'));
    }


    $job_id=mysqli_real_escape_string($conn, $params['id']);
    $employer_email=mysqli_real_escape_string($conn, $params['email']);

    $SQLE = "select * from users where email = '$employer_email' ";
    $exeE = mysqli_query($conn, $SQLE);
    $resE = mysqli_fetch_assoc($exeE);
    $employee_id = $resE['id'];

    $SQL = "select * from `job-applications` where job_id = $job_id and job_seeker_id = $employee_id ";
    $exe = mysqli_query($conn, $SQL);
    $resE = mysqli_num_rows($exe);
    if($resE > 0){
    $SQL1 = "delete from `job-applications` where job_id = $job_id and job_seeker_id = $employee_id";
    $R = mysqli_query($conn, $SQL1);
    if ($R) {
        $data = [
            'status' => 200,
             'message' => 'deleted Successfully',
         ];
        header("Http/1.0 200 deleted");
         echo json_encode($data);
    } else {
        $data = [
            'status' => 200,
            'message' => 'Can not deleted',
        ];
        header("Http/1.0 200 Can not deleted ");
        return json_encode($data);
    }
}

// } 
else {
    $data = [
        'status' => 404,
        'message' => 'This Application Not Found',
    ];
    header("Http/1.0 404 This Application Not Found");
    echo json_encode($data);

}
    /****************** */
   

}
?>