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
    
<?php include("sidebar.php") ?>

<div class="page-wrapper">
    <div class="content container-fluid">
    <div class="page-name mb-4">
    <h4 class="m-0"><img src="../assets/img/dashboard-profile.jpg" class="mr-1" alt="profile" /> Welcome <?php echo $employee_first_name; ?></h4>
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
<div class="col-xl-6 col-sm-12 col-12">
<div class="row">
<!-- <div class="col-xl-6 col-sm-6 col-12">
<a class="btn-emp" href="../index.php"> Admin Dashboard</a>
</div> -->
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-dash" href="#">Employee Dashboard</a>
</div>
</div>
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


</body>
</html>
