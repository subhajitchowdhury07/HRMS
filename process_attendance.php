<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['type'])) {
    $user_id = $_POST['user_id'];
    $type = $_POST['type'];

    // Include the database connection file
    include('db_conn.php');

    try {
        // Check if the employee has manually clocked out
        if ($type == 'clock_out') {
            // Get the current date
            $currentDate = date('Y-m-d');

            // Check if the employee has manually clocked out for the current date
            $query = "SELECT clock_out FROM attendance WHERE employee_id = :user_id AND DATE(clock_in) = :currentDate";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->execute();

            // If the employee has manually clocked out, save the clock-out time as usual
            if ($stmt->rowCount() > 0) {
                $insert_query = "UPDATE attendance SET clock_out = NOW() WHERE employee_id = :user_id AND clock_out IS NULL";
            } else {
                // If the employee hasn't manually clocked out, automatically clock them out at 12 AM
                $insert_query = "INSERT INTO attendance (employee_id, clock_in, clock_out) VALUES (:user_id, NOW(), :currentDate)";
            }
        } elseif ($type == 'clock_in') {
            // Prepare the SQL statement for clock-in
            $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES (:user_id, NOW())";
        } else {
            echo json_encode(array("success" => false, "message" => "Invalid clock type"));
            exit();
        }

        // Execute the SQL statement
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':user_id', $user_id);
        if ($type == 'clock_out' && !isset($currentDate)) {
            $stmt->bindParam(':currentDate', $currentDate);
        }
        $stmt->execute();

        echo json_encode(array("success" => true, "message" => "Attendance record added/updated successfully"));
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Error: " . $e->getMessage()));
    }

    // Close database connection
    $conn = null;
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}
?>
