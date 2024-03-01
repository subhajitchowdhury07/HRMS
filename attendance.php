<?php
// Include the database connection file
include('db_conn.php');

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['emp_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Initialize variables
$clockInTime = null;
$clockOutTime = null;
$totalWorkedHours = null;
$successMessage = '';

// Fetch user ID from session
$user_id = $_SESSION['emp_id'];

// Fetch existing clock-in time and total worked hours from the database if available
$query = "SELECT clock_in, total_worked_hr FROM attendance WHERE employee_id = :user_id AND clock_out IS NULL";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

// Check if there is a row returned
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $clockInTime = $row['clock_in'];
    $totalWorkedHours = $row['total_worked_hr'];
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    $type = $_POST['type'];

    // If clock-in time is not set and the user clicked Clock In
    if ($type == 'clock_in' && !$clockInTime) {
        $clockInTime = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES (:user_id, :clockInTime)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':clockInTime', $clockInTime);
        $stmt->execute();
    }

    // If clock-out time is set and the user clicked Clock Out
    if ($type == 'clock_out' && $clockInTime) {
        $clockOutTime = date('Y-m-d H:i:s');

        // Calculate total worked hours
        $totalWorkedHours = calculateTotalWorkedHours($clockInTime, $clockOutTime);

        // Update the database with clock-out time and total worked hours
        $update_query = "UPDATE attendance SET clock_out = :clockOutTime, total_worked_hr = :totalWorkedHours WHERE employee_id = :user_id AND clock_out IS NULL";
        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(':clockOutTime', $clockOutTime);
        $stmt->bindParam(':totalWorkedHours', $totalWorkedHours);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Set success message
        $successMessage = 'You have successfully clocked out.';
    }
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

// Fetch the first name from the database based on the emp_id
$query = "SELECT first_name FROM employees WHERE emp_id = :emp_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':emp_id', $_SESSION['emp_id']);
$stmt->execute();

// Check if the query executed successfully and if a row is returned
if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $first_name = $user['first_name'];
} else {
    // Handle the case where the first name is not found
    $first_name = "Employee";
}

// Close the database connection
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>

    <!-- Your Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #007bff;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            width: 150px;
        }

        #workedHours {
            margin-top: 20px;
            font-size: 18px;
        }

        .clock-in-btn {
            background-color: #28a745;
            color: #fff;
        }

        .clock-out-btn {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <h2>Attendance System</h2>
    <p>Welcome, <?php echo $first_name; ?>!</p>

    <?php
    // Display success message if set
    if ($successMessage) {
        echo "<p>$successMessage</p>";
    } else {
        // Check if the user is already clocked in
        if ($clockInTime) {
            echo "<p>Now you are already clocked in.</p>";
        } else if ($clockOutTime) {
            echo "<p>Now you are successfully clocked out</p>";
        }
    }
    ?>

    <form id="clockForm" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <button type="submit" name="type" value="clock_in" class="clock-in-btn">Clock In</button>
        <button type="submit" name="type" value="clock_out" class="clock-out-btn">Clock Out</button>
    </form>

    <div id="workedHours">Worked Hours: <span id="hoursWorked"><?php echo $totalWorkedHours ?? '--:--:--'; ?></span></div>
</body>

</html>
