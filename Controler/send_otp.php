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

if(!empty($data->verify_type)){    

    if($data->verify_type=='mobile')
    {
        $items->name = $data->mobile_no;
    }
    if($data->verify_type=='email')
    {
        $items->name = $data->email_id;
    }
    $items->otp = rand(100000,999999); 
    $items->source_type = $data->verify_type;
    $items->created = date('Y-m-d H:i:s'); 
    if($items->send_otp()){         
        http_response_code(201);         
        echo json_encode(array("message" => "OTP send to your '".$data->verify_type."'."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to Send OTP."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to Send OTP. Information is duplicate or incomplete."));
}
?>