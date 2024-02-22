<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['type'])) {
    include_once("../db_conn.php");

    $user_id = $_POST['user_id'];
    $type = $_POST['type'];

    try {
        // Establish database connection
        $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Set Indian time zone
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date('Y-m-d H:i:s');

        // Set MySQL time zone
        $dbh->exec("SET time_zone = '+05:30'");

        // Check if the employee has manually clocked out
        if ($type == 'clock_out') {
            // Get the current date
            $currentDate = date('Y-m-d');

            // Check if the employee has manually clocked out for the current date
            $query = "SELECT clock_out FROM attendance WHERE employee_id = :user_id AND DATE(clock_in) = :currentDate";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":currentDate", $currentDate);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // If the employee has manually clocked out, save the clock-out time as usual
            if ($result) {
                $insert_query = "UPDATE attendance SET clock_out = :currentDateTime WHERE employee_id = :user_id AND clock_out IS NULL";
            } else {
                // If the employee hasn't manually clocked out, automatically clock them out at 12 AM
                $insert_query = "INSERT INTO attendance (employee_id, clock_in, clock_out) VALUES (:user_id, :currentDateTime, :currentDate 00:00:00)";
            }
        } elseif ($type == 'clock_in') {
            // Prepare the SQL statement for clock-in
            $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES (:user_id, :currentDateTime)";
        } else {
            echo json_encode(array("success" => false, "message" => "Invalid clock type"));
            exit();
        }

        // Execute the SQL statement
        $stmt = $dbh->prepare($insert_query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":currentDateTime", $currentDateTime);
        if ($type == 'clock_out') {
            $stmt->bindParam(":currentDate", $currentDate);
        }
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Attendance record added/updated successfully"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error executing query"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Connection failed: " . $e->getMessage()));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}
?>
