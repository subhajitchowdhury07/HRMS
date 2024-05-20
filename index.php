<?php include("sidebar.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Sedulous technology .pvt .ltd</title>

    <link rel="shortcut icon" href="assets/img/sedulous-small-icon.png">
    <link rel="stylesheet" href="assets/css/style.css">
<!-- 
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    body {
        background-color: #fff;
        /* White background */
        color: #555;
        /* Blue text color */
        font-weight: bold;
        font-family: 'Poppins', sans-serif;
        /* Poppins font */
        /* margin-top: -60px; */
    }

    h2 {
        color: #51ad26;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .custom-menu-bar {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        background-color: #fff;
        /* White color for the menu bar */
        color: #20509e;
        /* Blue text color for menu items */
    }

    .custom-menu-item {
        margin-right: 20px;
        position: relative;
    }

    .custom-menu-item a {
        color: #20509e;
        /* Blue text color for menu items */
        text-decoration: none;
        font-weight: bold;
        /* Bold text */
    }

    .custom-dropdown {
        /* align-items: center; */
        display: none;
        position: absolute;
        border-radius: 10px;
        top: 100%;
        left: 0;
        background-color: #fff;
        /* White color for dropdown */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        width: 160px;
        /* Set the width of the dropdown */
        /* border-radius: 4px; Optional: Add some border-radius */
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        /* Add transition for smooth effect */
    }

    .custom-menu-item:hover .custom-dropdown {
        display: block;
    }

    .custom-dropdown a {
        display: block;
        padding: 10px;
        color: #20509e;
        /* Blue text color for dropdown items */
        text-decoration: none;
        font-weight: normal;
        /* Normal text weight for dropdown items */
        transition: background-color 0.3s ease;
        /* Add transition for smooth effect */
    }

    .custom-dropdown:hover {
        background-color: #f9f9f9;
        /* Light gray background on hover */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        /* Slightly darker box-shadow on hover */
    }

    .custom-dropdown a:hover {
        border-radius: 0 0 10px;
        background-color: #e3e3e3;
        /* Lighter gray background on sub-menu hover */
    }

    .rounded-plus-icon {
        margin-left: auto;
        font-weight: bold;
        align-items: center;
        text-align: center;
    }

    .rounded-plus-icon a {
        color: #fff;
        height: 40px;
        width: 40px;
        display: block;
        padding: 10px;
        background-color: #74b330;
        /* Green color for the plus icon */
        border-radius: 50%;
        text-align: center;
        text-decoration: none;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .custom-menu-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .custom-menu-item {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .custom-menu-bar,
        .custom-menu-item,
        .custom-dropdown {
            width: 100%;
        }

        .rounded-plus-icon {
            margin-left: 0;
            margin-top: 10px;
        }

    }
    </style>
    <style>
    /* body {
        background: #cff5b5;
    } */

    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
    }

    .main-section {
        background: transparent;
        max-width: 500px;
        width: 90%;
        height: 500px;
        margin: 30px auto;
        border-radius: 10px;
    }

    .add-section {
        width: 100%;
        background: #fff;
        margin: 0px auto;
        padding: 10px;
        border-radius: 5px;
    }

    .add-section input {
        display: block;
        width: 95%;
        height: 40px;
        margin: 10px auto;
        border: 2px solid #ccc;
        font-size: 16px;
        border-radius: 5px;
        padding: 0px 5px;
    }

    .add-section button {
        display: block;
        width: 95%;
        height: 40px;
        margin: 0px auto;
        border: none;
        outline: none;
        background: #87c22f;
        color: #fff;
        font-family: sans-serif;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }


    .add-section button:hover {
        box-shadow: 0 2px 2px 0 #ccc, 0 2px 3px 0 #ccc;
        opacity: 0.7;
    }



    #errorMes {
        display: block;
        background: #f2dede;
        width: 95%;
        margin: 0px auto;
        color: rgb(139, 19, 19);
        padding: 10px;
        height: 35px;
    }

    .show-todo-section {
        width: 100%;
        background: #fff;
        margin: 30px auto;
        padding: 10px;
        border-radius: 5px;
    }

    .todo-item {
        width: 95%;
        margin: 10px auto;
        padding: 20px 10px;
        box-shadow: 0 4px 8px 0 #ccc, 0 6px 20px 0 #ccc;
        border-radius: 5px;
    }

    .todo-item h2 {
        display: inline-block;
        padding: 5px 0px;
        font-size: 17px;
        font-family: sans-serif;
        color: #555;
    }

    .todo-item small {
        display: block;
        width: 100%;
        padding: 5px 0px;
        color: #888;
        padding-left: 30px;
        font-size: 14px;
        font-family: sans-serif;
    }

    .remove-to-do {
        display: block;
        float: right;
        width: 20px;
        height: 20px;
        font-family: sans-serif;
        color: rgb(139, 97, 93);
        text-decoration: none;
        text-align: right;
        padding: 0px 5px 8px 0px;
        border-radius: 50%;
        transition: background 1s;
        cursor: pointer;
    }

    .remove-to-do:hover {
        background: rgb(139, 97, 93);
        color: #fff;
    }

    .checked {
        color: #999 !important;
        text-decoration: line-through;
    }

    .todo-item input {
        margin: 0px 5px;
    }

    .empty {
        font-family: sans-serif;
        font-size: 16px;
        text-align: center;
        color: #cccc;
    }

    .show-todo-section {
        width: 100%;
        max-height: 400px;
        /* Set a maximum height for the to-do section */
        overflow-y: auto;
        /* Add a vertical scrollbar when content exceeds the maximum height */
        background: #fff;
        margin: 30px auto;
        padding: 10px;
        border-radius: 5px;
    }
    </style>
    <style>
    /* Add this to your existing style or in a separate style section */
    li ul {
        display: none;
        position: absolute;
        background-color: #fff;
        /* Set your desired background color */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }

    li:hover ul {
        display: block;
    }

    li ul li {
        display: block;
        padding: 10px;
    }

    li ul li a {
        text-decoration: none;
        color: #333;
        /* Set your desired text color */
        display: block;
    }

    li ul li a:hover {
        background-color: #f4f4f4;
        /* Set your desired hover background color */
    }
    </style>

    <style>
    /* Custom CSS for upcoming birthday section */
    .birthday-item {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
        color: green;
    }

    .birthday-card {
        min-height: 200px;
        /* Adjust height as needed */
        padding: 15px;
    }


    .birthday-item img {
        width: 50px;
        /* Adjust image size as needed */
        height: 50px;
        border-radius: 50%;
        /* Make the image round */
        margin-right: 10px;
        object-fit: cover;
    }
    .work-anniversary-item img {
        width: 50px;
        /* Adjust image size as needed */
        height: 50px;
        border-radius: 50%;
        /* Make the image round */
        margin-right: 10px;
        object-fit: cover;
    }

    .birthday-info {
        display: inline-block;
        vertical-align: top;
        text-align: center;
    }

    .text-muted {
        font-size: 16px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .birthday-date {
        font-weight: bold;
    }

    /* Custom CSS for attendance system */
    .attendance-container {
        margin-top: 20px;
        margin-bottom: 38px;
    }

    .attendance-section {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .attendance-header {
        /*margin-left:68px;*/
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .clock-btn {
        /* padding: 20px; */
        padding: 10px 20px;
        font-size: 20px;
        margin-right: 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .clock-in-btn {
        background-color: #51ad26;
        color: #fff;
        border: none;
    }

    .clock-out-btn {
        background-color: #dc3545;
        color: #fff;
        border: none;
    }

    .clocked-status {
        font-size: 18px;
        margin-top: 10px;
    }

    /* Alert Box CSS */
    .alert {
        padding: 20px;
        background-color: #f44336;
        /* Red */
        color: white;
        margin-bottom: 15px;

    }

    /* The close button */
    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* When moving the mouse over the close button */
    .closebtn:hover {
        color: black;
    }
    .leave-type {
        max-width: 200px; /* Set maximum width for the leave type cell */
        overflow: hidden; /* Hide overflow content */
        text-overflow: ellipsis; /* Add ellipsis for overflow content */
        white-space: nowrap; /* Prevent line breaks */
        word-wrap: break-word; /* Allow long words to wrap to the next line */
        word-break: break-all;
    }
    .starting-balance {
            text-align: center;
        }


    /* Responsive adjustments */
    @media (max-width: 768px) {
        .attendance-section {
            padding: 15px;
        }

        .attendance-header {
            font-size: 20px;
        }

        .clock-btn {
            padding: 8px 16px;
            font-size: 16px;
        }

        .clocked-status {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .birthday-item img {
            width: 40px;
            height: 40px;
        }

        .birthday-date {
            font-size: 14px;
        }

        .attendance-section {
            padding: 10px;
        }

        .attendance-header {
            font-size: 18px;
        }

        .clock-btn {
            padding: 6px 12px;
            font-size: 14px;
        }

        .clocked-status {
            font-size: 14px;
        }
    }
    </style>
</head>

<body>


    <?php
    
// $servername = "localhost";
// $dbname = "hrms";
// $username = "root"; // replace with your database username
// $password = ""; // replace with your database password

// try {
//     $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully"; 
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }


?>


    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-name mb-4">
                <h4 class="m-0">
                    <span class="user-img">
                        <img src="<?php echo fetchProfilePic($conn, $_SESSION['emp_id']); ?>" alt="">
                        <span class="status online"></span>
                    </span> Welcome <?php echo $employee_first_name; ?>
                    (<?php echo $user_type = $_SESSION['user_type']; ?>)
                </h4>
                <label><?php echo date('D, d M Y'); ?></label> <!-- Change here to display the current date -->
            </div>
            <div class="row mb-4">
                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="breadcrumb-path ">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-3"
                                        alt="breadcrumb" />Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                        <h3>Admin Dashboard</h3>
                    </div>
                </div>
                <!-- <div class="col-xl-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-xl-6 col-sm-6 col-12">
                            <a class="btn-dash" href="#"> Admin Dashboard</a>
                        </div>

                    </div>
                </div> -->
            </div>

            <?php
include('db_conn.php');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// // Include the database connection file
// include('db_conn.php');

// // Start the session
// session_start();
date_default_timezone_set('Asia/Kolkata');

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
$successMessage = null;
$alertMessage = null;

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
        $successMessage = 'You have successfully clocked in at ' . $clockInTime;
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
        $successMessage = 'You have successfully clocked out at ' . $clockOutTime;

        // Reset clock in time
        $clockInTime = null;
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

// Function to fetch profile picture URL based on emp_id

?>
<style>
    #timer {
        font-size: 24px;
        font-weight: bold;
        color:#51ad26;
        margin-bottom: 20px;
}

</style>
<h2>Attendance System</h2>
<p>Welcome, <?php echo $first_name; ?>!</p>
<?php
// Display success message if set
if ($successMessage) {
    echo "<p>$successMessage</p>";
} else {
    // Check if the user is already clocked in
    if ($clockInTime) {
        echo "<p>You are already clocked in since $clockInTime</p>";
    } else if ($clockOutTime) {
        echo "<p>Now you are successfully clocked out at $clockOutTime</p>";
    }
}
?>
<form id="clockForm" method="POST" class="attendance-container">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <button type="submit" name="type" value="clock_in" class="clock-btn clock-in-btn">Clock In</button>
    <button type="submit" name="type" value="clock_out" class="clock-btn clock-out-btn">Clock Out</button>
</form>
<div id="workedHours">Worked Hours: <span id="hoursWorked"><?php echo $totalWorkedHours ?? '--:--:--'; ?></span></div>
<div id="stopwatch" class="stopwatch"></div>
<div id="timer" class="timer" style="display: none;"> 00:00:00</div> <!-- New HTML element for displaying the timer -->
<script>
    // JavaScript code for stopwatch and timer
var stopwatchElement = document.getElementById('stopwatch');
var timerElement = document.getElementById('timer');
var intervalId = null;
var startTime = <?php echo $clockInTime ? strtotime($clockInTime) * 1000 : 'null'; ?>; // Convert clock in time to milliseconds

function updateClock() {
    if (!startTime) return; // If start time is not set, do nothing

    var currentTime = new Date().getTime();
    var elapsedTime = currentTime - startTime;
    var totalSeconds = Math.floor(elapsedTime / 1000);

    // Calculate hours, minutes, and seconds
    var hours = Math.floor(totalSeconds / 3600);
    var minutes = Math.floor((totalSeconds % 3600) / 60);
    var seconds = totalSeconds % 60;

    // Format time display
    var hoursStr = (hours < 10) ? '0' + hours : hours;
    var minutesStr = (minutes < 10) ? '0' + minutes : minutes;
    var secondsStr = (seconds < 10) ? '0' + seconds : seconds;

    // Update timer display
    timerElement.textContent = hoursStr + ':' + minutesStr + ':' + secondsStr + 's';
}

function startClock() {
    if (!startTime) return; // If start time is not set, do nothing
    intervalId = setInterval(updateClock, 1000);
}

function stopClock() {
    clearInterval(intervalId);
}

// Start clock if clocked in
if (<?php echo $clockInTime ? 'true' : 'false'; ?>) {
    timerElement.style.display = 'block'; // Show the timer
    startClock(); // Start the clock
}

// Check if clock out button was clicked, and stop the clock if needed
var clockOutBtn = document.querySelector('.clock-out-btn');
clockOutBtn.addEventListener('click', function () {
    stopClock(); // Stop the clock when clocking out
});

// Check if clock in button was clicked, and reset the timer
var clockInBtn = document.querySelector('.clock-in-btn');
clockInBtn.addEventListener('click', function () {
    timerElement.textContent = 'Timer: 00:00:00'; // Reset timer display when clocking in
});

</script>




            <!-- Alert Box -->
            <?php if ($alertMessage): ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php echo $alertMessage; ?>
            </div>
            <?php endif; ?>


            <?php
// Assuming you have a PDO connection named $dbh

$sql = "SELECT id from employees"; // Modify the query to select the desired employee information
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$empcount = $query->rowCount();
?>

            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card board1 fill1 ">
                        <div class="card-body">
                            <div class="card_widget_header">
                                <label>Employees</label>
                                <h4><?php echo $empcount; ?></h4>
                            </div>
                            <div class="card_widget_img">
                                <img src="assets/img/dash1.png" alt="card-img" />
                            </div>
                        </div>
                    </div>
                </div>

                <!--counting pending leaves -->

                <?php
// $conn = new mysqli("localhost", "root", "", "hrms");

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
include('db_conn.php');

// Fetch count of pending leave requests
$sqlPendingLeaves = "SELECT COUNT(*) AS pendingCount FROM leaves WHERE status NOT IN ('Approved', 'Rejected')";
$resultPendingLeaves = $conn->query($sqlPendingLeaves);

$pendingCount = 0;
if ($resultPendingLeaves !== false) {
    $rowPendingLeaves = $resultPendingLeaves->fetch(PDO::FETCH_ASSOC);
    $pendingCount = $rowPendingLeaves['pendingCount'];
}

// Close the PDO connection (optional, as PDO automatically closes when script ends)
// $conn = null;

// $conn->close();
?>
                <!-- Your HTML structure with the calculated pending leaves count -->
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'director'): ?>
                <a href="leave_management_for_director.php" style="text-decoration: none; color: inherit;">
                    <?php else: ?>
                    <a href="leave_management_system.php" style="text-decoration: none; color: inherit;">
                        <?php endif; ?>

                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card board1 fill3">
                                <div class="card-body">
                                    <div class="card_widget_header">
                                        <label>Pending Leaves</label>
                                        <h4><?php echo $pendingCount; ?></h4>
                                    </div>
                                    <div class="card_widget_img">
                                        <img src="assets/img/dash3.png" alt="card-img" />
                                    </div>
                                </div>
                            </div>
                    </a>
            </div>


        </div>
        <div class="row">
            <div class="col-xl-6 d-flex mobile-h">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Total Employees</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="invoice_chart"></div>
                        <div class="text-center text-muted">
                            <div class="row">
                                <div class="col-4">
                                    <div class="mt-4">
                                        <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary mr-1"></i>
                                            Business</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-4">
                                        <p class="mb-2 text-truncate"><i class="fas fa-circle text-success mr-1"></i>
                                            Testing</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-4">
                                        <p class="mb-2 text-truncate"><i class="fas fa-circle text-danger mr-1"></i>
                                            Development</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Attendance Report</h5>
                        </div>
                    </div>
                    <div class="card-body">
                    <?php
// Include database connection
include 'db_conn.php';

// Function to calculate daily late comings
function calculateDailyLateComings($date) {
    global $conn;
    $lateCount = 0;

    $sql = "SELECT COUNT(*) AS late_count FROM attendance WHERE DATE(clock_in) = :date AND TIME(clock_in) > '10:10:00'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $lateCount = $result['late_count'];
    }

    return $lateCount;
}

// Function to generate date-wise reports for the specified date range
function generateDateWiseReport($startDate, $endDate) {
    global $conn;
    $report = array();

    // Create an array of all dates within the specified range
    $allDates = [];
    $currentDate = $startDate;
    while ($currentDate <= $endDate) {
        $allDates[] = $currentDate;
        $currentDate = date('Y-m-d', strtotime($currentDate . ' + 1 day'));
    }

    // Query attendance data for each date and populate the report array
    foreach ($allDates as $date) {
        $totalAttendance = 0;
        $lateComings = 0;

        $sql = "SELECT COUNT(*) AS total_attendance FROM attendance WHERE DATE(clock_in) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $totalAttendance = $result['total_attendance'];
            $lateComings = calculateDailyLateComings($date);
        }

        $report[$date] = array(
            'total_attendance' => $totalAttendance,
            'late_comings' => $lateComings
        );
    }

    return $report;
}

