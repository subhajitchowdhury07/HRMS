<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Check if an employee is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: employee_login.php"); // Redirect to the employee login page
    exit();
}

$emp_id = $_SESSION['emp_id'];

// Fetch leave requests for the logged-in employee
$sql = "SELECT * FROM leaves WHERE emp_id = $emp_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leave Details</title>
</head>
<body>

<!-- Employee Section: Leave Details -->
<h2>Your Leave Requests</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Leave Type</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Description</th>
        <th>Status</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["leave_type"] . "</td>";
            echo "<td>" . $row["from_date"] . "</td>";
            echo "<td>" . $row["to_date"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No leave requests</td></tr>";
    }
    ?>
</table>

<a href="employee_logout.php">Logout</a>

</body>
</html>
