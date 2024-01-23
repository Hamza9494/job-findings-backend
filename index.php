<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

require "./vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


 $credentials =  $login_data = json_decode(file_get_contents("php://input"), true);
 $token = $credentials["token"];
 $key = "mykey2010";

$mysqli = require __DIR__ . "/database.php";


 if($token) {
    $decoded_jwt = JWT::decode($token , new Key($key , "HS256"));
 
 echo json_encode([$decoded_jwt]);

 }


?>