// Function to prepare data for weekly report graph
function prepareWeeklyReportData($report) {
    $dates = array_keys($report);
    $totalAttendance = array();
    $lateComings = array();

    foreach ($dates as $date) {
        $totalAttendance[] = $report[$date]['total_attendance'];
        $lateComings[] = $report[$date]['late_comings'];
    }

    return array(
        'dates' => $dates,
        'total_attendance' => $totalAttendance,
        'late_comings' => $lateComings
    );
}

// Function to find the first attendance date
function findFirstAttendanceDate() {
    global $conn;
    $sql = "SELECT MIN(DATE(clock_in)) AS first_date FROM attendance";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Find the first attendance date
$firstDate = findFirstAttendanceDate();

// Calculate the end date (7 days after the first attendance date)
$endDate = date('Y-m-d', strtotime($firstDate . ' + 6 days'));

// Generate date-wise report for the specified date range
$report = generateDateWiseReport($firstDate, $endDate);

// Prepare data for weekly report graph
$weeklyReportData = prepareWeeklyReportData($report);

// Handle next and previous actions
if (isset($_POST['action'])) {
    $currentStartDate = $_POST['startDate'];
    if ($_POST['action'] === 'next') {
        $firstDate = date('Y-m-d', strtotime($currentStartDate . ' + 7 days'));
    } elseif ($_POST['action'] === 'previous') {
        $firstDate = date('Y-m-d', strtotime($currentStartDate . ' - 7 days'));
    }
    $endDate = date('Y-m-d', strtotime($firstDate . ' + 6 days'));
    $report = generateDateWiseReport($firstDate, $endDate);
    $weeklyReportData = prepareWeeklyReportData($report);
}
?>

    
    <style>
        

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .button-container button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }
    </style>

