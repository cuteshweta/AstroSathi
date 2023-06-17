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
 
$data = json_decode(file_get_contents("php://input"));
if(!empty($data->first_name) && !empty($data->last_name) && !empty($data->gender) && !empty($data->mobile_no) && !empty($data->email_id)){    
    $items->fname = $data->first_name; 
    $items->lname = $data->last_name;
    $items->mname = $data->middle_name;
    $items->gender = $data->gender; 
    $items->mobile = $data->mobile_no; 
    $items->email = $data->email_id; 
    $items->created = date('Y-m-d H:i:s');
    if($items->create_user()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Succesfully Registered"));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to Registered."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to Registered. Information is duplicate or incomplete."));
}
?>