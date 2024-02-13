<?php
// Include necessary files (e.g., database connection)

$host = "localhost"; // Replace with your database host (usually "localhost")
$user = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "hrms"; // Replace with your database name

// Create a database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start or resume session
session_start();

// Check if the user is logged in
<<<<<<< HEAD
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user-specific leave records from the database
$employee_id = $_SESSION['user_id'];
$query = "SELECT * FROM leave_history WHERE employee_id = $employee_id";
=======
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// Retrieve user-specific leave records from the database
$employee_id = $_SESSION['emp_id'];
$query = "SELECT * FROM leave_history WHERE employee_id = '$employee_id'";
>>>>>>> c982c37 (Second update)
$result = mysqli_query($conn, $query);

// Check for errors in the query result
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Display leave history
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Add other necessary stylesheets -->
</head>

<body>

    <?php include("sidebar.php"); ?>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>Leave History</h2>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table">
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['leave_type'] . "</td>";
                            echo "<td>" . $row['start_date'] . "</td>";
                            echo "<td>" . $row['end_date'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }

                        echo '</tbody>
                            </table>';
                    } else {
                        echo '<p>No leave history available.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Add other necessary scripts -->

</body>

</html>