<body>
    <div class="container">
        <h2 style="font-size: small;">Weekly Attendance Report (<?php echo $firstDate . ' to ' . $endDate; ?>)</h2>
        <div class="button-container">
            <form method="post">
                <input type="hidden" name="startDate" value="<?php echo $firstDate; ?>">
                <button type="submit" name="action" value="previous">Previous</button>
            </form>
            <form method="post">
                <input type="hidden" name="startDate" value="<?php echo $firstDate; ?>">
                <button type="submit" name="action" value="next">Next</button>
            </form>
        </div>
        <canvas id="weeklyReportChart" width="800" height="400"></canvas>
    </div>

    <script>
        // Get the canvas element
        var ctx = document.getElementById('weeklyReportChart').getContext('2d');

        // Prepare data for the chart
        var data = {
            labels: <?php echo json_encode($weeklyReportData['dates']); ?>,
            datasets: [{
                label: 'Total Attendance',
                data: <?php echo json_encode($weeklyReportData['total_attendance']); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Late Comings',
                data: <?php echo json_encode($weeklyReportData['late_comings']); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Create and display the chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


                        
                    </div>
                </div>
            </div>
            
            <!-- Leave Taking Percentage -->

            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Leave Taking Percentage</h5>
                        </div>
                    </div>
                    <div class="card-body">
                    <?php
// Include database connection
include 'db_conn.php';

// Function to calculate percentage of leave days taken for a specific month
function calculateLeavePercentage($month, $year) {
    global $conn;

    // Construct the start and end date of the specified month
    $startDate = date('Y-m-01', strtotime("$year-$month"));
    $endDate = date('Y-m-t', strtotime("$year-$month"));

    // SQL query to fetch leaves data for the specified month where status is Approved
    $sql = "SELECT SUM(DATEDIFF(LEAST(`to_date`, :endDate), GREATEST(`from_date`, :startDate)) + 1) AS total_leave_days
            FROM leaves
            WHERE `from_date` BETWEEN :startDate AND :endDate
            AND `to_date` BETWEEN :startDate AND :endDate
            AND `status` = 'Approved'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Total days in the month
    $totalDaysInMonth = date('t', strtotime("$year-$month"));

    // Calculate leave percentage
    $leavePercentage = ($result['total_leave_days'] / $totalDaysInMonth) * 100;

    return $leavePercentage;
}

// Function to get leave percentages for each month of a year
function getLeavePercentagesForYear($year) {
    $leavePercentages = array();
    for ($month = 1; $month <= 12; $month++) {
        $leavePercentage = calculateLeavePercentage($month, $year);
        $leavePercentages[] = $leavePercentage;
    }
    return $leavePercentages;
}

// Example usage: Get leave percentages for each month of 2024
$year = 2024;
$leavePercentages = getLeavePercentagesForYear($year);

// Convert leave percentages array to JSON for use in JavaScript
$leavePercentagesJSON = json_encode($leavePercentages);
?>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* padding: 20px; */
            background-color: #f4f4f4;
        }

        canvas {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
        
    </style>
<!-- </head>
<body> -->
    <canvas id="leavePercentageChart" width="800" height="400"></canvas>

    <script>
        // Get the canvas element
        var ctx = document.getElementById('leavePercentageChart').getContext('2d');

        // Parse leave percentages JSON data
        var leavePercentages = <?php echo $leavePercentagesJSON; ?>;

        // Prepare data for the chart
        var data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Leave Percentage',
                data: leavePercentages,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        };

        // Create and display the line chart
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Leave Percentage (%)'
                        }
                    }
                }
            }
        });
    </script>
                    </div>
                </div>
            </div>

            <!-- Attendance percentage graph -->

            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Attendance Percentage</h5>
                        </div>
                    </div>
                    <div class="card-body">

                    <?php
