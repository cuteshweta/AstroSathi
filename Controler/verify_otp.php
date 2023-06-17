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

if(!empty($data->source)){    

   $items->name = $data->source;
   $items->otp = $data->otp;
    if($items->verify_otp()){         
        http_response_code(201);         
        echo json_encode(array("message" => "OTP Verify Successfully"));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to Verify OTP."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to Verify OTP. Information is duplicate or incomplete."));
}
?>