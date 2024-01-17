<?php 

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

 $signup_data = json_decode(file_get_contents("php://input"), true);

 if($signup_data) {
    echo json_encode(["message" => "data recived succesfully" , "prof" => $signup_data["name"]]);
 }
?>