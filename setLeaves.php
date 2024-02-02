<?php
session_start();

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to add a new leave type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_leave_type'])) {
    $leaveType = $_POST['leave_type'];
    $description = $_POST['description'];

    // Perform validation and insert into the database
    $sql = "INSERT INTO tableleaves (Leavetype, Description, CreationDate) VALUES ('$leaveType', '$description', NOW())";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Leave type added successfully";
    } else {
        $error_message = "Error adding leave type: " . $conn->error;
    }
}

// Fetch all leave types from the database
$sql = "SELECT * FROM tableleaves";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include('sidebar.php');?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manage Leave Types</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                // Display success or error messages
                                if (isset($success_message)) {
                                    echo '<div style="color: green; margin-bottom: 10px;">' . $success_message . '</div>';
                                }
                                if (isset($error_message)) {
                                    echo '<div style="color: red; margin-bottom: 10px;">' . $error_message . '</div>';
                                }
                                ?>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="leave_type">Leave Type:</label>
                                        <input type="text" class="form-control" id="leave_type" name="leave_type" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="add_leave_type">Add Leave Type</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List of Leave Types</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <?php
                                    // Display the list of leave types
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<li>' . '<b>' . $row['LeaveType'] .'</b>'. ' - ' . $row['Description'] . ' - ' . $row['CreationDate'] . '</li>';
                                        }
                                    } else {
                                        echo '<li>No leave types found</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap
