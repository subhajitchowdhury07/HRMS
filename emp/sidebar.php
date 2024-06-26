<?php
// Start the session at the beginning of the file
session_start();
// Check if the user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../login.php");
    exit();
}

// Include the database connection file
include ('../db_conn.php');

// Fetch employee data if the session variable is set
if (isset($_SESSION['emp_id'])) {
    try {
        // Prepare and execute a query to fetch employee data
        $stmt = $conn->prepare("SELECT first_name, last_name FROM employees WHERE emp_id = :emp_id");
        $stmt->bindParam(':emp_id', $_SESSION['emp_id']);
        $stmt->execute();
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract first name and last name from the fetched data
        $employee_first_name = $employee['first_name'];
        $employee_last_name = $employee['last_name'];
    } catch (PDOException $e) {
        // Handle query errors
        echo "Error fetching employee data: " . $e->getMessage();
        // Exit or handle the error as appropriate
        exit();
    }
}

// Function to fetch profile picture URL based on emp_id
function fetchProfilePic($conn, $emp_id) {
    // Query to fetch profile picture URL
    $query = "SELECT profile_pic FROM employees WHERE emp_id = :emp_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':emp_id', $emp_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if profile picture URL exists
    if ($row && isset($row['profile_pic'])) {
        return $row['profile_pic'];
    } else {
        // Default profile picture URL if not found
        return "../assets/img/dashboard-profile.jpg";
    }
}

// Now you can output your HTML content
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Sedulous technology .pvt .ltd</title>

    <link rel="shortcut icon" href="../assets/img/sedulous-small-icon.png">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> -->
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

    <style>
    body {
        background-color: #fff;
        /* White background */
        color: #20509e;
        /* Blue text color */
        font-family: 'Poppins', sans-serif;
        /* Poppins font */
    }

    .user-img img {
        width: 50px;
        /* Adjust image size as needed */
        height: 50px;
        border-radius: 50%;
        /* Make the image round */
        margin-right: 10px;
        object-fit: cover;
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



</head>

<body>


    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="index-employee.php" class="logo">
                    <img src="../assets/img/logo2.png" alt="Logo">
                </a>
                <a href="index-employee.php" class="logo logo-small">
                    <img src="../assets/img/sedulous-small-icon.png" alt="Logo" width="30" height="30">
                </a>
                <a href="javascript:void(0);" id="toggle_btn">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
            </div>




            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>


            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <span class="user-img">
                            <img src="<?php echo fetchProfilePic($conn, $_SESSION['emp_id']); ?>" alt="">
                            <span class="status online"></span>
                        </span>

                        <span><?php echo $employee_first_name; ?> <?php echo $employee_last_name; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php"><i data-feather="user" class="mr-1"></i> Profile</a>
                        <a class="dropdown-item" href="profile-setting.php"><i data-feather="settings" class="mr-1"></i>
                            Settings</a>
                        <a class="dropdown-item" href="../logout.php"><i data-feather="log-out" class="mr-1"></i>
                            Logout</a>
                    </div>
                </li>

            </ul>

            <!-- <div>
        <div class="rounded-plus-icon">
            <a href="#">+</a>
        </div>
    </div> -->



            <div class="dropdown mobile-user-menu show">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right ">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="settings.php">Settings</a>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>

        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div class="sidebar-contents">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <div class="mobile-show">
                            <div class="offcanvas-menu">
                                <div class="user-info align-center bg-theme text-center">
                                    <span class="lnr lnr-cross  text-white" id="mobile_btn_close">X</span>
                                    <a href="javascript:void(0)" class="d-block menu-style text-white">
                                        <div class="user-avatar d-inline-block mr-3">
                                            <img style="width: 100px; height: 100px; border:4px solid white ;border-radius: 50%; object-fit: cover;"
                                                src="<?php echo fetchProfilePic($conn, $_SESSION['emp_id']); ?>"
                                                alt="user avatar" class="rounded-circle" width="50">
                                            <br>
                                            <br>
                                            <span><b><?php echo $employee_first_name; ?>
                                                    <?php echo $employee_last_name; ?></b></span>

                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <a href="index-employee.php"><img src="../assets/img/home.svg" alt="sidebar_img">
                                    <span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="timesheet.php"><img src="../assets/img/home.svg" alt="sidebar_img">
                                    <span>Timesheet</span></a>
                            </li>
                            
                            <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='manager'): ?>
    <li><a href="add_task.php"><img src="../assets/img/addtask.svg" alt="sidebar_img"> <span>Add task</span></a></li>
    <?php endif; ?>
                            <li>
                                <a href="view_tasks.php"><img src="../assets/img/addtask.svg" alt="sidebar_img">
                                    <span>Tasks</span></a>
                            </li>
                            <!-- <li>
