<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

$user_email = json_decode(file_get_contents("php://input"), true);


$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $user_email["email"]);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

echo json_encode($user);
