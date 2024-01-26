<?php

use Firebase\JWT\JWT;

require "./vendor/autoload.php";


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

$login_data = json_decode(file_get_contents("php://input"), true);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users WHERE email = ? ";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $login_data["email"]);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user) {
   if (password_verify($login_data["password"], $user["password_hash"]) && $user["account_activation_hash"] ==  '') {
      $key = "mykey2010";
      $payload = ["name" => $user["name"]];
      $jwt = JWT::encode($payload, $key, 'HS256');

      echo json_encode(["token" => $jwt]);
   } else {
      echo  json_encode(["user_exist" => false, "information" => "invalid password"]);
   }
} else if (!$user) {
   echo json_encode(["user_exist" => false]);
}
