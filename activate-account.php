<?php 
 $token = $_GET["token"];

 $token_hash = hash("SHA256" , $token);
 
 $mysqli = require __DIR__ . "/database.php";

 $sql = "SELECT * FROM users WHERE account_activation_hash = ? " ;

 $stmt = $mysqli->prepare($sql);

 $stmt->bind_param('s' , $token_hash) ;

 $stmt->execute();


 $result = $stmt->get_result() ;

 $user = $result->fetch_assoc();

  if(!$user) {
    die("no unactivated account to activate");
 } ;



 
 $sql = "UPDATE users SET account_activation_hash = NULL WHERE id = ? " ;

 $stmt = $mysqli->prepare($sql); 

  $stmt->bind_param('s' , $user["id"]) ;

   $stmt->execute() ;

 
 

 

?>