// Include database connection
include 'db_conn.php';

// Function to calculate attendance percentage for each employee over the next 3 months
function calculateAttendancePercentage() {
    global $conn;

    // Get the current date
    $currentDate = date('Y-m-d');

    // Calculate the end date (3 months from the current date)
    $endDate = date('Y-m-d', strtotime('+3 months', strtotime($currentDate)));

    // Initialize an array to store attendance percentages for each employee
    $attendanceData = array();

    // Query to get distinct employees from the attendance table
    $sql = "SELECT DISTINCT employee_id FROM attendance";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Iterate through each employee
    foreach ($employees as $employeeId) {
        // Query to get the first clock_in date for the employee
        $sql = "SELECT MIN(clock_in) AS first_clock_in FROM attendance WHERE employee_id = :employeeId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employeeId', $employeeId);
        $stmt->execute();
        $firstClockInDate = $stmt->fetchColumn();

        // Calculate the total number of working days (excluding Sundays) for the next 3 months
        $totalWorkingDays = 0;
        $currentMonth = date('Y-m', strtotime($currentDate));
        $endMonth = date('Y-m', strtotime($endDate));
        while ($currentMonth <= $endMonth) {
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($currentMonth)), date('Y', strtotime($currentMonth)));
            for ($i = 1; $i <= $totalDaysInMonth; $i++) {
                $dayOfWeek = date('N', strtotime($currentMonth . '-' . $i));
                if ($dayOfWeek != 7) { // Exclude Sundays
                    $totalWorkingDays++;
                }
            }
            $currentMonth = date('Y-m', strtotime($currentMonth . ' + 1 month'));
        }

        // Query to count the number of attended days for the employee within the next 3 months
        $sql = "SELECT COUNT(DISTINCT DATE(clock_in)) AS attended_days FROM attendance WHERE employee_id = :employeeId AND DATE(clock_in) BETWEEN :firstClockInDate AND :endDate";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employeeId', $employeeId);
        $stmt->bindParam(':firstClockInDate', $firstClockInDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();
        $attendedDays = $stmt->fetchColumn();

        // Calculate the attendance percentage
        $attendancePercentage = ($attendedDays / $totalWorkingDays) * 100;

        // Query to get employee name
        $sql = "SELECT first_name FROM employees WHERE emp_id = :employeeId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employeeId', $employeeId);
        $stmt->execute();
        $employeeName = $stmt->fetchColumn();

        // Store the attendance data for the employee
        $attendanceData[] = array(
            'name' => $employeeName,
            'attendancePercentage' => $attendancePercentage
        );
    }

    // Sort attendance data based on attendance percentage in descending order
    usort($attendanceData, function($a, $b) {
        return $b['attendancePercentage'] - $a['attendancePercentage'];
    });

    return $attendanceData;
}

