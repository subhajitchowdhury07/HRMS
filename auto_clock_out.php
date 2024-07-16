<?php
// Include the database connection file
include('db_conn.php');

// Get the current time with AM/PM format
date_default_timezone_set('Asia/Kolkata');
$current_time = date('h:i A');

// Define the duration after which automatic clock-out happens (10 hours)
$automatic_clock_out_duration = 10 * 3600; // 10 hours in seconds

// Fetch users who are currently clocked in but haven't clocked out
$query = "SELECT employee_id, clock_in FROM attendance WHERE clock_out IS NULL";
$stmt = $conn->query($query);

// Loop through the results
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $employee_id = $row['employee_id'];
    $clock_in_time = $row['clock_in'];

    // Calculate the expected automatic clock-out time
    $clock_in_timestamp = strtotime($clock_in_time);
    $automatic_clock_out_time = $clock_in_timestamp + $automatic_clock_out_duration;
    $automatic_clock_out_time_formatted = date('Y-m-d H:i:s', $automatic_clock_out_time);

    // Check if the current time has passed the automatic clock-out time
    if (time() > $automatic_clock_out_time) {
        // Calculate total worked hours
        $total_worked_hours = calculateTotalWorkedHours($clock_in_time, $automatic_clock_out_time_formatted);

        // Update the database with clock-out time and total worked hours
        $update_query = "UPDATE attendance SET clock_out = :clock_out_time, total_worked_hr = :total_worked_hours WHERE employee_id = :employee_id AND clock_out IS NULL";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindParam(':clock_out_time', $automatic_clock_out_time_formatted);
        $update_stmt->bindParam(':total_worked_hours', $total_worked_hours);
        $update_stmt->bindParam(':employee_id', $employee_id);
        $update_stmt->execute();
    }
}

// Function to calculate total worked hours
function calculateTotalWorkedHours($start_time, $end_time) {
    $start_timestamp = strtotime($start_time);
    $end_timestamp = strtotime($end_time);

    $seconds = $end_timestamp - $start_timestamp;
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}
?>
