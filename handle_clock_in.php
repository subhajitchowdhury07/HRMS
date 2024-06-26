<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['action_type'])) {
    $user_id = $_POST['user_id'];
    $action_type = $_POST['action_type'];

    // Include your database connection code here
    include("db_conn.php");

    // Fetch existing clock-in time and total worked hours from the database if available
    $query = "SELECT clock_in, total_worked_hr FROM attendance WHERE employee_id = :user_id AND clock_out IS NULL";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // Initialize clock-in, clock-out times, and total worked hours
    $clockInTime = null;
    $clockOutTime = null;
    $totalWorkedHours = null;

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $clockInTime = $result['clock_in'];
        $totalWorkedHours = $result['total_worked_hr'];
    }

    // If clock-in time is not set and the user clicked Clock In
    if ($action_type == 'clock_in' && !$clockInTime) {
        $clockInTime = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES (:user_id, :clockInTime)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':clockInTime', $clockInTime);
        $stmt->execute();

        // Return the clock in time and total worked hours as a response
        echo json_encode(['clock_time' => $clockInTime, 'total_worked_hours' => $totalWorkedHours]);
        exit();
    }

    // If clock-out time is set and the user clicked Clock Out
    if ($action_type == 'clock_out' && $clockInTime) {
        $clockOutTime = date('Y-m-d H:i:s');

        // Calculate total worked hours
        $totalWorkedHours = calculateTotalWorkedHours($clockInTime, $clockOutTime);

        // Update the database with clock-out time and total worked hours
        $update_query = "UPDATE attendance SET clock_out = :clockOutTime, total_worked_hr = :totalWorkedHours WHERE employee_id = :user_id AND clock_out IS NULL";
        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':clockOutTime', $clockOutTime);
        $stmt->bindParam(':totalWorkedHours', $totalWorkedHours);
        $stmt->execute();

        // Return the clock out time and total worked hours as a response
        echo json_encode(['clock_time' => $clockOutTime, 'total_worked_hours' => $totalWorkedHours]);
        exit();
    }

    // Close database connection
    $conn = null;
}

// Function to calculate total worked hours
function calculateTotalWorkedHours($startTime, $endTime) {
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);

    $seconds = $endTimestamp - $startTimestamp;
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}
?>