<a href="employee.php"><img src="../assets/img/employee.svg" alt="sidebar_img"><span> Employees</span></a>
</li> -->
                            <!-- <li>
<a href="company.html"><img src="assets/img/company.svg" alt="sidebar_img"> <span> Company</span></a>
</li> -->
                            <li>
                                <a href="calendar.php"><img src="../assets/img/calendar.svg" alt="sidebar_img">
                                    <span>Calendar</span></a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="../assets/img/leave.svg" alt="sidebar_img"> <span>Leave</span>
                                </a>
                                <ul>
                                    <li><a href="leave.php">Holiday List</a></li>
                                    <li><a href="leave_application_form.php">Apply Leave</a></li>
                                    <li><a href="leave_history.php">Leave History</a></li>
                                    <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='manager'): ?>
                                    <li><a href="leave_management_system.php">Leave management</a></li>
                                    <?php endif; ?>

                                    <!-- Add more leave types as needed -->
                                </ul>
                            </li>

                            <li>
                                <a href="#">
                                    <img src="../assets/img/leave.svg" alt="sidebar_img"> <span>Employee</span>
                                </a>
                                <ul>
                                    <li><a href="emp_member.html">Directory</a></li>
                                    <li><a href="profile-graph.html">Organization Chart</a></li>
                                    <!-- Add more leave types as needed -->
                                </ul>
                            </li>
                            <!-- <li>
    <a href="leave.php">
        <img src="assets/img/leave.svg" alt="sidebar_img"> <span>Time off</span>
    </a>
    <ul>
        <li><a href="#">My Time off</a></li>
        <li><a href="#">Team Time off</a></li>
       
    </ul>
</li> -->
                            <li>
                                <a href="#">
                                    <img src="../assets/img/attendance.svg" alt="sidebar_img"> <span>Attendance</span>
                                </a>
                                <ul>
                                    <li><a href="../attendance.php">My Attendance</a></li>
                                    <!-- <li><a href="View_attendance.php">Team Attendance</a></li> -->
                                    <li><a href="attendance_history.php">Attendance History</a></li>
                                    <!-- Add more leave types as needed -->
                                </ul>
                            </li>
                            <!-- <li>
    <a href="#">
        <img src="assets/img/leave.svg" alt="sidebar_img"> <span>Goal</span>
    </a>
    <ul>
        <li><a href="#">My Goal</a></li>
        <li><a href="#">Team Goal</a></li>
        
    </ul>
</li> -->


                            <!-- <li>
    <a href="calculate_salary.php"><img src="../assets/img/calculator.svg" alt="sidebar_img"> <span>Salary Calculator</span></a>
</li> -->
                            <!-- <li>
    <a href="#"><img src="../assets/img/calculator.svg" alt="sidebar_img"> <span>Update</span></a>
</li> -->
                            <!-- <li>
<a href="review.html"><img src="assets/img/review.svg" alt="sidebar_img"><span>Review</span></a>
</li>
<li>
<a href="report.html"><img src="assets/img/report.svg" alt="sidebar_img"><span>Report</span></a>
</li>
<li>
<a href="manage.html"><img src="assets/img/manage.svg" alt="sidebar_img"> <span>Manage</span></a>
</li> -->
                            <!-- <li>
<a href="settings.php"><img src="../assets/img/settings.svg" alt="sidebar_img"><span>Settings</span></a>
</li> -->
                            <li>
                                <a href="profile.php"><img src="../assets/img/profile.svg" alt="sidebar_img">
                                    <span>Profile</span></a>
                            </li>
                        </ul>
                        <ul class="logout">
                            <li>
                                <a href="../logout.php"><img src="../assets/img/logout.svg" alt="sidebar_img"><span>Log
                                        out</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

        </body>
<!-- Move this script to the end of the body tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="../assets/plugins/apexchart/chart-data.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Get the current URL
        var currentUrl = window.location.pathname;

        // Loop through each anchor tag in the navigation menu
        $('.sidebar-menu a').each(function() {
            // Get the href attribute of the anchor tag
            var linkUrl = $(this).attr('href');

            // Check if the current URL contains the href attribute
            if (currentUrl.includes(linkUrl)) {
                // Add the 'active' class to the parent <li> element
                $(this).closest('li').addClass('active');
            }
        });
    });
</script>

</html>
