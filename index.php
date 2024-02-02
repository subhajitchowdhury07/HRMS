<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>

<link rel="shortcut icon" href="assets/img/favicon.png">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">
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


</head>
<body>

	<?php
$servername = "localhost";
$dbname = "hrms";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password

try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


<div class="main-wrapper">

<div class="header">

<div class="header-left">
<a href="index.php" class="logo">
<img src="assets/img/logo2.png" alt="Logo">
</a>
<a href="index.php" class="logo logo-small">
<img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
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
<img src="assets/img/profile2.jpg" alt="">
<span class="status online"></span>
</span>
<span>subhajit chowdhury</span>
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="profile.html"><i data-feather="user" class="mr-1"></i> Profile</a>
<a class="dropdown-item" href="settings.php"><i data-feather="settings" class="mr-1"></i> Settings</a>
<a class="dropdown-item" href="login.php"><i data-feather="log-out" class="mr-1"></i> Logout</a>
</div>
</li>

</ul>

<div class="custom-menu-bar">
        <div class="custom-menu-item">
            <a href="#">Employee</a>
            <div class="custom-dropdown">
                <a href="emp_member.html">Directory</a>
                <a href="profile-graph.html">Organization Chart</a>
            </div>
        </div>

        <div class="custom-menu-item">
            <a href="#">Time off</a>
            <div class="custom-dropdown">
                <a href="#">My Time off</a>
                <a href="#">Team Time off</a>
            </div>
        </div>

        <div class="custom-menu-item">
            <a href="#">Attendance</a>
            <div class="custom-dropdown">
                <a href="#">My Attendance</a>
                <a href="#">Team Attendance</a>
            </div>
        </div>

        <div class="custom-menu-item">
            <a href="#">Goal</a>
            <div class="custom-dropdown">
                <a href="#">My Goal</a>
                <a href="#">Team Goal</a>
            </div>
        </div>

        <div class="custom-menu-item">
            <a href="#">Documents</a>
            <div class="custom-dropdown">
                <a href="#">My Documents</a>
                <a href="#">Team Documents</a>
            </div>
        </div>

        <div class="custom-menu-item">
            <a href="#">Update</a>
        </div>
        <div class="rounded-plus-icon">
            <a href="#">+</a>
        </div>
    </div>



<div class="dropdown mobile-user-menu show">
<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu dropdown-menu-right ">
<a class="dropdown-item" href="profile.html">My Profile</a>
<a class="dropdown-item" href="settings.php">Settings</a>
<a class="dropdown-item" href="login.php">Logout</a>
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
<img src="assets/img/profiles/avatar-18.jpg" alt="user avatar" class="rounded-circle" width="50">
</div>
</a>
</div>
</div>
 </div>
<ul>
<li class="active">
<a href="index.php"><img src="assets/img/home.svg" alt="sidebar_img"> <span>Dashboard</span></a>
</li>
<li>
<a href="employee.php"><img src="assets/img/employee.svg" alt="sidebar_img"><span> Employees</span></a>
</li>
<!-- <li>
<a href="company.html"><img src="assets/img/company.svg" alt="sidebar_img"> <span> Company</span></a>
</li> -->
<li>
<a href="calendar.php"><img src="assets/img/calendar.svg" alt="sidebar_img"> <span>Calendar</span></a>
</li>
<li>
    <a href="leave.php">
        <img src="assets/img/leave.svg" alt="sidebar_img"> <span>Leave</span>
    </a>
    <ul>
        <li><a href="leave_management_system.php">Leave Management</a></li>
        <li><a href="setLeaves.php">Manage Leave Type</a></li>
        <!-- Add more leave types as needed -->
    </ul>
</li>
<li>
<li>
	<a href="calculate_salary.php"><img src="assets/img/calculator.svg" alt="sidebar_img"> <span>Salary Calculator</span></a>
</li>
<!-- <li>
<a href="review.html"><img src="assets/img/review.svg" alt="sidebar_img"><span>Review</span></a>
</li>
<li>
<a href="report.html"><img src="assets/img/report.svg" alt="sidebar_img"><span>Report</span></a>
</li> -->
<!-- <li>
<a href="manage.html"><img src="assets/img/manage.svg" alt="sidebar_img"> <span>Manage</span></a>
</li> -->
<li>
<a href="settings.php"><img src="assets/img/settings.svg" alt="sidebar_img"><span>Settings</span></a>
</li>
<li>
<a href="profile.php"><img src="assets/img/profile.svg" alt="sidebar_img"> <span>Profile</span></a>
</li>
</ul>
<ul class="logout">
<li>
<a href="login.php"><img src="assets/img/logout.svg" alt="sidebar_img"><span>Log out</span></a>
</li>
</ul>
</div>
</div>
</div>
</div>


<div class="page-wrapper">
<div class="content container-fluid">
<div class="page-name 	mb-4">
<h4 class="m-0"><img src="assets/img/profile2.jpg" class="mr-1" alt="profile" /> Welcome Admin</h4>
<label>Sun, 29 Nov 2019</label>
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
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-emp" href="emp/index-employee.php">Employee Dashboard</a>
</div>
</div>
</div>
</div>


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
$conn = new mysqli("localhost", "root", "", "hrms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch count of pending leave requests
$sqlPendingLeaves = "SELECT COUNT(*) AS pendingCount FROM leaves WHERE status NOT IN ('Approved', 'Rejected')";
$resultPendingLeaves = $conn->query($sqlPendingLeaves);

$pendingCount = 0;
if ($resultPendingLeaves->num_rows > 0) {
    $rowPendingLeaves = $resultPendingLeaves->fetch_assoc();
    $pendingCount = $rowPendingLeaves['pendingCount'];
}

$conn->close();
?>
<!-- Your HTML structure with the calculated pending leaves count -->
<a href="leave_management_system.php" style="text-decoration: none; color: inherit;">

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


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>