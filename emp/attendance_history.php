<?php include("sidebar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance History</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<!-- Add other necessary stylesheets -->

<style>
    .page-wrapper {
        padding: 20px;
    }
    .content {
        background-color: #f3f3f3;
        padding: 20px;
    }
    h2 {
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    p {
        font-size: 18px;
        margin-bottom: 20px;
    }
</style>
</head>
<body>

<?php
// Include necessary files (e.g., database connection)
include('../db_conn.php');

// Start or resume session
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../login.php");
    exit();
}

// Retrieve user-specific attendance records from the database
$employee_id = $_SESSION['emp_id'];
$query = "SELECT * FROM attendance WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$employee_id]);

// Check for errors in the query result
if (!$stmt) {
    die("Query failed: " . $conn->errorInfo()[2]);
}
?>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2>Attendance History</h2>
                <?php
                if ($stmt->rowCount() > 0) {
                    echo '<div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>Total Worked Hours</th>
                                    </tr>
                                </thead>
                                <tbody>';

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . date("d-m-y") . "</td>";
                        echo "<td>" . date("H:i:s", strtotime($row['clock_in'])) . "</td>";
                        echo "<td>" . ($row['clock_out'] ? date("H:i:s", strtotime($row['clock_out'])) : "N/A") . "</td>";
                        echo "<td>" . $row['total_worked_hr'] . "</td>";
                        echo "</tr>";
                    }

                    echo '</tbody>
                        </table>
                        </div>';
                } else {
                    echo '<p>No attendance history available.</p>';
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
