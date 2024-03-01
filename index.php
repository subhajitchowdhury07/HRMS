
<?php include("sidebar.php") ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>

<link rel="shortcut icon" href="assets/img/sedulous-small-icon.png">

<!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

        <style>
    body {
        background-color: #fff; /* White background */
        color: #20509e; /* Blue text color */
        font-family: 'Poppins', sans-serif; /* Poppins font */
    }

    .custom-menu-bar {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        background-color: #fff; /* White color for the menu bar */
        color: #20509e; /* Blue text color for menu items */
    }
    
    .custom-menu-item {
        margin-right: 20px;
        position: relative;
    }
    
    .custom-menu-item a {
        color: #20509e; /* Blue text color for menu items */
        text-decoration: none;
        font-weight: bold; /* Bold text */
    }
    
    .custom-dropdown {
        /* align-items: center; */
        display: none;
        position: absolute;
        border-radius: 10px;
        top: 100%;
        left: 0;
        background-color: #fff; /* White color for dropdown */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        width: 160px; /* Set the width of the dropdown */
        /* border-radius: 4px; Optional: Add some border-radius */
        transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Add transition for smooth effect */
    }

    .custom-menu-item:hover .custom-dropdown {
        display: block;
    }

    .custom-dropdown a {
        display: block;
        padding: 10px;
        color: #20509e; /* Blue text color for dropdown items */
        text-decoration: none;
        font-weight: normal; /* Normal text weight for dropdown items */
        transition: background-color 0.3s ease; /* Add transition for smooth effect */
    }

    .custom-dropdown:hover {
        background-color: #f9f9f9; /* Light gray background on hover */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Slightly darker box-shadow on hover */
    }
    
    .custom-dropdown a:hover {
        border-radius: 0 0 10px;
        background-color: #e3e3e3; /* Lighter gray background on sub-menu hover */
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
        background-color: #74b330; /* Green color for the plus icon */
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
        max-height: 400px; /* Set a maximum height for the to-do section */
        overflow-y: auto; /* Add a vertical scrollbar when content exceeds the maximum height */
        background: #fff;
        margin: 30px auto;
        padding: 10px;
        border-radius: 5px;
    }
</style>
<style>/* Add this to your existing style or in a separate style section */
li ul {
    display: none;
    position: absolute;
    background-color: #fff; /* Set your desired background color */
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
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
    color: #333; /* Set your desired text color */
    display: block;
}

li ul li a:hover {
    background-color: #f4f4f4; /* Set your desired hover background color */
}
</style>

<style>
/* Custom CSS for upcoming birthday section */
.birthday-item {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
    color:green;
}

.birthday-item img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
}

.birthday-info {
    display: inline-block;
    vertical-align: top;
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
    font-size: 18px;
    margin-right: 10px;
    border-radius: 5px;
    cursor: pointer;
}

.clock-in-btn {
    background-color: #28a745;
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
include ('db_conn.php');
// Initialize clockInTime, clockOutTime, and totalWorkedHours
$clockInTime = null;
$clockOutTime = null;
$totalWorkedHours = null;

?>


<div class="page-wrapper">
<div class="content container-fluid">
<div class="page-name mb-4">
    <h4 class="m-0"><img src="assets/img/dashboard-profile.jpg" class="mr-1" alt="profile" /> Welcome <?php echo $employee_first_name; ?> (<?php echo $user_type = $_SESSION['user_type']; ?>)</h4>
    <label><?php echo date('D, d M Y'); ?></label> <!-- Change here to display the current date -->
</div>
<div class="row mb-4">
<div class="col-xl-6 col-sm-12 col-12">
<div class="breadcrumb-path ">
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-3" alt="breadcrumb" />Home</a>
</li>
<li class="breadcrumb-item active">Dashboard</li>
</ul>
<h3>Admin Dashboard</h3>
</div>
</div>
<div class="col-xl-6 col-sm-12 col-12">
<div class="row">
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-dash" href="#"> Admin Dashboard</a>
</div>

</div>
</div>
</div>

<!-- //attendance system -->
<h2>Attendance System</h2>
<p>Welcome, <?php echo htmlspecialchars($employee_first_name); ?>!</p>

<?php
date_default_timezone_set('Asia/Kolkata');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['type'])) {
    $user_id = $_POST['user_id'];
    $type = $_POST['type'];

    // Include database connection
    // include('../db_conn.php');

    try {
        // Fetch existing clock-in time and total worked hours from the database if available
        $query = "SELECT clock_in, total_worked_hr FROM attendance WHERE employee_id = :user_id AND clock_out IS NULL";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Initialize clock-in, clock-out times, and total worked hours
        $clockInTime = null;
        $clockOutTime = null;
        $totalWorkedHours = null;

        if ($row) {
            $clockInTime = $row['clock_in'];
            $totalWorkedHours = $row['total_worked_hr'];
        }

        // If clock-in time is not set and the user clicked Clock In
        if ($type == 'clock_in' && !$clockInTime) {
            $clockInTime = date('Y-m-d H:i:s');
            $insert_query = "INSERT INTO attendance (employee_id, clock_in) VALUES (:user_id, :clockInTime)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':clockInTime', $clockInTime);
            $stmt->execute();
            echo "Clocked in at: " . $clockInTime . "<br>";
        }

        // If clock-out time is set and the user clicked Clock Out
        if ($type == 'clock_out' && $clockInTime) {
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
            echo "Clocked out at: " . $clockOutTime . "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close database connection
        $conn = null;
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
?>

<?php 
// Check if the user is already clocked in
if ($clockInTime) {
    if ($type == 'clock_out') {
        echo "Now you are successfully clocked out";
    }
    else if ($type == 'clock_in') {
        echo "you are already successfully clocked In";
    }
    else {
        echo "you are already clocked in.";
        }
    }
    else if($clockOutTime) {
    echo "Now you are successfully clocked out";
    }
?>
<?php 
// include("sidebar.php");
// Check if the user is logged in
if (!isset($_SESSION['emp_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}    // Fetch the user details based on the stored user_id in the session
$user_id = $_SESSION['emp_id'];

// Close the database connection
// mysqli_close($conn);
?>
<form id="clockForm" method="POST" class="attendance-container">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <button type="submit" name="type" value="clock_in" class="clock-btn clock-in-btn">Clock In</button>
    <button type="submit" name="type" value="clock_out" class="clock-btn clock-out-btn">Clock Out</button>
</form>

<div id="workedHours" class="clocked-status">Worked Hours: <span id="hoursWorked"><?php echo $totalWorkedHours ?? '--:--:--'; ?></span></div>

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
<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary mr-1"></i> Business</p>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-success mr-1"></i> Testing</p>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger mr-1"></i> Development</p>
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
                                <img src="img/f.png" width="100%" />
                                <img src="img/Ellipsis.gif" width="80px">
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

<div class="col-xl-6 d-flex">
    <div class="card flex-fill">
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
            while ($employee = $query->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="birthday-item">';
                echo '<img src="' . $employee['profile_pic'] . '" alt="' . $employee['first_name'] . '">';
                echo '<div class="birthday-info">';
                echo '<p>' . $employee['first_name'] . '</p>';
                echo '<p class="birthday-date">Birthday: ' . date('F d', strtotime($employee['birth_date'])) . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>




<script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
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
                
                $.post('app/check.php', 
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

</body>
</html>