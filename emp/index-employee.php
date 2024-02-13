<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>
<link rel="shortcut icon" href="../assets/img/favicon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../assets/css/style.css">

<<<<<<< HEAD
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
=======
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
</style>
</head>
<body>

<?php
session_start();

// Check if the employee is logged in
if (!isset($_SESSION['emp_id'])) {
    // Redirect the user to the login page or handle authentication as per your requirement
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$dbname = "hrms";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password

try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 

    $stmt = $dbh->prepare("SELECT first_name FROM employees WHERE emp_id = :emp_id");
    $stmt->bindParam(':emp_id', $_SESSION['emp_id']);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    // Extract first name from the fetched data
    $employee_first_name = $employee['first_name'];
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
>>>>>>> c982c37 (Second update)
    
<?php include("sidebar.php") ?>

<div class="page-wrapper">
<<<<<<< HEAD
<div class="content container-fluid">
<div class="page-name 	mb-4">
<h4 class="m-0"><img src="../assets/img/profiles/avatar-14.jpg" class="mr-1" alt="profile" /> Welcome Maria</h4>
<label>Sun, 29 Nov 2019</label>
=======
    <div class="content container-fluid">
    <div class="page-name mb-4">
    <h4 class="m-0"><img src="../assets/img/dashboard-profile.jpg" class="mr-1" alt="profile" /> Welcome <?php echo $employee_first_name; ?></h4>
    <label><?php echo date('D, d M Y'); ?></label> <!-- Change here to display the current date -->
>>>>>>> c982c37 (Second update)
</div>
<div class="row mb-4">
<div class="col-xl-6 col-sm-12 col-12">
<div class="breadcrumb-path ">
<ul class="breadcrumb">
<<<<<<< HEAD
<li class="breadcrumb-item"><a href="index.php"><img src="../assets/img/dash.png" class="mr-3" alt="breadcrumb" />Home</a>
=======
<li class="breadcrumb-item"><a href="index-employee.php"><img src="../assets/img/dash.png" class="mr-3" alt="breadcrumb" />Home</a>
>>>>>>> c982c37 (Second update)
</li>
<li class="breadcrumb-item active">Dashboard</li>
</ul>
<h3>Employee Dashboard</h3>
</div>
</div>
<div class="col-xl-6 col-sm-12 col-12">
<div class="row">
<<<<<<< HEAD
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-emp" href="../index.php"> Admin Dashboard</a>
</div>
=======
<!-- <div class="col-xl-6 col-sm-6 col-12">
<a class="btn-emp" href="../index.php"> Admin Dashboard</a>
</div> -->
>>>>>>> c982c37 (Second update)
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-dash" href="#">Employee Dashboard</a>
</div>
</div>
</div>
</div>
<<<<<<< HEAD
<div class="row mb-4">
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill1 ">
<div class="card-body">
<div class="card_widget_header">
<label>Employees</label>
<h4>700</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash1.png" alt="card-img" />
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill2 ">
<div class="card-body">
<div class="card_widget_header">
<label>Companies</label>
<h4>30</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash2.png" alt="card-img" />
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill3 ">
<div class="card-body">
<div class="card_widget_header">
<label>Leaves</label>
<h4>9</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash3.png" alt="card-img" />
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill4 ">
<div class="card-body">
<div class="card_widget_header">
<label>Salary</label>
<h4>$5.8M</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash4.png" alt="card-img" />
</div>
</div>
</div>
</div>
</div>
=======

>>>>>>> c982c37 (Second update)
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
<<<<<<< HEAD
<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Total Salary By Unit</h5>
</div>
</div>
<div class="card-body">
<div id="sales_chart"></div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-6 col-sm-12 col-12 d-flex">
<div class="card card-list flex-fill">
<div class="card-header ">
<h4 class="card-title-dash">Your Upcoming Leave</h4>
<div class="dropdown">
<button class="btn btn-action " type="button" id="roomsBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-ellipsis-h"></i>
</button>
<div class="dropdown-menu" aria-labelledby="roomsBtn">
<a class="dropdown-item" href="#">Action</a>
</div>
</div>
</div>
<div class="card-body p-0">
<div class="leave-set">
<span class="leave-inactive">
<i class="fas fa-briefcase"></i>
</span>
<label>Mon, 16 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Fri, 20 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Wed, 25 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Fri, 27 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Tue, 31 Dec 2021</label>
</div>
<div class="leave-viewall">
<a href="leave.php">View all <img src="../assets/img/right-arrow.png" class="ml-2" alt="arrow" /></a>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-12 col-12 d-flex">
<div class="card card-list flex-fill">
<div class="card-header">
<div class="p-0  ">
<h4 class="card-title">Recent Activities</h4>
</div>
</div>
<div class="card-body dash-activity">
<div class="slimscroll activity_scroll">
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-02.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>2 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-05.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>3 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-07.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>4 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-08.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>5 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-09.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>6 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-10.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>2 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-12.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>3 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-13.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>4 hours ago</span>
</div>
</div>
</div>
<div class="leave-viewall activit">
<a>View all <img src="../assets/img/right-arrow.png" class="ml-2" alt="arrow"></a>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-12 col-12 d-flex">
<div class="card card-list flex-fill ">
<div class="card-header">
<h2 class="card-titles">Team Leads</h2>
<a class="manage-link">Manage Team</a>
</div>
<div class="card-body p-0">
<div class="manage-set">
<div class="manage-name">
<label>John Gibbs</label>
<span>PHP</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-21.jpg" alt="profile">
</div>
</div>
<div class="manage-set">
<div class="manage-name">
<label>Danny Ward</label>
<span>Design</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-20.jpg" alt="profile">
</div>
</div>
<div class="manage-set">
<div class="manage-name">
<label>Linda Craver</label>
<span>IOS</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-19.jpg" alt="profile">
</div>
</div>
<div class="manage-set">
<div class="manage-name">
<label>Jenni Sims</label>
<span>Android</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-18.jpg" alt="profile">
</div>
</div>
<div class="manage-set border-0">
<div class="manage-name">
<label>Maria Cotton</label>
<span>Business</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-17.jpg" alt="profile">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


=======

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

<script src="../js/jquery-3.2.1.min.js"></script>

>>>>>>> c982c37 (Second update)
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script src="../assets/js/feather.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="../assets/js/script.js"></script>
</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> c982c37 (Second update)
