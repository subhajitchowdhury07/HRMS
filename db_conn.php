<?php 

$serverName = "localhost";
$userName = "u431054670_root";
$password = "Sedulous@123";
$dbname = "u431054670_hrms";

// $conn = new mysqli("localhost", "root", "", "hrms");
try {
  $conn = new PDO("mysql:host=$serverName;dbname=$dbname", $userName, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
try {
  $dbh = new PDO("mysql:host=$serverName;dbname=$dbname", $userName, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully"; 
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>