<?php
error_reporting(0);
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
    

    // Fetch existing clock-in time and total worked hours from the database if available
    $query = "SELECT clock_in, total_worked_hr FROM attendance WHERE employee_id = '$user_id' AND clock_out IS NULL";
    $result = mysqli_query($conn, $query);

    // Initialize clock-in, clock-out times, and total worked hours
    $clockInTime = null;
    $clockOutTime = null;
    $totalWorkedHours = null;

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $clockInTime = $row['clock_in'];
        $totalWorkedHours = $row['total_worked_hr'];
    }

    // If clock-in time is not set and the user clicked Clock In
    if ($type == 'clock_in' && !$clockInTime) {
        $clockInTime = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES ('$user_id', '$clockInTime')";
        $conn->query($insert_query);
    }

    // If clock-out time is set and the user clicked Clock Out
    if ($type == 'clock_out' && $clockInTime) {
        $clockOutTime = date('Y-m-d H:i:s');

        // Calculate total worked hours
        $totalWorkedHours = calculateTotalWorkedHours($clockInTime, $clockOutTime);

        // Update the database with clock-out time and total worked hours
        $update_query = "UPDATE attendance SET clock_out = '$clockOutTime', total_worked_hr = '$totalWorkedHours' WHERE employee_id = '$user_id' AND clock_out IS NULL";
        $conn->query($update_query);
    }

    // Close database connection
    mysqli_close($conn);
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
    <?php 
    // include("sidebar.php");
    // Check if the user is logged in
    if (!isset($_SESSION['emp_id'])) {
        // Redirect to the login page if not logged in
        header('Location: login.php');
        exit();
    }

    // Establish a database connection
    $conn = mysqli_connect("localhost", "root", "", "hrms");

    // Check for a database connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the user details based on the stored user_id in the session
    $user_id = $_SESSION['emp_id'];

    // Fetch the first name from the database
    $query = "SELECT first_name FROM employees WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $first_name = $user['first_name'];
    } else {
        $first_name = "Employee";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <h2>Attendance System</h2>
    <p>Welcome, <?php echo $first_name; ?>!</p>
    <?php
    // Check if the user is already clocked in
    if ($clockInTime) {
        echo "<p>Now you are already clocked in.</p>";
    }
    else if($clockOutTime) {
        echo "<p>Now you are successfully clocked out</p>";
    }
    ?>
    

    <form id="clockForm" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <button type="submit" name="type" value="clock_in" class="clock-in-btn">Clock In</button>
        <button type="submit" name="type" value="clock_out" class="clock-out-btn">Clock Out</button>
    </form>

    <div id="workedHours">Worked Hours: <span id="hoursWorked"><?php echo $totalWorkedHours ?? '--:--:--'; ?></span></div>

    <!-- Your Custom JS -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Handle form submission
            document.getElementById('clockForm').addEventListener('submit', function (event) {
                event.preventDefault();

                var type = event.submitter.value;

                if (type === 'clock_in') {
                    // Clock In
                    sendClockDataToServer('clock_in');
                    event.submitter.disabled = true; // Disable the clock-in button
                } else if (type === 'clock_out') {
                    // Clock Out
                    sendClockDataToServer('clock_out');
                }
            });

            // Function to send clock-in/clock-out data to the server
            function sendClockDataToServer(type) {
                // Replace '/your/server/endpoint' with the actual URL endpoint on your server
                fetch('storeTime.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        user_id: <?php echo $user_id; ?>,
                        type: type,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the server response if needed
                    console.log('Data sent to server:', data);

                    // Update worked hours on the page if it's available in the response
                    if (data.worked_hours) {
                        document.getElementById('hoursWorked').textContent = data.worked_hours;
                    }
                })
                .catch(error => {
                    console.error('Error sending data to server:', error);
                });
            }
        });
    </script> -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Handle form submission
            document.getElementById('clockForm').addEventListener('submit', function (event) {
                event.preventDefault();

                var type = event.submitter.value;

                if (type === 'clock_in') {
                    // Clock In
                    sendClockDataToServer('clock_in');
                    event.submitter.disabled = true; // Disable the clock-in button
                } else if (type === 'clock_out') {
                    // Clock Out
                    sendClockDataToServer('clock_out');
                }
            });

            // Function to send clock-in/clock-out data to the server
            function sendClockDataToServer(type) {
                // Replace '/your/server/endpoint' with the actual URL endpoint on your server
                fetch('process_attendance.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        user_id: <?php echo $user_id; ?>,
                        type: type,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the server response if needed
                    console.log('Data sent to server:', data);

                    // Update worked hours on the page if it's available in the response
                    if (data.worked_hours) {
                        document.getElementById('hoursWorked').textContent = data.worked_hours;
                    }

                    // Show server response message if available
                    if (data.message) {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error sending data to server:', error);
                });
            }
        });
    </script> -->
</body>

</html>
