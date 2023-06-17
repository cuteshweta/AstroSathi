<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../Library/config/Database.php';
include_once '../Model/Process.php';
 
$database = new Database();
$db = $database->getConnection();
$items = new Process($db);
 
$data = json_decode(file_get_contents("php://input"),true);
// $fileName  =  $_FILES['sendimage']['name'];
// $tempPath  =  $_FILES['sendimage']['tmp_name'];
// $fileSize  =  $_FILES['sendimage']['size'];
if(!empty($data->user_id)){ 
    $items->id=  $data->user_id; 
    $items->fname = $data->first_name; 
    $items->lname = $data->last_name;
    $items->mname = $data->middle_name;
    $items->gender = $data->gender; 
    $items->mother_name = $data->mother_name; 
    $items->father_name = $data->father_name; 
    $items->lang = $data->lang; 
    $items->city = $data->city;
    $items->state = $data->state;
    $items->pincode = $data->pincode; 
    $items->nationality = $data->nationality; 
    $items->birth_date = $data->birth_date;
    $items->birthe_time = $data->birthe_time; 
    $items->birth_place = $data->birth_place; 
    $items->religion = $data->religion; 
    // $upload_path = 'upload/'; // set upload folder path 
    // $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
    // // valid image extensions
    // $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
    // // allow valid image file formats
    // if(in_array($fileExt, $valid_extensions))
    // {
    //     //check file not exist our upload folder path
    //     if(!file_exists($upload_path . $fileName))
    //     {
    //         if($fileSize < 5000000){
    //             move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
    //         }
    //     }
    // }
    // $items->update = date('Y-m-d H:i:s');
    if($items->update_profile()){  

        http_response_code(201);         
        echo json_encode(array("message" => "Profile Update SuccessFully"));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to Update Profile."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to update Profile. Information is duplicate or incomplete."));
}
?>