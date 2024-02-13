<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "hrms");

// Check for database connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the elapsed time from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$elapsedTime = $data['elapsed_seconds'];

// Store the elapsed time in the database
$sql = "INSERT INTO elapsed_times (elapsed_time) VALUES ($elapsedTime)";
if ($conn->query($sql) === TRUE) {
    $response = array("status" => "success", "message" => "Time stored successfully in the database.");
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Error storing time in the database: " . $conn->error);
    echo json_encode($response);
}

// Close database connection
$conn->close();
?>
