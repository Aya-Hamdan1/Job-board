<?php

require 'db.php';
function getList($input0){ //get application GET parameters
 
    global $conn;
    
    if(!isset($input0['id'])){
        return error422(('Job id not found '));
    }
    $job_id = mysqli_real_escape_string($conn, $input0['id']);
    if(empty(trim($job_id))){
        return error422('Enter Job Id!');
       }
       
    /**************** */
    $SQLC = "select * from `job-applications` where job_id = $job_id";
    $app = mysqli_query($conn, $SQLC);
    if($app){
        if(mysqli_num_rows($app) > 0){
            $res = mysqli_fetch_all($app, MYSQLI_ASSOC);

            $data = [
                'status' =>200,
                'message' => 'Application List fetch successfully',
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


function updateApp($input, $params){ //update App PUT
    global $conn;
   
    // if(!isset($params['email'])){
    //     return error422(('email not found '));
    // }
    // elseif(empty(trim($params['email']))){
    //     return error422(('Enter your email '));
    // }
    if(!isset($params['id'])){
        return error422(('Application id not found '));
    }
    elseif(empty(trim($params['id']))){
        return error422(('Enter Application id'));
    }
    
    $App_id=mysqli_real_escape_string($conn, $params['id']);

    $cover_letter =mysqli_real_escape_string($conn, $input['cover_letter']);
    $status = mysqli_real_escape_string($conn, $input['status']);
    $resume=mysqli_real_escape_string($conn, $input['resume']);
   
   
   if(empty(trim($cover_letter))){
    return error422('Enter yor cover_letter!');
   }
   elseif(empty(trim($status))){
    return error422('Enter yor status!');
   }
   elseif(empty(trim($resume))){
    return error422('Enter yor resume!');
   }
   else{
    $SQLU = "select * from `job-applications` where id = '$App_id' ";
    $exe = mysqli_query($conn, $SQLU);
    $check =  mysqli_num_rows($exe);
    if($check > 0){
    
    
    $sql1 = "update `job-applications` set cover_letter='$cover_letter' , status='$status',resume='$resume' where id=$App_id";
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

function getMyApp($input0){ //get employer App
    global $conn;
    
    if(!isset($input0['email'])){
        return error422(('email not found '));
    }
    $email = mysqli_real_escape_string($conn, $input0['email']);
    if(empty(trim($email))){
        return error422('Enter your Email!');
       }

       $SQLC = "select * from users where email = '$email'";
       $exe = mysqli_query($conn, $SQLC);
       $res = mysqli_fetch_assoc($exe);
       $id = $res['id'];
       
    /**************** */
    $SQLC = "select * from `job-applications` where job_seeker_id = $id";
    $app = mysqli_query($conn, $SQLC);
    if($app){
        if(mysqli_num_rows($app) > 0){
            $res = mysqli_fetch_all($app, MYSQLI_ASSOC);

            $data = [
                'status' =>200,
                'message' => 'Application List fetch successfully',
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
?>