// Function to get a subset of employee data based on the current index
function getSubsetOfEmployeeData($attendanceData, $currentIndex, $pageSize) {
    $subset = array_slice($attendanceData, $currentIndex, $pageSize);
    return $subset;
}

// Calculate attendance percentages for each employee
$attendanceData = calculateAttendancePercentage();

// Handle pagination
$currentIndex = isset($_GET['index']) ? intval($_GET['index']) : 0;
$pageSize = 7; // Change this to 10 if you want to display 10 employees at a time
$totalPages = ceil(count($attendanceData) / $pageSize);
$subsetData = getSubsetOfEmployeeData($attendanceData, $currentIndex, $pageSize);

// HTML and CSS for displaying the bar graph
?>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* padding: 20px; */
            background-color: #f4f4f4;
        }

        canvas {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .navigation {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .navigation button {
            margin: 0 10px;
            padding: 8px 16px;
            background-color: green; /* Changed button color to green */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .navigation button:hover {
            background-color: #0056b3;
        }

        .page-info {
            margin-top: 10px;
            text-align: center;
            font-size: 14px;
        }
    </style>
<!-- </head>
<body> -->
    <canvas id="employeeAttendanceChart" width="800" height="400"></canvas>

    <div class="navigation">
        <?php if ($currentIndex > 0): ?>
            <a href="?index=<?= max(0, $currentIndex - $pageSize) ?>"><button id="prevBtn">&lt; Previous</button></a>
        <?php endif; ?>
        <?php if ($currentIndex < $totalPages - 1): ?>
            <a href="?index=<?= min($currentIndex + $pageSize, count($attendanceData) - 1) ?>"><button id="nextBtn">Next &gt;</button></a>
        <?php endif; ?>
    </div>

    <div class="page-info">
        <?php
            $remaining = count($attendanceData) - ($currentIndex + 1);
            echo "Showing " . ($currentIndex + 1) . " - " . min($currentIndex + $pageSize, count($attendanceData)) . " of " . count($attendanceData) . " employees";
            if ($remaining > 0) {
                echo " - $remaining remaining";
            }
        ?>
    </div>

    <script>
        var subsetData = <?php echo json_encode($subsetData); ?>;
        var ctx = document.getElementById('employeeAttendanceChart').getContext('2d');

        function drawChart() {
            var employeeNames = subsetData.map(function(data) {
                return data.name;
            });
            var attendancePercentages = subsetData.map(function(data) {
                return data.attendancePercentage;
            });

            var data = {
                labels: employeeNames,
                datasets: [{
                    label: 'Attendance Percentage',
                    data: attendancePercentages,
                    backgroundColor: attendancePercentages.map(function(percentage) {
                        if (percentage < 75) {
                            return 'rgba(255, 99, 132, 0.7)';
                        } else if (percentage > 96) {
                            return 'rgba(75, 192, 192, 0.7)';
                        } else {
                            return 'rgba(54, 162, 235, 0.7)';
                        }
                    }),
                    borderWidth: 1
                }]
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    indexAxis: 'y',
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Employee Name'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Attendance Percentage (%)'
                            }
                        }
                    }
                }
            });
        }

        drawChart();
    </script>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">To-Do List</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="main-section">
                            <div class="add-section">
                                <form action="app/add.php" method="POST" autocomplete="off">
                                    <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                                    <input type="text" name="title" style="border-color: #ff6666"
                                        placeholder="This field is required" />
                                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                                    <?php }else{ ?>
                                    <input type="text" name="title" placeholder="What do you need to do?" />
                                    <button type="submit"><b>Add</b><span></span></button>
                                    <?php } ?>
                                </form>
                            </div>
                            <?php 
                    $todos = $dbh->query("SELECT * FROM todos ORDER BY id DESC");
                ?>
                            <div class="show-todo-section">
                                <?php if($todos->rowCount() <= 0){ ?>
                                <div class="todo-item">
                                    <div class="empty">
                                        <img src="img/f.png" width="100%" />
                                        <img src="img/Ellipsis.gif" width="80px">
                                    </div>
                                </div>
                                <?php } ?>
                                <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                                <div class="todo-item">
                                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
                                    <?php if($todo['checked']){ ?>
                                    <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>"
                                        checked />
                                    <h2 class="checked"><?php echo $todo['title'] ?></h2>
                                    <?php }else { ?>
                                    <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>"
                                        class="check-box" />
                                    <h2><?php echo $todo['title'] ?></h2>
                                    <?php } ?>
                                    <br>
                                    <small>created: <?php echo $todo['date_time'] ?></small>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 d-flex">
                <div class="card flex-fill birthday-card">
                    <div class="card-header">
                        <h5 class="card-title">Upcoming Birthdays</h5>
                    </div>
                    <div class="card-body">
                        <?php
            $currentDate = date('Y-m-d');
            $nextWeek = date('Y-m-d', strtotime('+7 days', strtotime($currentDate)));
            $query = $dbh->prepare("SELECT * FROM employees WHERE MONTH(birth_date) = MONTH(DATE_ADD(:currentDate, INTERVAL 7 DAY))");
            $query->bindParam(':currentDate', $currentDate);
            $query->execute();
            $foundBirthday = false; // Flag to check if any birthday is found

            while ($employee = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="birthday-item">';
                if (!empty($employee['profile_pic'])) {
                    echo '<img src="' . $employee['profile_pic'] . '" alt="' . $employee['first_name'] . '">';
                } else {
                    // Use default profile picture URL
                    echo '<img src="assets/img/dashboard-profile.jpg" alt="Default Profile Picture">';
                }
                echo '<div class="birthday-info">';
                echo '<p>Happy Birthday, ' . $employee['first_name'] . ' 🎉😍</p>';
                echo '<p class="birthday-date">Birthday: ' . date('F d', strtotime($employee['birth_date'])) . '</p>';
                echo '</div>';
                echo '</div>';
                $foundBirthday = true; // Set flag to true if birthday is found
            }

            // Display message with GIF if no birthdays are found
            if (!$foundBirthday) {
                echo '<div class="card flex-fill birthday-section">';
                echo '<img src="assets/img/not_found.gif" alt="No upcoming birthdays">';
                echo '<p style="color: #849ed1; text-align: center; padding-bottom: 10px;">No upcoming birthdays in the next week.</p>';
                echo '</div>';
            }
            ?>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 d-flex">
                <div class="card flex-fill birthday-card">
                    <div class="card-header">
                        <h5 class="card-title">New Hires</h5>
                    </div>
                    <div class="card-body">
                        <?php
            // Get the current date
            $currentDate = date('Y-m-d');

            // Fetch employees who have started within the last 15 days and are still within their first 15 days
            $newHiresQuery = $dbh->prepare("SELECT * FROM employees WHERE start_date >= DATE_SUB(:currentDate, INTERVAL 15 DAY) AND start_date <= :currentDate");
            $newHiresQuery->bindParam(':currentDate', $currentDate);
            $newHiresQuery->execute();
            $newHires = $newHiresQuery->fetchAll(PDO::FETCH_ASSOC);

            // Display new hires
            if (!empty($newHires)) {
                foreach ($newHires as $employee) {
                    // Calculate the end date of the 15-day period
                    $endDate = date('Y-m-d', strtotime($employee['start_date'] . ' + 15 days'));

                    // Check if the employee is still within the 15-day period
                    if ($endDate >= $currentDate) {
                        // Display welcome message for new hire
                        echo '<div class="birthday-item">';
                        echo '<p style="color : #51ad26">Welcome in Sedulous ' . $employee['first_name'] . ' 🎉🎉</p>';
                        if (!empty($employee['profile_pic'])) {
                            echo '<img src="' . $employee['profile_pic'] . '" alt="' . $employee['first_name'] . '">';
                        } else {
                            // Use default profile picture URL
                            echo '<img src="assets/img/dashboard-profile.jpg" alt="Default Profile Picture">';
                        }
                        echo '<div class="birthday-info">';
                        echo '<p>' . $employee['first_name'] . '</p>';
                        echo '<p class="birthday-date">Start Date: ' . date('F d', strtotime($employee['start_date'])) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } else {
                // Display message with GIF if no new hires are found in the last 15 days
                echo '<div class="card flex-fill birthday-section">';
                echo '<img src="assets/img/not_found.gif" alt="No new hires">';
                echo '<p style="color: #849ed1; text-align: center; padding-bottom: 10px;">No new hires in the last 15 days.</p>';
                echo '</div>';
            }
            ?>
                    </div>
                </div>
            </div>

    <!-- Leave balance -->
    <div class="col-xl-6">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title">Leave Balance Report</h5>
            </div>
            <div class="card-body">
                <?php
                include('db_conn.php'); // Include database connection
                
                // Fetch leave details for the logged-in employee
                $emp_id = $_SESSION['emp_id'];
                $query = "SELECT a.leave_type_id, s.leave_type, a.starting_balance 
                          FROM allotted_leave a
                          INNER JOIN setleave s ON a.leave_type_id = s.id
                          WHERE a.employeeID = :emp_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':emp_id', $emp_id);
                $stmt->execute();

                // Check if leave records exist
                if ($stmt->rowCount() > 0) {
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Leave Type</th>';
                    echo '<th>Starting Balance</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    // Loop through each leave record
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td class="leave-type">' . $row['leave_type'] . '</td>';
                        echo '<td class="starting-balance">' . $row['starting_balance'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No leave allotted currently.</p>';
                }

                // Close the database connection
                $conn = null;
                ?>
            </div>
        </div>
    </div>



    <div class="col-xl-6">
    <div class="card flex-fill">
        <div class="card-header">
            <h5 class="card-title">Work Anniversaries</h5>
        </div>
        <div class="card-body">
            <?php
            include('db_conn.php');
            // Fetch employees who are celebrating their work anniversary within the next two days
            $currentDate = date('Y-m-d');
            $twoDaysLater = date('Y-m-d', strtotime('+2 days', strtotime($currentDate)));

            $query = "SELECT * FROM employees WHERE DATE_ADD(start_date, INTERVAL 1 YEAR) BETWEEN :currentDate AND :twoDaysLater";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':currentDate', $currentDate);
            $stmt->bindParam(':twoDaysLater', $twoDaysLater);
            $stmt->execute();

            $foundAnniversary = false; // Flag to check if any anniversary is found

            while ($employee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="work-anniversary-item">';
                if (!empty($employee['profile_pic'])) {
                    echo '<img src="' . $employee['profile_pic'] . '" alt="' . $employee['first_name'] . '">';
                } else {
                    // Use default profile picture URL
                    echo '<img src="assets/img/dashboard-profile.jpg" alt="Default Profile Picture">';
                }
                echo '<div class="work-anniversary-info">';
                echo '<p>Happy 1 Year Work Anniversary, ' . $employee['first_name'] . ' 🎉😍</p>';
                echo '</div>';
                echo '</div>';
                $foundAnniversary = true; // Set flag to true if anniversary is found
            }

            // Display message if no work anniversaries are found
            if (!$foundAnniversary) {
                echo '<div class="card flex-fill birthday-section">';
                echo '<img src="assets/img/search.gif" alt="No work anniversaries">';
                echo '<p style="color: #849ed1; text-align: center; padding-bottom: 10px;">No work anniversaries in the upcoming 2 days.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>





            <script src="js/jquery-3.2.1.min.js"></script>

            <script>
            $(document).ready(function() {
                $('.remove-to-do').click(function() {
                    const id = $(this).attr('id');

                    $.post("app/remove.php", {
                            id: id
                        },
                        (data) => {
                            if (data) {
                                $(this).parent().hide(600);
                            }
                        }
                    );
                });

                $(".check-box").click(function(e) {
                    const id = $(this).attr('data-todo-id');

                    $.post('app/check.php', {
                            id: id
                        },
                        (data) => {
                            if (data != 'error') {
                                const h2 = $(this).next();
                                if (data === '1') {
                                    h2.removeClass('checked');
                                } else {
                                    h2.addClass('checked');
                                }
                            }
                        }
                    );
                });
            });
            </script>



</body>

</html>