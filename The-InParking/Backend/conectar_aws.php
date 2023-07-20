<?php
$servername = "theinparking.c6cshpwbtmrs.us-east-2.rds.amazonaws.com";
$username = "admin_tip";
$password = "Admin1234$";
$database = "theinparking";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>