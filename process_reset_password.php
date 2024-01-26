<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

$reset_password_data = json_decode(file_get_contents("php://input"), true);

$reset_token = $reset_password_data["id"];

$reset_token_hash = hash("sha256", $reset_token);
