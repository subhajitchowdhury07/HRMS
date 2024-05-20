<?php include("sidebar.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>
<link rel="shortcut icon" href="../assets/img/sedulous-small-icon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../assets/css/style.css">

<style>
    p{
        font-weight: bold;
    }

h2 {
    color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    }
/* Custom CSS for upcoming birthday section */
.birthday-item {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
    color:green;
}
.birthday-card {
    min-height: 200px; /* Adjust height as needed */
    padding: 15px;
}


.birthday-item img {
    width: 50px; /* Adjust image size as needed */
    height: 50px;
    border-radius: 50%; /* Make the image round */
    margin-right: 10px;
    object-fit: cover;
}
.work-anniversary-item img{
    width: 50px; /* Adjust image size as needed */
    height: 50px;
    border-radius: 50%; /* Make the image round */
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
    margin-bottom:38px;
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
    background-color: #f44336; /* Red */
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
// Check if the employee is logged in
if (!isset($_SESSION['emp_id'])) {
    // Redirect the user to the login page or handle authentication as per your requirement
    header("Location: login.php");
    exit();
}

include('../db_conn.php'); // Include database connection

try {
    $stmt = $conn->prepare("SELECT first_name FROM employees WHERE emp_id = :emp_id");
    $stmt->bindParam(':emp_id', $_SESSION['emp_id']);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    // Extract first name from the fetched data
    $employee_first_name = $employee['first_name'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}


?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-name mb-4">
            <h4 class="m-0"><span class="user-img">
                <img src="<?php echo fetchProfilePic($conn, $_SESSION['emp_id']); ?>" alt="">
                        <span class="status online"></span>
                    </span> Welcome <?php echo $employee_first_name; ?> (<?php echo $user_type = $_SESSION['user_type']; ?>)</h4>
                    <label><?php echo date('D, d M Y'); ?></label> <!-- Change here to display the current date -->
                </div>
<div class="row mb-4">
<div class="col-xl-6 col-sm-12 col-12">
    <div class="breadcrumb-path ">
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index-employee.php"><img src="../assets/img/dash.png" class="mr-3" alt="breadcrumb" />Home</a>
</li>
<li class="breadcrumb-item active">Dashboard</li>
</ul>
<h3>Employee Dashboard</h3>
</div>
</div>
<!-- <div class="col-xl-6 col-sm-12 col-12">
    <div class="row">
        <div class="col-xl-6 col-sm-6 col-12">
            <a class="btn-emp" href="../index.php"> Admin Dashboard</a>
        </div>
        <div class="col-xl-6 col-sm-6 col-12">
            <a class="btn-dash" href="#">Employee Dashboard</a>
        </div>
    </div>
</div> -->
</div>

<?php
include('../db_conn.php');

// Initialize clockInTime, clockOutTime, totalWorkedHours, successMessage, and alertMessage
$clockInTime = null;
$clockOutTime = null;
$totalWorkedHours = null;
$successMessage = null;
$alertMessage = null;

date_default_timezone_set('Asia/Kolkata');

// Function to get the user's IP address
function getUserIP() {
    // Check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validateIP($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // Check for IP addresses from proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Extract the IPs
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        // Reverse the array to get the real IP
        $ipList = array_reverse($ipList);
        // Check each IP if it's a valid one
        foreach ($ipList as $ip) {
            if (validateIP($ip)) {
                return $ip;
            }
        }
    }

    // Use REMOTE_ADDR as fallback
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
}

// Function to validate an IP address
function validateIP($ip) {
    return filter_var($ip, FILTER_VALIDATE_IP) !== false;
}

// Define array of office IP addresses
$officeIPs = array('::1', '203.192.209.70', '192.168.1.55');

// Get the user's IP address
$userIP = getUserIP();

// Function to check if the user's IP is within the office network
function isInOfficeNetwork($userIP, $officeIPs) {
    // Check if the user's IP matches any of the office IP addresses
    return in_array($userIP, $officeIPs);
}

// Check if the user is logged in
if (!isset($_SESSION['emp_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

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
        // Check if the user is in the office network
        $userIP = getUserIP();
        if (!isInOfficeNetwork($userIP, $officeIPs)) {
            $alertMessage = 'You are not in the office premises.';
        } else {
            $clockInTime = date('Y-m-d H:i:s A');
            // Start stopwatch when clocking in

            // Insert clock in time into the database
            $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES (:user_id, :clockInTime)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':clockInTime', $clockInTime);
            $stmt->execute();
            $successMessage = 'You have successfully clocked in at ' . $clockInTime;
        }
    }

    // If clock-out time is set and the user clicked Clock Out
    if ($type == 'clock_out' && $clockInTime) {
        $clockOutTime = date('Y-m-d h:i:s A');

        // Stop stopwatch when clocking out
        $endTime = time();

        // Calculate total worked hours
        $totalWorkedSeconds = $endTime - strtotime($clockInTime);
        $totalWorkedHours = sprintf('%02d:%02d:%02d', ($totalWorkedSeconds / 3600), ($totalWorkedSeconds / 60 % 60), ($totalWorkedSeconds % 60));

        // Update the database with clock-out time and total worked hours
        $update_query = "UPDATE attendance SET clock_out = :clockOutTime, total_worked_hr = :totalWorkedHours WHERE employee_id = :user_id AND clock_out IS NULL";
        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(':clockOutTime', $clockOutTime);
        $stmt->bindParam(':totalWorkedHours', $totalWorkedHours);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Set success message
        $successMessage = 'You have successfully clocked out at ' . $clockOutTime;

        // Reset clock in and out times
        $clockInTime = null;
        $clockOutTime = null;
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

    // Format hours to 12-hour format
    $formattedHours = date('h', mktime(0, 0, $hours));

    return sprintf('%02d:%02d:%02d', $formattedHours, $minutes, $seconds);
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
<div id="workedHours" style="font-weight: 600;">Worked Hours: <span id="hoursWorked"><?php echo $totalWorkedHours ?? '--:--:--'; ?></span></div>
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
<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary mr-1"></i> Business</p>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-success mr-1"></i> Development</p>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger mr-1"></i> Testing</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- //graph's -->



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
                            <input type="text" 
                                name="title" 
                                style="border-color: #ff6666"
                                placeholder="This field is required" />
                            <button type="submit">Add &nbsp; <span>&#43;</span></button>
                        <?php }else{ ?>
                            <input type="text" 
                                name="title" 
                                placeholder="What do you need to do?" />
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
                                <img src="../img/f.png" width="100%" />
                                <img src="../img/Ellipsis.gif" width="80px">
                            </div>
                        </div>
                    <?php } ?>
                    <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="todo-item">
                            <span id="<?php echo $todo['id']; ?>"
                                class="remove-to-do">x</span>
                            <?php if($todo['checked']){ ?> 
                                <input type="checkbox"
                                    class="check-box"
                                    data-todo-id ="<?php echo $todo['id']; ?>"
                                    checked />
                                <h2 class="checked"><?php echo $todo['title'] ?></h2>
                            <?php }else { ?>
                                <input type="checkbox"
                                    data-todo-id ="<?php echo $todo['id']; ?>"
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
</div>
<script>
    $(document).ready(function(){
        $('.remove-to-do').click(function(){
            const id = $(this).attr('id');
            
            $.post("../app/remove.php", 
                  {
                      id: id
                  },
                  (data)  => {
                     if(data){
                         $(this).parent().hide(600);
                     }
                  }
            );
        });

        $(".check-box").click(function(e){
            const id = $(this).attr('data-todo-id');
            
            $.post('../app/check.php', 
                  {
                      id: id
                  },
                  (data) => {
                      if(data != 'error'){
                          const h2 = $(this).next();
                          if(data === '1'){
                              h2.removeClass('checked');
                          }else {
                              h2.addClass('checked');
                          }
                      }
                  }
            );
        });
    });
</script>

<div class="row">
    <div class="col-xl-6">
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
                    echo '<img src="../assets/img/dashboard-profile.jpg" alt="Default Profile Picture">';
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
                echo '<img src="../assets/img/not_found.gif" alt="No upcoming birthdays">';
                echo '<p style="color: #849ed1; text-align: center; padding-bottom: 10px;">No upcoming birthdays in the next week.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- // new hire section -->
<div class="col-xl-6">
        <div class="card flex-fill birthday-card">
            <!-- New Hires Section -->
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
                        echo '<p style="color : #51ad26; font-weight: bold;">Welcome in Sedulous ' . $employee['first_name'] . ' 🎉🎉</p>';
                        if (!empty($employee['profile_pic'])) {
                            echo '<img src="' . $employee['profile_pic'] . '" alt="' . $employee['first_name'] . '">';
                        } else {
                            // Use default profile picture URL
                            echo '<img src="../assets/img/dashboard-profile.jpg" alt="Default Profile Picture">';
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
                echo '<img src="../assets/img/not_found.gif" alt="No new hires">';
                echo '<p style="color: #849ed1; text-align: center; padding-bottom: 10px;">No new hires in the last 15 days.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="col-xl-6">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title">Leave Balance Report</h5>
            </div>
            <div class="card-body">
                <?php
                include('../db_conn.php'); // Include database connection
                
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
            include('../db_conn.php');
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
                    echo '<img src="../assets/img/dashboard-profile.jpg" alt="Default Profile Picture">';
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
                echo '<img src="../assets/img/search.gif" alt="No work anniversaries">';
                echo '<p style="color: #849ed1; text-align: center; padding-bottom: 10px;">No work anniversaries in the upcoming 2 days.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>




</body>
</html>
