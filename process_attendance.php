<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['type'])) {
    $user_id = $_POST['user_id'];
    $type = $_POST['type'];

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "hrms");

    // Check for database connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the employee has manually clocked out
    if ($type == 'clock_out') {
        // Get the current date
        $currentDate = date('Y-m-d');
        
        // Check if the employee has manually clocked out for the current date
        $query = "SELECT clock_out FROM attendance WHERE employee_id = '$user_id' AND DATE(clock_in) = '$currentDate'";
        $result = mysqli_query($conn, $query);
        
        // If the employee has manually clocked out, save the clock-out time as usual
        if ($result && mysqli_num_rows($result) > 0) {
            $insert_query = "UPDATE attendance SET clock_out = NOW() WHERE employee_id = '$user_id' AND clock_out IS NULL";
        } else {
            // If the employee hasn't manually clocked out, automatically clock them out at 12 AM
            $insert_query = "INSERT INTO attendance (employee_id, clock_in, clock_out) VALUES ('$user_id', NOW(), '$currentDate 00:00:00')";
        }
    } elseif ($type == 'clock_in') {
        // Prepare the SQL statement for clock-in
        $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES ('$user_id', NOW())";
    } else {
        echo json_encode(array("success" => false, "message" => "Invalid clock type"));
        exit();
    }

    // Execute the SQL statement
    if ($conn->query($insert_query) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Attendance record added/updated successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: " . $conn->error));
    }

    // Close database connection
    mysqli_close($conn);
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}
?>
